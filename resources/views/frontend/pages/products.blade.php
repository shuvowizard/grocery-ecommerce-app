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
                    <form id="filterForm" method="GET" action="{{ route('products') }}">
                        <div class="sidebar">
                            <!-- Categories Filter -->
                            <div class="filter-widget mb-4">
                                <h5 class="fw-bold mb-3">Categories</h5>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="category" id="catAll"
                                        value="" checked>
                                    <label class="form-check-label" for="catAll">
                                        All Products
                                    </label>
                                </div>
                                @foreach ($categories as $category)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="category"
                                            id="cat{{ $category->id }}" value="{{ $category->slug }}"
                                            {{ request('category') == $category->slug ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cat{{ $category->id }}">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Price Filter -->
                            <div class="filter-widget mb-4">
                                <h5 class="fw-bold mb-3">Price Range</h5>
                                <div class="price d-flex justify-content-start mb-3">
                                    <div class="min mr_5">
                                        <input type="number" name="min_price" class="form-control"
                                            value="{{ request('min_price') }}" min="0" placeholder="Min Price">
                                    </div>
                                    <div class="max">
                                        <input type="number" name="max_price" class="form-control"
                                            value="{{ request('max_price') }}" min="0" placeholder="Max Price">
                                    </div>
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

                            <input type="hidden" name="sort_by" id="sortByInput" value="{{ request('sort_by') }}">

                            <!-- Reset Filters Button -->
                            <button class="btn btn-outline-success w-100" type="submit">
                                <i class="bi bi-arrow-clockwise me-2"></i>Apply Filters
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Products Grid -->
                <div class="col-lg-9 col-md-8">
                    <!-- Toolbar -->
                    <div
                        class="products-toolbar d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded">
                        <div>
                            @if ($products->total() > 0)
                                <p class="mb-0 text-muted">Showing <strong>{{ $products->firstItem() }} -
                                        {{ $products->lastItem() }}</strong> of <strong> {{ $products->total() }}
                                    </strong>results</p>
                            @else
                                <p class="mb-0 text-muted">No products found</p>
                            @endif
                        </div>
                        <div class="d-flex align-items-center">
                            <label class="me-2 mb-0" style="width:100px;">Sort by:</label>
                            <select class="form-select form-select-sm" id="sortByDropdown">
                                <option value="" {{ request('sort_by') == '' ? 'selected' : '' }}>Default</option>
                                <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price:
                                    Low
                                    to High</option>
                                <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>
                                    Price:
                                    High to Low</option>
                                <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Name: A
                                    to Z
                                </option>
                                <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Name:
                                    Z to
                                    A</option>
                            </select>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="row g-4">
                        <!-- Product cart -->
                        @foreach ($products as $product)
                            @php
                                $variation = $product->variations->first();
                                $discount = $variation->discount_percentage ?? 0;
                                $inStock = ($variation->stock ?? 0) > 0;
                                $hasDiscount = $variation && $variation->regular_price > 0;
                            @endphp
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="card product-card h-100 border-0 shadow-sm">
                                    <div class="position-relative">
                                        <a href="{{ route('product', $product->slug) }}">
                                            <div
                                                class="product-image bg-light d-flex align-items-center justify-content-center overflow-hidden">
                                                <img src="{{ asset('uploads/product/' . $product->photo) }}"
                                                    alt="{{ $product->name }}" class="img-fluid w-100 h-100">
                                            </div>
                                        </a>

                                        <div
                                            class="position-absolute top-0 end-0 m-2 d-flex flex-column gap-1 align-items-end">
                                            @if ($product->is_new)
                                                <span class="badge bg-primary">New</span>
                                            @endif

                                            @if ($inStock && $discount > 0)
                                                <span class="badge bg-danger">-{{ $discount }}%</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="small text-muted mb-1">{{ $product->category->name }}</p>
                                        <h6 class="card-title"><a href="{{ route('product', $product->slug) }}"
                                                class="text-decoration-none text-dark">{{ $product->name }}</a></h6>
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
                                                @if ($variation)
                                                    <span
                                                        class="text-success fw-bold fs-5">${{ number_format($variation->sale_price, 2) }}</span>
                                                    @if ($hasDiscount)
                                                        <span
                                                            class="text-muted text-decoration-line-through small ms-1">${{ number_format($variation->regular_price, 2) }}</span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="position-absolute bottom-0 end-0 m-2 d-flex gap-2">
                                            <button type="button" class="btn btn-sm btn-outline-danger wishlist-btn"
                                                data-product-id="{{ $product->id }}">
                                                <i class="bi bi-heart"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-success add-to-cart-btn"
                                                data-product-id="{{ $product->id }}"
                                                data-variation-id="{{ $variation->id ?? '' }}"
                                                {{ !$variation || !$inStock ? 'disabled' : '' }}>
                                                <i class="bi bi-cart-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-5">
                            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        //? submit filter form with disabled empty inputs
        function submitFilterForm() {
            $('#filterForm')
                .find('input, select').each(function() {
                    if ($(this).val() === '') {
                        $(this).prop('disabled', true);
                    } else {
                        $(this).prop('disabled', false);
                    }
                });

            $('input[name="rating"]').prop('disabled', true);
            $('#filterForm').submit();
        }

        //? Sort by dropdown
        $('#sortByDropdown').change(function() {
            $('#sortByInput').val($(this).val());
            submitFilterForm();
        });

        //? Filter by category
        $('input[name="category"]').on('change', function() {
            submitFilterForm();
        });

        //? Filter by price range with debounce
        let timer;
        $('input[name="min_price"], input[name="max_price"]').on('input', function() {
            clearTimeout(timer);
            timer = setTimeout(function() {
                submitFilterForm();
            }, 500);
        });

        //? Add to cart (async/await)
        async function addToCart(productId, variationId, quantity = 1) {
            try {
                const response = await axios.post("{{ route('cart.add') }}", {
                    product_id: productId,
                    product_variation_id: variationId,
                    quantity: quantity,
                });

                const data = response.data;

                const badge = document.getElementById('cartCountBadge');
                if (badge) {
                    badge.textContent = data.cart_count;
                    badge.classList.toggle('d-none', data.cart_count === 0);
                }

                iziToast.success({
                    message: data.message,
                    position: 'topRight',
                    timeout: 5000,
                    progressBarColor: '#00FF00'
                });
            } catch (error) {
                const message = error.response?.data?.message || 'Something went wrong. Please try again.';
                iziToast.error({
                    message: message,
                    position: 'topRight',
                    timeout: 5000,
                    progressBarColor: '#FF0000'
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.body.addEventListener('click', function(e) {
                const btn = e.target.closest('.add-to-cart-btn');
                if (!btn) return;

                const productId = btn.dataset.productId;
                const variationId = btn.dataset.variationId;

                if (!variationId) {
                    iziToast.error({
                        message: 'This product is currently unavailable.',
                        position: 'topRight',
                        timeout: 5000,
                    });
                    return;
                }

                addToCart(productId, variationId, 1);
            });

            document.body.addEventListener('click', async function(event) {
                @guest
                    window.location.href = "{{ route('login') }}";
                    return;
                @endguest
                
                const button = event.target.closest('.wishlist-btn');
                if (!button) return;
                const productId = button.dataset.productId;

                try {
                    const response = await axios.post("{{ route('wishlist.add') }}", {
                        product_id: productId
                    });

                    const badge = document.getElementById('wishlistCountBadge');
                    if (badge) {
                        badge.textContent = response.data.wishlist_count;
                        badge.classList.toggle('d-none', response.data.wishlist_count === 0);
                    }

                    iziToast.success({
                        message: response.data.message,
                        position: 'topRight',
                        timeout: 3000
                    });
                } catch (error) {
                    iziToast.error({
                        message: error.response?.data?.message || 'Something went wrong. Please try again.',
                        position: 'topRight',
                        timeout: 3000
                    });
                }
            });
            
        });
    </script>
@endpush
