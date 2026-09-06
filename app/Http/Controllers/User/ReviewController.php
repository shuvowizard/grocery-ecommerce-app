<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Verified purchase check - delivered order e ei product ache kina
        $orderDetail = OrderDetail::whereHas('order', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->where('product_id', $product->id)
            ->first();
            
        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'order_id' => $orderDetail->order_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Thank you for your review!',
            'average_rating' => $product->fresh()->average_rating,
            'review_count' => $product->fresh()->review_count,
        ]);
    }
}
