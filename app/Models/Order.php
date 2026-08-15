<?php

namespace App\Models;

use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_no',
        'payment_method',
        'payment_status',
        'transaction_id',
        'currency',
        'total_price',
        'subtotal_price',
        'delivery_option_cost',
        'coupon_code',
        'coupon_discount_type',
        'coupon_discount_value',
        'coupon_discount_amount',
        'billing_name',
        'billing_email',
        'billing_phone',
        'billing_address',
        'billing_country',
        'billing_state',
        'billing_city',
        'billing_zip',
        'note',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
