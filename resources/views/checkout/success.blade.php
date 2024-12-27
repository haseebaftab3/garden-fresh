@extends('layouts.master')
@section('title', 'Garden Fresh | Order Success')
@section('content')

    @push('css')
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
        <style>
            .order-success-container {
                background-color: #ffffff;
                padding: 40px 20px;
                border-radius: 15px;
                max-width: 850px;
                margin: 30px auto;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
                border-top: 5px solid #F6841F;
            }

            /* Header Section */
            .order-success-header {
                margin-bottom: 20px;
                text-align: center;
            }

            .icon-circle {
                width: 70px;
                height: 70px;
                border-radius: 50%;
                background-color: #71BF44;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 0 auto 15px;
                font-size: 40px;
                color: #fff;
            }

            .success-title {
                font-size: 24px;
                font-weight: 700;
                color: #222;
                margin-bottom: 10px;
            }

            .order-message {
                font-size: 16px;
                color: #555;
                line-height: 1.6;
                padding: 0 10px;
            }

            /* Order Summary Table */
            .order-summary-card {
                background-color: #fdfdfd;
                border-radius: 10px;
                padding: 15px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                margin-bottom: 20px;
            }

            .order-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 14px;
            }

            .order-table th {
                background-color: #F6841F;
                color: #fff;
                font-weight: bold;
                padding: 10px;
                text-align: left;
            }

            .order-table td {
                padding: 10px;
                border-bottom: 1px solid #ddd;
                color: #333;
                word-wrap: break-word;
            }

            .order-total {
                background-color: #71BF44;
                color: #fff;
                font-weight: bold;
            }

            .order-total td {
                border: none;
                padding: 12px;
            }

            /* Payment Info Section */
            .payment-info-card {
                background-color: #f9f9f9;
                border-radius: 10px;
                padding: 20px;
                margin-top: 15px;
            }

            .payment-info-list {
                padding: 0;
                list-style: none;
                margin: 0;
            }

            .payment-info-list li {
                display: flex;
                justify-content: space-between;
                font-size: 14px;
                margin-bottom: 10px;
                color: #555;
            }

            .payment-info-list .label {
                font-weight: 500;
            }

            .payment-info-list .value {
                color: #222;
                font-weight: 600;
            }

            /* Action Buttons */
            .action-buttons .axil-btn {
                display: inline-block;
                padding: 10px 20px;
                font-size: 14px;
                font-weight: 500;
                border-radius: 25px;
                text-transform: uppercase;
                text-decoration: none;
                transition: all 0.3s ease;
                margin: 10px 5px;
                color: #fff;
                text-align: center;
            }

            .btn-primary {
                background-color: #F6841F;
                border: none;
            }

            .btn-primary:hover {
                background-color: #d36f1a;
            }

            .btn-secondary {
                background-color: #71BF44;
                border: none;
            }

            .btn-secondary:hover {
                background-color: #5b9936;
            }

            .axil-btn i {
                margin-right: 8px;
            }

            /* Responsive Design */
            @media (max-width: 768px) {

                .order-summary-card,
                .payment-info-card {
                    padding: 15px;
                }

                .order-table th,
                .order-table td {
                    padding: 8px;
                }

                .success-title {
                    font-size: 20px;
                }

                .order-message {
                    font-size: 14px;
                }

                .action-buttons .axil-btn {
                    padding: 10px 15px;
                    font-size: 12px;
                }
            }

            @media (max-width: 576px) {
                .order-success-container {
                    padding: 20px;
                }

                .icon-circle {
                    width: 50px;
                    height: 50px;
                    font-size: 30px;
                }

                .success-title {
                    font-size: 18px;
                }

                .order-message {
                    font-size: 12px;
                }

                .order-table th,
                .order-table td {
                    font-size: 12px;
                }

                .action-buttons .axil-btn {
                    font-size: 12px;
                    padding: 8px 10px;
                }
            }
        </style>
    @endpush

    <div class="order-success-container">
        <div class="order-success-header">
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
            <h3 class="subtitle text-center mb-3">Order Summary</h3>
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
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>PKR {{ number_format($item->price_per_item, 2) }}</td>
                            <td>PKR {{ number_format($item->total_price, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr class="order-total">
                        <td colspan="3" class="text-right"><strong>Total</strong></td>
                        <td>PKR {{ number_format($order->total, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="payment-info-card">
            <h3 class="subtitle text-center">Payment Details</h3>
            <ul class="payment-info-list">
                <li>
                    <span class="label">Payment Method:</span>
                    <span
                        class="value">{{ ucfirst($order->payment->payment_method === 'cod' ? 'Cash on Delivery' : $order->payment->payment_method ?? 'N/A') }}</span>
                </li>
                <li>
                    <span class="label">Total Paid:</span>
                    <span class="value">PKR {{ number_format($order->total, 2) }}</span>
                </li>
            </ul>
        </div>

        <div class="action-buttons text-center mt-4">
            <a href="{{ route('home') }}" class="axil-btn btn-primary">
                <i class="fa fa-home"></i> Back to Home
            </a>
            <a href="{{ route('shop') }}" class="axil-btn btn-secondary">
                <i class="fa fa-shopping-bag"></i> Continue Shopping
            </a>
        </div>
    </div>

    @push('scripts')
        <!-- Font Awesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    @endpush

@endsection
