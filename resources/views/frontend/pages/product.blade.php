@extends('frontend.layouts.app')

@section('title', 'Product')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products') }}" class="text-success">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Product Details Section -->
    <section class="product-details py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Product Images -->
                <div class="col-lg-5">
                    <div class="product-images">
                        <!-- Main Image -->
                        <div class="main-image mb-3">
                            <img src="{{ asset('uploads/product/' . $product->photo) }}" alt="{{ $product->name }}"
                                class="rounded shadow-sm w-100 product-single-img">
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-7">
                    <div class="product-info">
                        <!-- Badge -->
                        @php
                            $firstVariation = $product->variations->first();
                            $discount = $firstVariation->discount_percentage ?? 0;
                            $inStock = ($firstVariation->stock ?? 0) > 0;
                        @endphp

                        <div class="d-flex gap-2 mb-2">
                            @if($product->is_new)
                                <span class="badge bg-primary" id="newBadge">New</span>
                            @endif

                            <span class="badge bg-danger" id="discountBadge" @if(!$inStock || $discount <= 0)
                            style="display:none;" @endif>-{{ $discount }}% OFF</span>
                        </div>

                        <!-- Product Title -->
                        <h2 class="fw-bold mb-3">{{ $product->name }}</h2>

                        <!-- Rating -->
                        <div class="d-flex align-items-center mb-3">
                            <span class="text-warning fs-5">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </span>
                            <span class="ms-2 text-muted">(4.5) 128 Reviews</span>
                        </div>

                        <!-- Price -->
                        @php
                            $firstVariation = $product->variations->first();
                            $hasDiscount = $firstVariation->regular_price > 0;
                        @endphp
                        <div class="price-section mb-4">
                            <h3 class="text-success fw-bold d-inline" id="currentPrice">
                                ${{ number_format($firstVariation->sale_price, 2) }}
                            </h3>
                            <span class="text-muted text-decoration-line-through fs-5 ms-2" id="originalPrice"
                                @if(!$hasDiscount) style="display:none;"
                                @endif>${{ number_format($firstVariation->regular_price, 2) }}</span>
                        </div>

                        <!-- Short Description -->
                        <p class="text-muted mb-4">
                            {{ $product->short_description }}
                        </p>

                        <!-- Availability -->
                        <div class="mb-3">
                            <span class="fw-bold">Availability:</span>
                            <span class="text-success" id="inStockLabel" style="display:none;"><i
                                    class="bi bi-check-circle-fill"></i> In Stock</span>
                            <span class="text-danger" id="outOfStockLabel" style="display:none;"><i
                                    class="bi bi-x-circle-fill"></i> Out of Stock</span>
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <span class="fw-bold">Category:</span>
                            <a href="{{ route('products') }}"
                                class="text-success text-decoration-none">{{ $product->category->name }}</a>
                        </div>

                        <!-- Weight/Size Options -->
                        <div class="mb-4">
                            <label class="fw-bold mb-2">Weight:</label>
                            <div class="btn-group" role="group">
                                @foreach ($product->variations as $variation)
                                    <input type="radio" class="btn-check weight-option" name="weight"
                                        id="weight{{ $loop->iteration }}" value="1"
                                        data-price="{{ $variation->sale_price }}"
                                        data-original="{{ $variation->regular_price }}"
                                        data-stock="{{ $variation->stock ?? 0 }}"
                                        data-discount="{{ $variation->discount_percentage }}" {{ $loop->first ? 'checked' : '' }}>
                                    <label class="btn btn-outline-success" for="weight{{ $loop->iteration }}">{{ $variation->label }}</label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="mb-4">
                            <label class="fw-bold mb-2">Quantity:</label>
                            <div class="input-group product-quantity-input">
                                <button class="btn btn-outline-success" type="button" id="decrementBtn">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <input type="number" class="form-control text-center" id="quantityInput" value="1" min="1">
                                <button class="btn btn-outline-success" type="button" id="incrementBtn">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 mb-4">
                            <button class="btn btn-success btn-lg flex-grow-1" id="addToCartBtn">
                                <i class="bi bi-cart-plus me-2"></i>Add to Cart
                            </button>
                            <button class="btn btn-outline-success btn-lg" id="wishlistBtn">
                                <i class="bi bi-heart"></i>
                            </button>
                            <button class="btn btn-outline-success btn-lg" id="shareBtn">
                                <i class="bi bi-share"></i>
                            </button>
                        </div>

                        <!-- Buy Now Button -->
                        <button class="btn btn-dark btn-lg w-100 mb-4" id="buyNowBtn">
                            <i class="bi bi-lightning-fill me-2"></i>Buy Now
                        </button>

                    </div>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="row mt-5">
                <div class="col-12">
                    <ul class="nav nav-tabs" id="productTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                data-bs-target="#description" type="button">
                                Description
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info"
                                type="button">
                                Additional Information
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                                type="button">
                                Reviews (128)
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content border border-top-0 p-4" id="productTabContent">
                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="description">
                            {!! $product->description !!}
                        </div>

                        <!-- Additional Info Tab -->
                        <div class="tab-pane fade" id="info">
                            <h5 class="mb-3">Additional Information</h5>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th width="30%">Weight</th>
                                        <td>1 kg, 2 kg, 5 kg</td>
                                    </tr>
                                    <tr>
                                        <th>Origin</th>
                                        <td>USA</td>
                                    </tr>
                                    <tr>
                                        <th>Quality</th>
                                        <td>Organic</td>
                                    </tr>
                                    <tr>
                                        <th>Check</th>
                                        <td>Healthy</td>
                                    </tr>
                                    <tr>
                                        <th>Shelf Life</th>
                                        <td>7-10 days when refrigerated</td>
                                    </tr>
                                    <tr>
                                        <th>Storage</th>
                                        <td>Store in a cool, dry place or refrigerate</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="reviews">
                            <h5 class="mb-4">Customer Reviews</h5>

                            <!-- Review Item -->
                            <div class="review-item border-bottom pb-4 mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar-circle bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 50px; height: 50px;">
                                        <strong>JD</strong>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">John Doe</h6>
                                        <div class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mb-2"><small>Reviewed on November 5, 2025</small></p>
                                <p>Excellent quality apples! Very fresh and crisp. Will definitely order again.</p>
                            </div>

                            <!-- Review Item -->
                            <div class="review-item border-bottom pb-4 mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar-circle bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 50px; height: 50px;">
                                        <strong>SM</strong>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Sarah Miller</h6>
                                        <div class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mb-2"><small>Reviewed on November 3, 2025</small></p>
                                <p>Great taste and perfect for baking. A bit pricey but worth it for the quality.</p>
                            </div>

                            <!-- Add Review Form -->
                            <div class="mt-5">
                                <h5 class="mb-3">Write a Review</h5>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Your Rating</label>
                                        <div class="rating-input">
                                            <i class="bi bi-star text-warning fs-4 me-1"></i>
                                            <i class="bi bi-star text-warning fs-4 me-1"></i>
                                            <i class="bi bi-star text-warning fs-4 me-1"></i>
                                            <i class="bi bi-star text-warning fs-4 me-1"></i>
                                            <i class="bi bi-star text-warning fs-4 me-1"></i>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Your Name</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Your Review</label>
                                        <textarea class="form-control" rows="4" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit Review</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="fw-bold mb-4">Related Products</h3>
                    <div class="row g-4">
                        <!-- Related Product 1 -->
                        @forelse($relatedProducts as $relatedProduct)
                            <div class="col-lg-3 col-md-6">
                                <div class="card product-card h-100 border-0 shadow-sm">
                                    <div class="position-relative">
                                        <a href="{{ route('product', $relatedProduct->slug) }}">
                                            <div
                                                class="product-image bg-light d-flex align-items-center justify-content-center overflow-hidden">
                                                <img src="{{ asset('uploads/product/' . $relatedProduct->photo) }}"
                                                    alt="{{ $relatedProduct->name }}" class="img-fluid w-100 h-100">
                                            </div>
                                        </a>
                                        <button class="btn btn-sm btn-success position-absolute bottom-0 end-0 m-2">
                                            <i class="bi bi-cart-plus"></i>
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <p class="small text-muted mb-1">{{ $relatedProduct->category->name }}</p>
                                        <h6 class="card-title">
                                            <a href="{{ route('product', $relatedProduct->slug) }}"
                                                class="text-decoration-none text-dark">{{ $relatedProduct->name }}
                                            </a>
                                        </h6>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="text-warning small">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </span>
                                            <small class="text-muted ms-2">(4.7)</small>
                                        </div>
                                        @foreach($relatedProduct->variations as $variation)
                                            <span
                                                class="text-success fw-bold fs-5">${{ number_format($variation->sale_price, 2) }}</span>
                                            <span
                                                class="text-muted text-decoration-line-through small ms-1">${{ number_format($variation->regular_price, 2) }}</span>
                                            @break
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-danger">No related products found</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            console.log('Script loaded');

            // get sale price and regular price
            var salePrice = parseFloat('{{ $product->variations->first()->sale_price }}');
            var regularPrice = parseFloat('{{ $product->variations->first()->regular_price }}');

            // Store base unit prices
            var baseUnitPrice = salePrice;
            var baseOriginalPrice = regularPrice;

            // Get initial stock from the first variation
            var initialStock = parseInt('{{ $product->variations->first()->stock ?? 0 }}');

            // Function to update discount badge based on the selected variation
            function updateDiscountBadge() {
                var selectedOption = $('input[name="weight"]:checked');
                var discount = parseFloat(selectedOption.data('discount') || 0);
                var stock = parseInt(selectedOption.data('stock') || 0);

                if (stock > 0 && discount > 0) {
                    $('#discountBadge').text('-' + discount + '% OFF').show();
                } else {
                    $('#discountBadge').hide();
                }
            }

            // Function to update stock status
            function updateStockStatus(stock) {
                if (stock > 0) {
                    $('#inStockLabel').show();
                    $('#outOfStockLabel').hide();
                    $('#addToCartBtn').prop('disabled', false);
                    updateDiscountBadge();
                } else {
                    $('#inStockLabel').hide();
                    $('#outOfStockLabel').show();
                    $('#addToCartBtn').prop('disabled', true);
                    $('#discountBadge').hide();
                }
            }

            updateStockStatus(initialStock);
            

            // Function to update total price
            function updateTotalPrice() {
                var quantity = parseInt($('#quantityInput').val());
                var currentStock = getCurrentStock();

                if (quantity > currentStock) {
                    quantity = currentStock;
                    $('#quantityInput').val(quantity);
                }

                var totalPrice = baseUnitPrice * quantity;
                var originalTotal = baseOriginalPrice * quantity;

                $('#currentPrice').text('$' + totalPrice.toFixed(2));

                if (baseOriginalPrice > 0) {
                    $('#originalPrice').text('$' + originalTotal.toFixed(2)).show();
                } else {
                    $('#originalPrice').hide();
                }
            }

            // Helper function to get current stock
            function getCurrentStock() {
                var selectedOption = $('input[name="weight"]:checked');
                return parseInt(selectedOption.data('stock') || 0);
            }

            // Weight option change handler
            $('input[name="weight"]').on('change', function () {
                baseUnitPrice = parseFloat($(this).data('price'));
                baseOriginalPrice = parseFloat($(this).data('original'));

                var newStock = parseInt($(this).data('stock') || 0);

                $('#quantityInput').val(1);

                $('#currentPrice').text('$' + baseUnitPrice.toFixed(2));

                if (baseOriginalPrice > 0) {
                    $('#originalPrice').text('$' + baseOriginalPrice.toFixed(2)).show();
                } else {
                    $('#originalPrice').hide();
                }

                updateStockStatus(newStock);
                updateTotalPrice();
            });

            // Quantity increment/decrement handlers
            $('#incrementBtn').on('click', function () {
                var input = $('#quantityInput');
                var currentVal = parseInt(input.val());
                var currentStock = getCurrentStock();

                if (currentVal < currentStock) {
                    input.val(currentVal + 1);
                    updateTotalPrice();
                }
            });

            // Quantity decrement handler
            $('#decrementBtn').on('click', function () {
                var input = $('#quantityInput');
                var currentVal = parseInt(input.val());
                if (currentVal > 1) {
                    input.val(currentVal - 1);
                    updateTotalPrice();
                }
            });

            // Handle manual input change
            $('#quantityInput').on('change', function () {
                var currentVal = parseInt($(this).val());
                var currentStock = getCurrentStock();

                if (currentVal < 1 || isNaN(currentVal)) {
                    $(this).val(1);
                } else if (currentVal > currentStock) {
                    $(this).val(currentStock);
                }
                updateTotalPrice();
            });
        });
    </script>
@endpush