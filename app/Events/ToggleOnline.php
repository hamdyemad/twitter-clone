<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ToggleOnline implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $online;
    public $id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
      $this->online = $data['online'];
      $this->id = $data['id'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('toggle-online');
    }

    public function broadcastAs() {
      return 'toggle-online';
    }
}
