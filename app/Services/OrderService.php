<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderStatusChange;

class OrderService{
    public function getOrder(){
        return Order::with('items')->get();
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
        $order->changeStatus($newStatus);

        OrderStatusChange::create([
            'order_id' => $order->id,
            'user_id' => $userId,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
        ]);
    }
}

?>
