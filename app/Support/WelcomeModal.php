<?php

namespace App\Support;

use App\Models\Setting;

/**
 * Builds the public website welcome modal configuration from stored settings.
 */
class WelcomeModal
{
    /**
     * Setting keys for the website welcome modal.
     *
     * @var list<string>
     */
    public const SETTING_KEYS = [
        'welcome_modal_enabled',
        'welcome_modal_title',
        'welcome_modal_message',
        'welcome_modal_media_type',
        'welcome_modal_image',
        'welcome_modal_video_url',
        'welcome_modal_button_text',
        'welcome_modal_button_url',
        'welcome_modal_revision',
    ];

    /**
     * Get welcome modal payload for the public layout.
     *
     * @return array<string, mixed>
     */
    public static function config(): array
    {
        $settings = Setting::getMany(self::SETTING_KEYS);
        $mediaType = $settings['welcome_modal_media_type'] ?? 'image';

        if (! in_array($mediaType, ['none', 'image', 'video'], true)) {
            $mediaType = 'image';
        }

        $title = trim((string) ($settings['welcome_modal_title'] ?? ''));
        $message = trim((string) ($settings['welcome_modal_message'] ?? ''));

        return [
            'enabled' => filter_var($settings['welcome_modal_enabled'] ?? false, FILTER_VALIDATE_BOOLEAN),
            'revision' => (string) ($settings['welcome_modal_revision'] ?? '1'),
            'title' => $title,
            'message' => $message,
            'mediaType' => $mediaType,
            'imageUrl' => MediaPath::url(
                $settings['welcome_modal_image'] ?? null,
                'gallery-4.jpg'
            ),
            'videoEmbedUrl' => self::embedUrl((string) ($settings['welcome_modal_video_url'] ?? '')),
            'buttonText' => trim((string) ($settings['welcome_modal_button_text'] ?? '')),
            'buttonUrl' => trim((string) ($settings['welcome_modal_button_url'] ?? '')),
            'hasContent' => $title !== '' || $message !== '' || $mediaType !== 'none',
        ];
    }

    /**
     * Resolve an embeddable video URL for the modal player.
     */
    public static function embedUrl(string $url): string
    {
        $url = trim($url);

        if ($url === '') {
            return '';
        }

        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{6,})/', $url, $matches)) {
            return 'https://www.youtube.com/embed/'.$matches[1];
        }

        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $url, $matches)) {
            return 'https://player.vimeo.com/video/'.$matches[1];
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }

        return MediaPath::url($url);
    }
}
