<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #212529; color: #fff; padding: 20px; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { text-align: left; padding: 8px; border-bottom: 1px solid #eee; }
        .total-row td { font-weight: bold; border-top: 2px solid #333; }
        .badge { display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 12px; }
        .badge-paid { background: #d1e7dd; color: #0f5132; }
        .badge-pending { background: #fff3cd; color: #664d03; }
        .footer { margin-top: 20px; font-size: 12px; color: #777; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>🔔 New Order Received</h2>
        </div>

        <p>A new order has been placed on the store. Details below:</p>

        <table>
            <tr>
                <td><strong>Order No:</strong></td>
                <td>{{ $order->order_no }}</td>
            </tr>
            <tr>
                <td><strong>Customer:</strong></td>
                <td>{{ $order->billing_name }} ({{ $order->billing_email }})</td>
            </tr>
            <tr>
                <td><strong>Phone:</strong></td>
                <td>{{ $order->billing_phone }}</td>
            </tr>
            <tr>
                <td><strong>Payment Method:</strong></td>
                <td>{{ ucfirst($order->payment_method) }}</td>
            </tr>
            <tr>
                <td><strong>Payment Status:</strong></td>
                <td>
                    <span class="badge {{ $order->payment_status === 'paid' ? 'badge-paid' : 'badge-pending' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </td>
            </tr>
        </table>

        <h4 style="margin-top: 20px;">Order Items</h4>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderDetails as $item)
                    <tr>
                        <td>{{ $item->product_name }} @if($item->label) ({{ $item->label }}) @endif</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->sale_price, 2) }}</td>
                        <td>${{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table>
            <tr>
                <td>Subtotal</td>
                <td>${{ number_format($order->subtotal_price, 2) }}</td>
            </tr>
            @if($order->coupon_discount_amount > 0)
                <tr>
                    <td>Discount ({{ $order->coupon_code }})</td>
                    <td>-${{ number_format($order->coupon_discount_amount, 2) }}</td>
                </tr>
            @endif
            <tr>
                <td>Delivery Charge</td>
                <td>${{ number_format($order->delivery_option_cost, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td>Total</td>
                <td>${{ number_format($order->total_price, 2) }} {{ $order->currency }}</td>
            </tr>
        </table>

        <p style="margin-top: 20px;"><strong>Shipping Address:</strong><br>
            {{ $order->billing_address }}, {{ $order->billing_city }}, {{ $order->billing_state }},
            {{ $order->billing_country }} - {{ $order->billing_zip }}
        </p>

        @if($order->note)
            <p><strong>Order Notes:</strong><br>{{ $order->note }}</p>
        @endif

        <div class="footer">
            <p>Login to the admin panel to process this order.</p>
        </div>
    </div>
</body>
</html>