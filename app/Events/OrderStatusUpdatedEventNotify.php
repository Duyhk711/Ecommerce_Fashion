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

class OrderStatusUpdatedEventNotify
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function broadcastOn()
    {
        // Tạo channel riêng cho user
        return new PrivateChannel('user.' . $this->order->user_id);
    }

    public function broadcastWith()
    {
        $statusMessages = [
            1 => "Đơn hàng đã đặt thành công, đang chờ xác nhận từ cửa hàng",
            2 => "Đơn hàng đã được xác nhận và đang chờ giao cho đơn vị vận chuyển",
            3 => "Đơn hàng đang trên đường giao tới bạn",
            4 => "Đơn hàng đã giao thành công, vui lòng xác nhận đã nhận được hàng để đánh giá đơn hàng",
            'huy_don_hang' => "Đơn hàng đã bị hủy",
        ];
        $status = $this->order->status;
        $orderSku = $this->order->sku;
        $statusMessage = $statusMessages[$status] ?? "trạng thái không xác định";
        $message = "Đơn hàng <strong>{$orderSku}</strong> {$statusMessage}.";

        return [
            'notification' => [
                'title' => "Cập nhật đơn hàng",
                'message' => $message, // Thông báo đầy đủ
                'link' => route('orderDetail', $this->order->id), // Link đến chi tiết đơn hàng
            ],
        ];
    }
}
