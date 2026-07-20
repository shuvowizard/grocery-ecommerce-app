@extends('frontend.layouts.app')

@section('title', 'About')

@section('content')

    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- About Hero Section -->
    <section class="about-hero py-5 bg-success bg-opacity-10">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="fw-bold mb-4">Welcome to FreshMart</h1>
                    <p class="lead mb-4">Your trusted partner for fresh, organic, and quality groceries delivered right to
                        your doorstep.</p>
                    <p>Since 2020, we've been committed to providing our customers with the freshest produce, highest
                        quality products, and exceptional service. Our mission is to make healthy living accessible and
                        convenient for everyone.</p>
                </div>
                <div class="col-lg-6">
                    <img src="{{  asset('dist-frontend/images/Green Apple.jpg') }}" alt="FreshMart Store" class="img-fluid rounded shadow about-hero-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="our-story py-5">
        <div class="container">

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div
                                class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 avatar-circle-lg">
                                <i class="bi bi-award text-success icon-2xl"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Quality First</h4>
                            <p class="text-muted mb-0">We source only the finest products from trusted suppliers and local
                                farmers to ensure the highest quality for our customers.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div
                                class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 avatar-circle-lg">
                                <i class="bi bi-truck text-success icon-2xl"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Fast Delivery</h4>
                            <p class="text-muted mb-0">Our efficient delivery network ensures your groceries reach you fresh
                                and on time, every single time.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div
                                class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 avatar-circle-lg">
                                <i class="bi bi-heart text-success icon-2xl"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Customer Care</h4>
                            <p class="text-muted mb-0">Your satisfaction is our priority. Our dedicated support team is
                                always ready to assist you with any questions or concerns.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="mission-vision py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-5">
                            <div class="d-flex align-items-center mb-4">
                                <div
                                    class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 avatar-circle-md">
                                    <i class="bi bi-bullseye text-success fs-3"></i>
                                </div>
                                <h3 class="fw-bold mb-0">Our Mission</h3>
                            </div>
                            <p class="text-muted mb-0">To provide our customers with convenient access to fresh,
                                high-quality groceries while supporting local farmers and sustainable practices. We strive
                                to make healthy living affordable and accessible for all families.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-5">
                            <div class="d-flex align-items-center mb-4">
                                <div
                                    class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 avatar-circle-md">
                                    <i class="bi bi-eye text-success fs-3"></i>
                                </div>
                                <h3 class="fw-bold mb-0">Our Vision</h3>
                            </div>
                            <p class="text-muted mb-0">To become the most trusted and preferred online grocery destination,
                                known for exceptional quality, service, and commitment to sustainability. We envision a
                                future where everyone has easy access to nutritious, fresh food.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="statistics py-5">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="stat-card">
                        <h2 class="fw-bold text-success mb-2">10,000+</h2>
                        <p class="text-muted mb-0">Happy Customers</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <h2 class="fw-bold text-success mb-2">5000+</h2>
                        <p class="text-muted mb-0">Products Available</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <h2 class="fw-bold text-success mb-2">50+</h2>
                        <p class="text-muted mb-0">Local Farmers</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <h2 class="fw-bold text-success mb-2">24/7</h2>
                        <p class="text-muted mb-0">Customer Support</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection