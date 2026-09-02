<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCouponCodeController;
use App\Http\Controllers\Admin\AdminDeliveryOptionController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\WishlistController;
use Illuminate\Support\Facades\Route;

// -------------- Frontend Route -------------- //
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/post/{slug}', [FrontendController::class, 'post'])->name('post');
Route::get('/terms', [FrontendController::class, 'terms'])->name('terms');
Route::get('/privacy', [FrontendController::class, 'privacy'])->name('privacy');
Route::get('/products', [FrontendController::class, 'products'])->name('products');
Route::get('/product/{slug}', [FrontendController::class, 'product'])->name('product');

# Cart routes (in CartController)
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'cartUpdate'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'cartItemRemove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'cartClear'])->name('cart.clear');
Route::post('/cart/coupon/apply', [CartController::class, 'applyCoupon'])->name('cart.coupon.apply');
Route::post('/cart/coupon/remove', [CartController::class, 'removeCoupon'])->name('cart.coupon.remove');

# Checkout routes
Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::post('/checkout/shipping/update', [FrontendController::class, 'updateShippingMethod'])->name('checkout.shipping.update');

# Payment routes (in PaymentController)
Route::post('/payment/place-order', [PaymentController::class, 'placeOrder'])->name('order.place');
Route::get('/payment/paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
Route::get('/payment/paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');
Route::get('/payment/stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
Route::get('/payment/stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');
// -------------- End Frontend Route -------------- //


// -------------- User Route -------------- //
Route::middleware('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'profileUpdate'])->name('profile.update');
    Route::get('/orders', [UserController::class, 'orders'])->name('orders');
    Route::get('/order/invoice/{order_no}', [UserController::class, 'orderInvoice'])->name('order.invoice');
    Route::get('/order/invoice/download/{order_no}', [UserController::class, 'downloadInvoice'])->name('order.invoice.download');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
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
    # For Admin User Management Routes
    Route::get('/user/index', [AdminUserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [AdminUserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [AdminUserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [AdminUserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [AdminUserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}', [AdminUserController::class, 'destroy'])->name('user.delete');
    # For Admin Category Management Routes
    Route::get('/category/index', [AdminCategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [AdminCategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [AdminCategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [AdminCategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{id}', [AdminCategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{id}', [AdminCategoryController::class, 'destroy'])->name('category.delete');
    # For Admin Product Management Routes
    Route::get('/product/index', [AdminProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [AdminProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [AdminProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [AdminProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}', [AdminProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [AdminProductController::class, 'destroy'])->name('product.delete');
    # Product Variation Management Routes
    Route::get('/product/variation/{id}', [AdminProductController::class, 'variationIndex'])->name('product.variation');
    Route::post('/product/variation/{id}', [AdminProductController::class, 'variationStore'])->name('product.variation.store');
    Route::put('/product/variation/update/{id}', [AdminProductController::class, 'variationUpdate'])->name('product.variation.update');
    Route::delete('/product/variation/delete/{id}', [AdminProductController::class, 'variationDestroy'])->name('product.variation.delete');
    # For Admin Coupon Code Management Routes
    Route::get('/coupon/index', [AdminCouponCodeController::class, 'index'])->name('coupon.index');
    Route::get('/coupon/create', [AdminCouponCodeController::class, 'create'])->name('coupon.create');
    Route::post('/coupon/store', [AdminCouponCodeController::class, 'store'])->name('coupon.store');
    Route::get('/coupon/edit/{id}', [AdminCouponCodeController::class, 'edit'])->name('coupon.edit');
    Route::put('/coupon/update/{id}', [AdminCouponCodeController::class, 'update'])->name('coupon.update');
    Route::delete('/coupon/delete/{id}', [AdminCouponCodeController::class, 'destroy'])->name('coupon.delete');
    # For Admin Delivery Options Management Routes
    Route::get('/delivery/index', [AdminDeliveryOptionController::class, 'index'])->name('delivery.index');
    Route::get('/delivery/create', [AdminDeliveryOptionController::class, 'create'])->name('delivery.create');
    Route::post('/delivery/store', [AdminDeliveryOptionController::class, 'store'])->name('delivery.store');
    Route::get('/delivery/edit/{id}', [AdminDeliveryOptionController::class, 'edit'])->name('delivery.edit');
    Route::put('/delivery/update/{id}', [AdminDeliveryOptionController::class, 'update'])->name('delivery.update');
    Route::delete('/delivery/delete/{id}', [AdminDeliveryOptionController::class, 'destroy'])->name('delivery.delete');
    # For Admin Order Management Routes
    Route::get('/order/index', [AdminOrderController::class, 'index'])->name('order.index');
    Route::patch('/order/{order}/status', [AdminOrderController::class, 'updateOrderStatus'])->name('order.status.update');
    Route::get('/order/{order_no}/invoice', [AdminOrderController::class, 'orderInvoice'])->name('order.invoice');
    Route::delete('/order/{order}/delete', [AdminOrderController::class, 'OrderDestroy'])->name('order.delete');
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

