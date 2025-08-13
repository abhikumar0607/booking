<!DOCTYPE html>
<html>
<head>
    <title>Booking Assigned</title>
</head>
<body>
    <p>Dear Driver,</p>
    <p>booking (ID: {{ $booking->id }}) has been assigned to you.</p>
    <p>Status: {{ $booking->status }}</p>
    <p>Thank you!</p>
</body>
</html>

