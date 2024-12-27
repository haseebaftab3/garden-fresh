<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 700px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-top: 6px solid #4C9A2A;
        }

        .header {
            text-align: center;
            padding: 30px;
            background-color: #4C9A2A;
            color: #ffffff;
        }

        .header img {
            width: 120px;
            margin-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 600;
            line-height: 1.4;
        }

        .content {
            padding: 25px;
        }

        .content h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333333;
            font-weight: 600;
        }

        .content p {
            color: #555555;
            line-height: 1.8;
            margin-bottom: 15px;
            font-size: 15px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            padding: 12px;
            border: 1px solid #dddddd;
            text-align: left;
            font-size: 14px;
        }

        .table th {
            background-color: #71BF44;
            color: #ffffff;
            font-weight: 600;
        }

        .table td {
            color: #555555;
        }

        .total-row td {
            font-weight: 600;
            color: #ffffff;
            background-color: #4C9A2A;
            font-size: 15px;
        }

        .footer {
            text-align: center;
            padding: 25px;
            background-color: #f4f4f4;
            font-size: 14px;
            color: #777777;
        }

        .footer a {
            color: #4C9A2A;
            text-decoration: none;
            font-weight: 500;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media only screen and (max-width: 768px) {
            .email-container {
                margin: 20px;
            }

            .header h1 {
                font-size: 22px;
            }

            .content p {
                font-size: 14px;
            }

            .table th,
            .table td {
                font-size: 13px;
                padding: 10px;
            }

            .footer {
                font-size: 13px;
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
            <p>
                Hello, {{ $order->customer_name }}!<br>
                Your order <strong>#{{ $order->order_number }}</strong> has been successfully placed. Thank you for
                choosing Garden Fresh!
            </p>
            <p>
                We’ve sent a confirmation email to your inbox. You will receive another email when your order is
                shipped.
            </p>

            <!-- Order Summary -->
            <h3>Order Summary</h3>
            <table class="table">
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
            <h3>Payment Details</h3>
            <p>
                <strong>Payment Method:</strong>
                {{ ucfirst($order->payment->payment_method === 'cod' ? 'Cash on Delivery' : $order->payment->payment_method ?? 'N/A') }}
            </p>
            <p>
                <strong>Total Paid:</strong> PKR {{ number_format($order->total, 2) }}
            </p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>
                <a href="{{ route('home') }}">Visit Our Website</a> | <a href="{{ route('shop') }}">Shop More</a>
            </p>
            <p>&copy; {{ date('Y') }} Garden Fresh. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
