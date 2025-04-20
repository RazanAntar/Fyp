<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSeat extends Model
{
    protected $fillable = ['event_id', 'seat_number', 'occupant_id', 'occupant_type'];

    public function occupant()
    {
        return $this->morphTo();
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
