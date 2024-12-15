<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class CreateNewOrder extends Notification
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
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'category' => 'admin',
            'order_id' => $this->order->id,
            'message' => $this->message,
            'link' => route('admin.orders.index'),
            'title' => $this->title,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'category' => 'admin',
            'voucher_id' => $this->order->id,
            'message' => $this->message,
            'link' => route('admin.orders.index'),
            'title' => $this->title,
        ]);
    }
}
