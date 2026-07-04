<?php

namespace App\Support;

class IconMap
{
    /**
     * Map Font Awesome icon names to Remix Icon classes.
     *
     * @var array<string, string>
     */
    private const FA_TO_REMIX = [
        'fa-location-dot' => 'ri-map-pin-line',
        'fa-bed' => 'ri-hotel-bed-line',
        'fa-headset' => 'ri-customer-service-2-line',
        'fa-award' => 'ri-award-line',
        'fa-champagne-glasses' => 'ri-goblet-line',
        'fa-snowflake' => 'ri-snowy-line',
        'fa-temperature-low' => 'ri-temp-cold-line',
        'fa-person-swimming' => 'ri-swimming-pool-line',
        'fa-tv' => 'ri-tv-line',
        'fa-wifi' => 'ri-wifi-line',
        'fa-shirt' => 'ri-shirt-line',
        'fa-car' => 'ri-car-line',
        'fa-clock' => 'ri-time-line',
        'fa-gift' => 'ri-gift-line',
        'fa-mug-saucer' => 'ri-cup-line',
        'fa-utensils' => 'ri-restaurant-line',
        'fa-spa' => 'ri-heart-pulse-line',
        'fa-dumbbell' => 'ri-run-line',
        'fa-water-ladder' => 'ri-swimming-pool-line',
        'fa-square-parking' => 'ri-parking-box-line',
        'fa-mug-hot' => 'ri-cup-line',
        'fa-gamepad' => 'ri-gamepad-line',
        'fa-martini-glass' => 'ri-goblet-line',
    ];

    /**
     * Resolve a Remix Icon class from a stored icon value.
     */
    public static function remix(?string $icon): string
    {
        if (! filled($icon)) {
            return 'ri-check-line';
        }

        $icon = trim($icon);

        if (str_starts_with($icon, 'ri-')) {
            return $icon;
        }

        $icon = str_replace(['fa-solid', 'fa-regular', 'fa-brands'], '', $icon);
        $icon = trim(str_replace('  ', ' ', $icon));

        if (! str_starts_with($icon, 'fa-')) {
            $icon = 'fa-'.$icon;
        }

        return self::FA_TO_REMIX[$icon] ?? 'ri-check-line';
    }
}
