<?php 

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Log;

class SessionEnded implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $sessionId;

    public function __construct($sessionId)
    {
        $this->sessionId = $sessionId;
        
    }

    public function broadcastOn()
    {
        Log::info('SessionEnded event details', [
            'sessionId' => $this->sessionId,
            'channel' => 'chat-session.' . $this->sessionId,
            'user' => request()->user()->id ?? 'unknown'
        ]);
        return new Channel('chat-session.' . $this->sessionId);
    }
    public function broadcastWith()
    {
        return [
            'sessionId' => $this->sessionId,
            'timestamp' => now()->toIso8601String(),
            'initiator' => request()->user()->id ?? 'unknown'
        ];
    }
    public function broadcastAs(): string
    {
        return 'session-ended';
    }
}
