<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PremiumService extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'icon',
        'description',
        'price',
        'sort_order',
        'status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'status' => 'boolean',
        ];
    }
}
