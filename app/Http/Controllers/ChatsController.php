<?php

namespace App\Http\Controllers;

use App\Events\SendAdminMessage;
use App\Events\SendUserMessage;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{

    public function adminIndex()
    {
        $pusherKey = env('PUSHER_APP_KEY');
        $pusherCluster = env('PUSHER_APP_CLUSTER');
        $users = User::where('role', 'user')->get();
        foreach ($users as $user) {
            $user->unread_count = Chat::where('receiver_id', Auth::id())
                ->where('sender_id', $user->id)
                ->where('seen', 0)
                ->count();
        }

        return view('admin.chat.chat', compact('users', 'pusherKey', 'pusherCluster'));
    }
    
    public function markMessagesAsRead(Request $request)
    {
        $receiverId = $request->input('receiver_id');
        $adminId = Auth::id();
        Chat::where('sender_id', $receiverId)
            ->where('receiver_id', $adminId)
            ->where('seen', 0)
            ->update(['seen' => 1]);

        return response()->json(['success' => true]);
    }
    public function userIndex()
    {
        $pusherKey = env('PUSHER_APP_KEY');
        $pusherCluster = env('PUSHER_APP_CLUSTER');
        $admins = User::where('role', 'admin')->get();
        return view('client.chat', compact('admins', 'pusherKey', 'pusherCluster'));
    }

    public function fetchMessages(Request $request)
    {
        $receiverId = $request->input('receiver_id');
        $senderId = Auth::id();
        $messages = Chat::where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)
                ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', $senderId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json(['messages' => $messages]);
    }
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
        ]);

        $chat = new Chat();
        $chat->sender_id = Auth::id();
        $chat->receiver_id = $request->input('receiver_id');
        $chat->message = $request->input('message');
        $chat->seen = 0;
        $chat->save();

        event(new SendAdminMessage($chat));

        return response()->json(['success' => true, 'message' => 'Tin nhắn đã được gửi']);
    }
    public function fetchMessagesFromUserToAdmin(Request $request)
    {
        $receiverId = $request->input('receiver_id');
        $userId = Auth::id();
        $messages = Chat::where(function ($query) use ($userId, $receiverId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($userId, $receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', $userId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json(['messages' => $messages]);
    }
    public function sendMessageFromUserToAdmin(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
        ]);

        $chat = new Chat();
        $chat->sender_id = Auth::id();
        $chat->receiver_id = $request->input('receiver_id');
        $chat->message = $request->input('message');
        $chat->seen = 0;
        $chat->save();

        event(new SendUserMessage($chat));

        return response()->json(['success' => true, 'message' => 'Tin nhắn đã được gửi']);
    }
    public function getFirstAdmin()
    {
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            return response()->json(['admin_id' => $admin->id, 'admin_name' => $admin->name]);
        }
        return response()->json(['error' => 'No admin found'], 404);
    }
}