<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobActivity extends Model
{
    protected $fillable = ['job_id', 'professional_id'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }
}
