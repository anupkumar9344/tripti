@extends('layouts.app')

@section('title', 'Complete Payment | Tripti Hotel')

@section('content')
    <section class="booking-page booking-payment-page booking-page-no-breadcrumb" style="padding-top: 50px;">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger booking-alert">{{ session('error') }}</div>
            @endif

            @if (session('info'))
                <div class="alert alert-info booking-alert">{{ session('info') }}</div>
            @endif

            <div class="booking-success-card booking-payment-card">
                <div class="booking-success-icon">
                    <i class="ri-secure-payment-line"></i>
                </div>
                <h1>Complete Your Payment</h1>
                <p>Booking <strong>{{ $booking->booking_number }}</strong> is reserved. Pay now to complete your request.</p>

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
                        </strong>
                    </li>
                    <li>
                        <span>Amount payable</span>
                        <strong>₹{{ number_format((float) $booking->total_amount, 0) }}</strong>
                    </li>
                </ul>

                <div class="booking-success-actions">
                    <button type="button" class="booking-search-btn" id="razorpayPayBtn">
                        Pay with Razorpay
                    </button>
                    <a href="{{ route('booking.success', $booking->booking_number) }}" class="booking-back-link">View booking details</a>
                </div>
            </div>
        </div>
    </section>

    <form id="razorpayVerifyForm" action="{{ route('booking.payment.verify') }}" method="POST" class="d-none">
        @csrf
        <input type="hidden" name="booking_number" value="{{ $booking->booking_number }}">
        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value="{{ $razorpayOrderId }}">
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    </form>
@endsection

@push('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const payBtn = document.getElementById('razorpayPayBtn');
            const verifyForm = document.getElementById('razorpayVerifyForm');

            if (!payBtn || !verifyForm || typeof Razorpay === 'undefined') {
                return;
            }

            const options = {
                key: @json($razorpayKeyId),
                amount: {{ $amountPaise }},
                currency: 'INR',
                name: @json($siteName ?? 'Tripti Hotel'),
                description: 'Booking {{ $booking->booking_number }}',
                order_id: @json($razorpayOrderId),
                prefill: {
                    name: @json($booking->guestName()),
                    email: @json($booking->email),
                    contact: @json($booking->phone),
                },
                theme: {
                    color: '#111111',
                },
                handler: function (response) {
                    document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay_signature').value = response.razorpay_signature;
                    verifyForm.submit();
                },
                modal: {
                    ondismiss: function () {
                        payBtn.disabled = false;
                        payBtn.textContent = 'Pay with Razorpay';
                    },
                },
            };

            const razorpay = new Razorpay(options);

            payBtn.addEventListener('click', function () {
                payBtn.disabled = true;
                payBtn.textContent = 'Opening payment...';
                razorpay.open();
            });

            razorpay.open();
        });
    </script>
@endpush
