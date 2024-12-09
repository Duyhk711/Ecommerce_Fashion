<?php

namespace App\Events;

use App\Models\ChatSession;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewChatSessionAssigned implements ShouldBroadcast
{
    public $session;
    private $adminId;

    public function __construct(ChatSession $session, $adminId)
    {
        $this->session = $session;
        $this->adminId = $adminId;
    }

    public function broadcastOn()
    {
        return new Channel('admin-' . $this->adminId);
    }

    public function broadcastAs()
    {
        return 'new-session-assigned';
    }
}
