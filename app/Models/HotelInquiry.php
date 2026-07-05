<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HotelInquiry extends Model
{
    public const TYPE_ROOM = 'room';

    public const TYPE_EVENT = 'event';

    public const TYPE_BANQUET = 'banquet';

    public const TYPE_GENERAL = 'general';

    public const TYPE_OTHER = 'other';

    public const STATUS_NEW = 'new';

    public const STATUS_IN_PROGRESS = 'in_progress';

    public const STATUS_QUOTED = 'quoted';

    public const STATUS_CLOSED = 'closed';

    public const STATUS_CANCELLED = 'cancelled';

    public const SOURCE_MANUAL = 'manual';

    public const SOURCE_PHONE = 'phone';

    public const SOURCE_EMAIL = 'email';

    public const SOURCE_WALK_IN = 'walk_in';

    public const SOURCE_WEBSITE = 'website';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'inquiry_type',
        'room_type_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'subject',
        'message',
        'check_in_date',
        'check_out_date',
        'adults',
        'children',
        'source',
        'status',
        'admin_notes',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'check_in_date' => 'date',
            'check_out_date' => 'date',
            'adults' => 'integer',
            'children' => 'integer',
        ];
    }

    /**
     * @return list<string>
     */
    public static function types(): array
    {
        return [
            self::TYPE_ROOM,
            self::TYPE_EVENT,
            self::TYPE_BANQUET,
            self::TYPE_GENERAL,
            self::TYPE_OTHER,
        ];
    }

    /**
     * @return list<string>
     */
    public static function statuses(): array
    {
        return [
            self::STATUS_NEW,
            self::STATUS_IN_PROGRESS,
            self::STATUS_QUOTED,
            self::STATUS_CLOSED,
            self::STATUS_CANCELLED,
        ];
    }

    /**
     * @return list<string>
     */
    public static function sources(): array
    {
        return [
            self::SOURCE_MANUAL,
            self::SOURCE_PHONE,
            self::SOURCE_EMAIL,
            self::SOURCE_WALK_IN,
            self::SOURCE_WEBSITE,
        ];
    }

    /**
     * Scope inquiries by status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Get the related room type when this is a room inquiry.
     */
    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    /**
     * Human-readable inquiry type label.
     */
    public function typeLabel(): string
    {
        return match ($this->inquiry_type) {
            self::TYPE_ROOM => 'Room',
            self::TYPE_EVENT => 'Event',
            self::TYPE_BANQUET => 'Banquet',
            self::TYPE_GENERAL => 'General',
            default => 'Other',
        };
    }

    /**
     * Human-readable status label.
     */
    public function statusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_NEW => 'New',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_QUOTED => 'Quoted',
            self::STATUS_CLOSED => 'Closed',
            self::STATUS_CANCELLED => 'Cancelled',
            default => ucfirst(str_replace('_', ' ', $this->status)),
        };
    }

    /**
     * Human-readable source label.
     */
    public function sourceLabel(): string
    {
        return match ($this->source) {
            self::SOURCE_PHONE => 'Phone',
            self::SOURCE_EMAIL => 'Email',
            self::SOURCE_WALK_IN => 'Walk-in',
            self::SOURCE_WEBSITE => 'Website',
            default => 'Manual',
        };
    }

    /**
     * Bootstrap CSS badge class for the current status.
     */
    public function statusBadgeClass(): string
    {
        return match ($this->status) {
            self::STATUS_NEW => 'badge-soft-success',
            self::STATUS_IN_PROGRESS => 'badge-soft-warning',
            self::STATUS_QUOTED => 'badge-soft-info',
            self::STATUS_CLOSED => 'badge-soft-secondary',
            self::STATUS_CANCELLED => 'badge-soft-danger',
            default => 'badge-soft-secondary',
        };
    }
}
