<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewUser extends Notification
{
    use Queueable;

    protected $user;
    protected $message;
    protected $title;

    public function __construct($user, $message, $title)
    {
        $this->user = $user;
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
            'product_id' => $this->user->id,
            'message' => $this->message,
            'link' => route('admin.users.clients'),
            'title' => $this->title,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'category' => 'admin',
            'voucher_id' => $this->user->id,
            'message' => $this->message,
            'link' => route('admin.users.clients'),
            'title' => $this->title,
        ]);
    }
}
