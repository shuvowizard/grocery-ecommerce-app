<section class="categories py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Shop by Categories</h2>
            <p class="text-muted">Browse our top categories</p>
        </div>
        <div class="row g-4">
            @foreach ($categories as $category)
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="{{ route('products') }}?category={{ $category->slug }}" style="text-decoration: none;">
                        <div
                            class="category-card text-center px-3 bg-success rounded-3 h-100 d-flex flex-column align-items-center justify-content-between">
                            <h6 class="text-white fw-bold mb-0">{{ $category->name }}</h6>
                            <div class="icon">
                                <i class="bi bi-arrow-right text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
