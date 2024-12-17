<?php

namespace App\Events;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewOrderNotifyAdmin implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    /**
     * Create a new event instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function broadcastWith()
    {
     $message = "Có đơn hàng mới";
     Log::info('Broadcasted Data', [
        'title' => "Đơn hàng mới",
        'message' => "Có đơn hàng mới",
        'link' => route('admin.orders.index'),
        'created_at' => now()->format('Y-m-d H:i:s'),
    ]);
        $data = [
        'notification' => [
            'title' => "Đơn hàng mới",
            'message' => $message,
            'link' => route('admin.orders.index'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
    ];
    // dd($data);
    // Log::info('Broadcast data:', $data);

    return $data;
    }

    public function broadcastOn()
    {
        return new Channel('create_order');
    }
}
