<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReadMessages implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $unreaded_messages;
    public $user_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->unreaded_messages = $data['unreaded_messages'];
        $this->user_id = $data['user_id'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('read-messages');
    }

    public function broadcastAs() {
      return 'read-messages';
    }
}
