<?php

namespace App\Events\Sell\Order;

use App\Model\Sell\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PaymentSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Order model instance for which the payment was just sent out
     * @var Order
     */
    public $order;

    /**
     * Transaction informations returned from the Shippo API
     * @var array
     */
    public $label;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order, array $labelData)
    {
        $this->order = $order;
        $this->label = $labelData;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
