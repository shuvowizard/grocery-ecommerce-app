@extends('frontend.layouts.app')

@section('content')
    <!-- Hero Section -->
    @include('components.hero-section')

    <!-- Features Section -->
    @include('components.features')

    <!-- Categories Section -->
    @include('components.categories')

    <!-- Featured Products Section -->
    @include('components.featured-products')
@endsection

@push('scripts')
    <script>
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
        });
    </script>
@endpush
