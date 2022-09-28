<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Staudenmeir\LaravelMergedRelations\Eloquent\HasMergedRelationships;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasMergedRelationships;

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

    public function hasPendingFriendRequestFor($user)
    {
        return $this->pendingFriendsTo->contains($user);
//        return $this->pendingFriendsTo()->get()->contains($user);
    }



    public function friendsTo()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->withPivot('accepted')
            ->withTimestamps();
    }

    public function friendsFrom()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')
            ->withPivot('accepted')
            ->withTimestamps();
    }

    public function pendingFriendsTo()
    {
        return $this->friendsTo()->wherePivot('accepted', false);
    }

    public function pendingFriendsFrom()
    {
        return $this->friendsFrom()->wherePivot('accepted', false);
    }

    public function acceptedFriendsTo()
    {
        return $this->friendsTo()->wherePivot('accepted', true);
    }

    public function acceptedFriendsFrom()
    {
        return $this->friendsFrom()->wherePivot('accepted', true);
    }

    public function friends()
    {
        return $this->mergedRelationWithModel(User::class, 'friends_view');
    }


//    // all the users, who already sent friend request to THIS ($this is a current User)
//    public function friendsTo(): BelongsToMany
//    {
//        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
//            ->withPivot('accepted')
//            ->withTimestamps();
//    }
//    public function pendingFriendsTo(): BelongsToMany
//    {
//        return $this->friendsTo()->wherePivot('accepted', false);
//    }
//    public function acceptedFriendsTo(): BelongsToMany
//    {
//        return $this->friendsTo()->wherePivot('accepted', true);
//    }
//
//    // all the users, whom THIS sent friend request ($this is a current User)
//    public function friendsFrom(): BelongsToMany
//    {
//        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')
//            ->withPivot('accepted')
//            ->withTimestamps();
//    }
//    public function pendingFriendsFrom(): BelongsToMany
//    {
//        return $this->friendsFrom()->wherePivot('accepted', false);
//    }
//    public function acceptedFriendsFrom(): BelongsToMany
//    {
//        return $this->friendsFrom()->wherePivot('accepted', true);
//    }
}
