<?php

namespace App\Models;

use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\ProductSpecification;
use App\Models\ProductVariation;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'photo',
        'name',
        'slug',
        'short_description',
        'description',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class)->orderBy('sort_order', 'asc');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class);
    }

    protected function averageRating(): Attribute
    {
        return Attribute::make(
            get: fn() => round($this->reviews()->avg('rating') ?? 0, 1)
        );
    }

    protected function reviewCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->reviews()->count()
        );
    }

    protected function isNew(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->created_at?->diffInDays(now()) <= 7
        );
    }

    // Helper method for check product can be reviewed by user or not
    public function canBeReviewedBy(string $userId): bool
    {
        if (!$userId) {
            return false;
        }

        // Check if the user has purchased the product 
        return OrderDetail::whereHas('order', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->where('product_id', $this->id)
            ->exists();
    }
}
