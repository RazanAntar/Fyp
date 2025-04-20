<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'student_id',
        'name',
        'email',
        'resume_path',
        'education',
        'experience',
        'requirements',
        'status',  // Assuming this is a string of concatenated requirements
    ];

    // Optionally, define relationships if applicable
    public function job()
    {
        return $this->belongsTo('App\Models\Job');  // Ensure you have a Job model and jobs table
    }
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
        // or Student::class if you have a separate student model
    }
}
