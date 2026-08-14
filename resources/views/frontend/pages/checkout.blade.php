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
                            <form method="POST" action="#" id="checkoutForm">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', auth()->user()?->name) }}" placeholder="Enter your name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', auth()->user()?->email) }}"
                                            placeholder="Enter your email">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" class="form-control"
                                            value="{{ old('phone', auth()->user()?->phone) }}"
                                            placeholder="Enter your phone number">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Address <span class="text-danger">*</span></label>
                                        <input type="text" name="address" class="form-control"
                                            value="{{ old('address', auth()->user()?->address) }}"
                                            placeholder="Enter your address">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="country">Country <span
                                                class="text-danger">*</span></label>
                                        @php $selectedCountry = old('country', auth()->user()?->country); @endphp
                                        <select class="form-select" name="country" id="country" required>
                                            <option value="" disabled {{ $selectedCountry == '' ? 'selected' : '' }}>
                                                Select Country</option>
                                            <option value="USA" {{ $selectedCountry == 'USA' ? 'selected' : '' }}>United
                                                States</option>
                                            <option value="Canada" {{ $selectedCountry == 'Canada' ? 'selected' : '' }}>
                                                Canada</option>
                                            <option value="UK" {{ $selectedCountry == 'UK' ? 'selected' : '' }}>United
                                                Kingdom</option>
                                            <option value="Australia"
                                                {{ $selectedCountry == 'Australia' ? 'selected' : '' }}>Australia</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">State <span class="text-danger">*</span></label>
                                        <input type="text" name="state" class="form-control"
                                            value="{{ old('state', auth()->user()?->state) }}"
                                            placeholder="Enter your state">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">City <span class="text-danger">*</span></label>
                                        <input type="text" name="city" class="form-control"
                                            value="{{ old('city', auth()->user()?->city) }}" placeholder="Enter your city">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Zip Code <span class="text-danger">*</span></label>
                                        <input type="text" name="zip" class="form-control"
                                            value="{{ old('zip', auth()->user()?->zip) }}"
                                            placeholder="Enter your zip code">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Order Notes <span
                                                class="text-muted small">(Optional)</span></label>
                                        <textarea class="form-control" name="order_notes" rows="3"
                                            placeholder="Notes about your order, e.g. special notes for delivery">{{ old('order_notes') }}</textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Shipping Method -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Shipping Method</h5>

                            @foreach ($delivery_options as $item)
                                <div class="form-check mb-3 p-3 border rounded">
                                    <input class="form-check-input shipping-method" type="radio"
                                        name="delivery_option_id" id="current_item_{{ $loop->iteration }}"
                                        data-charge="{{ $item->charge }}" value="{{ $item->id }}"
                                        {{ session()->get('delivery_option_id') == $item->id ? 'checked' : '' }}>
                                    <label class="form-check-label w-100 d-flex justify-content-between"
                                        for="current_item_{{ $loop->iteration }}">
                                        <div>
                                            <strong>{{ $item->name }}</strong>
                                            <div class="small text-muted">{{ $item->description }}</div>
                                        </div>
                                        <strong class="text-success">${{ number_format($item->charge, 2) }}</strong>
                                    </label>
                                </div>
                            @endforeach
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
                                @foreach ($cart as $item)
                                    @php
                                        $variation = $variations->get($item['product_variation_id']);
                                        $product = $variation?->product;
                                        $itemTotal = ($variation?->sale_price ?? 0) * $item['quantity'];
                                    @endphp
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ asset('uploads/product/' . $product->photo) }}"
                                            alt="{{ $product->name }}" class="rounded me-2 product-thumb">
                                        <div class="flex-grow-1">
                                            <small class="d-block">{{ $product->name }}</small>
                                            <small class="text-muted">{{ $variation->label }} ×
                                                {{ $item['quantity'] }}</small>
                                        </div>
                                        <span class="fw-bold">${{ number_format($itemTotal, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <hr>

                            <!-- Pricing Details -->
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal:</span>
                                <span id="subtotal">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Delivery Fee:</span>
                                <span id="deliveryFee">${{ number_format($delivery_charge, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Discount:</span>
                                <span class="text-success"
                                    id="discount">-${{ number_format($discount_amount, 2) }}</span>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold fs-5">Total:</span>
                                <span class="fw-bold fs-5 text-success"
                                    id="total">${{ number_format($total, 2) }}</span>
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
        $(document).ready(function() {

            // Shipping method change handler
            $('.shipping-method').on('change', async function() {
                const deliveryOptionId = $(this).val();
                const charge = parseFloat($(this).data('charge'));

                // Optimistic update
                $('#deliveryFee').text('$' + charge.toFixed(2));

                try {
                    const {
                        data
                    } = await axios.post("{{ route('checkout.shipping.update') }}", {
                        delivery_option_id: deliveryOptionId,
                    });

                    $('#deliveryFee').text('$' + data.delivery_charge.toFixed(2));
                    $('#total').text('$' + data.total.toFixed(2));

                    iziToast.success({
                        message: data.message,
                        position: 'topRight',
                        timeout: 3000,
                    });
                } catch (error) {
                    const message = error.response?.data?.message || 'Something went wrong. Please try again.';
                    iziToast.error({
                        message: message,
                        position: 'topRight',
                        timeout: 3000,
                    });
                }
            });

        });
    </script>
@endpush
