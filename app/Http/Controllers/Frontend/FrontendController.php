<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
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

        $products = Product::with(['category', 'variations'])
            ->withMin('variations', 'sale_price')  # Get the minimum sale price of variations on the product table and alias it as `variations_min_sale_price` 
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($query) use ($request) {
                    $query->where('slug', $request->category);
                });
            })
            ->when($request->filled(['min_price', 'max_price']), function ($query) use ($request) {
                $query->whereHas('variations', function ($query) use ($request) {
                    $query->whereBetween('sale_price', [$request->min_price, $request->max_price]);
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
                fn($query) => $query->latest()  # fallback callback, if no sort_by parameter is provided, default to latest products
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

    public function cart()
    {
        return view('frontend.pages.cart');
    }

    public function checkout()
    {
        return view('frontend.pages.checkout');
    }
}
