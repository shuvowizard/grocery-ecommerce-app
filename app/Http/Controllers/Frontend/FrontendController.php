<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_variation_id' => 'required|exists:product_variations,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $quantity = $request->quantity ?? 1;

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_variation_id])) {
            $cart[$request->product_variation_id]['quantity'] += $quantity;
        } else {
            $cart[$request->product_variation_id] = [
                'product_id' => $request->product_id,
                'product_variation_id' => $request->product_variation_id,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart successfully!',
            'cart_count' => collect($cart)->sum('quantity'),
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

        return view('frontend.pages.cart', compact('cart', 'variations'));
    }

    public function checkout()
    {
        return view('frontend.pages.checkout');
    }
}
