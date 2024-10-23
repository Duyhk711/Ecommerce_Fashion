<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Testing\Fluent\Concerns\Interaction;

class OrderUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels; 

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function broadcastWith()
    {
        return [
            'order' => [
                'id' => $this->order->id, 
                'status' => $this->order->status,
                'statusMapping' => [
                    '1' => 'Chờ xác nhận',
                    '2' => 'Chờ vận chuyển',
                    '3' => 'Đang vận chuyển',
                    '4' => 'Hoàn thành',
                    'huy_don_hang' => 'Đơn hàng đã hủy',
                ],
                'badgeColor' => [
                    '1' => 'bg-warning',
                    '2' => 'bg-info',
                    '3' => 'bg-primary',
                    '4' => 'bg-success',
                    'huy_don_hang' => 'bg-danger',
                ],
            ],
        ];
    }

    public function broadcastOn()
    {
        return new Channel('orders');
    }
}
