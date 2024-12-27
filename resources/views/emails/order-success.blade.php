<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333333;
        }

        .email-container {
            max-width: 700px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-top: 6px solid #4C9A2A;
        }

        .header {
            text-align: center;
            padding: 40px;
            background-color: #4C9A2A;
            color: #ffffff;
        }

        .header img {
            width: 80px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            line-height: 1.3;
        }

        .content {
            padding: 20px;
        }

        .content h3 {
            margin-top: 20px;
            margin-bottom: 15px;
            font-size: 18px;
            color: #4C9A2A;
            font-weight: 600;
        }

        .content p {
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 15px;
            color: #555555;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #e0e0e0;
            text-align: left;
            font-size: 14px;
            word-break: break-word;
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
            font-weight: 700;
            background-color: #4C9A2A;
            color: #ffffff;
            font-size: 15px;
        }

        .footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 15px 20px;
            font-size: 12px;
            color: #777777;
        }

        .footer a {
            color: #4C9A2A;
            text-decoration: none;
            font-weight: 600;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media only screen and (max-width: 768px) {
            .email-container {
                margin: 15px;
                border-radius: 8px;
            }

            .header {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 20px;
            }

            .header img {
                width: 60px;
            }

            .content {
                padding: 15px;
            }

            .content h3 {
                font-size: 16px;
            }

            .content p {
                font-size: 13px;
            }

            .table th,
            .table td {
                font-size: 13px;
                padding: 8px;
            }

            .footer {
                font-size: 11px;
                padding: 10px;
            }
        }

        @media only screen and (max-width: 480px) {
            .header h1 {
                font-size: 18px;
            }

            .content h3 {
                font-size: 14px;
            }

            .content p {
                font-size: 12px;
            }

            .table th,
            .table td {
                font-size: 12px;
                padding: 5px;
            }

            .footer {
                font-size: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            <img src="{{ asset('assets/images/logo/logo-white.png') }}" alt="Garden Fresh Logo">
            <h1>Order Confirmation</h1>
        </div>

        <!-- Content Section -->
        <div class="content">
            <p>
                Hello <strong>{{ $order->customer_name }}</strong>,<br>
                Thank you for placing your order <strong>#{{ $order->order_number }}</strong> with Garden Fresh!
            </p>
            <p>
                A confirmation email has been sent to your inbox. You will be notified again once your order is shipped.
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
                            <td><strong>{{ $item->product_name }}</strong></td>
                            <td>{{ $item->quantity }}</td>
                            <td>PKR {{ number_format($item->price_per_item, 2) }}</td>
                            <td>PKR {{ number_format($item->total_price, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="3">Grand Total</td>
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
                <strong>Amount Paid:</strong> PKR {{ number_format($order->total, 2) }}
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
