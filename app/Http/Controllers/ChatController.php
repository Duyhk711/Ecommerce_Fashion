<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'user_id' => auth()->id(),
            'admin_id' => $request->admin_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['message' => $message]);
    }

    public function getMessages($adminId)
    {
        $messages = Message::where('user_id', auth()->id())
                            ->where('admin_id', $adminId)
                            ->orderBy('created_at', 'asc')
                            ->get();

        return response()->json(['messages' => $messages]);
    }
}
