<?php

namespace App\Models;

use App\Support\MediaPath;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'type',
        'source',
        'thumbnail',
        'icon_tags',
        'is_featured',
        'display_on_home',
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
            'is_featured' => 'boolean',
            'display_on_home' => 'boolean',
            'status' => 'boolean',
        ];
    }

    /**
     * Scope active gallery items ordered for display.
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
     * Scope gallery items shown on the home page showcase.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForHome(Builder $query): Builder
    {
        return $query
            ->where('display_on_home', true)
            ->activeOrdered();
    }

    /**
     * Determine whether the item is a video entry.
     */
    public function isVideo(): bool
    {
        return $this->type === 'video';
    }

    /**
     * Get the public URL used in popup links.
     */
    public function popupHref(): string
    {
        if ($this->isVideo()) {
            return $this->embedUrl();
        }

        return $this->sourceUrl();
    }

    /**
     * Resolve the item thumbnail for grids and cards.
     */
    public function thumbnailUrl(): string
    {
        $path = $this->thumbnail ?: ($this->isVideo() ? null : $this->source);

        return MediaPath::url($path, 'gallery-1.jpg');
    }

    /**
     * Resolve the full-size image source URL.
     */
    public function sourceUrl(): string
    {
        return MediaPath::url($this->source, 'gallery-1.jpg');
    }

    /**
     * Resolve an embeddable video URL for popup players.
     */
    public function embedUrl(): string
    {
        $url = trim($this->source);

        if ($url === '') {
            return '';
        }

        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{6,})/', $url, $matches)) {
            return 'https://www.youtube.com/embed/'.$matches[1];
        }

        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $url, $matches)) {
            return 'https://player.vimeo.com/video/'.$matches[1];
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }

        return MediaPath::url($url);
    }

    /**
     * Get icon classes for the featured home panel.
     *
     * @return list<string>
     */
    public function iconList(): array
    {
        if (! filled($this->icon_tags)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $this->icon_tags))));
    }
}
