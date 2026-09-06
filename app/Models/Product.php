<?php

namespace App\Models;

use App\Models\Category;
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

}
