<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $invoice_number }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
            background: #f9f9f9;
        }
        .invoice-box {
            max-width: 700px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }
        .details, .summary {
            width: 100%;
            margin-top: 20px;
        }
        .details td {
            padding: 6px 0;
        }
        .summary th, .summary td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }
        .summary {
            margin-top: 30px;
            border-top: 2px solid #444;
        }
        .summary tfoot td {
            font-weight: bold;
            border-top: 2px solid #444;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <h2>Booking Invoice</h2>

        <table class="details">
            <tr>
                <td><strong>Invoice No:</strong> {{ $invoice_number }}</td>
                <td><strong>Date:</strong> {{ $created_at->format('d M Y') }}</td>
            </tr>
            <tr>
                <td><strong>Booking ID:</strong> {{ $booking_id }}</td>
                <td><strong>Customer:</strong> {{ $customer_name }}</td>
            </tr>
            <tr>
                <td><strong>Check-in:</strong> {{ $check_in }}</td>
                <td><strong>Check-out:</strong> {{ $check_out }}</td>
            </tr>
            <tr>
                <td><strong>Hotel Type:</strong> {{ $hotel_category }}</td>
                <td><strong>Guests:</strong> {{ $guest_num }}</td>
            </tr>
            <tr>
                <td><strong>Booking Days:</strong> {{ $booking_days }}</td>
                <td></td>
            </tr>
        </table>

        <table class="summary">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Booking Price ({{ $booking_days }} days × ₹{{ number_format($booking_price, 2) }})</td>
                    <td>{{ number_format($booking_price * $booking_days, 2) }}</td>
                </tr>
                <tr>
                    <td>Tax ({{ $tax }}%)</td>
                    <td>{{ number_format($tax_amount, 2) }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>Total Amount</td>
                    <td>₹{{ number_format($total_amount, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="footer">
            Thank you for your booking!<br>
            This invoice was generated on {{ $created_at->format('d M Y, h:i A') }}.
        </div>
    </div>
</body>
</html>
