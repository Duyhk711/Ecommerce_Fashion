<?php

namespace App\Services;

use App\Mail\OrderUpdateNotify;
use App\Models\Order;
use App\Models\OrderStatusChange;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;


class OrderService
{
    public function getOrder($status = null, $perPage = 6, $payment_status = null, $order_date_start = null, $order_date_end = null, $order_search = null)
    {
        $query = Order::with('items');

        if ($order_search) {
            $query->where(function ($q) use ($order_search) {
                $q->where('sku', 'like', "%$order_search%")
                    ->orWhere('customer_name', 'like', "%$order_search%");
            });
        }

        if ($order_date_start && $order_date_end) {
            $order_date_start = Carbon::parse($order_date_start)->startOfDay();
            $order_date_end = Carbon::parse($order_date_end)->endOfDay();
            $query->whereBetween('created_at', [$order_date_start, $order_date_end]);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($payment_status) {
            $query->where('payment_status', $payment_status);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getOrderDetail($id)
    {
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

        return $order;
    }

    public function sendMailNotifyOrderUpdate($order)  {
        Mail::to($order->customer_email)->queue(new OrderUpdateNotify($order));
    }
}
