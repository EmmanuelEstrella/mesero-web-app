<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use App\Robot;

class RobotCommand implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $robot;
    public $beacon_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( Robot $robot, $beacon_id)
    {
        $this->robot = $robot;
        $this->beacon_id = $beacon_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel-'.$robot->robot_id);
    }

    public function broadcastWith() {
        return [
            'beacon_id' => $this->beacon_id
            
        ];
    }
}