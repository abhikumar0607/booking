
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Driver Account Created</title>
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
            background: #f1f1f1;
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
            <img src="https://rrlogistic.com.au/mail-logo.png" alt="RR Logistic">
        </div>

        <!-- Content -->
        <div class="content">
            <h2>Hello {{ $name }},</h2>
            <p>Your driver account has been created successfully.</p>

            <div class="details">
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
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
