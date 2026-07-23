@extends('frontend.layouts.app')

@section('title', 'Products')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Products Section with Sidebar -->
    <section class="products-section py-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3 col-md-4">
                    <div class="sidebar">
                        <!-- Categories Filter -->
                        <div class="filter-widget mb-4">
                            <h5 class="fw-bold mb-3">Categories</h5>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="category" id="catAll" checked>
                                <label class="form-check-label" for="catAll">
                                    All Products
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="category" id="catFruits">
                                <label class="form-check-label" for="catFruits">
                                    Fresh Fruits
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="category" id="catDairy">
                                <label class="form-check-label" for="catDairy">
                                    Fresh Vegetables
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="category" id="catMeat">
                                <label class="form-check-label" for="catMeat">
                                    Seafood & Meat
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="category" id="catBakery">
                                <label class="form-check-label" for="catBakery">
                                    Grains & Pulses
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="category" id="catBeverages">
                                <label class="form-check-label" for="catBeverages">
                                    Condiments & Beverages
                                </label>
                            </div>
                        </div>

                        <!-- Price Filter -->
                        <div class="filter-widget mb-4">
                            <h5 class="fw-bold mb-3">Price Range</h5>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="price" id="priceAll" checked>
                                <label class="form-check-label" for="priceAll">
                                    All Prices
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="price" id="price1">
                                <label class="form-check-label" for="price1">
                                    Under $5
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="price" id="price2">
                                <label class="form-check-label" for="price2">
                                    $5 - $10
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="price" id="price3">
                                <label class="form-check-label" for="price3">
                                    $10 - $20
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="price" id="price4">
                                <label class="form-check-label" for="price4">
                                    $20 & Above
                                </label>
                            </div>
                        </div>

                        <!-- Rating Filter -->
                        <div class="filter-widget mb-4">
                            <h5 class="fw-bold mb-3">Rating</h5>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="rating" id="ratingAll" checked>
                                <label class="form-check-label" for="ratingAll">
                                    All Ratings
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="rating" id="rating5">
                                <label class="form-check-label" for="rating5">
                                    <span class="text-warning">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="rating" id="rating4">
                                <label class="form-check-label" for="rating4">
                                    <span class="text-warning">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                    </span> & Up
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="rating" id="rating3">
                                <label class="form-check-label" for="rating3">
                                    <span class="text-warning">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </span> & Up
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="rating" id="rating4">
                                <label class="form-check-label" for="rating4">
                                    <span class="text-warning">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </span> & Up
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="rating" id="rating5">
                                <label class="form-check-label" for="rating5">
                                    <span class="text-warning">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </span> & Up
                                </label>
                            </div>
                        </div>

                        <!-- Brand Filter -->
                        <div class="filter-widget mb-4">
                            <h5 class="fw-bold mb-3">Brand</h5>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="brand" id="brandAll" checked>
                                <label class="form-check-label" for="brandAll">
                                    All Brands
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="brand" id="brand1">
                                <label class="form-check-label" for="brand1">
                                    Fresh Harvest
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="brand" id="brand2">
                                <label class="form-check-label" for="brand2">
                                    Organic Valley
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="brand" id="brand3">
                                <label class="form-check-label" for="brand3">
                                    Green Farms
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="brand" id="brand4">
                                <label class="form-check-label" for="brand4">
                                    Nature's Best
                                </label>
                            </div>
                        </div>

                        <!-- Reset Filters Button -->
                        <button class="btn btn-outline-success w-100">
                            <i class="bi bi-arrow-clockwise me-2"></i>Reset Filters
                        </button>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="col-lg-9 col-md-8">
                    <!-- Toolbar -->
                    <div
                        class="products-toolbar d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded">
                        <div>
                            <p class="mb-0 text-muted">Showing <strong>1-12</strong> of <strong>48</strong> results</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <label class="me-2 mb-0">Sort by:</label>
                            <select class="form-select form-select-sm">
                                <option>Default</option>
                                <option>Price: Low to High</option>
                                <option>Price: High to Low</option>
                                <option>Name: A to Z</option>
                                <option>Name: Z to A</option>
                                <option>Rating: High to Low</option>
                            </select>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="row g-4">
                        <!-- Product 1 -->
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card product-card h-100 border-0 shadow-sm">
                                <div class="position-relative">
                                    <a href="{{ route('product', 1) }}">
                                        <div
                                            class="product-image bg-light d-flex align-items-center justify-content-center overflow-hidden">
                                            <img src="{{ asset('dist-frontend/images/Green Apple.jpg') }}" alt="Fresh Green Apples"
                                                class="img-fluid w-100 h-100">
                                        </div>
                                    </a>
                                    <span class="badge bg-danger position-absolute top-0 end-0 m-2">-20%</span>
                                    <button class="btn btn-sm btn-success position-absolute bottom-0 end-0 m-2">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <p class="small text-muted mb-1">Fruits</p>
                                    <h6 class="card-title"><a href="{{ route('product', 1) }}"
                                            class="text-decoration-none text-dark">Fresh Green Apples</a></h6>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </span>
                                        <small class="text-muted ms-2">(4.5)</small>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span class="text-success fw-bold fs-5">$4.99</span>
                                            <span class="text-muted text-decoration-line-through small ms-1">$6.99</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product 2 -->
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card product-card h-100 border-0 shadow-sm">
                                <div class="position-relative">
                                    <a href="{{ route('product', 1) }}">
                                        <div
                                            class="product-image bg-light d-flex align-items-center justify-content-center overflow-hidden">
                                            <img src="{{ asset('dist-frontend/images/Egg.jpg') }}" alt="Farm Fresh Eggs" class="img-fluid w-100 h-100">
                                        </div>
                                    </a>
                                    <span class="badge bg-success position-absolute top-0 end-0 m-2">New</span>
                                    <button class="btn btn-sm btn-success position-absolute bottom-0 end-0 m-2">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <p class="small text-muted mb-1">Dairy</p>
                                    <h6 class="card-title"><a href="{{ route('product', 1) }}"
                                            class="text-decoration-none text-dark">Farm Fresh Eggs (12)</a></h6>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </span>
                                        <small class="text-muted ms-2">(5.0)</small>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span class="text-success fw-bold fs-5">$5.99</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product 3 -->
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card product-card h-100 border-0 shadow-sm">
                                <div class="position-relative">
                                    <a href="{{ route('product', 1) }}">
                                        <div
                                            class="product-image bg-light d-flex align-items-center justify-content-center overflow-hidden">
                                            <img src="{{ asset('dist-frontend/images/Coconuts.jpg') }}" alt="Fresh Coconuts"
                                                class="img-fluid w-100 h-100">
                                        </div>
                                    </a>
                                    <button class="btn btn-sm btn-success position-absolute bottom-0 end-0 m-2">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <p class="small text-muted mb-1">Fruits</p>
                                    <h6 class="card-title"><a href="{{ route('product', 1) }}"
                                            class="text-decoration-none text-dark">Fresh Coconuts</a></h6>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </span>
                                        <small class="text-muted ms-2">(4.0)</small>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span class="text-success fw-bold fs-5">$3.49</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add more products as needed (repeat structure) -->
                        <!-- Product 4-12 would go here -->

                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="mt-5">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection