<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function faq()
    {
        return view('frontend.pages.faq');
    }

    public function blog()
    {
        return view('frontend.pages.blog');
    }

    public function post($slug)
    {
        return view('frontend.pages.post', compact('slug'));
    }

    public function terms()
    {
        return view('frontend.pages.terms');
    }
}
