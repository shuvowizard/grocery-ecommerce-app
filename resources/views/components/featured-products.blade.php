<section class="featured-products py-5 bg-light" id="deals">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Featured Products</h2>
            <p class="text-muted">Check out our best selling products</p>
        </div>
        <div class="row g-4">
            <!-- Product 1 -->
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card product-card h-100 border-0 shadow-sm">
                        <a href="{{ route('product', $product->slug) }}" class="text-decoration-none text-dark">
                            <div class="position-relative">
                                <div
                                    class="product-image bg-light d-flex align-items-center justify-content-center overflow-hidden">
                                    <img src="{{ asset('uploads/product/' . $product->photo) }}"
                                        alt="{{ $product->name }}" class="img-fluid w-100 h-100" />
                                </div>
                                <span class="badge bg-danger position-absolute top-0 inset-e-0 m-2">-20%</span>
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
                                        @foreach ($product->variations as $variation)
                                            <span
                                                class="text-success fw-bold fs-5">${{ number_format($variation->sale_price, 2) }}</span>
                                            <span class="text-muted text-decoration-line-through small ms-1">${{ number_format($variation->regular_price, 2) }}</span>
                                            @break
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </a>
                        <button class="btn btn-sm btn-success position-absolute bottom-0 end-0 m-2">
                            <i class="bi bi-cart-plus"></i>
                        </button>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>