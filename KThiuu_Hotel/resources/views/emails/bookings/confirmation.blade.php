<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #1f2937;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px;
            color: #333333;
        }

        .booking-details {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }

        .booking-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 10px;
        }

        .booking-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .label {
            font-weight: bold;
            color: #6b7280;
        }

        .value {
            color: #111827;
            font-weight: 600;
        }

        .footer {
            background-color: #f3f4f6;
            color: #9ca3af;
            text-align: center;
            padding: 20px;
            font-size: 12px;
        }

        .btn {
            display: inline-block;
            background-color: #4f46e5;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Booking Confirmed!</h1>
        </div>
        <div class="content">
            <p>Dear {{ $booking->user->name }},</p>
            <p>Thank you for choosing KThiuu-Hotel. Your booking has been successfully confirmed.</p>

            <div class="booking-details">
                <div class="booking-row">
                    <span class="label">Booking Ref:</span>
                    <span class="value">#{{ $booking->id }}</span>
                </div>
                <div class="booking-row">
                    <span class="label">Hotel:</span>
                    <span class="value">{{ $booking->room->hotel->name }}</span>
                </div>
                <div class="booking-row">
                    <span class="label">Room Type:</span>
                    <span class="value">{{ $booking->room->type }}</span>
                </div>
                <div class="booking-row">
                    <span class="label">Check-in:</span>
                    <span class="value">{{ $booking->check_in }}</span>
                </div>
                <div class="booking-row">
                    <span class="label">Check-out:</span>
                    <span class="value">{{ $booking->check_out }}</span>
                </div>
                <div class="booking-row">
                    <span class="label">Total Price:</span>
                    <span class="value" style="color: #4f46e5;">${{ number_format($booking->total_price, 2) }}</span>
                </div>
            </div>

            <p>We look forward to welcoming you!</p>

            <div style="text-align: center;">
                <a href="{{ route('bookings.index') }}" class="btn">View My Bookings</a>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} KThiuu-Hotel. All rights reserved.
        </div>
    </div>
</body>

</html>