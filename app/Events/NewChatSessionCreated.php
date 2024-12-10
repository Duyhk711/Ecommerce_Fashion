<?php

namespace App\Events;

use App\Models\ChatSession;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class NewChatSessionCreated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $session;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ChatSession $session)
    {
        $this->session = $session;
    }

    public function broadcastOn()
    {
        return new Channel('admin-sessions');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->session->id,
            'user_id' => $this->session->user_id,
        ];
    }
}
