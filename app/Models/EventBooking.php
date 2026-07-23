<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EventBooking extends Model
{
    public const TYPE_BANQUET = 'banquet';

    public const TYPE_MEETING = 'meeting';

    public const STATUS_NEW = 'new';

    public const STATUS_CONFIRMED = 'confirmed';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_CANCELLED = 'cancelled';

    public const SOURCE_WEBSITE = 'website';

    public const SOURCE_MANUAL = 'manual';

    public const SOURCE_PHONE = 'phone';

    public const SOURCE_EMAIL = 'email';

    protected $fillable = [
        'reference_number',
        'booking_type',
        'contact_name',
        'email',
        'phone',
        'company_name',
        'number_of_people',
        'program_name',
        'event_date',
        'event_time',
        'purpose',
        'additional_notes',
        'booking_amount',
        'advance_amount',
        'advance_paid_at',
        'source',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'event_date' => 'date',
        'advance_paid_at' => 'date',
        'number_of_people' => 'integer',
        'booking_amount' => 'decimal:2',
        'advance_amount' => 'decimal:2',
    ];

    /**
     * @return list<string>
     */
    public static function types(): array
    {
        return [self::TYPE_BANQUET, self::TYPE_MEETING];
    }

    /**
     * @return list<string>
     */
    public static function statuses(): array
    {
        return [
            self::STATUS_NEW,
            self::STATUS_CONFIRMED,
            self::STATUS_COMPLETED,
            self::STATUS_CANCELLED,
        ];
    }

    /**
     * @return list<string>
     */
    public static function sources(): array
    {
        return [
            self::SOURCE_WEBSITE,
            self::SOURCE_MANUAL,
            self::SOURCE_PHONE,
            self::SOURCE_EMAIL,
        ];
    }

    public function scopeStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    public function typeLabel(): string
    {
        return match ($this->booking_type) {
            self::TYPE_MEETING => 'Meeting',
            default => 'Banquet',
        };
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
            default => 'New',
        };
    }

    public function statusBadgeClass(): string
    {
        return match ($this->status) {
            self::STATUS_CONFIRMED => 'badge-soft-success',
            self::STATUS_COMPLETED => 'badge-soft-info',
            self::STATUS_CANCELLED => 'badge-soft-danger',
            default => 'badge-soft-warning',
        };
    }

    public function sourceLabel(): string
    {
        return match ($this->source) {
            self::SOURCE_MANUAL => 'Manual',
            self::SOURCE_PHONE => 'Phone',
            self::SOURCE_EMAIL => 'Email',
            default => 'Website',
        };
    }

    public function balanceAmount(): ?float
    {
        if ($this->booking_amount === null) {
            return null;
        }

        return max(0, round((float) $this->booking_amount - (float) ($this->advance_amount ?? 0), 2));
    }

    public function advancePaymentLabel(): string
    {
        if ($this->booking_amount === null || (float) $this->booking_amount <= 0) {
            return 'Not quoted';
        }

        $advance = (float) ($this->advance_amount ?? 0);
        $total = (float) $this->booking_amount;

        if ($advance <= 0) {
            return 'Pending';
        }

        if ($advance >= $total) {
            return 'Paid';
        }

        return 'Partial';
    }

    public function advancePaymentBadgeClass(): string
    {
        return match ($this->advancePaymentLabel()) {
            'Paid' => 'badge-soft-success',
            'Partial' => 'badge-soft-info',
            'Pending' => 'badge-soft-warning',
            default => 'badge-soft-secondary',
        };
    }

    public static function generateReferenceNumber(): string
    {
        do {
            $number = 'EB'.now()->format('ymd').strtoupper(Str::random(4));
        } while (self::query()->where('reference_number', $number)->exists());

        return $number;
    }
}
