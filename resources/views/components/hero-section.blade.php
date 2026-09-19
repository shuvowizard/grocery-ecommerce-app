<section class="hero-section">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        @if($sliders->count() > 1)
            <div class="carousel-indicators">
                @foreach($sliders as $slider)
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $loop->index }}"
                        class="{{ $loop->first ? 'active' : '' }}"></button>
                @endforeach
            </div>
        @endif

        <div class="carousel-inner">
            @forelse($sliders as $slider)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="hero-slide bg-gradient-{{ ($loop->index % 3) + 1 }}">
                        <div class="container">
                            <div class="row align-items-center py-5">
                                <div class="col-lg-6 mb-4 mb-lg-0">
                                    <h1 class="display-3 fw-bold mb-3">{{ $slider->title }}</h1>
                                    @if($slider->description)
                                        <p class="lead mb-4">{{ $slider->description }}</p>
                                    @endif
                                    @if($slider->button_text)
                                        <a href="{{ $slider->button_link ?? '#' }}" class="btn btn-success btn-lg">
                                            {{ $slider->button_text }} <i class="bi bi-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-lg-6 text-center">
                                    <img src="{{ asset('uploads/slider/' . $slider->photo) }}" alt="{{ $slider->title }}"
                                        class="rounded shadow hero-carousel-img" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Default fallback / If no sliders are available --}}
                <div class="carousel-item active">
                    <div class="hero-slide bg-gradient-1">
                        <div class="container">
                            <div class="row align-items-center py-5">
                                <div class="col-lg-6">
                                    <h1 class="display-3 fw-bold mb-3">Fresh Organic Vegetables</h1>
                                    <p class="lead mb-4">Get up to 50% off on fresh organic produce.</p>
                                    <a href="{{ route('products') }}" class="btn btn-success btn-lg">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>