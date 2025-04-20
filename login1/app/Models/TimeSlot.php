<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    public function mentor()
{
    return $this->belongsTo(User::class, 'mentor_id');
}
protected $fillable = [
    'mentor_id',
    'date',
    'start_time',
    'end_time',
];
}
