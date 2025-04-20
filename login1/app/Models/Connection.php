<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    // app/Models/Connection.php
protected $fillable = [
    'user_id',
    'connected_user_id',
    'connected_user_type',
    'status'
];

public function user()
{
    return $this->belongsTo(User::class);
}

// app/Models/Connection.php

public function connectedUser()
{
    return $this->morphTo('connected_user', 'connected_user_type', 'connected_user_id');
}
}
