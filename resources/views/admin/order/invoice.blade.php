@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Order Invoice</h1>
        </div>
        <div class="section-body">
            <!-- Invoice Section -->
            <section class="invoice-section mb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <!-- Action Buttons -->
                            <div class="text-center mb-3 no-print">
                                <button class="btn btn-success" onclick="printInvoice()">
                                    <i class="bi bi-printer me-2"></i>Print Invoice
                                </button>
                            </div>

                            <div class="card border-0 shadow-sm" id="print_invoice">
                                <div class="card-body p-4">
                                    <!-- Invoice Content - Table Based Layout -->
                                    <table class="invoice-table" width="100%" cellpadding="0" cellspacing="0"
                                        style="border-collapse: collapse;">
                                        <!-- Invoice Header -->
                                        <tr>
                                            <td colspan="2" style="padding-bottom: 20px;">
                                                <table width="100%" cellpadding="5" cellspacing="0">
                                                    <tr>
                                                        <td width="50%" style="vertical-align: top;">
                                                            <h2
                                                                style="color: #198754; margin: 0 0 15px 0; font-weight: bold;">
                                                                INVOICE
                                                            </h2>
                                                            <p style="margin: 0;"><strong>Invoice #:</strong>
                                                                {{ $order->order_no }}
                                                            </p>
                                                            <p style="margin: 0;"><strong>Date:</strong>
                                                                {{ $order->created_at->format('d M Y') }}
                                                            </p>
                                                            <p style="margin: 0;"><strong>Status:</strong>
                                                                {{ ucfirst($order->status) }}
                                                            </p>
                                                        </td>
                                                        <td width="50%" style="text-align: right; vertical-align: top;">
                                                            <h4 style="margin: 0 0 10px 0; font-weight: bold;">FreshMart
                                                                Grocery
                                                            </h4>
                                                            <p style="margin: 0;">123 Market Street</p>
                                                            <p style="margin: 0;">New York, NY 10001</p>
                                                            <p style="margin: 0;">Phone: (123) 456-7890</p>
                                                            <p style="margin: 0;">Email: info@freshmart.com</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <!-- Billing & Shipping Info -->
                                        <tr>
                                            <td colspan="2" style="padding-bottom: 20px;">
                                                <table width="100%" cellpadding="5" cellspacing="0">
                                                    <tr>
                                                        <td width="50%" style="vertical-align: top;">
                                                            <h5 style="margin: 0 0 10px 0; font-weight: bold;">Bill To:</h5>
                                                            <p style="margin: 0;">
                                                                <strong>{{ $order->billing_name }}</strong>
                                                            </p>
                                                            <p style="margin: 0;">{{ $order->billing_address }}</p>
                                                            <p style="margin: 0;">{{ $order->billing_city }}</p>
                                                            <p style="margin: 0;">Phone: {{ $order->billing_phone }}</p>
                                                            <p style="margin: 0;">Email: {{ $order->billing_email }}</p>
                                                        </td>
                                                        <td width="50%" style="vertical-align: top; text-align: right;">
                                                            <h5 style="margin: 0 0 10px 0; font-weight: bold;">Ship To:</h5>
                                                            <p style="margin: 0;">
                                                                <strong>{{ $order->billing_name }}</strong>
                                                            </p>
                                                            <p style="margin: 0;">{{ $order->billing_address }}</p>
                                                            <p style="margin: 0;">{{ $order->billing_city }}</p>
                                                            <p style="margin: 0;">Phone: {{ $order->billing_phone }}</p>
                                                            <p style="margin: 0;">Email: {{ $order->billing_email }}</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <!-- Order Items Table -->
                                        <tr>
                                            <td colspan="2" style="padding-bottom: 20px;">
                                                <table width="100%" cellpadding="10" cellspacing="0"
                                                    style="border-collapse: collapse; border: 1px solid #ddd;">
                                                    <thead>
                                                        <tr style="background-color: #f8f9fa;">
                                                            <th
                                                                style="text-align: left; padding: 12px; border: 1px solid #ddd; width: 5%;">
                                                                SL#</th>
                                                            <th
                                                                style="text-align: left; padding: 12px; border: 1px solid #ddd; width: 45%;">
                                                                Product</th>
                                                            <th
                                                                style="text-align: center; padding: 12px; border: 1px solid #ddd; width: 15%;">
                                                                Quantity</th>
                                                            <th
                                                                style="text-align: right; padding: 12px; border: 1px solid #ddd; width: 15%;">
                                                                Price</th>
                                                            <th
                                                                style="text-align: right; padding: 12px; border: 1px solid #ddd; width: 20%;">
                                                                Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->orderDetails as $orderItem)
                                                            <tr>
                                                                <td style="padding: 12px; border: 1px solid #ddd;">
                                                                    {{ $loop->iteration }}</td>
                                                                <td style="padding: 12px; border: 1px solid #ddd;">
                                                                    <strong>{{ $orderItem->product_name }}</strong><br>
                                                                    <span
                                                                        style="color: #6c757d; font-size: 13px;">{{ $orderItem->label }}</span>
                                                                </td>
                                                                <td
                                                                    style="text-align: center; padding: 12px; border: 1px solid #ddd;">
                                                                    {{ $orderItem->quantity }}
                                                                </td>
                                                                <td
                                                                    style="text-align: right; padding: 12px; border: 1px solid #ddd;">
                                                                    ${{ number_format($orderItem->sale_price, 2) }}</td>
                                                                <td
                                                                    style="text-align: right; padding: 12px; border: 1px solid #ddd; font-weight: bold;">
                                                                    ${{ number_format($orderItem->total_price, 2) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <!-- Order Summary -->
                                        <tr>
                                            <td colspan="2">
                                                <table width="100%" cellpadding="5" cellspacing="0">
                                                    <tr>
                                                        <td width="40%" style="vertical-align: top;">
                                                            <table width="100%" cellpadding="5" cellspacing="0">
                                                                <tr>
                                                                    <td width="50%" style="vertical-align: top;">
                                                                        <h6 style="margin: 0 0 10px 0; font-weight: bold;">
                                                                            Payment
                                                                            Method:</h6>
                                                                        <p style="margin: 5px 0;">
                                                                            @if ($order->payment_method === 'paypal')
                                                                                Paypal
                                                                            @elseif($order->payment_method === 'stripe')
                                                                                Stripe
                                                                            @elseif($order->payment_method === 'cod')
                                                                                Cash On Delivery
                                                                            @endif
                                                                        </p>
                                                                    </td>
                                                                    <td width="50%" style="vertical-align: top;">
                                                                        <h6 style="margin: 0 0 10px 0; font-weight: bold;">
                                                                            Payment
                                                                            Status:</h6>
                                                                        <p style="margin: 5px 0;">
                                                                            {{ ucfirst($order->payment_status) }}
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td width="20%" style="vertical-align: top;">
                                                        </td>
                                                        <td width="40%">
                                                            <table width="100%" cellpadding="8" cellspacing="0"
                                                                style="border-collapse: collapse;">
                                                                <tr>
                                                                    <td style="padding: 0;">Subtotal:</td>
                                                                    <td
                                                                        style="text-align: right; padding: 0; font-weight: bold;">
                                                                        ${{ number_format($order->subtotal_price, 2) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 0;">
                                                                        Discount
                                                                        @if ($order->coupon_code)
                                                                            ({{ $order->coupon_code }}
                                                                            @if ($order->coupon_discount_type === 'percentage')
                                                                                - {{ $order->coupon_discount_value }}%
                                                                            @endif
                                                                            ):
                                                                        @else
                                                                            :
                                                                        @endif
                                                                    </td>
                                                                    <td
                                                                        style="text-align: right; padding: 0; color: #dc3545;">
                                                                        -${{ number_format($order->coupon_discount_amount, 2) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 0;">Delivery Charge:</td>
                                                                    <td style="text-align: right; padding: 0;">
                                                                        ${{ number_format($order->delivery_option_cost, 2) }}
                                                                    </td>
                                                                </tr>
                                                                <tr style="border-top: 2px solid #000;">
                                                                    <td style="padding: 8px 0; font-size: 18px;">
                                                                        <strong>Total:</strong>
                                                                    </td>
                                                                    <td
                                                                        style="text-align: right; padding: 8px 0; font-size: 20px; font-weight: bold; color: #198754;">
                                                                        ${{ number_format($order->total_price, 2) }}</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="text-center mt-3 no-print">
                                <a href="{{ route('admin.order.index') }}" class="text-decoration-none">
                                    <i class="bi bi-arrow-left me-1"></i>Back to Orders
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function printInvoice() {
            let body = document.body.innerHTML;
            let data = document.getElementById('print_invoice').innerHTML;
            document.body.innerHTML = data;
            window.print();
            document.body.innerHTML = body;
        }
    </script>
@endpush
