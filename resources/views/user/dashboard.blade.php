@extends('frontend.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Account</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Customer Dashboard Section -->
    <section class="customer-dashboard py-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                @include('user.auth.sidebar')

                <!-- Dashboard Content -->
                <div class="col-lg-9">
                    <h3 class="fw-bold mb-4">Dashboard</h3>

                    <!-- Stats Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <div
                                        class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 avatar-circle-md">
                                        <i class="bi bi-bag-check text-primary fs-4"></i>
                                    </div>
                                    <h4 class="fw-bold mb-1">24</h4>
                                    <small class="text-muted">Total Orders</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <div
                                        class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 avatar-circle-md">
                                        <i class="bi bi-clock-history text-success fs-4"></i>
                                    </div>
                                    <h4 class="fw-bold mb-1">2</h4>
                                    <small class="text-muted">Pending</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <div
                                        class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 avatar-circle-md">
                                        <i class="bi bi-truck text-info fs-4"></i>
                                    </div>
                                    <h4 class="fw-bold mb-1">1</h4>
                                    <small class="text-muted">Shipped</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <div
                                        class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 avatar-circle-md">
                                        <i class="bi bi-heart text-warning fs-4"></i>
                                    </div>
                                    <h4 class="fw-bold mb-1">6</h4>
                                    <small class="text-muted">Wishlist</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold">Recent Orders</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="px-4 py-3">Order ID</th>
                                            <th class="py-3">Date</th>
                                            <th class="py-3">Total</th>
                                            <th class="py-3">Status</th>
                                            <th class="py-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-4 py-3">#ORD-2024-1001</td>
                                            <td class="py-3">Nov 10, 2025</td>
                                            <td class="py-3 fw-bold">$45.99</td>
                                            <td class="py-3"><span class="badge bg-success">Delivered</span></td>
                                            <td class="py-3">
                                                <a href="customer-invoice.html"
                                                    class="btn btn-sm btn-outline-success">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3">#ORD-2024-1002</td>
                                            <td class="py-3">Nov 08, 2025</td>
                                            <td class="py-3 fw-bold">$32.50</td>
                                            <td class="py-3"><span class="badge bg-info">Shipped</span></td>
                                            <td class="py-3">
                                                <a href="customer-invoice.html"
                                                    class="btn btn-sm btn-outline-success">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3">#ORD-2024-1003</td>
                                            <td class="py-3">Nov 05, 2025</td>
                                            <td class="py-3 fw-bold">$78.25</td>
                                            <td class="py-3"><span class="badge bg-warning">Pending</span></td>
                                            <td class="py-3">
                                                <a href="customer-invoice.html"
                                                    class="btn btn-sm btn-outline-success">View</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-center py-3">
                            <a href="customer-orders.html" class="text-success text-decoration-none fw-bold">
                                View All Orders <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection