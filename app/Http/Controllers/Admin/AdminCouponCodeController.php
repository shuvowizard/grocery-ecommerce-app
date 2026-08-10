<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CouponCode;
use Illuminate\Http\Request;

class AdminCouponCodeController extends Controller
{
    public function index()
    {
        $coupon_data = CouponCode::all();
        return view('admin.coupon.index', compact('coupon_data'));
    }
}
