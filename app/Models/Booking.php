<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Booking extends Model
{
    protected $fillable = [
        'room_id',
        'starts_at',
        'ends_at',
    ];
    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'total_price' => 'decimal:2',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function room(): BelongsTo{
        return $this->belongsTo(Room::class);
    }

    public function addons(): BelongsToMany
    {
        return $this->belongsToMany(Addon::class,'booking_addon')
            ->withPivot(['quantity', 'price_at_booking'])
            ->using(BookingAddon::class)
            ->withTimestamps();
    }

}
