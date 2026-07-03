<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class MediaPath
{
    /**
     * Resolve a public URL from a stored path or legacy filename.
     */
    public static function url(?string $path, ?string $defaultImage = null): string
    {
        if (empty($path)) {
            return $defaultImage ? asset('images/'.$defaultImage) : '';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'media-management/')) {
            return asset($path);
        }

        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        if (str_starts_with($path, 'settings/')
            || str_starts_with($path, 'services/')
            || str_starts_with($path, 'treatments/')
            || str_starts_with($path, 'experts/')
            || str_starts_with($path, 'users/')) {
            return asset('storage/'.$path);
        }

        return asset('images/'.ltrim($path, '/'));
    }

    /**
     * Normalize a pasted media URL or path for database storage.
     */
    public static function normalize(?string $value): ?string
    {
        if (! filled($value)) {
            return null;
        }

        $value = trim($value);

        if (! str_starts_with($value, 'http://') && ! str_starts_with($value, 'https://')) {
            return ltrim($value, '/');
        }

        $path = parse_url($value, PHP_URL_PATH);

        if (! is_string($path) || $path === '') {
            return $value;
        }

        $path = ltrim($path, '/');

        foreach (['media-management/', 'storage/'] as $segment) {
            $position = strpos($path, $segment);

            if ($position !== false) {
                $normalized = substr($path, $position);

                if ($segment === 'storage/') {
                    return substr($normalized, strlen('storage/'));
                }

                return $normalized;
            }
        }

        if (str_contains($path, 'images/')) {
            return basename($path);
        }

        return $value;
    }

    /**
     * Parse multiple pasted URLs from a textarea (one per line).
     *
     * @return list<string>
     */
    public static function parseUrlLines(?string $text): array
    {
        if (! filled($text)) {
            return [];
        }

        $paths = [];

        foreach (preg_split('/\R/', $text) as $line) {
            $normalized = self::normalize(trim($line));

            if ($normalized) {
                $paths[] = $normalized;
            }
        }

        return array_values(array_unique($paths));
    }

    /**
     * Delete a legacy public-disk file without removing media library files.
     */
    public static function deleteLegacyFile(?string $path): void
    {
        if (! $path || str_starts_with($path, 'media-management/') || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return;
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
