<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $chatSessionId;

    public function __construct(Message $message)
    {
        $this->message = $message->load('session');
        $this->chatSessionId = $message->chat_session_id;
    }

    public function broadcastOn(): array
    {
        $channels = [
            new Channel('chat-session.' . $this->chatSessionId),
        ];
    
        // Phát tới kênh riêng của admin trong session này
        if ($this->message->session && $this->message->session->admin_id) {
            $channels[] = new Channel('admin-' . $this->message->session->admin_id);
        }
    
        return $channels;
    }

    public function broadcastAs(): string
    {
        return 'new-message';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->message->id,
            'chat_session_id' => $this->message->chat_session_id,
            'sender_id' => $this->message->sender_id,
            'sender_name' => $this->message->sender->name,
            'message' => $this->message->message,
            'created_at' => $this->message->created_at,
        ];
    }
}