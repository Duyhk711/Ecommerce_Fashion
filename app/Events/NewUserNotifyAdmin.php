<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewUserNotifyAdmin implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;
    /**
     * Create a new event instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function broadcastWith()
    {
     $message = "Có khách hàng mới vừa đăng kí tài khoản ";

            $data = [
            'notification' => [
                'title' => "Có khách hàng mới vừa đăng kí tài khoản",
                'message' => $message,
                'link' => route('admin.users.clients'),
            ],
        ];
    }

    public function broadcastOn()
    {
        return new Channel('new_user');
    }
}
