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

}
