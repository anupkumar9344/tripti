<?php

namespace App\Models;

use App\Support\MediaPath;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class VideoFeedback extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'video_feedbacks';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'video_url',
        'thumbnail',
        'display_on_home',
        'display_on_services',
        'sort_order',
        'status',
    ];

    /**
     * Get the attribute casts.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'display_on_home' => 'boolean',
            'display_on_services' => 'boolean',
            'status' => 'boolean',
        ];
    }

    /**
     * Scope active video feedbacks ordered for display.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActiveOrdered(Builder $query): Builder
    {
        return $query
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    /**
     * Scope video feedbacks shown on the home page.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForHome(Builder $query): Builder
    {
        return $query
            ->where('display_on_home', true)
            ->activeOrdered();
    }

    /**
     * Scope video feedbacks shown on the services page.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForServices(Builder $query): Builder
    {
        return $query
            ->where('display_on_services', true)
            ->activeOrdered();
    }

    /**
     * Resolve an embeddable video URL for inline players.
     */
    public function embedUrl(): string
    {
        $url = trim($this->video_url);

        if ($url === '') {
            return '';
        }

        if ($this->isDirectVideo()) {
            return $this->playableUrl();
        }

        if ($videoId = self::extractYoutubeId($url)) {
            return 'https://www.youtube.com/embed/'.$videoId;
        }

        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $url, $matches)) {
            return 'https://player.vimeo.com/video/'.$matches[1];
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }

        return $this->playableUrl();
    }

    /**
     * Resolve an embed URL with autoplay for inline playback.
     */
    public function inlineEmbedUrl(): string
    {
        $url = $this->embedUrl();

        if ($url === '') {
            return '';
        }

        if (str_contains($url, 'youtube.com/embed')) {
            $separator = str_contains($url, '?') ? '&' : '?';

            return $url.$separator.'autoplay=1&rel=0&modestbranding=1&playsinline=1';
        }

        if (str_contains($url, 'player.vimeo.com')) {
            $separator = str_contains($url, '?') ? '&' : '?';

            return $url.$separator.'autoplay=1';
        }

        return $url;
    }

    /**
     * Determine whether the video URL is a direct media file.
     */
    public function isDirectVideo(): bool
    {
        $url = strtolower(trim($this->video_url));

        if (preg_match('/\.(mp4|webm|ogg|mov)(\?.*)?$/i', $url)) {
            return true;
        }

        return str_contains($url, 'media-management/video/');
    }

    /**
     * Resolve the public URL used for playback and poster loading.
     */
    public function playableUrl(): string
    {
        return MediaPath::url(trim($this->video_url));
    }

    /**
     * Determine whether the card should use the video file as its poster source.
     */
    public function usesInlineVideoPoster(): bool
    {
        return $this->isDirectVideo();
    }

    /**
     * Resolve a thumbnail image for the reel card.
     */
    public function thumbnailUrl(): string
    {
        if (filled($this->thumbnail)) {
            return MediaPath::url($this->thumbnail, 'assets/img/rooms/1.jpg');
        }

        if ($this->isDirectVideo()) {
            return '';
        }

        if ($videoId = self::extractYoutubeId($this->video_url)) {
            return 'https://img.youtube.com/vi/'.$videoId.'/hqdefault.jpg';
        }

        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', trim($this->video_url), $matches)) {
            return $this->vimeoThumbnailUrl($matches[1]);
        }

        return asset('assets/img/rooms/1.jpg');
    }

    /**
     * Display title for the short.
     */
    public function displayTitle(): string
    {
        return filled($this->title) ? $this->title : 'Hotel Short';
    }

    /**
     * Social-style handle shown on the reel card.
     */
    public function guestHandle(): string
    {
        $base = filled($this->title)
            ? strtolower((string) preg_replace('/[^a-zA-Z0-9]+/', '.', $this->title))
            : 'guest'.$this->id;

        return '@'.trim($base, '.');
    }

    /**
     * Fetch and cache a Vimeo thumbnail URL.
     */
    private function vimeoThumbnailUrl(string $vimeoId): string
    {
        return Cache::remember('video-feedback-vimeo-thumb-'.$vimeoId, 86400, function () use ($vimeoId): string {
            try {
                $response = Http::timeout(5)->get('https://vimeo.com/api/oembed.json', [
                    'url' => 'https://vimeo.com/'.$vimeoId,
                ]);

                if ($response->successful()) {
                    return (string) ($response->json('thumbnail_url') ?? '');
                }
            } catch (\Throwable) {
                return '';
            }

            return '';
        });
    }

    /**
     * Extract a YouTube video ID from common URL formats.
     */
    public static function extractYoutubeId(string $url): ?string
    {
        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{6,})/', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
