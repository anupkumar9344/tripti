<?php

namespace App\Support;

/**
 * Shared site page links for admin page pickers.
 */
class SitePages
{
    /**
     * Get the public site pages available in admin link pickers.
     *
     * @return array<int, array{label: string, path: string}>
     */
    public static function options(): array
    {
        return [
            ['label' => 'Home', 'path' => '/'],
            ['label' => 'About Us', 'path' => '/about-us'],
            ['label' => 'Treatment', 'path' => '/treatment'],
            ['label' => 'Services', 'path' => '/services'],
            ['label' => 'Our Expert Team', 'path' => '/our-expert-team'],
            ['label' => 'Health Programs', 'path' => '/health-programs'],
            ['label' => 'Gallery', 'path' => '/gallery'],
            ['label' => 'Blog', 'path' => '/blog'],
            ['label' => 'FAQs', 'path' => '/faq'],
            ['label' => 'Contact Us', 'path' => '/contact-us'],
        ];
    }

    /**
     * Get site pages with full URLs for admin selects.
     *
     * @return array<int, array{label: string, url: string}>
     */
    public static function all(): array
    {
        return array_map(static function (array $page): array {
            return [
                'label' => $page['label'],
                'url' => url($page['path']),
            ];
        }, self::options());
    }
}
