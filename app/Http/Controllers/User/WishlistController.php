<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', auth('web')->id())
            ->with(['product.category', 'product.variations'])
            ->latest()
            ->get();

        return view('user.wishlist', compact('wishlists'));
    }

    public function addToWishlist(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = auth('web')->user();

        // Check if the product is already in the wishlist
        if ($user->wishlists()->where('product_id', $request->product_id)->exists()) {
            return response()->json(['status' => false, 'message' => 'Product is already in your wishlist.'], 400);
        }

        // Add the product to the user's wishlist
        $user->wishlists()->create([
            'product_id' => $request->product_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Product added to your wishlist.',
            'wishlist_count' => Wishlist::where('user_id', auth('web')->id())->count(),
        ], 200);
    }

    public function removeWishlistItem(string $productId)
    {
        $user = auth('web')->user();
        $wishlistItem = $user->wishlists()->where('product_id', $productId)->first();

        if (!$wishlistItem) {
            return response()->json(['status' => false, 'message' => 'Product not found in your wishlist'], 404);
        }

        $wishlistItem->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product removed from your wishlist.',
            'wishlist_count' => Wishlist::where('user_id', auth('web')->id())->count(),
        ], 200);
    }

    public function clearWishlist()
    {
        $user = auth('web')->user();
        $user->wishlists()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Wishlist cleared successfully.',
            'wishlist_count' => 0,
        ], 200);
    }

     public function addAllToCart()
    {
        $wishlistItems = Wishlist::where('user_id', auth('web')->id())
            ->with('product.variations')
            ->get();

        $cart = session()->get('cart', []);
        $addedCount = 0;
        $skippedCount = 0;
        $addedProductIds = [];  // Keep track of added product IDs

        foreach ($wishlistItems as $item) {
            $variation = $item->product->variations->first();

            if (!$variation || $variation->stock == 0) {
                $skippedCount++;
                continue;
            }

            $existingQty = $cart[$variation->id]['quantity'] ?? 0;

            if ($existingQty + 1 > $variation->stock) {
                $skippedCount++;
                continue;
            }

            $cart[$variation->id] = [
                'product_id' => $item->product_id,
                'product_variation_id' => $variation->id,
                'quantity' => $existingQty + 1,
            ];

            $addedProductIds[] = $item->product_id;
            $addedCount++;
        }

        session()->put('cart', $cart);

        // Remove the added items from the wishlist
        if (!empty($addedProductIds)) {
            Wishlist::where('user_id', auth('web')->id())
                ->whereIn('product_id', $addedProductIds)
                ->delete();
        }

        $message = "{$addedCount} item(s) added to cart.";
        if ($skippedCount > 0) {
            $message .= " {$skippedCount} item(s) skipped (out of stock).";
        }

        return response()->json([
            'status' => true,
            'message' => $message,
            'cart_count' => collect($cart)->sum('quantity'),
            'wishlist_count' => Wishlist::where('user_id', auth('web')->id())->count(),
        ], 200);
    }

}
