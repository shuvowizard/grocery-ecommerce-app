<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $fillable = [
        'product_id',
        'label',
        'regular_price',
        'sale_price',
        'stock',
        'sort_order',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected function discountPercentage(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->regular_price > 0 && $this->regular_price > $this->sale_price) {
                    return round((($this->regular_price - $this->sale_price) / $this->regular_price) * 100);
                }
                return 0;
            }
        );
    }

}
