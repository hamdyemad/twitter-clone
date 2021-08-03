<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, FollowableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'online'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function timeline() {
        $ids = $this->followings->pluck('id')->push($this->id);
       return Tweet::whereIn('user_id',$ids)->latest()->get();
    }

    public function tweets() {
        return $this->hasMany(Tweet::class);
    }

    public function likes() {
        return $this->belongsToMany(Tweet::class, 'likes')->withTimestamps();
    }

    public function toggleLike(Tweet $tweet) {
        $this->toggleLikeSys($tweet, $this->isLiked($tweet), 1);
    }
    public function toggleDislike(Tweet $tweet) {
        $this->toggleLikeSys($tweet, $this->isDisLiked($tweet), 0);

    }
    public function toggleLikeSys(Tweet $tweet, $checked, $record) {
        if($this->likes->contains($tweet)) {
            if($checked) {
                return $this->likes()->detach($tweet);
            } else {
                return $this->likes()->updateExistingPivot($tweet, ['liked' => $record]);
            }
        } else {
            $this->likes()->attach($tweet);
            return $this->likes()->updateExistingPivot($tweet, ['liked' => $record]);
        }
    }

    // check if the user liked the tweet
    public function isLiked(Tweet $tweet) {
        return $this->likes()->where('liked', 1)->get()->contains($tweet);
    }
    // check if the user disliked the tweet
    public function isDisLiked(Tweet $tweet) {
        return $this->likes()->where('liked', 0)->get()->contains($tweet);
    }

    public function getUnreadedMessages() {
      return $this->messages->pluck('readed')->
      filter(function ($readed) {return $readed == 0;})->count();
    }

    public function messages() {
      return $this->hasMany(Chat::class);
    }

}
