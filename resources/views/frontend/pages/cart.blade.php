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

            @if (session()->has('cart') && count(session()->get('cart')) > 0)
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
                                                <tr class="cart-item"
                                                    data-variation-id="{{ $item['product_variation_id'] }}"
                                                    data-stock="{{ $variation->stock ?? 0 }}"
                                                    data-price="{{ $price }}">
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
                                                        <span
                                                            class="fw-bold item-total">${{ number_format($total, 2) }}</span>
                                                    </td>
                                                    <td class="py-3 align-middle">
                                                        <button class="btn btn-sm btn-outline-danger remove-item-btn">
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
                            <button class="btn btn-outline-danger" id="clearCartBtn">
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
                                    <span class="fw-bold" id="subtotal">${{ number_format($subTotal, 2) }}</span>
                                </div>

                                @php
                                    $deliveryCharge = session('delivery_option_charge', 0);
                                    $couponDiscount = $appliedCoupon['discount_amount'] ?? 0;
                                    $grandTotal = $subTotal - $couponDiscount + $deliveryCharge;
                                @endphp

                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted">Delivery Fee:</span>
                                    <span class="fw-bold" id="delivery">(+)
                                        ${{ number_format($deliveryCharge, 2) }}</span>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted">Discount:</span>
                                    <span class="text-success fw-bold" id="discount">(-)
                                        ${{ number_format($couponDiscount, 2) }}</span>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between mb-4">
                                    <span class="fw-bold fs-5">Total:</span>
                                    <span class="fw-bold fs-5 text-success"
                                        id="total">${{ number_format($grandTotal, 2) }}</span>
                                </div>

                                <!-- Coupon Code -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Have a Coupon?</label>
                                    <div class="input-group {{ $appliedCoupon ? 'd-none' : '' }}" id="couponInputGroup">
                                        <input type="text" class="form-control" id="couponInput"
                                            placeholder="Enter coupon code">
                                        <button class="btn btn-outline-success" type="button"
                                            id="applyCouponBtn">Apply</button>
                                    </div>

                                    <div id="appliedCouponInfo" class="{{ $appliedCoupon ? '' : 'd-none' }} mt-2">
                                        <span class="badge bg-success"
                                            id="appliedCouponCode">{{ $appliedCoupon['code'] ?? '' }}</span>
                                        <button class="btn btn-sm btn-link text-danger p-0 ms-2"
                                            id="removeCouponBtn">Remove</button>
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
            @else
                <div class="col-lg-12">
                    <p class="text-danger">Your cart is empty. <a href="{{ route('products') }}" class="text-success"
                            style="text-decoration: none;">Continue Shopping...</a></p>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // INITIAL VALUES (from Blade/session on page load)
            let currentDiscount = {{ $couponDiscount ?? 0 }};
            const deliveryFee = {{ $deliveryCharge ?? 0 }};

            // Read subtotal currently shown on screen
            function getCurrentSubtotal() {
                return parseFloat($('#subtotal').text().replace(/[^0-9.]/g, '')) || 0;
            }

            // Update badge, subtotal, discount, and total from a cart summary response
            function applyCartSummary(data) {
                document.getElementById('cartCountBadge').textContent = data.cart_count;
                $('#subtotal').text('$' + data.subtotal.toFixed(2));
                currentDiscount = data.discount_amount;
                $('#discount').text('(-) $' + data.discount_amount.toFixed(2));
                $('#total').text('$' + data.total.toFixed(2));
            }

            function showSuccess(message) {
                iziToast.success({
                    message,
                    position: 'topRight',
                    timeout: 3000
                });
            }

            function showError(error, fallback = 'Something went wrong. Please try again.') {
                iziToast.error({
                    message: error.response?.data?.message || fallback,
                    position: 'topRight',
                    timeout: 3000
                });
            }

            function getRowStock($row) {
                return parseInt($row.data('stock')) || 0;
            }

            /* ---------- Product Quantity Update ---------- */
            async function updateCartQuantity($row, quantity) {
                try {
                    const {
                        data
                    } = await axios.post("{{ route('cart.update') }}", {
                        product_variation_id: $row.data('variation-id'),
                        quantity,
                    });

                    $row.find('.item-total').text('$' + data.item_total.toFixed(2));
                    applyCartSummary(data);
                    showSuccess(data.message);
                } catch (error) {
                    showError(error);
                }
            }

            /* ---------- Increase Quantity ---------- */
            $('.qty-increase').on('click', function() {
                const $row = $(this).closest('.cart-item');
                const input = $row.find('.qty-input');
                const currentVal = parseInt(input.val());

                if (currentVal >= getRowStock($row)) {
                    return iziToast.warning({
                        message: 'Cannot add more than available stock.',
                        position: 'topRight',
                        timeout: 3000
                    });
                }

                input.val(currentVal + 1);
                updateCartQuantity($row, currentVal + 1);
            });

            /* ---------- Decrease Quantity ---------- */
            $('.qty-decrease').on('click', function() {
                const $row = $(this).closest('.cart-item');
                const input = $row.find('.qty-input');
                const currentVal = parseInt(input.val());

                if (currentVal <= 1) {
                    return iziToast.warning({
                        message: 'Quantity cannot be less than 1.',
                        position: 'topRight',
                        timeout: 3000
                    });
                }

                input.val(currentVal - 1);
                updateCartQuantity($row, currentVal - 1);
            });

            /*  Manual quantity input change (typed directly into the box)  */
            $('.qty-input').on('change', function() {
                const $row = $(this).closest('.cart-item');
                const stock = getRowStock($row);
                let val = parseInt($(this).val());

                if (val < 1 || isNaN(val)) {
                    val = 1;
                } else if (val > stock) {
                    val = stock;
                    iziToast.warning({
                        message: 'Cannot add more than available stock.',
                        position: 'topRight',
                        timeout: 3000
                    });
                }

                $(this).val(val);
                updateCartQuantity($row, val);
            });

            /* ---------- Remove / Clear ---------- */
            $(document).on('click', '.remove-item-btn', async function() {
                const $row = $(this).closest('.cart-item');

                try {
                    const {
                        data
                    } = await axios.post("{{ route('cart.remove') }}", {
                        product_variation_id: $row.data('variation-id'),
                    });

                    $row.remove();
                    applyCartSummary(data);
                    showSuccess(data.message);

                    if (data.cart_count === 0) location.reload();
                } catch (error) {
                    showError(error);
                }
            });

            $('#clearCartBtn').on('click', async function() {
                try {
                    const {
                        data
                    } = await axios.post("{{ route('cart.clear') }}");
                    document.getElementById('cartCountBadge').textContent = data.cart_count;
                    showSuccess(data.message);
                    location.reload();
                } catch (error) {
                    showError(error, 'Something went wrong.');
                }
            });

            /* ---------- Coupon Apply ---------- */
            $('#applyCouponBtn').on('click', async function() {
                const code = $('#couponInput').val().trim();

                if (!code) {
                    return iziToast.warning({
                        message: 'Please enter a coupon code.',
                        position: 'topRight',
                        timeout: 3000
                    });
                }

                try {
                    const {
                        data
                    } = await axios.post("{{ route('cart.coupon.apply') }}", {
                        code,
                        subtotal: getCurrentSubtotal(),
                    });

                    currentDiscount = data.discount_amount;
                    $('#discount').text('(-) $' + data.discount_amount.toFixed(2));
                    $('#total').text('$' + data.total.toFixed(2));
                    $('#appliedCouponCode').text(data.coupon_code);

                    $('#couponInputGroup').addClass('d-none');
                    $('#appliedCouponInfo').removeClass('d-none');

                    showSuccess(data.message);
                } catch (error) {
                    showError(error);
                }
            });

            /* ---------- Coupon Remove ---------- */
            $('#removeCouponBtn').on('click', async function() {
                try {
                    const {
                        data
                    } = await axios.post("{{ route('cart.coupon.remove') }}", {
                        subtotal: getCurrentSubtotal(),
                    });

                    currentDiscount = 0;
                    $('#discount').text('(-) $0.00');
                    $('#total').text('$' + data.total.toFixed(2));
                    $('#couponInput').val('');

                    $('#couponInputGroup').removeClass('d-none');
                    $('#appliedCouponInfo').addClass('d-none');

                    showSuccess(data.message);
                } catch (error) {
                    showError(error, 'Something went wrong.');
                }
            });

        });
    </script>
@endpush
