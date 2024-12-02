<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications->find($id);
        if ($notification && !$notification->read_at) {
            $notification->markAsRead();  // Đánh dấu là đã đọc
        }
        return response()->json(['success' => true]);
    }

    public function fetchNotifications(Request $request)
    {
        $user = auth()->user();

        // Sử dụng paginate với 5 thông báo mỗi lần tải
        $notifications = $user->notifications->orderBy('created_at', 'desc')->paginate(5);

        // Trả về dữ liệu dưới dạng JSON
        return response()->json([
            'data' => $notifications->items(),
            'next_page_url' => $notifications->nextPageUrl() // URL của trang kế tiếp nếu có
        ]);
    }
}
