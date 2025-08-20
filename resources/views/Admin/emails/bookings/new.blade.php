<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Assigned</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0; padding: 0;
            background: #f4f6f8;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .header {
            background: #004aad;
            padding: 20px;
            text-align: center;
        }
        .header img {
            max-width: 160px;
        }
        .content {
            padding: 25px;
            line-height: 1.6;
        }
        h2 {
            margin-top: 0;
            color: #004aad;
        }
        .details {
            margin: 20px 0;
            background: #f9fbfd;
            padding: 15px;
            border-left: 4px solid #004aad;
            border-radius: 6px;
        }
        .details p {
            margin: 5px 0;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            background: #28a745;
            color: #fff !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 15px;
        }
        .footer {
            text-align: center;
            padding: 15px;
            background: #f1f1f1;
            font-size: 13px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="https://rrlogistic.com.au/logo.png" alt="RR Logistic">
        </div>

        <!-- Content -->
        <div class="content">
            <h2>Hello Admin,</h2>
            <p>A new booking has been created. Here are the details:</p>

            <div class="details">
                <p><strong>Sender:</strong> {{ $booking->sender_name ?? 'N/A' }}</p>
                <p><strong>Sender Phone:</strong> {{ $booking->sender_phone ?? 'N/A' }}</p>
                <p><strong>Recipient Name:</strong> {{ $booking->recipient_name ?? 'N/A' }}</p>
                <p><strong>Recipient Phone:</strong> {{ $booking->recipient_phone ?? 'N/A' }}</p>
                <p><strong>Pickup Address:</strong> {{ $booking->pickup_address ?? 'N/A' }}</p>
                <p><strong>Delivery Address:</strong> {{ $booking->delivery_address ?? 'N/A' }}</p>
                <p><strong>Items:</strong> {{ $booking->item_type ?? 'N/A' }}</p>
                <p><strong>Total Items:</strong> {{ $booking->number_of_items ?? 'N/A' }}</p>
                <p><strong>Total Price:</strong> {{ $booking->price ?? 'N/A' }}</p>
                <p><strong>Payment Status:</strong> {{ $booking->payment_status ?? 'N/A' }}</p>
            </div>

            <p style="text-align:center;">
                <a href="https://rrlogistic.com.au/login" class="btn">Login to Dashboard</a>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>© {{ date('Y') }} RR Logistic. All rights reserved.</p>
            <p>This is an automated email. Please do not reply.</p>
        </div>
    </div>
</body>
</html>
