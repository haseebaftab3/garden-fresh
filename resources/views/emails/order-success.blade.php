<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 650px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #F6841F;
        }

        .header {
            text-align: center;
            padding: 30px;
            background-color: #71BF44;
            color: #fff;
        }

        .header img {
            width: 120px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px;
        }

        .content h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #F6841F;
            color: #fff;
        }

        .total-row td {
            font-weight: bold;
            color: #fff;
            background-color: #71BF44;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            font-size: 14px;
            color: #777;
        }

        .footer a {
            color: #F6841F;
            text-decoration: none;
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
            <p>Your order <strong>#{{ $order->order_number }}</strong> has been successfully placed!</p>
            <p>A confirmation email has been sent to your inbox. We’ll notify you once your order is on the way.</p>

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
            <p><strong>Payment Method:</strong>
                {{ ucfirst($order->payment->payment_method === 'cod' ? 'Cash on Delivery' : $order->payment->payment_method ?? 'N/A') }}
            </p>
            <p><strong>Total Paid:</strong> PKR {{ number_format($order->total, 2) }}</p>
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
