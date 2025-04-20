<?php

namespace App\Models;
use App\Models\Job;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Professional extends Authenticatable
{
    use Notifiable;
    public function receivable()
    {
        return $this->morphOne(Notification::class, 'receivable');
    }

    protected $fillable = [
        'name', 'email', 'password', 'status', 'phone', 'company'
    ];
// app/Models/Professional.php
public function events()
{
    return $this->morphToMany(Event::class, 'participant', 'event_participants');
}

public function feedbacks()
{
    return $this->morphMany(Feedback::class, 'author');
}

public function jobs()
{
    return $this->hasMany(Job::class);
}

public function sentConnectionRequests()
{
    return $this->hasMany(Connection::class, 'user_id');
}

public function receivedConnectionRequests()
{
    return $this->hasMany(Connection::class, 'connected_user_id')
                ->where('connected_user_type', 'professional');
}

// app/Models/Professional.php

public function connections()
{
    return $this->hasMany(Connection::class, 'connected_user_id')
                ->where('connected_user_type', 'App\Models\Professional');
}

public function acceptedConnections()
{
    return $this->connections()->where('status', 'accepted');
}
    // Add other necessary model methods or properties here
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
        // Get all users this professional has messaged with
        $sentTo = User::whereIn('id', 
            $this->sentMessages()
                ->where('receiver_type', User::class)
                ->pluck('receiver_id')
        );
        
        $receivedFrom = User::whereIn('id',
            $this->receivedMessages()
                ->where('sender_type', User::class)
                ->pluck('sender_id')
        );
        
        return $sentTo->union($receivedFrom)->distinct();
    }
}

