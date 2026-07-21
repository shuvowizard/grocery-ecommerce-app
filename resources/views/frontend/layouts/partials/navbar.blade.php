<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-success" href="{{ route('home') }}">
            <img src="{{ ('dist-frontend/images/logo.png') }}" alt="FreshMart" height="40" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Categories
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="products.html">Fresh Fruits</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="products.html">Fresh Vegetables</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="products.html">Seafood & Meat</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="products.html">Grains & Pulses</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="products.html">Condiments & Beverages</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.html">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog.html">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <div class="input-group me-3 navbar-search">
                    <input type="text" class="form-control" placeholder="Search products..." />
                    <button class="btn btn-success" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <a href="customer-wishlist.html" class="btn btn-outline-success position-relative me-2">
                    <i class="bi bi-heart"></i>
                </a>
                <a href="cart.html" class="btn btn-success position-relative">
                    <i class="bi bi-cart3"></i>
                    <span class="position-absolute top-0 inset-s-100 translate-middle badge rounded-pill bg-danger">
                        5
                    </span>
                </a>
            </div>
        </div>
    </div>
</nav>