<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Interfaces\WorkFlowEvent;

class UrlReachedEvent extends BaseWorkFlowEvent implements WorkFlowEvent
{
    use InteractsWithSockets, SerializesModels;

    public $parameters = [];

    public $step = 0;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($params = [])
    {
        $this->parameters = $params;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
