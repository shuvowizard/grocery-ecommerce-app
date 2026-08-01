<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.product.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        # Validate Input
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name' => ['required', 'string', 'max:255', 'unique:products,name'],
            'short_description' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
        ]);

        # Handle Photo Upload
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = Str::slug($request->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
            if (!file_exists(public_path('uploads/product'))) {
                mkdir(public_path('uploads/product'), 0755, true);
            }
            $image->move(public_path('uploads/product'), $imageName);
            $validated['photo'] = $imageName;
        }

        // Create Product
        $validated['slug'] = Str::slug($request->name);
        Product::create($validated);

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully!');
    }
}
