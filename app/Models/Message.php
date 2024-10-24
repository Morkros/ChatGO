<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'transmitter_id',
        'receiver_id',
        'body',
        'translated_message_id',
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function translation()
    {
        return $this->belongsTo(Translation::class, 'translated_message_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
