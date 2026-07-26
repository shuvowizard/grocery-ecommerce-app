<div class="col-lg-3 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <div class="profile-photo">
                    <img src="{{ auth()->guard('web')->user()->photo ? asset('uploads/user/' . auth()->guard('web')->user()->photo) : asset('uploads/default.png') }}"
                        alt="user profile photo">
                </div>
                <h5 class="mb-1">{{ auth()->guard('web')->user()->name }}</h5>
                <small class="text-muted">{{ auth()->guard('web')->user()->email }}</small>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item px-0">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark {{ request()->routeIs('dashboard') ? 'fw-bold' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                </li>
                <li class="list-group-item px-0">
                    <a href="{{ route('orders') }}" class="text-decoration-none text-dark {{ request()->routeIs('orders') ? 'fw-bold' : '' }}">
                        <i class="bi bi-bag-check me-2"></i>My Orders
                    </a>
                </li>
                <li class="list-group-item px-0">
                    <a href="{{ route('wishlist') }}" class="text-decoration-none text-dark {{ request()->routeIs('wishlist') ? 'fw-bold' : '' }}">
                        <i class="bi bi-heart me-2"></i>Wishlist
                    </a>
                </li>
                <li class="list-group-item px-0">
                    <a href="{{ route('profile') }}" class="text-decoration-none text-dark {{ request()->routeIs('profile') ? 'fw-bold' : '' }}">
                        <i class="bi bi-person me-2"></i>Profile Settings
                    </a>
                </li>
                <li class="list-group-item px-0">
                    <a href="{{ route('logout') }}" class="text-decoration-none text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>