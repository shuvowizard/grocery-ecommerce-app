@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Orders</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-sm" id=example1>
                                <thead>
                                    <tr class="text-center">
                                        <th>#SL</th>
                                        <th>User</th>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Payment Method</th>
                                        <th>Total Price</th>
                                        <th>Payment Status</th>
                                        <th>Delivery Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($orders->count() > 0)
                                        @foreach ($orders as $order)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order->user->name }} <small> <a
                                                            href="{{ route('admin.user.edit', $order->user_id) }}">Details</a></small>
                                                </td>
                                                <td>#{{ $order->order_no }}</td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                                <td>
                                                    @if ($order->payment_method === 'cod')
                                                        Cash On Delivery
                                                    @else
                                                        {{ $order->payment_method }}
                                                    @endif
                                                </td>
                                                <td class="fw-bold text-success">
                                                    ${{ number_format($order->total_price, 2) }}</td>
                                                <td>
                                                    @if ($order->payment_status === 'paid')
                                                        <span class="badge bg-success">{{ $order->payment_status }}</span>
                                                    @elseif($order->payment_status === 'pending')
                                                        <span class="badge bg-warning">{{ $order->payment_status }}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ $order->payment_status }}</span>
                                                    @endif
                                                </td>
                                                {{-- Delivery/Order Status Dropdown --}}
                                                <td>
                                                    <select class="form-select form-select-sm order-status-select"
                                                        data-order-id="{{ $order->id }}">
                                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>                                                        
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-info btn-md "><i
                                                            class="fas fa-file-invoice"></i></a>
                                                    {{-- Delete Button --}}
                                                    <form action="#" method="POST" class="d-inline"
                                                        onsubmit="return confirm('Are you sure you want to delete this order?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-md">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
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
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Order/Delivery status dropdown change handler
            $('.order-status-select').on('change', async function() {
                const orderId = $(this).data('order-id');
                const status = $(this).val();

                try {
                    const {
                        data
                    } = await axios.patch(`/admin/order/${orderId}/status`, {
                        status: status,
                    });

                    iziToast.success({
                        message: data.message,
                        position: 'topRight',
                        timeout: 3000,
                    });

                    location.reload();
                } catch (error) {
                    const message = error.response?.data?.message || 'Something went wrong.';
                    iziToast.error({
                        message: message,
                        position: 'topRight',
                        timeout: 3000,
                    });
                    location.reload();
                }
            });

        });
    </script>
@endpush
