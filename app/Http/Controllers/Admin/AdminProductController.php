<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
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

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.product.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        # Validate Input
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'photo' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name' => ['required', 'string', 'max:255', 'unique:products,name,' . $product->id],
            'short_description' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
        ]);

        # Handle Photo Upload
        if ($request->hasFile('photo')) {
            # Old photo delete
            if ($product->photo && file_exists(public_path('uploads/product/' . $product->photo))) {
                unlink(public_path('uploads/product/' . $product->photo));
            }
            $image = $request->file('photo');
            $imageName = Str::slug($request->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/product'), $imageName);
            $validated['photo'] = $imageName;
        }

        // Update Product
        $validated['slug'] = Str::slug($request->name);
        $product->update($validated);

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product->photo && file_exists(public_path('uploads/product/' . $product->photo))) {
            unlink(public_path('uploads/product/' . $product->photo));
        }
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully!');
    }

    public function variationIndex(String $id)
    {
        $product = Product::with('variations')->findOrFail($id);
        return view('admin.product.variations', ['product' => $product]);
    }

    public function variationStore(Request $request, String $id)
    {
        # Validate Input
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'regular_price' => ['required', 'numeric', 'min:0'],
            'sale_price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        // Create Product Variation
        $product = Product::findOrFail($id);
        $product->variations()->create($validated);

        return redirect()->back()->with('success', 'Product variation added successfully!');
    }

    public function variationUpdate(Request $request, String $id)
    {
        # Validate Input
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'regular_price' => ['required', 'numeric', 'min:0'],
            'sale_price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        // Update Product Variation
        $variation = ProductVariation::findOrFail($id);
        $variation->update($validated);

        return redirect()->back()->with('success', 'Product variation updated successfully!');
    }
}
