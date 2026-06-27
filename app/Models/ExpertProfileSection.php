<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpertProfileSection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'expert_id',
        'expert_profile_category_id',
        'content',
    ];

    /**
     * Get the expert that owns the section.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expert(): BelongsTo
    {
        return $this->belongsTo(Expert::class);
    }

    /**
     * Get the category for this section.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ExpertProfileCategory::class, 'expert_profile_category_id');
    }
}
