@extends('frontend.layouts.app')

@section('title', 'Contact')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section py-5">
        <div class="container">
            <!-- Page Header -->
            <div class="text-center mb-5">
                <h2 class="fw-bold">Get In Touch</h2>
                <p class="text-muted">Have questions? We'd love to hear from you. Send us a message and we'll respond as
                    soon as possible.</p>
            </div>

            <div class="row g-5">
                <!-- Contact Information -->
                <div class="col-lg-4">
                    <div class="contact-info">
                        <!-- Address -->
                        <div class="info-box mb-4 p-4 bg-light rounded">
                            <div class="d-flex align-items-start">
                                <div
                                    class="icon-box bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 contact-icon-box">
                                    <i class="bi bi-geo-alt text-success fs-3"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-2">Address</h5>
                                    <p class="text-muted mb-0">123 Market Street<br>City, State 12345<br>United States</p>
                                </div>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="info-box mb-4 p-4 bg-light rounded">
                            <div class="d-flex align-items-start">
                                <div
                                    class="icon-box bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 contact-icon-box">
                                    <i class="bi bi-telephone text-success fs-3"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-2">Phone</h5>
                                    <p class="text-muted mb-1">+1 234 567 8900</p>
                                    <p class="text-muted mb-0">+1 234 567 8901</p>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="info-box mb-4 p-4 bg-light rounded">
                            <div class="d-flex align-items-start">
                                <div
                                    class="icon-box bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 contact-icon-box">
                                    <i class="bi bi-envelope text-success fs-3"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-2">Email</h5>
                                    <p class="text-muted mb-1">support@freshmart.com</p>
                                    <p class="text-muted mb-0">info@freshmart.com</p>
                                </div>
                            </div>
                        </div>

                        <!-- Working Hours -->
                        <div class="info-box p-4 bg-light rounded">
                            <div class="d-flex align-items-start">
                                <div
                                    class="icon-box bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 contact-icon-box">
                                    <i class="bi bi-clock text-success fs-3"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-2">Working Hours</h5>
                                    <p class="text-muted mb-1">Mon - Sat: 8:00 AM - 10:00 PM</p>
                                    <p class="text-muted mb-0">Sunday: 9:00 AM - 6:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-8">
                    <div class="contact-form">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4 p-md-5">
                                <h4 class="fw-bold mb-4">Send Us a Message</h4>
                                <form action="" method="POST">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Your Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" name="phone">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Subject <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="subject" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Message <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="message" rows="6" required></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success px-5">
                                                <i class="bi bi-send me-2"></i>Send Message
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="map-container rounded overflow-hidden shadow-sm">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.2412648750455!2d-73.98784368459395!3d40.74844097932847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection