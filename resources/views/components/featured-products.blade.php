<section class="featured-products py-5 bg-light" id="deals">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Featured Products</h2>
            <p class="text-muted">Check out our best selling products</p>
        </div>
        <div class="row g-4">
            <!-- Product Card -->
            @foreach ($products as $product)
                @php
                    $variation = $product->variations->first();
                    $discount = $variation->discount_percentage ?? 0;
                    $inStock = ($variation->stock ?? 0) > 0;
                    $hasDiscount = $variation && $variation->regular_price > 0;
                @endphp
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card product-card h-100 border-0 shadow-sm position-relative">
                        <a href="{{ route('product', $product->slug) }}" class="text-decoration-none text-dark">
                            <div class="position-relative">
                                <div
                                    class="product-image bg-light d-flex align-items-center justify-content-center overflow-hidden">
                                    <img src="{{ asset('uploads/product/' . $product->photo) }}"
                                        alt="{{ $product->name }}" class="img-fluid w-100 h-100" />
                                </div>

                                <div
                                    class="position-absolute top-0 inset-e-0 m-2 d-flex flex-column gap-1 align-items-start">
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
                                <h6 class="card-title">{{ $product->name }}</h6>
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
                            </div>
                        </a>
                        <button type="button"
                            class="btn btn-sm btn-success position-absolute bottom-0 end-0 m-2 add-to-cart-btn"
                            data-product-id="{{ $product->id }}" data-variation-id="{{ $variation->id ?? '' }}"
                            {{ !$variation || !$inStock ? 'disabled' : '' }}>
                            <i class="bi bi-cart-plus"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

