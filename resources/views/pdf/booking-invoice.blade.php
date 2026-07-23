<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Booking Invoice {{ $booking->booking_number }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 24px;
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
            line-height: 1.5;
        }
        .header {
            border-bottom: 2px solid #6b4ce6;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }
        .header h1 {
            margin: 0 0 4px;
            font-size: 22px;
            color: #111;
        }
        .header p {
            margin: 2px 0;
            color: #555;
        }
        .invoice-meta {
            width: 100%;
            margin-bottom: 24px;
        }
        .invoice-meta td {
            vertical-align: top;
            width: 50%;
            padding: 0;
        }
        .section-title {
            margin: 0 0 8px;
            font-size: 13px;
            font-weight: bold;
            color: #6b4ce6;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .info-block p {
            margin: 0 0 4px;
        }
        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.items th,
        table.items td {
            border: 1px solid #ddd;
            padding: 10px 12px;
            text-align: left;
        }
        table.items th {
            background: #f7f4ff;
            font-weight: bold;
        }
        table.items td.amount,
        table.items th.amount {
            text-align: right;
            white-space: nowrap;
        }
        .totals {
            width: 100%;
            margin-top: 8px;
        }
        .totals td {
            padding: 6px 0;
        }
        .totals .label {
            text-align: right;
            padding-right: 16px;
            color: #555;
        }
        .totals .value {
            text-align: right;
            width: 120px;
            font-weight: bold;
        }
        .totals .grand-total .label,
        .totals .grand-total .value {
            font-size: 14px;
            color: #111;
            border-top: 2px solid #ddd;
            padding-top: 10px;
        }
        .footer {
            margin-top: 32px;
            padding-top: 16px;
            border-top: 1px solid #ddd;
            font-size: 11px;
            color: #666;
        }
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            background: #f3f0ff;
            color: #6b4ce6;
            font-size: 11px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $hotelName }}</h1>
        @if ($hotelAddress)
            <p>{{ $hotelAddress }}</p>
        @endif
        @if ($hotelPhone || $hotelEmail)
            <p>
                @if ($hotelPhone)Phone: {{ $hotelPhone }}@endif
                @if ($hotelPhone && $hotelEmail) · @endif
                @if ($hotelEmail)Email: {{ $hotelEmail }}@endif
            </p>
        @endif
    </div>

    <table class="invoice-meta">
        <tr>
            <td>
                <p class="section-title">Bill To</p>
                <div class="info-block">
                    <p><strong>{{ $booking->guestName() }}</strong></p>
                    <p>{{ $booking->email }}</p>
                    <p>{{ $booking->phone }}</p>
                    @if ($booking->country)
                        <p>{{ $booking->country }}</p>
                    @endif
                </div>
            </td>
            <td style="text-align: right;">
                <p class="section-title">Invoice Details</p>
                <div class="info-block">
                    <p><strong>Invoice #:</strong> {{ $booking->booking_number }}</p>
                    <p><strong>Date:</strong> {{ now()->format('d M Y') }}</p>
                    <p><strong>Status:</strong> <span class="badge">{{ $booking->statusLabel() }}</span></p>
                    <p><strong>Payment:</strong> {{ $booking->paymentMethodLabel() }} · {{ $booking->paymentStatusLabel() }}</p>
                </div>
            </td>
        </tr>
    </table>

    <p class="section-title">Stay Details</p>
    <table class="items">
        <thead>
            <tr>
                <th>Description</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th class="amount">Nights</th>
                <th class="amount">Rate / Night</th>
                <th class="amount">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $booking->roomType?->name ?? 'Room Booking' }}</td>
                <td>{{ $booking->check_in->format('d M Y') }}</td>
                <td>{{ $booking->check_out->format('d M Y') }}</td>
                <td class="amount">{{ $booking->nights }}</td>
                <td class="amount">₹{{ number_format((float) $booking->room_fare, 0) }}</td>
                <td class="amount">₹{{ number_format($booking->subtotalAmount(), 0) }}</td>
            </tr>
        </tbody>
    </table>

    <table class="totals" align="right">
        <tr>
            <td class="label">Subtotal</td>
            <td class="value">₹{{ number_format($booking->subtotalAmount(), 0) }}</td>
        </tr>
        @if ((float) $booking->discount_amount > 0)
            <tr>
                <td class="label">Promo Discount@if($booking->promo_code) ({{ $booking->promo_code }})@endif</td>
                <td class="value">-₹{{ number_format((float) $booking->discount_amount, 0) }}</td>
            </tr>
        @endif
        <tr class="grand-total">
            <td class="label">Total Amount</td>
            <td class="value">₹{{ number_format((float) $booking->total_amount, 0) }}</td>
        </tr>
    </table>

    <table class="invoice-meta" style="margin-top: 24px;">
        <tr>
            <td>
                <p class="section-title">Guest Summary</p>
                <div class="info-block">
                    <p><strong>Adults:</strong> {{ $booking->adults }}</p>
                    <p><strong>Children:</strong> {{ $booking->children }}</p>
                    @if ($booking->check_in_time)
                        <p><strong>Preferred Check-in Time:</strong> {{ $booking->check_in_time }}</p>
                    @endif
                    @if ($booking->check_out_time)
                        <p><strong>Preferred Check-out Time:</strong> {{ $booking->check_out_time }}</p>
                    @endif
                </div>
            </td>
            <td>
                @if ($booking->special_requests)
                    <p class="section-title">Special Requests</p>
                    <div class="info-block">
                        <p>{{ $booking->special_requests }}</p>
                    </div>
                @endif
            </td>
        </tr>
    </table>

    <div class="footer">
        <p>This is a computer-generated booking invoice from {{ $hotelName }}. Please retain it for your records.</p>
        <p>Our team will review your booking and confirm your stay shortly.</p>
    </div>
</body>
</html>
