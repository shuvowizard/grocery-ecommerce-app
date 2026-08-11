<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryOption;
use Illuminate\Http\Request;

class AdminDeliveryOptionController extends Controller
{
    public function index()
    {
        $delivery_data = DeliveryOption::latest()->get();
        return view('admin.delivery.index', compact('delivery_data'));
    }
}
