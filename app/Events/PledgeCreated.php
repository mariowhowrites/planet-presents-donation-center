<?php

namespace App\Events;

use App\Models\Pledge;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PledgeCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Pledge $pledge;

    /**
     * Create a new event instance.
     */
    public function __construct(Pledge $pledge)
    {
        $this->pledge = $pledge;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
