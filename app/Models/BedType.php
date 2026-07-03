<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BedType extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'sort_order',
    ];

    /**
     * Get rooms using this bed type.
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}
