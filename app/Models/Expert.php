<?php

namespace App\Models;

use App\Support\MediaPath;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Expert extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'photo',
        'designation',
        'specialty',
        'qualifications',
        'short_description',
        'specialty_location',
        'experience_label',
        'patients_treated',
        'highlight_quote',
        'long_description',
        'status',
        'display_on_home',
        'show_faq_section',
        'sort_order',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'display_on_home' => 'boolean',
            'show_faq_section' => 'boolean',
        ];
    }

    /**
     * Get the public URL for the expert photo.
     */
    public function photoUrl(): string
    {
        return MediaPath::url($this->photo);
    }

    /**
     * Build the combined stats line shown on expert cards.
     */
    public function statsLabel(): string
    {
        if ($this->experience_label && $this->qualifications) {
            return $this->experience_label.' | '.$this->qualifications;
        }

        return $this->experience_label ?: ($this->qualifications ?? '');
    }

    /**
     * Scope active experts ordered for listing pages.
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
     * Scope active experts marked for the home page section.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForHome(Builder $query): Builder
    {
        return $query
            ->where('status', true)
            ->where('display_on_home', true)
            ->orderBy('sort_order')
            ->orderBy('name');
    }

    /**
     * Generate a unique slug from the given name.
     */
    public static function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $count = 1;

        while (static::query()
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $original.'-'.$count++;
        }

        return $slug;
    }
}
