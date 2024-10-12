<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'id_contact',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_contact');
    }

    public function messages()
    {
        return $this->hasMany(Message::class,'transmitter_id');
    }
}

