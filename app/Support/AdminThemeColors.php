<?php

namespace App\Support;

/**
 * Resolve admin panel theme colors from settings with safe fallbacks.
 */
class AdminThemeColors
{
    public const DEFAULT_PRIMARY = '#7356a5';

    /**
     * Build the theme palette used by the admin panel.
     *
     * @return array<string, string>
     */
    public static function resolve(?string $primary = null): array
    {
        $primary = ThemeColors::normalizeHex($primary) ?: self::DEFAULT_PRIMARY;
        $secondary = ThemeColors::adjustBrightness($primary, 0.12);

        return [
            'primary' => $primary,
            'secondary' => $secondary,
            'primary_dark' => ThemeColors::adjustBrightness($primary, -0.12),
            'secondary_dark' => ThemeColors::adjustBrightness($secondary, -0.12),
            'primary_rgb' => ThemeColors::hexToRgbString($primary),
            'secondary_rgb' => ThemeColors::hexToRgbString($secondary),
        ];
    }

    /**
     * Resolve admin theme colors from stored settings.
     *
     * @param  array<string, mixed>  $settings
     * @return array<string, string>
     */
    public static function fromSettings(array $settings): array
    {
        return self::resolve($settings['admin_theme_primary_color'] ?? null);
    }
}
