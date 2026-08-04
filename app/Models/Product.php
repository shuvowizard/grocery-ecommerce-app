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
        ;
    }

    protected function isNew(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->created_at?->diffInDays(now()) <= 7
        );
    }

}
