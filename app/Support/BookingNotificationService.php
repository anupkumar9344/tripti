<?php

namespace App\Support;

use App\Mail\BookingAdminNotificationMail;
use App\Mail\BookingInvoiceMail;
use App\Models\Booking;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Sends booking confirmation emails to guests and admins.
 */
class BookingNotificationService
{
    /**
     * Send the guest invoice and admin notification for a booking.
     */
    public function send(Booking $booking): void
    {
        if (! $this->isSmtpConfigured()) {
            return;
        }

        $booking->loadMissing('roomType');

        $hotelName = Setting::getValue('website_name', config('app.name', 'Tripti Hotel'));
        $hotelAddress = Setting::getValue('address');
        $hotelPhone = Setting::getValue('phone_1');
        $hotelEmail = Setting::getValue('email_1');

        $invoiceData = [
            'booking' => $booking,
            'hotelName' => $hotelName,
            'hotelAddress' => $hotelAddress,
            'hotelPhone' => $hotelPhone,
            'hotelEmail' => $hotelEmail,
        ];

        $pdfContent = Pdf::loadView('pdf.booking-invoice', $invoiceData)->output();

        try {
            Mail::to($booking->email)->send(new BookingInvoiceMail(
                $booking,
                $hotelName,
                $pdfContent
            ));
        } catch (\Throwable $exception) {
            Log::warning('Booking invoice email could not be sent.', [
                'booking_id' => $booking->id,
                'booking_number' => $booking->booking_number,
                'error' => $exception->getMessage(),
            ]);
        }

        $adminEmail = config('mail.admin_address');

        if (! filled($adminEmail)) {
            return;
        }

        try {
            Mail::to($adminEmail)->send(new BookingAdminNotificationMail(
                $booking,
                $hotelName,
                $hotelAddress,
                $hotelPhone
            ));
        } catch (\Throwable $exception) {
            Log::warning('Booking admin notification email could not be sent.', [
                'booking_id' => $booking->id,
                'booking_number' => $booking->booking_number,
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Determine whether SMTP mail delivery is configured.
     */
    private function isSmtpConfigured(): bool
    {
        if (config('mail.default') !== 'smtp') {
            return false;
        }

        $host = config('mail.mailers.smtp.host');
        $username = config('mail.mailers.smtp.username');
        $fromAddress = config('mail.from.address');

        return filled($host)
            && filled($username)
            && filled($fromAddress)
            && $fromAddress !== 'hello@example.com';
    }
}
