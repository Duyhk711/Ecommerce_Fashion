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
    public $initiatorId;

    public function __construct($sessionId, $initiatorId = null)
    {
        $this->sessionId = $sessionId;
        $this->initiatorId = $initiatorId ?? (request()->user()->id ?? null);
    }

    public function broadcastOn()
    {
        Log::info('SessionEnded event details', [
            'sessionId' => $this->sessionId,
            'channel' => 'chat-session.' . $this->sessionId,
            'initiator' => $this->initiatorId
        ]);
        return new Channel('chat-session.' . $this->sessionId);
    }

    public function broadcastWith()
    {
        return [
            'sessionId' => $this->sessionId,
            'timestamp' => now()->toIso8601String(),
            'initiatorId' => $this->initiatorId
        ];
    }

    public function broadcastAs(): string 
    {
        return 'session-ended';
    }
}