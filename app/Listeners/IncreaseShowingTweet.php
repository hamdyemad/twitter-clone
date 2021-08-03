<?php

namespace App\Listeners;

use App\Events\ShowTweet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseShowingTweet
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ShowTweet $showTweet)
    {
        //
        $tweet = $showTweet->tweet;
        if(!$tweet->isViewed(auth()->user())) {
            $tweet->tweetViewers()->attach(auth()->user());
        }
    }
}
