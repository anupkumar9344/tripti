<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Get a setting value by key.
     */
    public static function getValue(string $key, ?string $default = null): ?string
    {
        $setting = static::query()->where('key', $key)->first();

        return $setting?->value ?? $default;
    }

    /**
     * Store or update a setting value by key.
     */
    public static function setValue(string $key, ?string $value): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    /**
     * Get multiple settings as a key-value array.
     *
     * @param  list<string>  $keys
     * @return array<string, string|null>
     */
    public static function getMany(array $keys): array
    {
        $settings = static::query()
            ->whereIn('key', $keys)
            ->pluck('value', 'key')
            ->all();

        $result = [];

        foreach ($keys as $key) {
            $result[$key] = $settings[$key] ?? null;
        }

        return $result;
    }

    /**
     * Resolve a stored image path for public display.
     */
    public static function imageUrl(?string $value, string $defaultFile = 'home-about-team.jpg'): string
    {
        if (empty($value)) {
            return asset('images/'.$defaultFile);
        }

        if (str_starts_with($value, 'settings/')) {
            return asset('storage/'.$value);
        }

        return asset('images/'.ltrim($value, '/'));
    }
}
