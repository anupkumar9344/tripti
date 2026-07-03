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
     * Get the public URL for the facility image.
     */
    public function imageUrl(): string
    {
        return MediaPath::url($this->image, 'assets/img/amenities/1.jpg');
    }
}
