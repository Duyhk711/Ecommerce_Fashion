<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class CreateProduct extends Notification
{
    use Queueable;

    protected $product;
    protected $message;
    protected $title;

    public function __construct($product, $message, $title)
    {
        $this->product = $product;
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
            'product_id' => $this->product->id,
            'message' => $this->message,
            'link' => route('admin.products.index'),
            'title' => $this->title,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'category' => 'admin',
            'voucher_id' => $this->product->id,
            'message' => $this->message,
            'link' => route('admin.products.index'),
            'title' => $this->title,
        ]);
    }
}
