<?php

namespace App\Models;

use App\Support\MediaPath;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HotelFacility extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'icon',
        'image',
        'short_description',
        'is_featured',
        'sort_order',
        'status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'status' => 'boolean',
        ];
    }

    /**
     * Scope active featured facilities for the home page.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForHome(Builder $query): Builder
    {
        return $query
            ->where('status', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->orderBy('title');
    }

    /**
     * Default images used when a facility has no uploaded image.
     *
     * @var list<string>
     */
    private const DEFAULT_IMAGES = [
        'assets/img/amenities/1.jpg',
        'assets/img/amenities/2.jpg',
        'assets/img/amenities/3.jpg',
        'assets/img/amenities/4.jpg',
    ];

    /**
     * Get the public URL for the facility image.
     */
    public function imageUrl(int $fallbackIndex = 0): string
    {
        if (filled($this->image)) {
            return MediaPath::url($this->image);
        }

        $defaults = self::DEFAULT_IMAGES;
        $index = max(0, $fallbackIndex) % count($defaults);

        return asset($defaults[$index]);
    }
}
