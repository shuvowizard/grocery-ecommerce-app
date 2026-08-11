<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CouponCode;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminCouponCodeController extends Controller
{
    public function index()
    {
        $coupon_data = CouponCode::latest()->get();
        return view('admin.coupon.index', compact('coupon_data'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:255', 'unique:coupon_codes,code'],
            'discount_type' => ['required', 'in:percentage,fixed'],
            'discount_value' => ['required', 'numeric', 'min:0', 'max:' . ($request->discount_type === 'percentage' ? 100 : 99999999.99)],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'starts_at' => ['required', 'date'],
            'expires_at' => ['required', 'date', 'after_or_equal:starts_at'],
            'status' => ['required', 'in:0,1'],
        ]);

        CouponCode::create($validated);
        return redirect()->route('admin.coupon.index')->with('success', 'Coupon Code Created Successfully');
    }

    public function edit(String $id)
    {
        $coupon = CouponCode::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, String $id)
    {
        $coupon = CouponCode::findOrFail($id);

        $validated = $request->validate([
            'code' => ['required', 'string', 'max:255', Rule::unique(CouponCode::class)->ignore($coupon->id)],
            'discount_type' => ['required', 'in:percentage,fixed'],
            'discount_value' => ['required', 'numeric', 'min:0', 'max:' . ($request->discount_type === 'percentage' ? 100 : 99999999.99)],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'starts_at' => ['required', 'date'],
            'expires_at' => ['required', 'date', 'after_or_equal:starts_at'],
            'status' => ['required', 'in:0,1'],
        ]);

        $coupon->update($validated);
        return redirect()->route('admin.coupon.index')->with('success', 'Coupon Code Updated Successfully');
    }

    public function destroy(String $id)
    {
        $coupon = CouponCode::findOrFail($id);
        $coupon->delete();
        return redirect()->route('admin.coupon.index')->with('success', 'Coupon Code Deleted Successfully');
    }
}
