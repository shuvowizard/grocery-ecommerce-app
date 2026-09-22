<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('sort_order')->get();
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ added successfully!');
    }

    public function edit(string $id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, string $id)
    {
        $faq = Faq::findOrFail($id);
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ updated successfully!');
    }

}
