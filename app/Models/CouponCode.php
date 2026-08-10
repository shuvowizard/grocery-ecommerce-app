<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponCode extends Model
{
    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'usage_limit',
        'used_count',
        'starts_at',
        'expires_at',
        'status',
    ];

    protected $casts = [
        'starts_at' => 'date',
        'expires_at' => 'date',
    ];
}
