<x-mail::message>
# Booking Confirmation

Dear {{ $booking->guestName() }},

Thank you for choosing **{{ $hotelName }}**. Your booking request has been received successfully.

**Booking Number:** {{ $booking->booking_number }}

**Room:** {{ $booking->roomType?->name ?? '—' }}

**Stay:** {{ $booking->check_in->format('d M Y') }} – {{ $booking->check_out->format('d M Y') }} ({{ $booking->nights }} night{{ $booking->nights === 1 ? '' : 's' }})

**Guests:** {{ $booking->adults }} adult{{ $booking->adults === 1 ? '' : 's' }}, {{ $booking->children }} child{{ $booking->children === 1 ? '' : 'ren' }}

**Payment:** {{ $booking->paymentMethodLabel() }} · {{ $booking->paymentStatusLabel() }}

**Total Amount:** ₹{{ number_format((float) $booking->total_amount, 0) }}

Your booking invoice is attached as a PDF for your records. Our team will review and confirm your stay shortly.

<x-mail::button :url="route('booking.success', $booking->booking_number)">
View Booking Details
</x-mail::button>

Thanks,<br>
{{ $hotelName }}
</x-mail::message>
