<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Address;
use App\Models\OrderTimeline;
use App\Models\Logistic;

class OrderController extends Controller
{
    public function index()
    {
        $allOrders = Order::with(['user', 'orderItems', 'payment', 'billingAddress', 'shippingAddress'])->get();

        return view('admin.orders.index', compact('allOrders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.product', 'payment', 'billingAddress', 'shippingAddress', 'timelines', 'logistic'])
            ->findOrFail($id);

        return view('admin.orders.detail', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.orders.edit', compact('order'));
    }
    public function changeAddress(Request $request, $order_id)
    {

        // Validate the input
        $validatedData = $request->validate([
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        // Find the order and its shipping address
        $order = Order::findOrFail($order_id);
        $address = $order->shippingAddress;

        // Update or create the shipping address
        if ($address) {
            $address->update($validatedData);
        } else {
            Address::create(array_merge($validatedData, ['order_id' => $order->id, 'type' => 'shipping']));
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Shipping address updated successfully.');
    }

    public function changeStatus(Request $request, $orderId)
    {

        // Validate the incoming request
        $validatedData = $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
            'logistic_provider' => 'nullable|string|max:255',
            'tracking_id' => 'nullable|string|max:255',
        ]);

        // Find the order
        $order = Order::findOrFail($orderId);

        // Update the status
        $order->update([
            'status' => $validatedData['status'],
        ]);

        $description = $this->generateDescription($validatedData['status']);


        // Create a new timeline entry
        OrderTimeline::create([
            'order_id' => $order->id,
            'status' => $validatedData['status'],
            'icon' => $this->getStatusIcon($validatedData['status']),
            'description' => $description,
            'event_date' => now()->toDateString(),
            'event_time' => now()->toTimeString(),
        ]);


        // Save logistics data if the status is 'shipped'
        if ($validatedData['status'] === 'shipped') {
            Logistic::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'logistic_provider' => $validatedData['logistic_provider'],
                    'tracking_id' => $validatedData['tracking_id'],
                    'status' => 'shipped',
                ]
            );
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Order status updated and timeline updated successfully!');
    }

    protected function generateDescription($newStatus)
    {
        $messages = [
            'pending' => "The order is now marked as Pending. Awaiting processing.",
            'processing' => "The order is being processed. Ensure all items are ready for shipment.",
            'shipped' => "The order has been shipped. The courier has been notified.",
            'delivered' => "The order has been delivered to the customer.",
            'cancelled' => "The order has been cancelled. Notify the customer if necessary.",
        ];

        return $messages[$newStatus] ?? "Order status updated successfully.";
    }

    protected function getStatusIcon($status)
    {
        $icons = [
            'pending' => 'ri-hourglass-line',
            'processing' => 'ri-settings-2-line',
            'shipped' => 'ri-truck-line',
            'delivered' => 'ri-checkbox-circle-line',
            'cancelled' => 'ri-close-circle-line',
        ];

        return $icons[$status] ?? null;
    }

    public function showInvoice($orderId)
    {
        // Fetch the order with its related data (e.g., items, user, address)
        $order = Order::with(['user', 'orderItems', 'billingAddress', 'shippingAddress', 'payment'])->findOrFail($orderId);

        // Return the invoice view with the order details
        return view('admin.orders.invoice', compact('order'));
    }
}
