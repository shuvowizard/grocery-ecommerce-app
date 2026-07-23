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
                    <li class="breadcrumb-item active" aria-current="page">Fresh Green Apples</li>
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
                            <img src="{{ asset('dist-frontend/images/Green Apple.jpg') }}" alt="Fresh Green Apples"
                                class="rounded shadow-sm w-100 product-single-img">
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-7">
                    <div class="product-info">
                        <!-- Badge -->
                        <span class="badge bg-danger mb-2">20% OFF</span>

                        <!-- Product Title -->
                        <h2 class="fw-bold mb-3">Fresh Green Apples</h2>

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
                        <div class="price-section mb-4">
                            <h3 class="text-success fw-bold d-inline" id="currentPrice">$4.99</h3>
                            <span class="text-muted text-decoration-line-through fs-5 ms-2" id="originalPrice">$6.99</span>
                        </div>

                        <!-- Short Description -->
                        <p class="text-muted mb-4">
                            Fresh, crisp, and delicious green apples. Perfect for snacking, salads, or baking.
                            These apples are handpicked from organic farms and delivered fresh to your doorstep.
                        </p>

                        <!-- Availability -->
                        <div class="mb-3">
                            <span class="fw-bold">Availability:</span>
                            <span class="text-success"><i class="bi bi-check-circle-fill"></i> In Stock</span>
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <span class="fw-bold">Category:</span>
                            <a href="{{ route('products') }}" class="text-success text-decoration-none">Fruits &
                                Vegetables</a>
                        </div>

                        <!-- Brand -->
                        <div class="mb-3">
                            <span class="fw-bold">Brand:</span>
                            <span class="text-muted">Fresh Harvest</span>
                        </div>

                        <!-- Weight/Size Options -->
                        <div class="mb-4">
                            <label class="fw-bold mb-2">Weight:</label>
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check weight-option" name="weight" id="weight1" value="1"
                                    data-price="4.99" data-original="6.99" checked>
                                <label class="btn btn-outline-success" for="weight1">1 kg</label>

                                <input type="radio" class="btn-check weight-option" name="weight" id="weight2" value="2"
                                    data-price="9.49" data-original="13.49">
                                <label class="btn btn-outline-success" for="weight2">2 kg</label>

                                <input type="radio" class="btn-check weight-option" name="weight" id="weight3" value="5"
                                    data-price="22.99" data-original="32.99">
                                <label class="btn btn-outline-success" for="weight3">5 kg</label>
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
                            <button class="btn btn-success btn-lg flex-grow-1">
                                <i class="bi bi-cart-plus me-2"></i>Add to Cart
                            </button>
                            <button class="btn btn-outline-success btn-lg">
                                <i class="bi bi-heart"></i>
                            </button>
                            <button class="btn btn-outline-success btn-lg">
                                <i class="bi bi-share"></i>
                            </button>
                        </div>

                        <!-- Buy Now Button -->
                        <button class="btn btn-dark btn-lg w-100 mb-4">
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
                            <h5 class="mb-3">Product Description</h5>
                            <p>
                                Our Fresh Green Apples are handpicked from the finest organic orchards. These crisp and
                                juicy apples
                                are perfect for healthy snacking, adding to salads, or using in your favorite recipes. Each
                                apple is
                                carefully selected to ensure the highest quality and freshness.
                            </p>
                            <p>
                                Green apples are known for their slightly tart flavor and firm texture. They're packed with
                                fiber,
                                vitamin C, and antioxidants, making them an excellent choice for a healthy lifestyle. Store
                                them in
                                a cool place or refrigerate to maintain freshness.
                            </p>
                            <h6 class="mt-4 mb-3">Benefits:</h6>
                            <ul>
                                <li>Rich in fiber and vitamin C</li>
                                <li>Low in calories</li>
                                <li>Supports digestive health</li>
                                <li>Great for heart health</li>
                                <li>100% organic and pesticide-free</li>
                            </ul>
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
                        <div class="col-lg-3 col-md-6">
                            <div class="card product-card h-100 border-0 shadow-sm">
                                <div class="position-relative">
                                    <a href="{{ route('product', 1) }}">
                                        <div
                                            class="product-image bg-light d-flex align-items-center justify-content-center overflow-hidden">
                                            <img src="{{ asset('dist-frontend/images/Orange.jpg') }}" alt="Fresh Oranges" class="img-fluid w-100 h-100">
                                        </div>
                                    </a>
                                    <button class="btn btn-sm btn-success position-absolute bottom-0 end-0 m-2">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <p class="small text-muted mb-1">Fruits</p>
                                    <h6 class="card-title"><a href="{{ route('product', 1) }}"
                                            class="text-decoration-none text-dark">Fresh Oranges</a></h6>
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
                                    <span class="text-success fw-bold">$6.99</span>
                                </div>
                            </div>
                        </div>

                        <!-- Add more related products -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection