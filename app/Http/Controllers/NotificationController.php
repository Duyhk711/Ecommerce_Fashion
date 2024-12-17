<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        try {
            // Lấy thông báo
            $notification = auth()->user()->notifications()->findOrFail($id);

            // Đánh dấu là đã đọc
            $notification->markAsRead();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function fetchNotificationsClient(Request $request)
    {
        $user = auth()->user();

        // Sử dụng paginate với 5 thông báo mỗi lần tải
        $notifications = $user->notifications->where('data->category', 'çlient')->orderBy('created_at', 'desc')->paginate(5);

        // Trả về dữ liệu dưới dạng JSON
        return response()->json([
            'data' => $notifications->items(),
            'next_page_url' => $notifications->nextPageUrl() // URL của trang kế tiếp nếu có
        ]);
    }

    public function getNotifyAdmin(Request $request)
    {
        $notifications = auth()->user()
            ->notifications
            ->where('data->category', 'admin') // Lọc thông báo cho admin
            ->get();

        return response()->json($notifications);
    }

    // API lấy thông báo của Client
    public function getNotifyClient(Request $request)
    {
        $notifications = auth()->user()
            ->notifications
            ->where('data->category', 'client') // Lọc thông báo cho client
            ->get();

        return response()->json($notifications);
    }
}
