<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BookingAddon extends Pivot
{
    protected $table = 'booking_addon';
    protected $fillable = [
        'booking_id',
        'addon_id',
        'quantity',
        'price_at_booking',
    ];

    public function booking(): BelongsTo{
        return $this->belongsTo(Booking::class);
    }

    public function addon(): BelongsTo{
        return $this->belongsTo(Addon::class);
    }
}
