<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_translated',
    ];

    // Definir la relación con el modelo Message (si es necesario)
    public function messages()
    {
        return $this->hasMany(Message::class, 'translated_message_id');
    }

}
