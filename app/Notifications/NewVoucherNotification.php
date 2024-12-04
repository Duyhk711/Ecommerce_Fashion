<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewVoucherNotification extends Notification
{
    use Queueable;

    protected $voucher;
    protected $message;
    protected $title;

    public function __construct($voucher, $message, $title)
    {
        $this->voucher = $voucher;
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
            'voucher_id' => $this->voucher->id,
            'message' => $this->message,
            'link' => route('vouchers.index'), // Link tới trang voucher
            'title' => $this->title,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'voucher_id' => $this->voucher->id,
            'message' => $this->message,
            'link' => route('vouchers.index'),
            'title' => $this->title,
        ]);
    }
}
