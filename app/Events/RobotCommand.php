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
    public $beaconId;
    public $orderId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( Robot $robot, $beaconId, $orderId)
    {
        $this->robot = $robot;
        $this->beaconId = $beaconId;
        $this->orderId = $orderId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel-'.$this->robot->robot_id);
    }

    public function broadcastWith() {
        return [
            'beacon_id' => $this->beaconId,
            'order_id' => $this->orderId,
            
        ];
    }
}