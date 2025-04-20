<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = ['student_id', 'mentor_id', 'meeting_date', 'meeting_time', 'status'];

    public function mentor()
{
    return $this->belongsTo(User::class, 'mentor_id');
}

public function student()
{
    return $this->belongsTo(User::class, 'student_id');
}

}
