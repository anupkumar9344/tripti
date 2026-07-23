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
                <p>
                    @if ($booking->payment_method === \App\Models\Booking::PAYMENT_RAZORPAY && $booking->payment_status === \App\Models\Booking::PAYMENT_PAID)
                        Your payment was successful and your booking request has been received. Our team will review and confirm your stay shortly.
                    @else
                        Your booking request has been received. Our team will review and confirm your stay shortly.
                    @endif
                </p>

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
                    @if ($booking->promo_code)
                        <li>
                            <span>Promo code</span>
                            <strong>{{ $booking->promo_code }}</strong>
                        </li>
                    @endif
                    <li>
                        <span>Subtotal</span>
                        <strong>₹{{ number_format($booking->subtotalAmount(), 0) }}</strong>
                    </li>
                    @if ((float) $booking->discount_amount > 0)
                        <li>
                            <span>Promo discount</span>
                            <strong>-₹{{ number_format((float) $booking->discount_amount, 0) }}</strong>
                        </li>
                    @endif
                    <li>
                        <span>Total</span>
                        <strong>₹{{ number_format((float) $booking->total_amount, 0) }}</strong>
                    </li>
                </ul>

                <div class="booking-success-actions">
                    @if ($booking->payment_method === \App\Models\Booking::PAYMENT_RAZORPAY && $booking->payment_status === \App\Models\Booking::PAYMENT_PENDING)
                        <a href="{{ route('booking.payment', $booking->booking_number) }}" class="booking-search-btn">Complete Payment</a>
                    @else
                        <a href="{{ url('/') }}" class="booking-search-btn">Back to Home</a>
                    @endif
                    <a href="{{ route('contact') }}" class="booking-back-link">Need help? Contact us</a>
                </div>
            </div>
        </div>
    </section>
@endsection
