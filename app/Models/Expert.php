<?php

namespace App\Models;

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
        ];
    }

    /**
     * Get the public URL for the expert photo.
     */
    public function photoUrl(): string
    {
        return asset('storage/'.$this->photo);
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
