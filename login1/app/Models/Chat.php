<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relationship to get receiver profile
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function receiverProfilee()
    {
        return $this->belongsTo(Professional::class, 'receiver_id', 'id')->select(['id', 'name']);
    }

    public function senderProfilee()
    {
        return $this->belongsTo(Professional::class, 'sender_id', 'id')->select(['id', 'name']);
    }
     
    public function receiverSellerProfile()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id')->select(['id', 'name']);
    }

    public function senderSellerProfile()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id')->select(['id', 'name']);
    }
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'seen',
    ];
    

}
