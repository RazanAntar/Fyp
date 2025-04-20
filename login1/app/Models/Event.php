<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'professional_id',
        'title', // Make sure this is 'title', not 'name'
        'description',
        'date_time',
        
        'venue',
        'type',
        'category',
        'is_paid',
        'price',
        'max_participants',
        'status',
    ];
    
    protected $casts = [
        'date_time' => 'datetime',
    ];
    public function seats()
    {
        return $this->hasMany(EventSeat::class);
    }
    
    public function hasSeatFor($participant)
{
    return $this->seats()
        ->where('occupant_id', $participant->id)
        ->where('occupant_type', get_class($participant))
        ->exists();
}

    /**
     * Get the participants for the event.
     */
    public function userParticipants()
    {
        return $this->morphedByMany(User::class, 'participant', 'event_participants');
    }
    
    // For professional participants
    public function professionalParticipants()
    {
        return $this->morphedByMany(Professional::class, 'participant', 'event_participants');
    }
    
    // Optional: Combine both for convenience
    public function participants()
    {
        return $this->userParticipants->merge($this->professionalParticipants);
    }


public function feedbacks()
{
    return $this->hasMany(Feedback::class);
}
    

    /**
     * Get the feedback for the event.
     */
  

    /**
     * Get the questions for the event.
     */
    public function questions()
    {
        return $this->hasMany(EventQuestion::class);
    }
}
