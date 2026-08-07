@extends('frontend.layouts.app')

@section('title', 'Cart')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Cart Section -->
    <section class="cart-section py-5">
        <div class="container">
            <h2 class="fw-bold mb-4">Shopping Cart</h2>

            <div class="row g-4">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col" class="px-4 py-3">Product</th>
                                            <th scope="col" class="py-3">Price</th>
                                            <th scope="col" class="py-3">Quantity</th>
                                            <th scope="col" class="py-3">Total</th>
                                            <th scope="col" class="py-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $subTotal = 0;
                                        @endphp
                                        @foreach ($cart as $item)
                                            @php
                                                $variation = $variations->get($item['product_variation_id']);
                                                $product = $variation?->product;
                                                $price = $variation?->sale_price ?? 0;
                                                $total = $price * $item['quantity'];
                                            @endphp
                                            <!-- Cart Item -->
                                            <tr class="cart-item" data-price="{{ $price }}"
                                                data-quantity="{{ $item['quantity'] }}">
                                                <td class="px-4 py-3">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('uploads/product/' . $product->photo) }}"
                                                            alt="{{ $product->photo }}"
                                                            class="rounded me-3 cart-product-thumb">
                                                        <div>
                                                            <h6 class="mb-1">{{ $product->name }}</h6>
                                                            <small class="text-muted">{{ $variation->label }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-3 align-middle">
                                                    <span
                                                        class="fw-bold text-success item-price">${{ number_format($price, 2) }}</span>
                                                </td>
                                                <td class="py-3 align-middle">
                                                    <div class="input-group quantity-input">
                                                        <button class="btn btn-sm btn-outline-secondary qty-decrease"
                                                            type="button">
                                                            <i class="bi bi-dash"></i>
                                                        </button>
                                                        <input type="text"
                                                            class="form-control form-control-sm text-center qty-input"
                                                            value="{{ $item['quantity'] }}">
                                                        <button class="btn btn-sm btn-outline-secondary qty-increase"
                                                            type="button">
                                                            <i class="bi bi-plus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="py-3 align-middle">
                                                    <span class="fw-bold item-total">${{ number_format($total, 2) }}</span>
                                                </td>
                                                <td class="py-3 align-middle">
                                                    <button class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @php
                                                $subTotal += $total;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('products') }}" class="btn btn-outline-success">
                            <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                        </a>
                        <button class="btn btn-outline-danger">
                            <i class="bi bi-trash me-2"></i>Clear Cart
                        </button>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4">Order Summary</h5>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Subtotal:</span>
                                <span class="fw-bold" id="subtotal">{{ number_format($subTotal, 2) }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Discount:</span>
                                <span class="text-success fw-bold" id="discount">-$2.00</span>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Delivery Fee:</span>
                                <span class="fw-bold" id="delivery">$5.00</span>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold fs-5">Total:</span>
                                <span class="fw-bold fs-5 text-success"
                                    id="total">$200</span>
                            </div>

                            <!-- Coupon Code -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Have a Coupon?</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter coupon code">
                                    <button class="btn btn-outline-success" type="button">Apply</button>
                                </div>
                            </div>

                            <!-- Proceed to Checkout -->
                            <a href="{{ route('checkout') }}" class="btn btn-success w-100 mb-3">
                                <i class="bi bi-lock me-2"></i>Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Fixed values
            const discountAmount = 2.00;
            const deliveryFee = 5.00;

            // Function to calculate and update cart totals
            function updateCartTotals() {
                let subtotal = 0;

                // Calculate subtotal from all cart items
                $('.cart-item').each(function() {
                    let price = parseFloat($(this).data('price'));
                    let quantity = parseInt($(this).find('.qty-input').val());
                    let itemTotal = price * quantity;

                    // Update item total
                    $(this).find('.item-total').text('$' + itemTotal.toFixed(2));

                    // Add to subtotal
                    subtotal += itemTotal;
                });

                // Calculate total
                let total = subtotal - discountAmount + deliveryFee;

                // Update summary
                $('#subtotal').text('$' + subtotal.toFixed(2));
                $('#total').text('$' + total.toFixed(2));
            }

            // Quantity increase handler
            $('.qty-increase').on('click', function() {
                let input = $(this).closest('.input-group').find('.qty-input');
                let currentVal = parseInt(input.val());
                input.val(currentVal + 1);
                updateCartTotals();
            });

            // Quantity decrease handler
            $('.qty-decrease').on('click', function() {
                let input = $(this).closest('.input-group').find('.qty-input');
                let currentVal = parseInt(input.val());
                if (currentVal > 1) {
                    input.val(currentVal - 1);
                    updateCartTotals();
                }
            });

            // Handle manual quantity input
            $('.qty-input').on('change', function() {
                let currentVal = parseInt($(this).val());
                if (currentVal < 1 || isNaN(currentVal)) {
                    $(this).val(1);
                }
                updateCartTotals();
            });
        });
    </script>
@endpush
