<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CouponCode;
use App\Models\DeliveryOption;
use App\Models\ProductVariation;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Recalculate the currently applied coupon's discount based on a new subtotal.
     * Also updates the session with the new discount amount.
     * Returns 0 if no coupon is applied.
     */
    private function recalculateCouponDiscount(float $subtotal): float
    {
        $appliedCoupon = session('coupon');

        if (!$appliedCoupon) {
            return 0;
        }

        $coupon = CouponCode::find($appliedCoupon['id']);

        // If the coupon has been deleted or is inactive then forget it from the session
        if (!$coupon || !$coupon->status) {
            session()->forget('coupon');
            return 0;
        }

        if ($coupon->discount_type === 'percentage') {
            $discount = $subtotal * ($coupon->discount_value / 100);
        } else {
            $discount = $coupon->discount_value;
        }

        // If the discount is greater than the subtotal then set it to the subtotal
        if ($discount > $subtotal) {
            $discount = $subtotal;
        }

        // Update the session
        session()->put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'discount_amount' => $discount,
        ]);

        return $discount;
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_variation_id' => 'required|exists:product_variations,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $variation = ProductVariation::findOrFail($request->product_variation_id);
        if ($variation->stock == 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product is out of stock.',
            ], 422);
        }

        $quantity = $request->quantity ?? 1;

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_variation_id])) {
            $newQuantity = $cart[$request->product_variation_id]['quantity'] + $quantity;

            // Stock Check after adding new Quantity
            if ($newQuantity > $variation->stock) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No more stock available for this product.',
                ], 422);
            }

            $cart[$request->product_variation_id]['quantity'] = $newQuantity;
        } else {
            // Stock Check after adding new Variation Item
            if ($quantity > $variation->stock) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No more stock available for this product.',
                ], 422);
            }

            $cart[$request->product_variation_id] = [
                'product_id' => $request->product_id,
                'product_variation_id' => $request->product_variation_id,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        Wishlist::where('user_id', auth('web')->id())->where('product_id', $request->product_id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart successfully!',
            'cart_count' => collect($cart)->sum('quantity'),
            'wishlist_count' => Wishlist::where('user_id', auth('web')->id())->count(),
        ]);
    }

    public function cart()
    {
        $cart = session()->get('cart', []);

        $variationIds = collect($cart)->pluck('product_variation_id')->unique()->values();

        $variations = ProductVariation::whereIn('id', $variationIds)
            ->with('product')
            ->get()
            ->keyBy('id');

        // Delivery charge
        $delivery_options = DeliveryOption::where('status', 1)->first();
        if (!session()->has('delivery_option_id') && $delivery_options) {
            session()->put('delivery_option_id', $delivery_options->id);
            session()->put('delivery_option_charge', $delivery_options->charge);
        }

        $appliedCoupon = session('coupon');
        return view('frontend.pages.cart', compact('cart', 'variations', 'appliedCoupon'));
    }

    public function cartUpdate(Request $request)
    {
        $request->validate([
            'product_variation_id' => 'required|exists:product_variations,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $variationId = $request->product_variation_id;

        if (!isset($cart[$variationId])) {
            return response()->json(['status' => false, 'message' => 'Item not found in cart.'], 404);
        }

        // Quantity never less than 1
        if ($request->quantity < 1) {
            return response()->json(['status' => false, 'message' => 'Quantity cannot be less than 1.'], 422);
        }

        // Quantity never greater than stock
        $variation = ProductVariation::find($variationId);
        if ($request->quantity > $variation->stock) {
            return response()->json([
                'status' => false,
                'message' => 'Only ' . $variation->stock . ' items available in stock.',
            ], 422);
        }

        $cart[$variationId]['quantity'] = $request->quantity;
        session()->put('cart', $cart);

        // Subtotal calculation
        $subtotal = 0;
        foreach ($cart as $item) {
            $v = ProductVariation::find($item['product_variation_id']);
            $subtotal += ($v->sale_price ?? 0) * $item['quantity'];
        }

        // Recalculate coupon discount (if a coupon is applied) based on the new subtotal
        $discount = $this->recalculateCouponDiscount($subtotal);

        $deliveryCharge = session('delivery_option_charge', 0);
        $total = ($subtotal - $discount) + $deliveryCharge;

        return response()->json([
            'status' => true,
            'message' => 'Cart updated successfully!',
            'subtotal' => $subtotal,
            'item_total' => $variation->sale_price * $request->quantity,
            'cart_count' => collect($cart)->sum('quantity'),
            'discount_amount' => $discount,
            'total' => $total,
        ]);
    }

    public function cartItemRemove(Request $request)
    {
        $request->validate([
            'product_variation_id' => 'required|exists:product_variations,id',
        ]);

        $cart = session()->get('cart', []);
        $variationId = $request->product_variation_id;

        if (!isset($cart[$variationId])) {
            return response()->json(['status' => false, 'message' => 'Item not found in cart.'], 404);
        }

        unset($cart[$variationId]);
        session()->put('cart', $cart);

        // Subtotal calculation
        $subtotal = 0;
        foreach ($cart as $item) {
            $v = ProductVariation::find($item['product_variation_id']);
            $subtotal += ($v->sale_price ?? 0) * $item['quantity'];
        }

        // Recalculate coupon discount based on new subtotal
        $discount = $this->recalculateCouponDiscount($subtotal);

        $deliveryCharge = session('delivery_option_charge', 0);
        $total = ($subtotal - $discount) + $deliveryCharge;

        return response()->json([
            'status' => true,
            'message' => 'Item removed from cart.',
            'subtotal' => $subtotal,
            'cart_count' => collect($cart)->sum('quantity'),
            'discount_amount' => $discount,
            'total' => $total,
        ]);
    }

    public function cartClear(Request $request)
    {
        session()->forget('cart');

        return response()->json([
            'status' => true,
            'message' => 'Cart cleared successfully!',
            'cart_count' => 0,
        ]);
    }

    // Coupon Code Apply
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'subtotal' => 'required|numeric|min:0',
        ]);

        $coupon = CouponCode::where('code', strtoupper($request->code))->first();

        if (!$coupon) {
            return response()->json(['status' => false, 'message' => 'Invalid coupon code.'], 404);
        }
        if (!$coupon->status) {
            return response()->json(['status' => false, 'message' => 'This coupon is inactive.'], 422);
        }
        if ($coupon->starts_at && now()->lt($coupon->starts_at)) {
            return response()->json(['status' => false, 'message' => 'This coupon is not active yet.'], 422);
        }
        if ($coupon->expires_at && now()->gt($coupon->expires_at)) {
            return response()->json(['status' => false, 'message' => 'This coupon has expired.'], 422);
        }
        if ($coupon->usage_limit !== null && $coupon->used_count >= $coupon->usage_limit) {
            return response()->json(['status' => false, 'message' => 'This coupon has reached its usage limit.'], 422);
        }

        $subtotal = $request->subtotal;

        // Discount calculation
        if ($coupon->discount_type === 'percentage') {
            $discount = $subtotal * ($coupon->discount_value / 100);
        } else {
            $discount = $coupon->discount_value;
        }

        // Discount never greater than subtotal
        if ($discount > $subtotal) {
            $discount = $subtotal;
        }

        // Save data in session
        session()->put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'discount_amount' => $discount,
        ]);

        $deliveryCharge = session('delivery_option_charge', 0);
        $total = ($subtotal - $discount) + $deliveryCharge;

        return response()->json([
            'status' => true,
            'message' => 'Coupon applied successfully!',
            'coupon_code' => $coupon->code,
            'discount_amount' => $discount,
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }

    public function removeCoupon(Request $request)
    {
        session()->forget('coupon');

        $subtotal = $request->subtotal ?? 0;
        $deliveryCharge = session('delivery_option_charge', 0);
        $total = $subtotal + $deliveryCharge;

        return response()->json([
            'status' => true,
            'message' => 'Coupon removed.',
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }
}
