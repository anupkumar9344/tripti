<?php

namespace App\Support;

/**
 * Normalizes admin page link values to full URLs.
 */
class PageLink
{
    /**
     * Convert a stored page link to a full public URL.
     */
    public static function normalize(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim($value);

        if ($value === '') {
            return null;
        }

        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        return url($value);
    }

    /**
     * Determine whether a stored value matches one of the site page URLs.
     */
    public static function matchesSitePage(?string $stored, string $pageUrl): bool
    {
        if ($stored === null || trim($stored) === '') {
            return false;
        }

        return self::normalize($stored) === self::normalize($pageUrl);
    }
}
