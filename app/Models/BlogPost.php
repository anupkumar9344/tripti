<?php

namespace App\Models;

use App\Support\MediaPath;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'featured_image',
        'author',
        'excerpt',
        'content',
        'tags',
        'published_at',
        'display_on_home',
        'sort_order',
        'status',
        'seo_meta_title',
        'seo_meta_description',
        'seo_meta_keywords',
        'seo_og_title',
        'seo_og_description',
        'seo_og_image',
        'seo_robots',
    ];

    /**
     * Get the attribute casts.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'display_on_home' => 'boolean',
            'status' => 'boolean',
        ];
    }

    /**
     * Scope active posts ordered for public pages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActiveOrdered(Builder $query): Builder
    {
        return $query
            ->where('status', true)
            ->orderByDesc('published_at')
            ->orderBy('sort_order')
            ->orderBy('title');
    }

    /**
     * Scope posts shown on the home page section.
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
     * Get the public URL for the featured image.
     */
    public function featuredImageUrl(): string
    {
        return MediaPath::url($this->featured_image);
    }

    /**
     * Get tag labels as an array.
     *
     * @return list<string>
     */
    public function tagList(): array
    {
        if (! filled($this->tags)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $this->tags))));
    }

    /**
     * Format the published date for cards and headers.
     */
    public function formattedDate(): string
    {
        return $this->published_at?->format('M j, Y') ?? '';
    }

    /**
     * Resolve the SEO meta title.
     */
    public function seoMetaTitle(): string
    {
        return $this->seo_meta_title ?: $this->title;
    }

    /**
     * Resolve the SEO meta description.
     */
    public function seoMetaDescription(): string
    {
        return $this->seo_meta_description ?: (string) ($this->excerpt ?? '');
    }

    /**
     * Resolve the Open Graph title.
     */
    public function seoOgTitle(): string
    {
        return $this->seo_og_title ?: $this->seoMetaTitle();
    }

    /**
     * Resolve the Open Graph description.
     */
    public function seoOgDescription(): string
    {
        return $this->seo_og_description ?: $this->seoMetaDescription();
    }

    /**
     * Resolve the Open Graph image URL.
     */
    public function seoOgImageUrl(): string
    {
        if ($this->seo_og_image) {
            return MediaPath::url($this->seo_og_image);
        }

        return $this->featuredImageUrl();
    }

    /**
     * Resolve SEO keywords for meta tags.
     */
    public function seoKeywordsText(): string
    {
        if (filled($this->seo_meta_keywords)) {
            return $this->seo_meta_keywords;
        }

        return implode(', ', $this->tagList());
    }

    /**
     * Generate a unique slug from the given title.
     */
    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (static::query()
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $original.'-'.$count++;
        }

        return $slug;
    }
}
