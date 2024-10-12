<?php

namespace App\Services\Client;

use App\Models\Order;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class MyOrderService
{


    public function getOrder($status = null, $keyword = null)
{
    $query = Order::with('items')
        ->where('user_id', Auth::id());

    if ($status) {
        if ($status == 'cho_thanh_toan') {
            $query->where('payment_method', 'THANH_TOAN_ONLINE')
                  ->where('payment_status', 'cho_thanh_toan');
        } else {
            $query->where('status', $status);
        }
    } else {
        $query->where('status', '<>', 'huy_don_hang');
    }

    if ($keyword) {
        $query->where('sku', 'LIKE', '%' . $keyword . '%');
    }

    return $query->paginate(10)->appends(['status' => $status, 'search' => $keyword]);
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
        $order->status = 'huy_don_hang';
        $order->save();

        return ['success' => true, 'message' => 'Đơn hàng đã được hủy thành công.'];
    }

    public function searchOrders($keyword)
    {
        return Order::with('items')
            ->where('user_id', Auth::id())
            ->where('sku', 'LIKE', '%' . $keyword . '%') // Tìm kiếm theo mã đơn hàng
            ->get();
    }
}
