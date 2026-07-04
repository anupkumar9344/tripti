@extends('layouts.app')

@section('title', 'Booking Confirmed | Tripti Hotel')

@section('content')
    <section class="booking-page booking-page-no-breadcrumb" style="padding-top: 50px;">
        <div class="container">
            <div class="booking-success-card">
                <div class="booking-success-icon">
                    <i class="ri-checkbox-circle-fill"></i>
                </div>
                <h1>Thank you, {{ $booking->first_name }}!</h1>
                <p>Your booking request has been received. Our team will review and confirm your stay shortly.</p>

                <div class="booking-success-number">
                    Booking No. <strong>{{ $booking->booking_number }}</strong>
                </div>

                <ul class="booking-summary-list booking-success-list">
                    <li>
                        <span>Room</span>
                        <strong>{{ $booking->roomType?->name }}</strong>
                    </li>
                    <li>
                        <span>Stay</span>
                        <strong>
                            {{ $booking->check_in->format('d M Y') }}
                            –
                            {{ $booking->check_out->format('d M Y') }}
                            ({{ $booking->nights }} night{{ $booking->nights === 1 ? '' : 's' }})
                        </strong>
                    </li>
                    <li>
                        <span>Guests</span>
                        <strong>{{ $booking->adults }} adult{{ $booking->adults === 1 ? '' : 's' }}, {{ $booking->children }} child{{ $booking->children === 1 ? '' : 'ren' }}</strong>
                    </li>
                    <li>
                        <span>Payment</span>
                        <strong>{{ $booking->paymentMethodLabel() }} · {{ $booking->paymentStatusLabel() }}</strong>
                    </li>
                    <li>
                        <span>Status</span>
                        <strong>{{ $booking->statusLabel() }}</strong>
                    </li>
                    <li>
                        <span>Total</span>
                        <strong>₹{{ number_format((float) $booking->total_amount, 0) }}</strong>
                    </li>
                </ul>

                <div class="booking-success-actions">
                    <a href="{{ url('/') }}" class="booking-search-btn">Back to Home</a>
                    <a href="{{ route('contact') }}" class="booking-back-link">Need help? Contact us</a>
                </div>
            </div>
        </div>
    </section>
@endsection
