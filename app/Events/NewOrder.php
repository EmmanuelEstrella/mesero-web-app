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
use App\Order;

class NewOrder implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $table;
    public $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $table, Order $order)
    {
        $this->table = $table;
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('orders-'. $this->order->id);
    }

    public function broadcastWith() {
        return [
            'table' => $this->table,
            'order' => $this->order,
            'items' => $this->order->items,
            'sub_total' => $this->order->sub_total,
            'total' => $this->order->total,
        ];
    }
}
