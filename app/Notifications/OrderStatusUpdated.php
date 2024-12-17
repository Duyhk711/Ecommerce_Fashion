<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderStatusUpdated extends Notification
{

    use Queueable;

    protected $order;
    protected $message;
    protected $title;

    public function __construct($order, $message, $title)
    {
        $this->order = $order;
        $this->message = $message;
        $this->title = $title;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast']; // Lưu vào DB và realtime
    }

    public function toArray($notifiable)
    {
        return [
            'category' => 'client',
            'order_sku' => $this->order->sku,
            'message' => $this->message,
            'link' => route('orderDetail', ['id' => $this->order->id]), // Đường link tới order detail
            'title' => $this->title,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'category' => 'client',
            'order_sku' => $this->order->sku,
            'message' => $this->message,
            'link' => route('orderDetail', ['id' => $this->order->id]),
            'title' => $this->title,
        ]);
    }

}
