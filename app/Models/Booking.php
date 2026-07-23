<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Booking extends Model
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_CONFIRMED = 'confirmed';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_CANCELLED = 'cancelled';

    /**
     * Status options used in admin menus and filters.
     *
     * @return list<string>
     */
    public static function statuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_CONFIRMED,
            self::STATUS_COMPLETED,
            self::STATUS_CANCELLED,
        ];
    }

    public const PAYMENT_COD = 'cod';

    public const PAYMENT_RAZORPAY = 'razorpay';

    public const PAYMENT_PENDING = 'pending';

    public const PAYMENT_PAID = 'paid';

    public const PAYMENT_FAILED = 'failed';

    public const PAYMENT_REFUNDED = 'refunded';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'booking_number',
        'room_type_id',
        'room_id',
        'check_in',
        'check_out',
        'adults',
        'children',
        'nights',
        'room_fare',
        'discount_amount',
        'total_amount',
        'booking_for',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'guests',
        'check_in_time',
        'check_out_time',
        'special_requests',
        'promo_code',
        'marketing_consent',
        'terms_accepted',
        'payment_method',
        'payment_status',
        'payment_gateway',
        'payment_order_id',
        'payment_reference',
        'payment_meta',
        'status',
        'admin_notes',
        'confirmed_at',
        'cancelled_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'check_in' => 'date',
            'check_out' => 'date',
            'room_fare' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'marketing_consent' => 'boolean',
            'terms_accepted' => 'boolean',
            'guests' => 'array',
            'payment_meta' => 'array',
            'confirmed_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    /**
     * Get the booked room type.
     */
    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    /**
     * Get the assigned room inventory unit, if any.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Scope bookings by status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Scope bookings that block inventory for a date range.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOverlapping(Builder $query, string $checkIn, string $checkOut): Builder
    {
        return $query
            ->whereIn('status', [self::STATUS_PENDING, self::STATUS_CONFIRMED])
            ->where('check_in', '<', $checkOut)
            ->where('check_out', '>', $checkIn);
    }

    /**
     * Generate a unique public booking number.
     */
    public static function generateBookingNumber(): string
    {
        do {
            $number = 'TH'.now()->format('ymd').strtoupper(Str::random(5));
        } while (self::query()->where('booking_number', $number)->exists());

        return $number;
    }

    /**
     * Get the guest full name.
     */
    public function guestName(): string
    {
        return trim($this->first_name.' '.$this->last_name);
    }

    /**
     * Get total guests for the stay.
     */
    public function totalGuests(): int
    {
        return (int) $this->adults + (int) $this->children;
    }

    /**
     * Get the stay subtotal before discounts.
     */
    public function subtotalAmount(): float
    {
        return round((float) $this->room_fare * (int) $this->nights, 2);
    }

    /**
     * Human-readable booking status label.
     */
    public function statusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
            default => 'Pending',
        };
    }

    /**
     * Human-readable payment method label.
     */
    public function paymentMethodLabel(): string
    {
        return match ($this->payment_method) {
            self::PAYMENT_RAZORPAY => 'Razorpay',
            default => 'Pay at Hotel (COD)',
        };
    }

    /**
     * Human-readable payment status label.
     */
    public function paymentStatusLabel(): string
    {
        return match ($this->payment_status) {
            self::PAYMENT_PAID => 'Paid',
            self::PAYMENT_FAILED => 'Failed',
            self::PAYMENT_REFUNDED => 'Refunded',
            default => 'Pending',
        };
    }

    /**
     * Whether this booking can still be confirmed.
     */
    public function canConfirm(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Whether this booking can still be cancelled.
     */
    public function canCancel(): bool
    {
        return in_array($this->status, [self::STATUS_PENDING, self::STATUS_CONFIRMED], true);
    }

    /**
     * Mark booking as confirmed.
     */
    public function markConfirmed(): void
    {
        $this->update([
            'status' => self::STATUS_CONFIRMED,
            'confirmed_at' => now(),
            'cancelled_at' => null,
        ]);
    }

    /**
     * Mark booking as cancelled.
     */
    public function markCancelled(): void
    {
        $this->update([
            'status' => self::STATUS_CANCELLED,
            'cancelled_at' => now(),
        ]);
    }

    /**
     * Count active bookings that overlap a stay for a room type.
     */
    public static function overlappingCount(int $roomTypeId, string $checkIn, string $checkOut, ?int $ignoreId = null): int
    {
        return self::query()
            ->where('room_type_id', $roomTypeId)
            ->overlapping($checkIn, $checkOut)
            ->when($ignoreId, fn (Builder $query) => $query->where('id', '!=', $ignoreId))
            ->count();
    }
}
