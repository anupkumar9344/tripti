<?php

namespace App\Models;

use App\Support\MediaPath;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HealthProgram extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'image',
        'video_url',
        'eyebrow',
        'section_title',
        'section_lead',
        'date_time',
        'location',
        'chief_consultant',
        'key_benefits',
        'button_text',
        'button_url',
        'sort_order',
        'status',
        'active_on_home',
    ];

    /**
     * Get the attribute casts.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'active_on_home' => 'boolean',
        ];
    }

    /**
     * Scope active programs ordered for listing pages.
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
     * Scope the active program shown on the home page.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForHome(Builder $query): Builder
    {
        return $query
            ->where('status', true)
            ->where('active_on_home', true)
            ->orderBy('sort_order')
            ->orderBy('title');
    }

    /**
     * Get the public URL for the program image.
     */
    public function imageUrl(): string
    {
        return MediaPath::url($this->image);
    }

    /**
     * Build the detail rows used on the public program section.
     *
     * @return array<int, array{label: string, value: string, tone: string, icon?: string}>
     */
    public function detailItems(bool $includeProgramName = true): array
    {
        $items = [];

        if ($includeProgramName) {
            $items[] = [
                'label' => 'Program Name',
                'value' => $this->title,
                'tone' => 'primary',
            ];
        }

        if ($this->date_time) {
            $items[] = [
                'label' => 'Date & Time',
                'value' => $this->date_time,
                'tone' => 'accent',
                'icon' => 'fa-calendar-days',
            ];
        }

        if ($this->location) {
            $items[] = [
                'label' => 'Location',
                'value' => $this->location,
                'tone' => 'warm',
                'icon' => 'fa-location-dot',
            ];
        }

        if ($this->chief_consultant) {
            $items[] = [
                'label' => 'Chief Consultant',
                'value' => $this->chief_consultant,
                'tone' => 'primary',
                'icon' => 'fa-user-doctor',
            ];
        }

        if ($this->key_benefits) {
            $items[] = [
                'label' => 'Key Benefits',
                'value' => $this->key_benefits,
                'tone' => 'accent',
            ];
        }

        return $items;
    }

    /**
     * Ensure only one program is marked active on the home page.
     */
    public static function syncActiveOnHome(int $programId): void
    {
        static::query()
            ->where('id', '!=', $programId)
            ->update(['active_on_home' => false]);
    }
}
