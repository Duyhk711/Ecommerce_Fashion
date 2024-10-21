<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendAdminMessage implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $message;

    public function __construct(Chat $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new Channel('chat.' . $this->message->receiver_id);
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message->message,
            'receiver_id' => $this->message->receiver_id,
            'sender_id' => $this->message->sender_id,
            'user' => $this->message->sender, // Thông tin người gửi
            'created_at' => $this->message->created_at
        ];
    }

    public function broadcastAs()
    {
        return 'admin-message';
    }
}
