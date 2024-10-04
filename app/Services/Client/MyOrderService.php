<?php

namespace App\Services\Client;

use App\Models\Order;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class MyOrderService
{


    public function getOrder()
    {
        // Lấy user_id của người dùng đang đăng nhập
        $userId = Auth::id();

        // Lấy danh sách đơn hàng của người dùng và tải thông tin đơn hàng chi tiết
        $orders = Order::with(['items','items.productVariant.product', 'items.productVariant.product.comments' => function ($query) use ($userId) {
            $query->where('user_id', $userId); // Lọc bình luận theo user_id
        }]) // Tải thông tin các mục đơn hàng cùng với thông tin sản phẩm variant và bình luận
            ->where('user_id', $userId) // Lọc theo user_id
            ->get();

        return $orders; // Trả về danh sách đơn hàng
    }

    public function getOrderDetail($id)
    {
        return Order::with(['items.productVariant.variantAttributes.attributeValue'])->findOrFail($id);
    }

    public function cancelOrder($order_id)
    {
        // Tìm đơn hàng theo ID
        $order = Order::find($order_id);

        if (!$order) {
            return ['success' => false, 'message' => 'Đơn hàng không tồn tại.'];
        }

        // Kiểm tra nếu người dùng có quyền hủy đơn hàng
        if ($order->user_id !== Auth::id()) {
            return ['success' => false, 'message' => 'Bạn không có quyền hủy đơn hàng này.'];
        }

        // Cập nhật trạng thái đơn hàng thành "Đã hủy"
        $order->status = 'Đã hủy';
        $order->save();

        return ['success' => true, 'message' => 'Đơn hàng đã được hủy thành công.'];
    }
}
