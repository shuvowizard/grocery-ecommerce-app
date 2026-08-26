<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderPlacedMail;
use App\Models\CouponCode;
use App\Models\DeliveryOption;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductVariation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    /**
     * Step 1 (Initial Step):  Validate billing form, then decide flow based on payment method.
     */
    public function placeOrder(Request $request)
    {
        if (!$request->has('payment_method')) {
            return redirect()->route('checkout')->with('warning', 'Please select a payment method.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'zip' => 'required|string',
            'order_notes' => 'nullable|string',
            'delivery_option_id' => 'required|exists:delivery_options,id',
            'payment_method' => 'required|in:paypal,stripe,cod',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        // Billing info + Cart summary will temporarily store in session. Later we'll use these to create an order and order details.
        session()->put('checkout_data', $request->only([
            'name',
            'email',
            'phone',
            'address',
            'country',
            'state',
            'city',
            'zip',
            'order_notes',
            'delivery_option_id',
            'payment_method',
        ]));

        if ($request->payment_method === 'paypal') {
            return $this->redirectToPaypal();
        }

        if ($request->payment_method === 'stripe') {
            return $this->redirectToStripe();
        }

        if ($request->payment_method === 'cod') {
            return $this->createOrder('cod', 'pending', null);
        }

        return back()->with('error', 'This payment method is not available yet.');
    }

    /**
     * Step 2 (PayPal only): Create a PayPal order and redirect the user to PayPal.
     */
    private function redirectToPaypal()
    {
        $cart = session('cart', []);
        $checkoutData = session('checkout_data');

        $subtotal = 0;
        foreach ($cart as $item) {
            $variation = ProductVariation::find($item['product_variation_id']);
            $subtotal += ($variation->sale_price ?? 0) * $item['quantity'];
        }

        $discountAmount = session('coupon')['discount_amount'] ?? 0;
        $delivery = DeliveryOption::find($checkoutData['delivery_option_id']);
        $deliveryCharge = $delivery->charge;
        $total = ($subtotal - $discountAmount) + $deliveryCharge;

        try {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal.success'),
                    "cancel_url" => route('paypal.cancel'),
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => number_format($total, 2, '.', ''),
                        ],
                    ]
                ],
            ]);

            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            }

            // Fallback Return: If Response get but "approve" link not found
            Log::error('PayPal order creation failed: ' . json_encode($response));
            return back()->with('error', 'Could not connect to PayPal. Please try again.');

        } catch (Exception $e) {
            // try/catch - unexpected crash (network, timeout, credentials etc...)
            Log::error('PayPal order creation failed: ' . $e->getMessage());
            return redirect()->route('checkout')->with('error', 'Could not connect to PayPal. Please try again.');
        }
    }

    /**
     * Step 3 (PayPal only): PayPal redirects back here after user approves payment.
     */
    public function paypalSuccess(Request $request)
    {
        try {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();

            $response = $provider->capturePaymentOrder($request->token);

            if (isset($response['status']) && $response['status'] === 'COMPLETED') {
                $transactionId = $response['id'];
                $currencyCode = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'] ?? 'USD';
                return $this->createOrder('paypal', 'paid', $transactionId, $currencyCode);
            }

            return redirect()->route('checkout')->with('error', 'Payment was not completed. Please try again.');

        } catch (Exception $e) {
            // try/catch - unexpected crash (network, timeout, credentials etc...)
            Log::error('PayPal payment capture failed: ' . $e->getMessage());
            return redirect()->route('checkout')->with('error', 'Payment was not completed. Please try again.');
        }
    }

    public function paypalCancel()
    {
        return redirect()->route('checkout')->with('error', 'You cancelled the PayPal payment.');
    }

    /**
     * Step 4 (Stripe only): Create a Stripe Checkout Session and redirect the user.
     */
    private function redirectToStripe()
    {
        $cart = session()->get('cart', []);
        $checkoutData = session('checkout_data');

        $subtotal = 0;
        foreach ($cart as $item) {
            $variation = ProductVariation::find($item['product_variation_id']);
            $subtotal += ($variation->sale_price ?? 0) * $item['quantity'];
        }

        $discountAmount = session('coupon')['discount_amount'] ?? 0;
        $delivery = DeliveryOption::find($checkoutData['delivery_option_id']);
        $deliveryCharge = $delivery->charge;
        $total = ($subtotal - $discountAmount) + $deliveryCharge;

        try {
            // Make Client Object using STRIPE secret API key
            $stripe = new StripeClient(config('stripe.stripe_secret_key'));

            // Create checkout session using the Client Object
            $session = $stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'Order Total',
                            ],
                            'unit_amount' => (int) round($total * 100),
                        ],
                        'quantity' => 1,
                    ]
                ],
                'mode' => 'payment',
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel'),
            ]);

            return redirect()->away($session->url);

        } catch (Exception $e) {
            Log::error('Stripe session creation failed: ' . $e->getMessage());
            return redirect()->route('checkout')->with('error', 'Could not connect to Stripe. Please try again.');
        }
    }

    /**
     * Step 5 (Stripe only): Stripe redirects back here after successful payment.
     */
    public function stripeSuccess(Request $request)
    {
        try {
            $stripe = new StripeClient(config('stripe.stripe_secret_key'));

            $session = $stripe->checkout->sessions->retrieve($request->session_id);

            if ($session->payment_status === 'paid') {
                $currencyCode = strtoupper($session->currency ?? 'USD');
                return $this->createOrder('stripe', 'paid', $session->payment_intent, $currencyCode);
            }

            return redirect()->route('checkout')->with('error', 'Payment was not completed. Please try again.');
        } catch (Exception $e) {
            Log::error('Stripe session retrieve failed: ' . $e->getMessage());
            return redirect()->route('checkout')->with('error', 'Payment was not completed. Please try again.');
        }
    }

    public function stripeCancel()
    {
        return redirect()->route('checkout')->with('error', 'You cancelled the Stripe payment.');
    }

    /**
     * Step 6 (Shared): Create the Order + OrderDetails, reduce stock, clear cart.
     * Used by PayPal, Stripe, COD (Cash on Delivery)
     */
    private function createOrder(string $paymentMethod, string $paymentStatus, ?string $transactionId, string $currencyCode = 'USD')
    {
        $cart = session()->get('cart', []);
        $checkoutData = session('checkout_data');

        if (empty($cart) || !$checkoutData) {
            return redirect()->route('cart')->with('error', 'Your cart session has expired.');
        }

        // Recalculate subtotal from cart (never trust client-side values)
        $subtotal = 0;
        foreach ($cart as $item) {
            $variation = ProductVariation::find($item['product_variation_id']);
            $subtotal += ($variation->sale_price ?? 0) * $item['quantity'];
        }

        // Coupon snapshot
        $appliedCoupon = session('coupon');
        $couponCode = null;
        $couponDiscountType = null;
        $couponDiscountValue = 0;
        $couponDiscountAmount = 0;

        if ($appliedCoupon) {
            $coupon = CouponCode::find($appliedCoupon['id']);
            if ($coupon) {
                $couponCode = $coupon->code;
                $couponDiscountType = $coupon->discount_type;
                $couponDiscountValue = $coupon->discount_value;
                $couponDiscountAmount = $appliedCoupon['discount_amount'];
            }
        }

        $delivery = DeliveryOption::find($checkoutData['delivery_option_id']);
        $deliveryCharge = $delivery->charge;
        $total = ($subtotal - $couponDiscountAmount) + $deliveryCharge;

        try {
            // 1. Start DB Transaction
            DB::beginTransaction();
            // Create the order
            $order = Order::create([
                'user_id' => auth('web')->id(),
                'order_no' => 'ORD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
                'payment_method' => $paymentMethod,
                'payment_status' => $paymentStatus,
                'transaction_id' => $transactionId,
                'currency' => $currencyCode,
                'subtotal_price' => round($subtotal, 2),
                'delivery_option_cost' => $deliveryCharge,
                'coupon_code' => $couponCode,
                'coupon_discount_type' => $couponDiscountType,
                'coupon_discount_value' => $couponDiscountValue,
                'coupon_discount_amount' => round($couponDiscountAmount, 2),
                'total_price' => round($total, 2),
                'billing_name' => $checkoutData['name'],
                'billing_email' => $checkoutData['email'],
                'billing_phone' => $checkoutData['phone'],
                'billing_address' => $checkoutData['address'],
                'billing_country' => $checkoutData['country'],
                'billing_state' => $checkoutData['state'],
                'billing_city' => $checkoutData['city'],
                'billing_zip' => $checkoutData['zip'],
                'note' => $checkoutData['order_notes'] ?? null,
                'status' => 'pending',
            ]);

            // Create order details + reduce stock
            foreach ($cart as $item) {
                $variation = ProductVariation::with('product')->find($item['product_variation_id']);

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $variation->product->id,
                    'product_variation_id' => $variation->id,
                    'product_name' => $variation->product->name,
                    'label' => $variation->label,
                    'sale_price' => $variation->sale_price,
                    'quantity' => $item['quantity'],
                    'total_price' => $variation->sale_price * $item['quantity'],
                ]);

                // Reduce stock
                $variation->decrement('stock', $item['quantity']);
            }

            // Increment coupon usage count
            if ($appliedCoupon) {
                $coupon = CouponCode::find($appliedCoupon['id']);
                $coupon?->increment('used_count');
            }

            // 2. Commit DB Transaction
            DB::commit();

        } catch (Exception $e) {
            // 3. If any query fails or throws exception, then Rollback DB Transaction
            DB::rollBack();

            Log::error('Order creation failed: ' . $e->getMessage());
            return redirect()->route('checkout')->with('error', 'Order creation failed due to a system error. Please try again.');
        }

        // Send order confirmation email
        try {
            Mail::to($order->billing_email)->send(new OrderPlacedMail($order));
        } catch (Exception $e) {
            Log::error('Order confirmation email failed: ' . $e->getMessage());
        }

        // Clear session data
        session()->forget(['cart', 'coupon', 'checkout_data', 'delivery_option_id', 'delivery_option_charge']);

        return redirect()->route('orders')->with('success', 'Order placed successfully!');
    }
}
