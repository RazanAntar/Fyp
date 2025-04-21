<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    //protected $fillable = ['name', 'email', 'password', 'status', 'isGrad'];
    //updated 

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
    ];

    /**
     * The attributes that should have default values.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'status' => 'inactive',  // default status is inactive
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'string', // Removed 'email_verified_at'
        ];
    }
    public function events()
    {
        return $this->morphToMany(Event::class, 'participant', 'event_participants');
    }
    
    public function feedbacks()
    {
        return $this->morphMany(Feedback::class, 'author');
    }
    
    public function connections()
    {
        return $this->hasMany(Connection::class);
    }

    public function sentConnectionRequests()
    {
        return $this->hasMany(Connection::class, 'user_id');
    }

    public function receivedConnectionRequests()
    {
        return $this->hasMany(Connection::class, 'connected_user_id')
                    ->where('connected_user_type', 'user');
    }

    public function acceptedConnections()
    {
        return $this->connections()->where('status', 'accepted');
    }
    public function sentMessages()
{
    return $this->morphMany(Message::class, 'sender');
}

public function receivedMessages()
{
    return $this->morphMany(Message::class, 'receiver');
}

public function chatContacts()
{
    // Get all professionals this user has messaged with or received messages from
    $sentTo = Professional::whereIn('id', 
        $this->sentMessages()
            ->where('receiver_type', Professional::class)
            ->pluck('receiver_id')
    );
    
    $receivedFrom = Professional::whereIn('id',
        $this->receivedMessages()
            ->where('sender_type', Professional::class)
            ->pluck('sender_id')
    );
    
    return $sentTo->union($receivedFrom)->distinct();
}
public function experiences()
{
    return $this->hasMany(Experience::class);
}
public function mentorMeetings()
{
    return $this->hasMany(Meeting::class, 'mentor_id')->with('student');
}
// In User.php
public function getNameAttribute()
{
    return "{$this->first_name} {$this->last_name}"; // or whatever naming fields you use
}


public function studentMeetings()
{
    return $this->hasMany(Meeting::class, 'student_id');
}
public function timeSlots()
{
    return $this->hasMany(TimeSlot::class, 'mentor_id');
}
public function applications()
{
    return $this->hasMany(JobApplication::class, 'student_id');
}

}