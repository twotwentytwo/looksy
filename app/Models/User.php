<?php

namespace Looksy\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    
    protected $table = 'users';

    protected $fillable = [
        'email', 
        'username', 
        'password',
        'first_name', 
        'last_name', 
        'location', 
        'recover_hash'
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    public function getName() 
    {
        if($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }

        if($this->first_name) {
            return $this->first_name;
        }

        return null;

    }

    public function getNameOrUsername() 
    {
        return $this->getName() ?: $this->username;
    }

    public function getFirstNameOrUsername() 
    {
        return $this->first_name ?: $this->username;
    }

     public function getAvatarUrl($size) 
    {
        if($this->location) {
            return 'https://ucarecdn.com/' . $this->location . '/-/scale_crop/400x400/center/-/quality/best/-/progressive/yes/-/resize/' . $size . '/';
        }
        
        return 'https://www.gravatar.com/avatar/' . md5(strtolower($this->email)) . '?s=' . $size . '&d=mm';
    }

    public function statuses()
    {
        return $this->hasMany('Looksy\Models\Status', 'user_id')->orderBy('created_at');
    }


    public function friendsOfMine() 
    {
        return $this->belongsToMany('Looksy\Models\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf() 
    {
        return $this->belongsToMany('Looksy\Models\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends() 
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->where('accepted', true)->get());
    }

    public function friendRequests() 
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get(); 
    }

    public function friendRequestsPending() 
    {
        return $this->friendOf()->wherePivot('accepted', false)->get(); 
    }

    public function hasFriendRequestPending(User $user) 
    {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user) 
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user) 
    {   
        $this->friendOf()->attach($user->id);
    }

    public function removeFriend(User $user) 
    {   
        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' =>true
        ]);
    }

    public function isFriendsWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }
}
