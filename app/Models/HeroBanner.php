<?php

namespace App\Models;

use App\Support\MediaPath;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HeroBanner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'eyebrow',
        'title',
        'text',
        'image',
        'primary_label',
        'primary_url',
        'secondary_label',
        'secondary_url',
        'secondary_type',
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
            'status' => 'boolean',
        ];
    }

    /**
     * Scope active hero banners ordered for the home slider.
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
     * Get the public URL for the banner image.
     */
    public function imageUrl(): string
    {
        return MediaPath::url($this->image);
    }

    /**
     * Resolve a stored URL for the public site.
     */
    public function resolveUrl(?string $url, string $fallback = '/contact-us'): string
    {
        if (! $url) {
            return url($fallback);
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }

        return url($url);
    }

    /**
     * Get the primary action URL.
     */
    public function primaryActionUrl(): string
    {
        return $this->resolveUrl($this->primary_url);
    }

    /**
     * Get the secondary action URL.
     */
    public function secondaryActionUrl(): string
    {
        return $this->resolveUrl($this->secondary_url, '/contact-us');
    }

    /**
     * Determine whether the secondary action opens a video popup.
     */
    public function isSecondaryVideo(): bool
    {
        return $this->secondary_type === 'video' && filled($this->secondary_url);
    }

    /**
     * Determine whether the secondary action should be shown.
     */
    public function hasSecondaryAction(): bool
    {
        return filled($this->secondary_label) && filled($this->secondary_url) && filled($this->secondary_type);
    }
}
