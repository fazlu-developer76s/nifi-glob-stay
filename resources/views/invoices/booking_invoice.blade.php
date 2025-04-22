<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $invoice_number }}</title>
    <style>
        body { font-family: sans-serif; }
        .box { padding: 20px; border: 1px solid #ccc; margin-top: 20px; }
    </style>
</head>
<body>
    <h2>Booking Invoice</h2>
    <div class="box">
        <p><strong>Invoice No:</strong> {{ $invoice_number }}</p>
        <p><strong>Booking ID:</strong> {{ $booking_id }}</p>
        <p><strong>Customer:</strong> {{ $customer_name }}</p>
        <p><strong>Check-in:</strong> {{ $check_in }}</p>
        <p><strong>Check-out:</strong> {{ $check_out }}</p>
        <p><strong>Booking Price:</strong> ₹{{ number_format($booking_price, 2) }}</p>
        <p><strong>Tax ({{ $tax }}%):</strong> ₹{{ number_format($tax_amount, 2) }}</p>
        <p><strong>Total Amount:</strong> ₹{{ number_format($total_amount, 2) }}</p>
        <p><strong>Generated On:</strong> {{ $created_at }}</p>
    </div>
</body>
</html>
