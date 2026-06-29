<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceBenefit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'service_id',
        'title',
        'sort_order',
    ];

    /**
     * Get the parent service.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
