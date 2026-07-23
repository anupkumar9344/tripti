<?php

namespace App\Support;

use App\Models\Booking;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

/**
 * Handles Razorpay order creation and payment verification.
 */
class RazorpayGateway
{
    /**
     * Setting keys used for Razorpay configuration.
     *
     * @var list<string>
     */
    public const SETTING_KEYS = [
        'razorpay_enabled',
        'razorpay_key_id',
        'razorpay_key_secret',
    ];

    /**
     * Get Razorpay settings from the database.
     *
     * @return array{enabled: bool, key_id: string|null, key_secret: string|null}
     */
    public static function settings(): array
    {
        $values = Setting::getMany(self::SETTING_KEYS);

        return [
            'enabled' => filter_var($values['razorpay_enabled'] ?? false, FILTER_VALIDATE_BOOLEAN),
            'key_id' => filled($values['razorpay_key_id'] ?? null) ? trim((string) $values['razorpay_key_id']) : null,
            'key_secret' => filled($values['razorpay_key_secret'] ?? null) ? trim((string) $values['razorpay_key_secret']) : null,
        ];
    }

    /**
     * Determine whether Razorpay online payments are configured and enabled.
     */
    public static function isEnabled(): bool
    {
        $settings = self::settings();

        return $settings['enabled']
            && filled($settings['key_id'])
            && filled($settings['key_secret']);
    }

    /**
     * Get the public Razorpay key id for checkout.
     */
    public static function keyId(): ?string
    {
        return self::settings()['key_id'];
    }

    /**
     * Create a Razorpay order for a booking.
     *
     * @return array<string, mixed>
     */
    public function createOrder(Booking $booking): array
    {
        $api = $this->api();
        $amountPaise = $this->amountInPaise((float) $booking->total_amount);

        if ($amountPaise < 100) {
            throw new \InvalidArgumentException('Booking amount must be at least ₹1 for online payment.');
        }

        return $api->order->create([
            'receipt' => $booking->booking_number,
            'amount' => $amountPaise,
            'currency' => 'INR',
            'notes' => [
                'booking_number' => $booking->booking_number,
                'guest_name' => $booking->guestName(),
            ],
        ])->toArray();
    }

    /**
     * Verify the Razorpay payment signature from checkout.
     */
    public function verifyPaymentSignature(string $orderId, string $paymentId, string $signature): bool
    {
        try {
            $this->api()->utility->verifyPaymentSignature([
                'razorpay_order_id' => $orderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature,
            ]);

            return true;
        } catch (\Throwable $exception) {
            Log::warning('Razorpay signature verification failed.', [
                'order_id' => $orderId,
                'payment_id' => $paymentId,
                'message' => $exception->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Convert rupees to paise for Razorpay.
     */
    public function amountInPaise(float $amount): int
    {
        return (int) round($amount * 100);
    }

    /**
     * Build a configured Razorpay API client.
     */
    private function api(): Api
    {
        $settings = self::settings();

        if (! self::isEnabled()) {
            throw new \RuntimeException('Razorpay is not configured.');
        }

        return new Api($settings['key_id'], $settings['key_secret']);
    }
}
