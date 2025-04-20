<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

protected $fillable = [
    'user_id',
    'title',
    'company',
    'description',
    'start_date',
    'end_date',
    'is_current',
];


}
