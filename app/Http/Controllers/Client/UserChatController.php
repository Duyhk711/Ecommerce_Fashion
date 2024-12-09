<?php

namespace App\Http\Controllers\Client;

use App\Events\NewChatSessionAssigned;
use App\Events\NewMessageSent;
use App\Events\SessionEnded;
use App\Http\Controllers\Controller;
use App\Models\ChatSession;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Log;

class UserChatController extends Controller
{
    public function startSession(Request $request)
{
    $existingSession = ChatSession::where('user_id', auth()->id())
        ->whereNull('ended_at')
        ->first();
    if ($existingSession) {
        return response()->json(['session' => $existingSession]);
    }

    $admin = User::where('role', 'admin')
        ->whereHas('roles.permissions', function ($query) {
            $query->where('id', 14); 
        })
        ->withCount(['sessions' => function ($query) {
            $query->whereNull('ended_at'); 
        }])
        ->orderByDesc('is_online') 
        ->orderBy('sessions_count', 'asc') 
        ->first();

    if (!$admin) {
        return response()->json(['error' => 'No admins available with the required permission'], 404);
    }

    $session = ChatSession::create([
        'user_id' => auth()->id(),
        'admin_id' => $admin->id,
    ]);

    event(new NewChatSessionAssigned($session, $admin->id));

    return response()->json(['session' => $session]);
}

public function checkSession()
{
    $existingSession = ChatSession::where('user_id', auth()->id())
        ->whereNull('ended_at')
        ->first();

    return response()->json([
        'session' => $existingSession ? $existingSession : null
    ]);
}

    public function getMessages($sessionId)
{
    $messages = Message::where('chat_session_id', $sessionId)
        ->with('sender') 
        ->get();
        
    return response()->json(['messages' => $messages]);
}



    public function sendMessage(Request $request, $sessionId)
    {
        $session = ChatSession::findOrFail($sessionId);

        $message = $session->messages()->create([
            'sender_id' => auth()->id(),
            'message' => $request->message,
        ]);
        
        event(new NewMessageSent($message));

        return response()->json(['message' => $message]);
    }

    public function endSession(Request $request, $sessionId)
{
    $session = ChatSession::where('id', $sessionId)
        ->where('user_id', auth()->id()) 
        ->first();
    
    if (!$session) {
        return response()->json(['error' => 'Session not found or you are not authorized to end this session.'], 403);
    }
    Message::where('chat_session_id', $sessionId)->delete();
    $session->ended_at = now();
    $session->status = 'ended';
    $session->save(); 
    event(new SessionEnded($sessionId)); 
    return response()->json(['success' => true, 'message' => 'Session ended successfully.']);
}



}
