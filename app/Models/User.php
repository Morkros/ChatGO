<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'language',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'phone' => 'string',
    ];
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'users_groups');
    }

    public function messagesTransmitted()
    {
        return $this->hasMany(Message::class, 'transmitter_id');
    }

    public function receivedMessages()
    {
        return $this->belongsToMany(Message::class, 'message_receiver', 'user_id', 'message_id');
    }
}
