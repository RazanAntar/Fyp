<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'author_id',
        'author_type',
        'comment',
    ];
    

    protected $table = 'feedbacks'; 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function author()
{
    return $this->morphTo();
}

public function event()
{
    return $this->belongsTo(Event::class);
}


  
    
}

