@extends('layouts.master')
@section('title', 'The Pets Medic | Order Success')
@section('content')
    <div class="order-success-container">
        <div class="order-success-content text-center">
            <div class="icon-circle">
                <i class="fa fa-check-circle" aria-hidden="true"></i>
            </div>
            <h1 class="success-title">Thank You for Your Order!</h1>
            <p class="order-message">
                Your order <strong>#{{ $order->order_number }}</strong> has been successfully placed! A confirmation email
                has been sent to your inbox. We’ll notify you once your order is on the way.
            </p>
        </div>

        <div class="order-summary-card">
            <h3 class="subtitle">Order Summary</h3>
            <table class="table order-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td class="product-name">{{ $item->product_name }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-left">PKR {{ number_format($item->price_per_item, 2) }}</td>
                            <td class="text-right">PKR {{ number_format($item->total_price, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr class="order-total">
                        <td colspan="3" class="text-right"><strong>Subtotal</strong></td>
                        <td class="text-right">PKR {{ number_format($order->subtotal, 2) }}</td>
                    </tr>
                    <tr class="order-total">
                        <td colspan="3" class="text-right"><strong>Total</strong></td>
                        <td class="text-right"><strong>PKR {{ number_format($order->total, 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="payment-info-card mt-4">
            <h3 class="subtitle">Payment Details</h3>
            <p>Payment Method:
                <strong>{{ ucfirst($order->payment->payment_method === 'cod' ? 'Cash on Delivery' : $order->payment->payment_method ?? 'N/A') }}</strong>
            </p>
            <p>Total Paid: <strong>PKR {{ number_format($order->total, 2) }}</strong></p>
        </div>

        <div class="action-button mt-5 text-center">
            <a href="{{ route('home') }}" class="axil-btn btn-primary">
                <i class="fa fa-home"></i> Back to Home
            </a>
        </div>
    </div>
    @push('css')
        <style>
            /* General Container */
            .order-success-container {
                background-color: #f9f9f9;
                padding: 40px;
                border-radius: 10px;
                max-width: 800px;
                margin: 50px auto;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            /* Success Content */
            .order-success-content {
                margin-bottom: 40px;
            }

            .order-success-content .icon-circle {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                background-color: #28a745;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 0 auto 20px;
                font-size: 40px;
                color: #fff;
            }

            .order-success-content .success-title {
                font-size: 28px;
                font-weight: bold;
                margin-bottom: 10px;
                color: #333;
            }

            .order-success-content .order-message {
                font-size: 16px;
                color: #555;
                line-height: 1.6;
            }

            /* Summary Card */
            .order-summary-card,
            .payment-info-card {
                background: #ffffff;
                padding: 20px;
                border-radius: 8px;
                margin-bottom: 20px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .subtitle {
                font-size: 20px;
                font-weight: 600;
                margin-bottom: 15px;
                color: #444;
            }

            /* Table */
            .table.order-table {
                width: 100%;
                border-collapse: collapse;
            }

            .table.order-table th,
            .table.order-table td {
                padding: 12px 15px;
                text-align: left;
                border-bottom: 1px solid #eee;
            }

            .table.order-table th {
                background: #f1f1f1;
                font-weight: bold;
                color: #333;
            }

            .table.order-table .order-total td {
                font-weight: bold;
            }

            /* Action Button */
            .action-button .axil-btn {
                display: inline-block;
                padding: 12px 25px;
                font-size: 16px;
                border-radius: 25px;
                background-color: #007bff;
                color: #fff;
                text-decoration: none;
                transition: background-color 0.3s;
            }

            .action-button .axil-btn:hover {
                background-color: #0056b3;
                text-decoration: none;
            }

            .action-button .axil-btn i {
                margin-right: 8px;
            }
        </style>
    @endpush
@endsection
