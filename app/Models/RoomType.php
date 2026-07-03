<?php

namespace App\Models;

use App\Support\MediaPath;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'image',
        'short_description',
        'fare',
        'max_adults',
        'max_children',
        'is_featured',
        'category',
        'sort_order',
        'status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fare' => 'decimal:2',
            'is_featured' => 'boolean',
            'status' => 'boolean',
        ];
    }

    /**
     * Get rooms for this room type.
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class)->orderBy('sort_order')->orderBy('room_number');
    }

    /**
     * Scope active room types ordered for public pages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActiveOrdered(Builder $query): Builder
    {
        return $query
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name');
    }

    /**
     * Scope active featured room types for the home page.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForHome(Builder $query): Builder
    {
        return $query
            ->activeOrdered()
            ->where('is_featured', true);
    }

    /**
     * Get a display label for the room category.
     */
    public function categoryLabel(): string
    {
        return $this->category === 'suite' ? 'Suite' : 'Room';
    }

    /**
     * Get the public URL for the room type image.
     */
    public function imageUrl(): string
    {
        return MediaPath::url($this->image, 'assets/img/rooms/1.jpg');
    }
}
