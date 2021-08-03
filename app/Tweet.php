<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->belongsToMany(User::class, 'likes','tweet_id');
    }

    public function countLiked($boolean) {
        return $this->likes()->where('liked', $boolean)->get()->count();
    }

    public function tweetViewersCount() {
        return $this->tweetViewers->count();
    }
    public function tweetViewers() {
        return $this->belongsToMany(User::class, 'tweet_view');
    }

    public function isViewed(User $user) {
        return $this->tweetViewers->contains($user);
    }
}
