<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    public $messager_id;
    public $message;
    public $name;
    public $image;
    public $time;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message)
    {
      $this->user_id = $message['user_id'];
      $this->messager_id = $message['messager_id'];
      $this->message = $message['message'];
      $this->name = $message['name'];
      $this->image = $message['image'];
      $this->time = $message['time'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('send-message');
    }

    public function broadcastAs() {
      return 'message';
    }
}
