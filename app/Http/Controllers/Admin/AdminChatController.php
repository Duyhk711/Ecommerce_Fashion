<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewMessageSent;
use App\Events\SessionEnded;
use App\Http\Controllers\Controller;
use App\Models\ChatSession;
use Illuminate\Http\Request;

class AdminChatController extends Controller
{
    public function listSessions()
{
    $sessions = ChatSession::where('admin_id', auth()->id())
        ->where('status', 'active')
        ->with(['user'])
        ->withCount([
            'messages as unread_count' => function ($query) {
                $query->where('is_read', false); 
            }
        ])
        ->orderByDesc(function ($query) {
            $query->select('created_at')
                ->from('messages')
                ->whereColumn('chat_sessions.id', 'messages.chat_session_id')
                ->orderByDesc('created_at')
                ->limit(1); 
        })
        ->get();

    return response()->json([
        'sessions' => $sessions
    ]);
}

    public function markMessagesRead($sessionId)
    {
        $session = ChatSession::findOrFail($sessionId);
        $session->messages()->where('is_read', false)->update(['is_read' => true]);

        return response()->json(['message' => 'Messages marked as read.']);
    }
    public function getMessages($sessionId)
    {
        $session = ChatSession::findOrFail($sessionId);
        $messages = $session->messages;
        return response()->json(['messages' => $messages]);
    }


    public function sendMessage(Request $request, $sessionId)
    {
        $session = ChatSession::findOrFail($sessionId);
        $message = $session->messages()->create([
            'sender_id' => auth()->id(),
            'message' => $request->message,
            'is_read' => true,
        ]);
        event(new NewMessageSent($message));

        return response()->json(['message' => $message]);
    }
    public function endSession($sessionId)
{
    $session = ChatSession::findOrFail($sessionId);
    if ($session->status === 'active') {
        $session->messages()->delete();
        $session->status = 'ended';
        $session->ended_at = now();
        $session->save();
        
        event(new SessionEnded($sessionId, auth()->id()));
        
        return response()->json(['message' => 'Session ended and messages deleted successfully.']);
    }
    return response()->json(['message' => 'Session is already ended or inactive.'], 400);
}

}
