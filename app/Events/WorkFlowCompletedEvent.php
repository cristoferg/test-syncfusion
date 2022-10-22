<?php

namespace App\Events;

use App\Interfaces\WorkFlowEvent;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WorkFlowCompletedEvent implements WorkFlowEvent
{
    use InteractsWithSockets, SerializesModels;

    public $step;
    public $workflow_uid;
    public $parameters;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($params = [])
    {
        $this->workflow_uid = $params['workflow_uid'];
        $this->step = $params['step'];
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
