<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'room_type_id',
        'bed_type_id',
        'room_number',
        'floor',
        'sort_order',
        'status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    /**
     * Get the room type for this room.
     */
    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    /**
     * Get the bed type for this room.
     */
    public function bedType(): BelongsTo
    {
        return $this->belongsTo(BedType::class);
    }
}
