@extends('frontend.layouts.app')

@section('title', 'Checkout')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cart') }}" class="text-success">Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Checkout Section -->
    <section class="checkout-section py-5">
        <div class="container">
            <h2 class="fw-bold mb-4">Checkout</h2>

            <div class="row g-4">
                <!-- Checkout Form -->
                <div class="col-lg-8">
                    <!-- Billing Details -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Billing Details</h5>
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Street Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="House number and street name"
                                            required>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control"
                                            placeholder="Apartment, suite, unit etc. (optional)">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">City <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">State / Province <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">ZIP / Postal Code <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Country <span class="text-danger">*</span></label>
                                        <select class="form-select" required>
                                            <option selected>United States</option>
                                            <option>Canada</option>
                                            <option>United Kingdom</option>
                                            <option>Australia</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Order Notes (Optional)</label>
                                        <textarea class="form-control" rows="3"
                                            placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Shipping Method -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Shipping Method</h5>
                            <div class="form-check mb-3 p-3 border rounded">
                                <input class="form-check-input shipping-method" type="radio" name="shipping" id="standard"
                                    value="5.00" checked>
                                <label class="form-check-label w-100 d-flex justify-content-between" for="standard">
                                    <div>
                                        <strong>Standard Delivery</strong>
                                        <div class="small text-muted">Delivery in 12 hours</div>
                                    </div>
                                    <strong class="text-success">$5.00</strong>
                                </label>
                            </div>
                            <div class="form-check mb-3 p-3 border rounded">
                                <input class="form-check-input shipping-method" type="radio" name="shipping" id="express"
                                    value="8.00">
                                <label class="form-check-label w-100 d-flex justify-content-between" for="express">
                                    <div>
                                        <strong>Express Delivery</strong>
                                        <div class="small text-muted">Delivery in 6 hours</div>
                                    </div>
                                    <strong class="text-success">$8.00</strong>
                                </label>
                            </div>
                            <div class="form-check p-3 border rounded">
                                <input class="form-check-input shipping-method" type="radio" name="shipping" id="sameday"
                                    value="10.00">
                                <label class="form-check-label w-100 d-flex justify-content-between" for="sameday">
                                    <div>
                                        <strong>Fast Delivery</strong>
                                        <div class="small text-muted">Delivery in 2 hours</div>
                                    </div>
                                    <strong class="text-success">$10.00</strong>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Payment Method</h5>

                            <div class="form-check mb-3 p-3 border rounded">
                                <input class="form-check-input" type="radio" name="payment" id="paypal">
                                <label class="form-check-label" for="paypal">
                                    <strong>PayPal</strong>
                                    <div class="small text-muted">You will be redirected to PayPal</div>
                                </label>
                            </div>

                            <div class="form-check mb-3 p-3 border rounded">
                                <input class="form-check-input" type="radio" name="payment" id="stripe">
                                <label class="form-check-label" for="stripe">
                                    <strong>Stripe</strong>
                                    <div class="small text-muted">You will be redirected to Stripe</div>
                                </label>
                            </div>

                            <div class="form-check p-3 border rounded">
                                <input class="form-check-input" type="radio" name="payment" id="cod">
                                <label class="form-check-label" for="cod">
                                    <strong>Cash on Delivery</strong>
                                    <div class="small text-muted">Pay when you receive the order</div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm sticky-top checkout-sticky">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Order Summary</h5>

                            <!-- Cart Items -->
                            <div class="cart-items-summary mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('dist-frontend/images/Green Apple.jpg') }}" alt="Product"
                                        class="rounded me-2 product-thumb">
                                    <div class="flex-grow-1">
                                        <small class="d-block">Fresh Green Apples</small>
                                        <small class="text-muted">1 kg × 1</small>
                                    </div>
                                    <span class="fw-bold">$4.00</span>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('dist-frontend/images/Egg.jpg') }}" alt="Product"
                                        class="rounded me-2 product-thumb">
                                    <div class="flex-grow-1">
                                        <small class="d-block">Farm Fresh Eggs</small>
                                        <small class="text-muted">1 box × 2</small>
                                    </div>
                                    <span class="fw-bold">$10.00</span>
                                </div>
                            </div>

                            <hr>

                            <!-- Pricing Details -->
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal:</span>
                                <span id="subtotal">$14.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Discount:</span>
                                <span class="text-success" id="discount">-$2.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Delivery Fee:</span>
                                <span id="deliveryFee">$5.00</span>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold fs-5">Total:</span>
                                <span class="fw-bold fs-5 text-success" id="total">$17.00</span>
                            </div>

                            <!-- Place Order Button -->
                            <button type="submit" class="btn btn-success w-100 mb-3">
                                <i class="bi bi-lock me-2"></i>Place Order
                            </button>

                            <!-- Security Badge -->
                            <div class="text-center">
                                <small class="text-muted">
                                    <i class="bi bi-shield-check text-success me-1"></i>
                                    Secure Checkout - SSL Encrypted
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Fixed values
            const subtotalAmount = 14.00;
            const discountAmount = 2.00;

            // Function to update order summary
            function updateOrderSummary() {
                // Get selected shipping fee
                let deliveryFee = parseFloat($('.shipping-method:checked').val());

                // Calculate total
                let total = subtotalAmount - discountAmount + deliveryFee;

                // Update display
                $('#deliveryFee').text('$' + deliveryFee.toFixed(2));
                $('#total').text('$' + total.toFixed(2));
            }

            // Shipping method change handler
            $('.shipping-method').on('change', function () {
                updateOrderSummary();
            });
        });
    </script>
@endpush