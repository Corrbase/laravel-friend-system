<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // friends
    public function friendsTo()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')->withPivot('accepted');
    }
    public function friendsFrom()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')->withPivot('accepted');
    }

    // pending
    public function pendingFriendsTo()
    {
        return $this->friendsFrom()->wherePivot('accepted', false);
    }
    public function pendingFriendsFrom()
    {
        return $this->friendsFrom()->wherePivot('accepted', false);
    }


    // accepted
    public function acceptedFriendsTo()
    {
        return $this->friendsFrom()->wherePivot('accepted', true);
    }
    public function acceptedFriendsFrom()
    {
        return $this->friendsFrom()->wherePivot('accepted', true);
    }
}
