<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MediaFile extends Model
{
    public const CATEGORY_IMAGE = 'image';

    public const CATEGORY_PDF = 'pdf';

    public const CATEGORY_DOCUMENT = 'document';

    public const CATEGORY_VIDEO = 'video';

    public const CATEGORY_OTHER = 'other';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'display_name',
        'original_name',
        'file_path',
        'mime_type',
        'extension',
        'file_size',
        'file_category',
        'usage_summary',
    ];

    /**
     * Map file extensions to media categories.
     *
     * @var array<string, string>
     */
    private const EXTENSION_CATEGORIES = [
        'jpg' => self::CATEGORY_IMAGE,
        'jpeg' => self::CATEGORY_IMAGE,
        'png' => self::CATEGORY_IMAGE,
        'webp' => self::CATEGORY_IMAGE,
        'svg' => self::CATEGORY_IMAGE,
        'pdf' => self::CATEGORY_PDF,
        'doc' => self::CATEGORY_DOCUMENT,
        'docx' => self::CATEGORY_DOCUMENT,
        'xls' => self::CATEGORY_DOCUMENT,
        'xlsx' => self::CATEGORY_DOCUMENT,
        'mp4' => self::CATEGORY_VIDEO,
        'zip' => self::CATEGORY_OTHER,
    ];

    /**
     * Resolve a category label for the admin UI.
     */
    public function categoryLabel(): string
    {
        return match ($this->file_category) {
            self::CATEGORY_IMAGE => 'Image',
            self::CATEGORY_PDF => 'PDF',
            self::CATEGORY_DOCUMENT => 'Document',
            self::CATEGORY_VIDEO => 'Video',
            default => 'Other',
        };
    }

    /**
     * Resolve usage text for the admin UI.
     */
    public function usageLabel(): string
    {
        return filled($this->usage_summary) ? $this->usage_summary : 'Not Tracked';
    }

    /**
     * Get the public URL for this file.
     */
    public function url(): string
    {
        return asset($this->file_path);
    }

    /**
     * Get the absolute filesystem path.
     */
    public function absolutePath(): string
    {
        return public_path($this->file_path);
    }

    /**
     * Determine whether the file is an image.
     */
    public function isImage(): bool
    {
        return $this->file_category === self::CATEGORY_IMAGE;
    }

    /**
     * Determine whether the file can be previewed inline in the browser.
     */
    public function isPreviewable(): bool
    {
        return in_array($this->file_category, [self::CATEGORY_IMAGE, self::CATEGORY_PDF, self::CATEGORY_VIDEO], true);
    }

    /**
     * Format file size for display.
     */
    public function formattedSize(): string
    {
        $bytes = (int) $this->file_size;

        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2).' MB';
        }

        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2).' KB';
        }

        return $bytes.' B';
    }

    /**
     * Resolve category from extension.
     */
    public static function categoryFromExtension(string $extension): string
    {
        $extension = strtolower($extension);

        return self::EXTENSION_CATEGORIES[$extension] ?? self::CATEGORY_OTHER;
    }

    /**
     * Allowed upload extensions.
     *
     * @return list<string>
     */
    public static function allowedExtensions(): array
    {
        return array_keys(self::EXTENSION_CATEGORIES);
    }

    /**
     * Build a display name from the original filename.
     */
    public static function displayNameFromOriginal(string $originalName): string
    {
        $name = pathinfo($originalName, PATHINFO_FILENAME);

        return Str::title(str_replace(['-', '_'], ' ', $name));
    }

    /**
     * Apply browse filters to a media query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     */
    public function scopeBrowse(Builder $query, ?string $search, ?string $category, string $sort): Builder
    {
        if ($search) {
            $query->where(function (Builder $builder) use ($search) {
                $builder->where('display_name', 'like', "%{$search}%")
                    ->orWhere('original_name', 'like', "%{$search}%");
            });
        }

        if ($category && $category !== 'all') {
            $query->where('file_category', $category);
        }

        return match ($sort) {
            'oldest' => $query->orderBy('created_at')->orderBy('display_name'),
            'name_asc' => $query->orderBy('display_name')->orderByDesc('created_at'),
            'name_desc' => $query->orderByDesc('display_name')->orderByDesc('created_at'),
            'size' => $query->orderByDesc('file_size')->orderByDesc('created_at'),
            default => $query->orderByDesc('created_at')->orderByDesc('id'),
        };
    }

    /**
     * Delete the physical file from disk.
     */
    public function deletePhysicalFile(): void
    {
        $path = $this->absolutePath();

        if (File::exists($path)) {
            File::delete($path);
        }
    }

    /**
     * Serialize media for API / picker responses.
     *
     * @return array<string, mixed>
     */
    public function toLibraryArray(): array
    {
        return [
            'id' => $this->id,
            'display_name' => $this->display_name,
            'original_name' => $this->original_name,
            'url' => $this->url(),
            'file_path' => $this->file_path,
            'mime_type' => $this->mime_type,
            'extension' => $this->extension,
            'file_size' => $this->file_size,
            'formatted_size' => $this->formattedSize(),
            'file_category' => $this->file_category,
            'category_label' => $this->categoryLabel(),
            'usage_label' => $this->usageLabel(),
            'is_image' => $this->isImage(),
            'is_video' => $this->file_category === self::CATEGORY_VIDEO,
            'is_previewable' => $this->isPreviewable(),
            'created_at' => $this->created_at?->format('d M Y, h:i A'),
        ];
    }
}
