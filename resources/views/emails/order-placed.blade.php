<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #198754; color: #fff; padding: 20px; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { text-align: left; padding: 8px; border-bottom: 1px solid #eee; }
        .total-row td { font-weight: bold; border-top: 2px solid #333; }
        .footer { margin-top: 20px; font-size: 12px; color: #777; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Thank you for your order!</h2>
        </div>

        <p>Hi {{ $order->billing_name }},</p>
        <p>Your order <strong>#{{ $order->order_no }}</strong> has been placed successfully. Here are your order details:</p>

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
            <tr>
                <td>Delivery Charge</td>
                <td>${{ number_format($order->delivery_option_cost, 2) }}</td>
            </tr>
            @if($order->coupon_discount_amount > 0)
                <tr>
                    <td>Discount ({{ $order->coupon_code }})</td>
                    <td>-${{ number_format($order->coupon_discount_amount, 2) }}</td>
                </tr>
            @endif            
            <tr class="total-row">
                <td>Total</td>
                <td>${{ number_format($order->total_price, 2) }}</td>
            </tr>
        </table>

        <p style="margin-top: 20px;"><strong>Shipping Address:</strong><br>
            {{ $order->billing_address }}, {{ $order->billing_city }}, {{ $order->billing_state }},
            {{ $order->billing_country }} - {{ $order->billing_zip }}
        </p>

        <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}<br>
            <strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}
        </p>

        <div class="footer">
            <p>If you have any questions, reply to this email or contact our support.</p>
        </div>
    </div>
</body>
</html>