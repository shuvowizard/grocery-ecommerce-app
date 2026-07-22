<footer class="footer bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-cart-check-fill"></i> FreshMart
                </h5>
                <p class="text-white-50">
                    Your one-stop shop for fresh and organic groceries delivered right
                    to your doorstep.
                </p>
                <div class="social-links">
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                        <i class="bi bi-youtube"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('about') }}" class="text-white-50 text-decoration-none">About Us</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('contact') }}" class="text-white-50 text-decoration-none">Contact Us</a>
                    </li>
                    <li class="mb-2">
                        <a href="privacy.html" class="text-white-50 text-decoration-none">Privacy Policy</a>
                    </li>
                    <li class="mb-2">
                        <a href="terms.html" class="text-white-50 text-decoration-none">Terms & Conditions</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('faq') }}" class="text-white-50 text-decoration-none">FAQs</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-3">Categories</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="products.html" class="text-white-50 text-decoration-none">Fresh Fruits</a>
                    </li>
                    <li class="mb-2">
                        <a href="products.html" class="text-white-50 text-decoration-none">Fresh Vegetables</a>
                    </li>
                    <li class="mb-2">
                        <a href="products.html" class="text-white-50 text-decoration-none">Seafood & Meat</a>
                    </li>
                    <li class="mb-2">
                        <a href="products.html" class="text-white-50 text-decoration-none">Grains & Pulses</a>
                    </li>
                    <li class="mb-2">
                        <a href="products.html" class="text-white-50 text-decoration-none">Condiments &
                            Beverages</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-3">Contact Info</h5>
                <ul class="list-unstyled text-white-50">
                    <li class="mb-2">
                        <i class="bi bi-geo-alt me-2"></i>
                        123 Market Street, City, State 12345
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone me-2"></i>
                        +1 234 567 8900
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-envelope me-2"></i>
                        support@freshmart.com
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-clock me-2"></i>
                        Mon - Sat: 8:00 AM - 10:00 PM
                    </li>
                </ul>
            </div>
        </div>
        <hr class="my-4 bg-white" />
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-white-50 mb-0">
                    &copy; {{ date('Y') }} FreshMart. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>