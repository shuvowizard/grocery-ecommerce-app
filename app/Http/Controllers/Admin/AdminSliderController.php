<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminSliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

        public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        $photoName = time() . '_' . Str::random(6) . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads/slider'), $photoName);

        Slider::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'photo' => $photoName,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.slider.index')->with('success', 'Slider added successfully!');
    }

    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, string $id)
    {
        $slider = Slider::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        $data = $request->only(['title', 'subtitle', 'button_text', 'button_link', 'sort_order', 'status']);

        if ($request->hasFile('photo')) {
            $oldPath = public_path('uploads/slider/' . $slider->photo);
            if (file_exists($oldPath)) unlink($oldPath);

            $photoName = time() . '_' . Str::random(6) . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/slider'), $photoName);
            $data['photo'] = $photoName;
        }

        $slider->update($data);

        return redirect()->route('admin.slider.index')->with('success', 'Slider updated successfully!');
    }
}
