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
        'media_type',
        'image',
        'video',
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
     * Get the public URL for the banner image or video poster.
     */
    public function imageUrl(): string
    {
        return $this->posterUrl();
    }

    /**
     * Determine whether the banner uses a background video.
     */
    public function isVideoBanner(): bool
    {
        return $this->media_type === 'video' && filled($this->video);
    }

    /**
     * Get the poster image shown before or behind video banners.
     */
    public function posterUrl(): string
    {
        if (filled($this->image)) {
            return MediaPath::url($this->image);
        }

        return asset('assets/img/hero/hero-1.png');
    }

    /**
     * Determine whether the banner video is a direct MP4/WebM file.
     */
    public function isDirectVideo(): bool
    {
        if (! filled($this->video)) {
            return false;
        }

        $url = strtolower($this->video);

        return str_ends_with($url, '.mp4')
            || str_ends_with($url, '.webm')
            || str_contains($url, '.mp4?')
            || str_contains($url, '.webm?');
    }

    /**
     * Resolve the direct video source URL.
     */
    public function videoSourceUrl(): string
    {
        return MediaPath::url($this->video);
    }

    /**
     * Resolve an embeddable video URL for background players.
     */
    public function videoEmbedUrl(): string
    {
        $url = trim((string) $this->video);

        if ($url === '') {
            return '';
        }

        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{6,})/', $url, $matches)) {
            $videoId = $matches[1];

            return 'https://www.youtube.com/embed/'.$videoId.'?autoplay=1&mute=1&controls=0&showinfo=0&rel=0&loop=1&playlist='.$videoId.'&playsinline=1';
        }

        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $url, $matches)) {
            return 'https://player.vimeo.com/video/'.$matches[1].'?autoplay=1&muted=1&background=1&loop=1';
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }

        return MediaPath::url($url);
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
