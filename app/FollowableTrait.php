<?php

namespace App;



trait FollowableTrait
{

    // check if the current user follow user
    public function isFollowing(User $user) {
        return $this->followings->contains($user);
    }

    // toggle follow
    public function toggleFollow(User $user) {
        if($this->isFollowing($user)) {
            return $this->followings()->detach($user);
        } else {
            return $this->followings()->attach($user);
        }
    }


    // get the followings of the user
    public function followings() {
        return $this->belongsToMany(User::class, 'followings', 'user_id', 'following_id')->withTimestamps();
    }
}
