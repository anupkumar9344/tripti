<x-mail::message>
# New Booking Received

A new booking request has been submitted on the website.

**Booking Number:** {{ $booking->booking_number }}

**Guest:** {{ $booking->guestName() }}

**Email:** {{ $booking->email }}

**Phone:** {{ $booking->phone }}

@if ($booking->country)
**Country:** {{ $booking->country }}
@endif

**Room Type:** {{ $booking->roomType?->name ?? '—' }}

**Check-in:** {{ $booking->check_in->format('d M Y') }}@if($booking->check_in_time) · {{ $booking->check_in_time }}@endif

**Check-out:** {{ $booking->check_out->format('d M Y') }}@if($booking->check_out_time) · {{ $booking->check_out_time }}@endif

**Guests:** {{ $booking->adults }} adults, {{ $booking->children }} children

**Nights:** {{ $booking->nights }}

**Payment Method:** {{ $booking->paymentMethodLabel() }}

**Payment Status:** {{ $booking->paymentStatusLabel() }}

**Subtotal:** ₹{{ number_format($booking->subtotalAmount(), 0) }}

@if ((float) $booking->discount_amount > 0)
**Promo Discount:** -₹{{ number_format((float) $booking->discount_amount, 0) }}

@if ($booking->promo_code)
**Promo Code:** {{ $booking->promo_code }}
@endif
@endif

**Total Amount:** ₹{{ number_format((float) $booking->total_amount, 0) }}

**Booking Status:** {{ $booking->statusLabel() }}

@if ($booking->special_requests)
**Special Requests:**

{{ $booking->special_requests }}
@endif

<x-mail::button :url="route('admin.bookings.show', $booking)">
View in Admin Panel
</x-mail::button>

Thanks,<br>
{{ $hotelName }}
</x-mail::message>
