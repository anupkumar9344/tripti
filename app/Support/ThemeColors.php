<?php

namespace App\Support;

/**
 * Resolve frontend theme colors from settings with safe fallbacks.
 */
class ThemeColors
{
    public const DEFAULT_PRIMARY = '#9d7e54';

    /**
     * Build the theme palette used by the public website.
     *
     * @return array<string, string>
     */
    public static function resolve(?string $primary = null): array
    {
        $primary = self::normalizeHex($primary) ?: self::DEFAULT_PRIMARY;
        $secondary = self::adjustBrightness($primary, 0.15);

        return [
            'primary' => $primary,
            'secondary' => $secondary,
            'primary_dark' => self::adjustBrightness($primary, -0.12),
            'primary_light' => self::adjustBrightness($primary, 0.1),
            'primary_rgb' => self::hexToRgbString($primary),
            'secondary_rgb' => self::hexToRgbString($secondary),
        ];
    }

    /**
     * Resolve theme colors from stored settings.
     *
     * @param  array<string, mixed>  $settings
     * @return array<string, string>
     */
    public static function fromSettings(array $settings): array
    {
        return self::resolve($settings['theme_primary_color'] ?? null);
    }

    /**
     * Normalize a user-provided color to a 6-digit hex value.
     */
    public static function normalizeHex(?string $color): ?string
    {
        if (! filled($color)) {
            return null;
        }

        $color = trim($color);

        if (preg_match('/^#([0-9a-fA-F]{3})$/', $color, $matches)) {
            $hex = $matches[1];

            return '#'.strtolower($hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2]);
        }

        if (preg_match('/^#([0-9a-fA-F]{6})$/', $color, $matches)) {
            return '#'.strtolower($matches[1]);
        }

        return null;
    }

    /**
     * Convert a hex color to an RGB string for CSS rgba() usage.
     */
    public static function hexToRgbString(string $hex): string
    {
        $hex = ltrim(self::normalizeHex($hex) ?? self::DEFAULT_PRIMARY, '#');

        return implode(', ', [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2)),
        ]);
    }

    /**
     * Lighten or darken a hex color by a percentage between -1 and 1.
     */
    public static function adjustBrightness(string $hex, float $percent): string
    {
        $hex = ltrim(self::normalizeHex($hex) ?? self::DEFAULT_PRIMARY, '#');
        $channels = [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2)),
        ];

        $adjusted = array_map(function (int $channel) use ($percent): int {
            if ($percent >= 0) {
                return (int) round($channel + ((255 - $channel) * $percent));
            }

            return (int) round($channel * (1 + $percent));
        }, $channels);

        return sprintf('#%02x%02x%02x', $adjusted[0], $adjusted[1], $adjusted[2]);
    }
}
