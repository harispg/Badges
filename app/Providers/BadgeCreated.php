<?php

namespace App\Providers;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BadgeCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $users;
    public $badge;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($users, $badge)
    {
        $this->users = $users;
        $this->badge = $badge;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    /*public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }*/
}
