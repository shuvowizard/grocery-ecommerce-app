<div class="top-bar bg-success text-white py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <span><i class="bi bi-telephone"></i> +1 234 567 8900</span>
                <span class="ms-3"><i class="bi bi-envelope"></i> support@freshmart.com</span>
            </div>
            <div class="col-md-6 text-end">
                @auth('web')
                    <span class="ms-3"><i class="bi bi-house-gear-fill"></i>
                        <a href="{{ route('dashboard') }}" class="text-white text-decoration-none">Dashboard</a></span>
                @else
                    <span class="ms-3"><i class="bi bi-box-arrow-in-right"></i>
                        <a href="{{ route('login') }}" class="text-white text-decoration-none">Login</a></span>
                    <span class="ms-3"><i class="bi bi-person"></i>
                        <a href="{{ route('register') }}" class="text-white text-decoration-none">Register</a></span>
                @endauth
            </div>
        </div>
    </div>
</div>