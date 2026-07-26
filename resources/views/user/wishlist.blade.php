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
                        <span class="text-muted">6 items</span>
                    </div>

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
                                        <!-- Wishlist Item 1 -->
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <img src="images/Green Apple.jpg" alt="Fresh Green Apples"
                                                        class="rounded me-3 wishlist-product-thumb">
                                                    <div>
                                                        <h6 class="mb-1">
                                                            <a href="product-single.html"
                                                                class="text-decoration-none text-dark">Fresh Green
                                                                Apples</a>
                                                        </h6>
                                                        <small class="text-muted">Category: Fruits</small>
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
                                                <span class="fw-bold text-success">$4.99</span>
                                                <div><small class="text-muted text-decoration-line-through">$6.99</small>
                                                </div>
                                            </td>
                                            <td class="py-3 align-middle">
                                                <span class="badge bg-success">In Stock</span>
                                            </td>
                                            <td class="py-3 align-middle">
                                                <button class="btn btn-success btn-sm mb-2">
                                                    <i class="bi bi-cart-plus me-1"></i>Add to Cart
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm d-block">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Wishlist Item 2 -->
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <img src="images/Orange.jpg" alt="Fresh Oranges"
                                                        class="rounded me-3 wishlist-product-thumb">
                                                    <div>
                                                        <h6 class="mb-1">
                                                            <a href="product-single.html"
                                                                class="text-decoration-none text-dark">Fresh Oranges (6
                                                                pack)</a>
                                                        </h6>
                                                        <small class="text-muted">Category: Fruits</small>
                                                        <div class="text-warning small mt-1">
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-half"></i>
                                                            <span class="text-muted ms-1">(4.7)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3 align-middle">
                                                <span class="fw-bold text-success">$6.99</span>
                                            </td>
                                            <td class="py-3 align-middle">
                                                <span class="badge bg-success">In Stock</span>
                                            </td>
                                            <td class="py-3 align-middle">
                                                <button class="btn btn-success btn-sm mb-2">
                                                    <i class="bi bi-cart-plus me-1"></i>Add to Cart
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm d-block">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Wishlist Item 3 -->
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <img src="images/Green Avocados.jpg" alt="Fresh Avocados"
                                                        class="rounded me-3 wishlist-product-thumb">
                                                    <div>
                                                        <h6 class="mb-1">
                                                            <a href="product-single.html"
                                                                class="text-decoration-none text-dark">Fresh Avocados</a>
                                                        </h6>
                                                        <small class="text-muted">Category: Fruits</small>
                                                        <div class="text-warning small mt-1">
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star"></i>
                                                            <span class="text-muted ms-1">(4.3)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3 align-middle">
                                                <span class="fw-bold text-success">$8.99</span>
                                            </td>
                                            <td class="py-3 align-middle">
                                                <span class="badge bg-success">In Stock</span>
                                            </td>
                                            <td class="py-3 align-middle">
                                                <button class="btn btn-success btn-sm mb-2">
                                                    <i class="bi bi-cart-plus me-1"></i>Add to Cart
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm d-block">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="products.html" class="btn btn-outline-success">
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
                </div>
            </div>
        </div>
    </section>
@endsection