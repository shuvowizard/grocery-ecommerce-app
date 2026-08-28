@extends('frontend.layouts.app')

@section('title', 'Orders')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Orders</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Customer Orders Section -->
    <section class="customer-dashboard customer-orders py-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                @include('user.auth.sidebar')

                <!-- Orders Content -->
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold mb-0">My Orders</h3>
                    </div>

                    <!-- Orders List -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm mb-0">
                                    <thead class="bg-light">
                                        <tr class="text-center">
                                            <th class="px-4 py-3">Order ID</th>
                                            <th class="py-3">Date</th>
                                            <th class="py-3">Payment Method</th>
                                            <th class="py-3">Total Price</th>
                                            <th class="py-3">Payment Status</th>
                                            <th class="py-3">Delivery Status</th>
                                            <th class="py-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($orders->count() > 0)
                                            @foreach ($orders as $order)
                                                <tr class="text-center">
                                                    <td class="py-3 fw-bold">#{{ $order->order_no }}</td>
                                                    <td class="py-3">{{ $order->created_at->format('d M Y') }}</td>
                                                    <td class="py-3 fw-bold text-success">
                                                        {{ strtoupper($order->payment_method) }}</td>
                                                    <td class="py-3 fw-bold text-success">
                                                        ${{ number_format($order->total_price, 2) }}</td>
                                                    <td class="py-3">
                                                        @if ($order->payment_status === 'paid')
                                                            <span
                                                                class="badge bg-success">{{ $order->payment_status }}</span>
                                                        @elseif($order->payment_status === 'pending')
                                                            <span
                                                                class="badge bg-warning">{{ $order->payment_status }}</span>
                                                        @else
                                                            <span
                                                                class="badge bg-danger">{{ $order->payment_status }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="py-3">
                                                        @if ($order->status === 'pending')
                                                            <span class="badge bg-warning">{{ $order->status }}</span>
                                                        @elseif($order->status === 'processing')
                                                            <span class="badge bg-info">{{ $order->status }}</span>
                                                        @elseif($order->status === 'shipped')
                                                            <span class="badge bg-primary">{{ $order->status }}</span>
                                                        @elseif($order->status === 'delivered')
                                                            <span class="badge bg-success">{{ $order->status }}</span>
                                                        @elseif($order->status === 'cancelled')
                                                            <span class="badge bg-danger">{{ $order->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="py-3">
                                                        <a href="{{ route('order.invoice', $order->order_no) }}"
                                                            class="btn btn-sm btn-success me-1">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('order.invoice.download', $order->order_no) }}"
                                                            class="btn btn-sm btn-outline-success" title="Download PDF">
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="text-center">
                                                <td colspan="7" class="py-3">No orders found. Please place an order.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }} --}}
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
