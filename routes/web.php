<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');

// -------------- User Route -------------- //
Route::middleware('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'profileUpdate'])->name('profile.update');
});

// -------- Authentication --------
Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/login', [UserController::class, 'authenticate'])->name('login.store');
Route::get('/logout', [UserController::class, 'destroy'])->name('logout');

// -------- Registration --------
Route::get('/registration', [UserController::class, 'create'])->name('register');
Route::post('/registration', [UserController::class, 'store'])->name('register.store');

// -------- Email Verification --------
Route::get('/verify/email/{token}/{email}', [UserController::class, 'verifyEmail'])->name('verify.email');

// -------- Forgot Password --------
Route::get('/forget-password', [UserController::class, 'forgetPassword'])->name('forget.password');
Route::post('/forget-password', [UserController::class, 'forgetPasswordSubmit'])->name('forget.password.submit');

// -------- Reset Password --------
Route::get('/reset-password/{token}/{email}', [UserController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password', [UserController::class, 'resetPasswordSubmit'])->name('reset.password.submit');


// -------------- End User Route -------------- //


// -------------- Admin Route -------------- //
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile', [AdminController::class, 'profileUpdate'])->name('profile.update');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    // -------- Authentication Route--------
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/login', [AdminController::class, 'store'])->name('login.store');
    Route::get('/logout', [AdminController::class, 'destroy'])->name('logout');

    // -------- Forgot Password --------
    Route::get('/forget-password', [AdminController::class, 'forgetPassword'])->name('forget.password');
    Route::post('/forget-password', [AdminController::class, 'forgetPasswordSubmit'])->name('forget.password.submit');

    // -------- Reset Password --------
    Route::get('/reset-password/{token}/{email}', [AdminController::class, 'resetPassword'])->name('reset.password');
    Route::post('/reset-password', [AdminController::class, 'resetPasswordSubmit'])->name('reset.password.submit');
});
// -------------- End Admin Route -------------- //

