<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // Suponiendo que cada contacto pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

