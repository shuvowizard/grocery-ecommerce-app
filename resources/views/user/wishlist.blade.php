@extends('frontend.layouts.app')

@section('title', 'Wishlist')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Customer Wishlist Section -->
    <section class="customer-dashboard customer-wishlist py-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                @include('user.auth.sidebar')

                <!-- Wishlist Content -->
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold mb-0">My Wishlist</h3>
                        <span class="text-muted" id="wishlistItemCount">{{ $wishlists->count() }} items</span>
                    </div>

                    @if ($wishlists->count() > 0)
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th scope="col" class="px-4 py-3">Product</th>
                                                <th scope="col" class="py-3">Price</th>
                                                <th scope="col" class="py-3">Stock Status</th>
                                                <th scope="col" class="py-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Wishlist Items -->
                                            @foreach ($wishlists as $item)
                                                @php
                                                    $product = $item->product;
                                                    $variation = $product->variations->first();
                                                    $inStock = ($variation->stock ?? 0) > 0;
                                                    $hasDiscount = $variation && $variation->regular_price > 0;
                                                @endphp
                                                <tr>
                                                    <td class="px-4 py-3">
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset('uploads/product/' . $product->photo) }}"
                                                                alt="{{ $product->name }}"
                                                                class="rounded me-3 wishlist-product-thumb">
                                                            <div>
                                                                <h6 class="mb-1">
                                                                    <a href="{{ route('product', $product->slug) }}"
                                                                        class="text-decoration-none text-dark">{{ $product->name }}</a>
                                                                </h6>
                                                                <small class="text-muted">Category:
                                                                    {{ $product->category->name }}</small>
                                                                <div class="text-warning small mt-1">
                                                                    <i class="bi bi-star-fill"></i>
                                                                    <i class="bi bi-star-fill"></i>
                                                                    <i class="bi bi-star-fill"></i>
                                                                    <i class="bi bi-star-fill"></i>
                                                                    <i class="bi bi-star-half"></i>
                                                                    <span class="text-muted ms-1">(4.5)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="py-3 align-middle">
                                                        @if ($variation)
                                                            <span
                                                                class="fw-bold text-success">${{ number_format($variation->sale_price, 2) }}</span>
                                                            @if ($hasDiscount)
                                                                <div><small
                                                                        class="text-muted text-decoration-line-through">${{ number_format($variation->regular_price, 2) }}</small>
                                                                </div>
                                                            @endif
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </td>
                                                    <td class="py-3 align-middle">
                                                        @if ($inStock)
                                                            <span class="badge bg-success">In Stock</span>
                                                        @else
                                                            <span class="badge bg-danger">Out of Stock</span>
                                                        @endif
                                                    </td>
                                                    <td class="py-3 align-middle">
                                                        <button class="btn btn-success btn-sm mb-2">
                                                            <i class="bi bi-cart-plus me-1"></i>Add to Cart
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-sm d-block wishlist-remove-btn"
                                                            data-product-id="{{ $product->id }}">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('products') }}" class="btn btn-outline-success">
                                <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                            </a>
                            <div class="d-flex gap-2">
                                <button class="btn btn-success">
                                    <i class="bi bi-cart-plus me-2"></i>Add All to Cart
                                </button>
                                <button class="btn btn-outline-danger">
                                    <i class="bi bi-trash me-2"></i>Clear Wishlist
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <p class="text-muted">Your wishlist is empty.</p>
                            <a href="{{ route('products') }}" class="btn btn-success">Browse Products</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
