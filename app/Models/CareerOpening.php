<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CareerOpening extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'department',
        'job_type',
        'location',
        'description',
        'sort_order',
        'status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    /**
     * @return list<string>
     */
    public static function jobTypes(): array
    {
        return ['Full Time', 'Part Time', 'Contract'];
    }

    /**
     * Scope active openings ordered for display.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActiveOrdered(Builder $query): Builder
    {
        return $query
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('title');
    }

    /**
     * Get applications submitted for this opening.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(CareerApplication::class);
    }
}
