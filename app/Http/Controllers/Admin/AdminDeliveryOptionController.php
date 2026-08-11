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

    public function create()
    {
        return view('admin.delivery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:delivery_options,name'],
            'description' => ['required', 'string'],
            'charge' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'status' => ['required', 'in:0,1'],
        ]);

        DeliveryOption::create($validated);
        return redirect()->route('admin.delivery.index')->with('success', 'Delivery Option Created Successfully');
    }

    public function edit(String $id)
    {
        $delivery = DeliveryOption::findOrFail($id);
        return view('admin.delivery.edit', compact('delivery'));
    }

    public function update(Request $request, String $id)
    {
        $delivery = DeliveryOption::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:delivery_options,name,' . $delivery->id],
            'description' => ['required', 'string'],
            'charge' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'status' => ['required', 'in:0,1'],
        ]);

        $delivery->update($validated);
        return redirect()->route('admin.delivery.index')->with('success', 'Delivery Option Updated Successfully');
    }

    public function destroy(String $id)
    {
        $delivery = DeliveryOption::findOrFail($id);
        $delivery->delete();
        return redirect()->route('admin.delivery.index')->with('success', 'Delivery Option Deleted Successfully');
    }
}
