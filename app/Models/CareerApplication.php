<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CareerApplication extends Model
{
    public const STATUS_NEW = 'new';

    public const STATUS_REVIEWED = 'reviewed';

    public const STATUS_SHORTLISTED = 'shortlisted';

    public const STATUS_REJECTED = 'rejected';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'career_opening_id',
        'name',
        'email',
        'phone',
        'position',
        'message',
        'status',
        'admin_notes',
    ];

    /**
     * @return list<string>
     */
    public static function statuses(): array
    {
        return [
            self::STATUS_NEW,
            self::STATUS_REVIEWED,
            self::STATUS_SHORTLISTED,
            self::STATUS_REJECTED,
        ];
    }

    /**
     * Scope applications by status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Get the opening this application was submitted for.
     */
    public function opening(): BelongsTo
    {
        return $this->belongsTo(CareerOpening::class, 'career_opening_id');
    }

    /**
     * Human-readable status label.
     */
    public function statusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_NEW => 'New',
            self::STATUS_REVIEWED => 'Reviewed',
            self::STATUS_SHORTLISTED => 'Shortlisted',
            self::STATUS_REJECTED => 'Rejected',
            default => ucfirst($this->status),
        };
    }

    /**
     * Bootstrap badge class for the current status.
     */
    public function statusBadgeClass(): string
    {
        return match ($this->status) {
            self::STATUS_NEW => 'badge-soft-success',
            self::STATUS_REVIEWED => 'badge-soft-info',
            self::STATUS_SHORTLISTED => 'badge-soft-warning',
            self::STATUS_REJECTED => 'badge-soft-danger',
            default => 'badge-soft-secondary',
        };
    }
}
