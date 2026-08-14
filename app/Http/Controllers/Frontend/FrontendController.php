<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CouponCode;
use App\Models\DeliveryOption;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->orderBy('name', 'asc')->get();
        $products = Product::where('status', 1)->with(['category', 'variations'])->latest()->get();
        return view('home', ['categories' => $categories, 'products' => $products]);
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function faq()
    {
        return view('frontend.pages.faq');
    }

    public function blog()
    {
        return view('frontend.pages.blog');
    }

    public function post($slug)
    {
        return view('frontend.pages.post', compact('slug'));
    }

    public function terms()
    {
        return view('frontend.pages.terms');
    }

    public function privacy()
    {
        return view('frontend.pages.privacy');
    }

    public function products(Request $request)
    {
        $categories = Category::orderBy('name', 'asc')->get();

        $hasPriceFilter = $request->filled('min_price') || $request->filled('max_price');
        $min = $request->filled('min_price') ? $request->min_price : 0;
        $max = $request->filled('max_price') ? $request->max_price : ProductVariation::max('sale_price'); # Get the maximum sale price of all product variations if max_price is not provided

        $products = Product::with(['category'])
            ->with([
                'variations' => function ($query) use ($hasPriceFilter, $min, $max) {
                    if ($hasPriceFilter) {
                        $query->whereBetween('sale_price', [$min, $max]);
                    }
                    $query->orderBy('sale_price', 'asc');
                }
            ])
            ->withMin('variations', 'sale_price') # Get the minimum sale price of variations on the product table and alias it as `variations_min_sale_price` 
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($query) use ($request) {
                    $query->where('slug', $request->category);
                });
            })
            ->when($hasPriceFilter, function ($query) use ($min, $max) {
                $query->whereHas('variations', function ($query) use ($min, $max) {
                    $query->whereBetween('sale_price', [$min, $max]);
                });
            })
            ->when(
                $request->filled('sort_by'),
                function ($query) use ($request) {
                    match ($request->sort_by) {
                        'price_asc' => $query->orderBy('variations_min_sale_price'),
                        'price_desc' => $query->orderByDesc('variations_min_sale_price'),
                        'name_asc' => $query->orderBy('name'),
                        'name_desc' => $query->orderByDesc('name'),
                        default => $query->latest(),
                    };
                },
                fn($query) => $query->latest()  // Fallback callback, to order by latest if no sort_by parameter is provided
            )
            ->paginate(6);

        return view('frontend.pages.products', compact('categories', 'products'));
    }

    public function product(string $slug)
    {
        $product = Product::where('slug', $slug)->with(['category', 'variations'])->firstOrFail();

        $relatedProducts = Product::with(['category', 'variations'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->orderBy('id', 'asc')
            ->take(4)
            ->get();

        return view('frontend.pages.product', compact('product', 'relatedProducts'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (!auth()->guard('web')->check()) {
            return redirect()->route('login')->with('error', 'Please login to checkout.');
        }
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $delivery_options = DeliveryOption::orderBy('id', 'asc')->get();

        $variationIds = collect($cart)->pluck('product_variation_id')->unique()->values();
        $variations = ProductVariation::whereIn('id', $variationIds)->with('product')->get()->keyBy('id');

        // Subtotal calculation based on cart
        $subtotal = 0;
        foreach ($cart as $item) {
            $variation = ProductVariation::find($item['product_variation_id']);
            $subtotal += ($variation->sale_price ?? 0) * $item['quantity'];
        }

        // Coupon discount recalculate
        $discount_amount = 0;
        $appliedCoupon = session('coupon');

        if ($appliedCoupon) {
            $coupon = CouponCode::find($appliedCoupon['id'] ?? null);

            if ($coupon && $coupon->status) {
                $discount_amount = $coupon->discount_type === 'percentage'
                    ? $subtotal * ($coupon->discount_value / 100)
                    : $coupon->discount_value;

                // Discount never greater than subtotal
                if ($discount_amount > $subtotal) {
                    $discount_amount = $subtotal;
                }

                // Keep session in sync with the recalculated discount
                session()->put('coupon', [
                    'id' => $coupon->id,
                    'code' => $coupon->code,
                    'discount_amount' => $discount_amount,
                ]);
            } else {
                session()->forget('coupon');  // Coupon deleted or deactivated, remove from session
            }
        }

        // Delivery charge, Total & cart count
        $delivery_charge = session('delivery_option_charge', 0);
        $total = ($subtotal - $discount_amount) + $delivery_charge;
        $cart_count = collect($cart)->sum('quantity');

        return view('frontend.pages.checkout', compact(
            'cart',
            'variations',
            'delivery_options',
            'subtotal',
            'discount_amount',
            'delivery_charge',
            'total',
            'cart_count'
        ));
    }

    public function updateShippingMethod(Request $request)
    {
        $request->validate([
            'delivery_option_id' => 'required|exists:delivery_options,id',
        ]);

        $delivery = DeliveryOption::find($request->delivery_option_id);

        if (!$delivery) {
            return response()->json(['status' => false, 'message' => 'Invalid shipping method.'], 422);
        }

        session()->put('delivery_option_id', $delivery->id);
        session()->put('delivery_option_charge', $delivery->charge);

        $cart = session()->get('cart', []);

        // Subtotal calculation (unchanged, just needed for the total)
        $subtotal = 0;
        foreach ($cart as $item) {
            $variation = ProductVariation::find($item['product_variation_id']);
            $subtotal += ($variation->sale_price ?? 0) * $item['quantity'];
        }

        // Discount already fixed from cart page, just read it from session
        $discount_amount = session('coupon')['discount_amount'] ?? 0;
        $delivery_charge = $delivery->charge;
        $total = ($subtotal - $discount_amount) + $delivery_charge;

        return response()->json([
            'status' => true,
            'message' => 'Shipping method updated.',
            'delivery_charge' => $delivery_charge,
            'total' => $total,
        ]);
    }
}
