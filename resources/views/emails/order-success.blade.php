<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            max-width: 650px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 25px;
            background-color: #4C9A2A;
            color: #fff;
        }

        .header img {
            width: 100px;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
            color: #fff;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .content h3 {
            font-size: 18px;
            color: #F6841F;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 14px;
            line-height: 1.8;
            color: #555;
        }

        .summary-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .summary-table th,
        .summary-table td {
            text-align: left;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #eaeaea;
        }

        .summary-table th {
            background-color: #F6841F;
            color: #fff;
            font-weight: 600;
        }

        .summary-table .total-row td {
            font-weight: 600;
            color: #fff;
            background-color: #4C9A2A;
            font-size: 15px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #F6841F;
            color: #fff;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .email-container {
                margin: 20px;
            }

            .content p {
                font-size: 13px;
            }

            .summary-table th,
            .summary-table td {
                font-size: 12px;
                padding: 8px;
            }

            .footer {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            <img src="{{ asset('assets/images/logo/logo-1.png') }}" alt="Garden Fresh Logo">
            <h1>Thank You for Your Order!</h1>
        </div>

        <!-- Content Section -->
        <div class="content">
            <p>Hello, {{ $order->customer_name }}!</p>
            <p>Your order <strong>#{{ $order->order_number }}</strong> has been successfully placed. A confirmation
                email has been sent to your inbox. You will receive updates when your order ships.</p>

            <!-- Order Summary -->
            <h3>Order Summary</h3>
            <table class="summary-table">
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
                    <tr class="total-row">
                        <td colspan="3">Total</td>
                        <td>PKR {{ number_format($order->total, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Payment Details -->
            <p><strong>Payment Method:</strong>
                {{ ucfirst($order->payment->payment_method === 'cod' ? 'Cash on Delivery' : $order->payment->payment_method ?? 'N/A') }}
            </p>
            <p><strong>Total Paid:</strong> PKR {{ number_format($order->total, 2) }}</p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p><a href="{{ route('home') }}">Visit Our Website</a> | <a href="{{ route('shop') }}">Shop More</a></p>
            <p>&copy; {{ date('Y') }} Garden Fresh. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
