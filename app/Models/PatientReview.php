<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PatientReview extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'reviewer_name',
        'initial',
        'avatar_tone',
        'review_time',
        'review_text',
        'rating',
        'is_verified',
        'sort_order',
        'status',
    ];

    /**
     * Get the attribute casts.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_verified' => 'boolean',
            'status' => 'boolean',
        ];
    }

    /**
     * Scope active reviews ordered for the website slider.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActiveOrdered(Builder $query): Builder
    {
        return $query
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('reviewer_name');
    }

    /**
     * Resolve the avatar initial shown on review cards.
     */
    public function avatarInitial(): string
    {
        if (! empty($this->initial)) {
            return Str::upper(Str::substr($this->initial, 0, 1));
        }

        return Str::upper(Str::substr($this->reviewer_name, 0, 1));
    }
}
