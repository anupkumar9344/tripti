<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'service_id',
        'image',
        'sort_order',
    ];

    /**
     * Get the service that owns the image.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the public URL for the gallery image.
     */
    public function imageUrl(): string
    {
        return asset('storage/'.$this->image);
    }
}
