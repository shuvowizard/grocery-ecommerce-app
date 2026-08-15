<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_variation_id',
        'product_name',
        'label',
        'sale_price',
        'quantity',
        'total_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productVariation()
    {
        return $this->belongsTo(ProductVariation::class, 'product_variation_id');
    }
}
