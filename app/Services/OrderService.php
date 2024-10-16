<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderStatusChange;

class OrderService{
    public function getOrder($status = null, $perPage = 6, $payment_status = null){
        $query = Order::with('items');

        if ($status) {
            $query->where('status', $status);
        }

        if ($payment_status) {
            $query->where('payment_status', $payment_status);
        }

        return $query->paginate($perPage);
    }

    public function getOrderDetail($id){
        return $order = Order::with([
            'user',
            'voucher',
            'address',
            'items.productVariant.variantAttributes.attributeValue',
            'items.productVariant.product',
            'statusChanges.user',
            'items',
        ])->findOrFail($id);
    }
    public function updateOrderStatus($orderId, $newStatus, $userId)
    {
        // Lấy đơn hàng theo ID
        $order = Order::findOrFail($orderId);

        // Lưu trạng thái cũ để ghi vào bảng OrderStatusChange
        $oldStatus = $order->status;

        // Thay đổi trạng thái

        try {
            $order->changeStatus($newStatus);
            OrderStatusChange::create([
                'order_id' => $order->id,
                'user_id' => $userId,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}

?>
