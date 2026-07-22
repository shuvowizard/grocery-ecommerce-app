@extends('frontend.layouts.app')

@section('title', 'Blog')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="blog-section py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="fw-bold mb-3">Latest Articles</h2>
                    <p class="text-muted">Stay updated with healthy eating tips, recipes, and grocery shopping guides</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Blog Post 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <a href="{{ route('post', 1) }}">
                            <img src="{{  asset('dist-frontend/images/post1.jpg')  }}" class="card-img-top" alt="Blog Post">
                        </a>
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="text-muted"><i class="bi bi-calendar3"></i> Nov 10, 2025</span>
                            </div>
                            <h5 class="card-title fw-bold">
                                <a href="{{ route('post', 1) }}" class="text-dark text-decoration-none">10 Benefits of Eating Fresh
                                    Fruits Daily</a>
                            </h5>
                            <p class="card-text text-muted">Discover how incorporating fresh fruits into your daily diet can
                                improve your health and boost your immune system...</p>
                            <a href="{{ route('post', 1) }}" class="btn btn-outline-success">Read More <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Blog Post 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <a href="{{ route('post', 1) }}">
                            <img src="{{ asset('dist-frontend/images/post2.jpg')}}" class="card-img-top" alt="Blog Post">
                        </a>
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="text-muted"><i class="bi bi-calendar3"></i> Nov 08, 2025</span>
                            </div>
                            <h5 class="card-title fw-bold">
                                <a href="{{ route('post', 1) }}" class="text-dark text-decoration-none">Easy Vegetarian Recipes for Busy
                                    Weekdays</a>
                            </h5>
                            <p class="card-text text-muted">Quick and delicious vegetarian meals that you can prepare in
                                under 30 minutes for your busy schedule...</p>
                            <a href="{{ route('post', 1) }}" class="btn btn-outline-success">Read More <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Blog Post 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <a href="{{ route('post', 1) }}">
                            <img src="{{ asset('dist-frontend/images/post3.jpg')}}" class="card-img-top" alt="Blog Post">
                        </a>
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="text-muted"><i class="bi bi-calendar3"></i> Nov 05, 2025</span>
                            </div>
                            <h5 class="card-title fw-bold">
                                <a href="{{ route('post', 1) }}" class="text-dark text-decoration-none">How to Choose the Best Fresh
                                    Produce</a>
                            </h5>
                            <p class="card-text text-muted">Learn expert tips on selecting the freshest fruits and
                                vegetables at your local grocery store or market...</p>
                            <a href="{{ route('post', 1) }}" class="btn btn-outline-success">Read More <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Blog Post 4 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <a href="{{ route('post', 1) }}">
                            <img src="{{ asset('dist-frontend/images/post4.jpg')}}" class="card-img-top" alt="Blog Post">
                        </a>
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="text-muted"><i class="bi bi-calendar3"></i> Nov 01, 2025</span>
                            </div>
                            <h5 class="card-title fw-bold">
                                <a href="{{ route('post', 1) }}" class="text-dark text-decoration-none">Complete Guide to Protein-Rich
                                    Foods</a>
                            </h5>
                            <p class="card-text text-muted">Everything you need to know about protein sources and how to
                                incorporate them into your daily meals...</p>
                            <a href="{{ route('post', 1) }}" class="btn btn-outline-success">Read More <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Blog Post 5 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <a href="{{ route('post', 1) }}">
                            <img src="{{ asset('dist-frontend/images/post5.jpg')}}" class="card-img-top" alt="Blog Post">
                        </a>
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="text-muted"><i class="bi bi-calendar3"></i> Oct 28, 2025</span>
                            </div>
                            <h5 class="card-title fw-bold">
                                <a href="{{ route('post', 1) }}" class="text-dark text-decoration-none">The Power of Green Vegetables</a>
                            </h5>
                            <p class="card-text text-muted">Why green vegetables should be a staple in your diet and how
                                they can transform your health...</p>
                            <a href="{{ route('post', 1) }}" class="btn btn-outline-success">Read More <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Blog Post 6 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <a href="{{ route('post', 1) }}">
                            <img src="{{ asset('dist-frontend/images/post6.jpg')}}" class="card-img-top" alt="Blog Post">
                        </a>
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="text-muted"><i class="bi bi-calendar3"></i> Oct 25, 2025</span>
                            </div>
                            <h5 class="card-title fw-bold">
                                <a href="{{ route('post', 1) }}" class="text-dark text-decoration-none">Meal Prep Ideas for the Week</a>
                            </h5>
                            <p class="card-text text-muted">Save time and eat healthy with these simple meal prep strategies
                                and batch cooking techniques...</p>
                            <a href="{{ route('post', 1) }}" class="btn btn-outline-success">Read More <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <nav class="mt-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
@endsection