<?php

namespace App\Models;

use App\Support\MediaPath;
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

        return MediaPath::url($value, $defaultFile);
    }

    /**
     * Resolve the admin login page background image URL.
     */
    public static function adminLoginImageUrl(?string $value = null, string $defaultFile = 'gallery-4.jpg'): string
    {
        $stored = $value ?? static::getValue('admin_login_image');

        return static::imageUrl($stored, $defaultFile);
    }

    /**
     * Resolve the site favicon URL for the website and admin panel.
     */
    public static function faviconUrl(?string $value = null, string $defaultFile = 'logo/logo.webp'): string
    {
        $stored = $value ?? static::getValue('website_favicon');

        if (empty($stored)) {
            $stored = static::getValue('website_logo');
        }

        if (empty($stored)) {
            return asset('images/'.$defaultFile);
        }

        return MediaPath::url($stored, $defaultFile);
    }
}
