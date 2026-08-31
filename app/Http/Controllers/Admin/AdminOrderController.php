<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.order.index', compact('orders'));
    }
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:processing,shipped,delivered',
        ]);

        $newStatus = $request->status;

        // If the order is Already delivered then it can't be changed
        if ($order->status === 'delivered') {
            return response()->json([
                'status' => false,
                'message' => 'This order has already been ' . $order->status . ' and cannot be changed.',
            ], 422);
        }

        // Forward-only movement enforce (pending → processing → shipped → delivered)
        $statusOrder = ['pending', 'processing', 'shipped', 'delivered'];
        $currentIndex = array_search($order->status, $statusOrder);
        $newIndex = array_search($newStatus, $statusOrder);

        if ($newIndex !== false && $currentIndex !== false && $newIndex < $currentIndex) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid status transition.',
            ], 422);
        }

        // Normal forward move (processing/shipped/delivered)
        $updateData = ['status' => $newStatus];

        // If COD order delivered then payment_status automatic paid
        if ($newStatus === 'delivered' && $order->payment_method === 'cod') {
            $updateData['payment_status'] = 'paid';
        }

        $order->update($updateData);

        // Send email notification to customer for order status
        $subject = "Order Delivery Status Updated - " . $order->order_no;
        $message = " Dear " . $order->billing_name . ",\n\nThe delivery status of your order has been updated to " . $newStatus . ". Please check your order details for more information." . "\n\nThank you for shopping with us!";
        Mail::to($order->billing_email)->send(new WebsiteMail($subject, $message));

        return response()->json([
            'status' => true,
            'message' => 'Order marked as ' . $newStatus . '.',
        ]);
    }

    public function orderInvoice(String $order_no)
    {  
        $order = Order::with('orderDetails')
            ->where('order_no', $order_no)
            ->first();

        if(!$order) {
            return back()->with('error', 'Order not found');
        }

        return view('admin.order.invoice', compact('order'));
    }
}
