<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job_posting';  // Make sure the table name is correct

    
  
    protected $fillable = [
        'professional_id', 'title', 'description', 'salary', 'location', 
        'company', 'type', 'experience_level', 'remote', 'major', 
        'requirements', 'deadline', 'status'
    ];

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }
    public function skills() {
        return $this->belongsToMany(Skill::class, 'job_skill');
    }
    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id'); // Check if the foreign key is correctly specified
    }
}




