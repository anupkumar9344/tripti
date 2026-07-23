<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'discount_type',
        'discount_value',
        'starts_at',
        'ends_at',
        'is_active',
        'is_default',
        'usage_limit',
        'used_count',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'discount_value' => 'decimal:2',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $promoCode): void {
            $promoCode->code = strtoupper(trim((string) $promoCode->code));

            if ($promoCode->is_default) {
                static::query()->where('id', '!=', $promoCode->getKey())->update(['is_default' => false]);
            }
        });
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(function (Builder $query): void {
                $query->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function (Builder $query): void {
                $query->whereNull('ends_at')->orWhere('ends_at', '>=', now());
            });
    }

    public function scopeDefault(Builder $query): Builder
    {
        return $query->where('is_default', true);
    }

    public function isApplicable(): bool
    {
        if (! $this->is_active) {
            return false;
        }

        if ($this->usage_limit !== null && $this->used_count >= $this->usage_limit) {
            return false;
        }

        $now = now();

        if ($this->starts_at && $this->starts_at->gt($now)) {
            return false;
        }

        if ($this->ends_at && $this->ends_at->lt($now)) {
            return false;
        }

        return true;
    }

    public function calculateDiscount(float $amount): float
    {
        if ($this->discount_type === 'percent') {
            $discount = round((float) $amount * ((float) $this->discount_value / 100), 2);
        } else {
            $discount = round((float) $this->discount_value, 2);
        }

        return min($discount, max(0, $amount));
    }

    public function statusLabel(): string
    {
        if (! $this->is_active) {
            return 'Inactive';
        }

        $now = now();

        if ($this->starts_at && $this->starts_at->gt($now)) {
            return 'Scheduled';
        }

        if ($this->ends_at && $this->ends_at->lt($now)) {
            return 'Expired';
        }

        if ($this->usage_limit !== null && $this->used_count >= $this->usage_limit) {
            return 'Exhausted';
        }

        return 'Active';
    }

    public function usageSummary(): string
    {
        if ($this->usage_limit === null) {
            return (string) $this->used_count.' used';
        }

        return $this->used_count.' / '.$this->usage_limit;
    }

    public function discountLabel(): string
    {
        if ($this->discount_type === 'percent') {
            $value = rtrim(rtrim(number_format((float) $this->discount_value, 2, '.', ''), '0'), '.');

            return $value.'% off';
        }

        $value = rtrim(rtrim(number_format((float) $this->discount_value, 2, '.', ''), '0'), '.');

        return '₹'.$value.' off';
    }

    public static function defaultApplicable(): ?self
    {
        $promoCode = static::query()->active()->default()->first();

        if (! $promoCode || ! $promoCode->isApplicable()) {
            return null;
        }

        return $promoCode;
    }

    public function applyToAmount(float $amount): float
    {
        $discount = $this->calculateDiscount($amount);

        return max(0, round((float) $amount - $discount, 2));
    }

    public function incrementUsage(): void
    {
        $this->forceFill(['used_count' => (int) $this->used_count + 1])->save();
    }
}
