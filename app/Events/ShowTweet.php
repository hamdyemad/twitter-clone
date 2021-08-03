<?php

namespace App\Events;

use App\Tweet;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShowTweet implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $counter;
    public $tweet;

    public function __construct($tweet,$counter)
    {   
        $this->tweet = $tweet;
        $this->counter = $counter;
    }
  
    public function broadcastOn()
    {
        return new Channel('my-channel');
    }
}
