<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    // all the users, who already sent friend request to THIS ($this is a current User)
    public function friendsTo(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->withPivot('accepted')
            ->withTimestamps();
    }
    public function pendingFriendsTo(): BelongsToMany
    {
        return $this->friendsTo()->wherePivot('accepted', false);
    }
    public function acceptedFriendsTo(): BelongsToMany
    {
        return $this->friendsTo()->wherePivot('accepted', true);
    }

    // all the users, whom THIS sent friend request ($this is a current User)
    public function friendsFrom(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')
            ->withPivot('accepted')
            ->withTimestamps();
    }
    public function pendingFriendsFrom(): BelongsToMany
    {
        return $this->friendsFrom()->wherePivot('accepted', false);
    }
    public function acceptedFriendsFrom(): BelongsToMany
    {
        return $this->friendsFrom()->wherePivot('accepted', true);
    }
}
