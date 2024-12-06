<?php

namespace App\Services\Client;

use App\Models\Order;
use App\Models\Comment;
use App\Models\OrderStatusChange;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusUpdated;


class MyOrderService
{


  public function getOrder($status = null, $keyword = null)
      {
          // Lấy user_id của người dùng đang đăng nhập
          $userId = Auth::id();

          // Tạo truy vấn cho đơn hàng
          $query = Order::with(['items.productVariant.product', 'items.productVariant.product.comments' => function ($query) use ($userId) {
              $query->where('user_id', $userId); // Lọc bình luận theo user_id
          }])
          ->where('user_id', $userId); // Lọc theo user_id

          // Kiểm tra trạng thái đơn hàng
          if ($status) {
              if ($status == 'cho_thanh_toan') {
                  $query->where('payment_method', 'THANH_TOAN_ONLINE')
                      ->where('payment_status', 'cho_thanh_toan')
                      ->where('status', ['1', '2']);
              } else {
                  $query->where('status', $status);
              }
          } else {
              $query->where('status', '<>', 'huy_don_hang');
          }

          // Kiểm tra từ khóa tìm kiếm
          if ($keyword) {
              $query->where('sku', 'LIKE', '%' . $keyword . '%');
          }

          return $query->orderBy('created_at', 'desc')->paginate(5)->appends(['status' => $status, 'search' => $keyword]);
      }

    public function getOrderDetail($id)
    {
        return Order::with(['items.productVariant.variantAttributes.attributeValue', 'items.productVariant.product', 'items.productVariant.product.comments'])->findOrFail($id);
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

        if ($order->payment_status == 'da_thanh_toan' || $order->payment_status == 'cho_thanh_toan') {
            $order->payment_status = 'huy_thanh_toan';
        }
        $oldStatus = $order->status;
        // Cập nhật trạng thái đơn hàng thành "Đã hủy"
        $order->status = 'huy_don_hang';

        $user = $order->user;
        $message = "Đơn hàng <strong>{$order->sku}</strong> đã bị huỷ";
        $title = "Cập nhật đơn hàng";
        $user->notify(new OrderStatusUpdated($order, $message, $title));
        $order->save();

        OrderStatusChange::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'old_status' => $oldStatus,
            'new_status' => 'huy_don_hang',
        ]);

        return ['success' => true, 'message' => 'Đơn hàng đã được hủy thành công.'];
    }

    public function orderSuccess($order_id){
        $order = Order::find($order_id);

        if (!$order) {
            return ['success' => false, 'message' => 'Đơn hàng không tồn tại.'];
        }


        if ($order->payment_status == 'cho_thanh_toan') {
            $order->payment_status = 'da_thanh_toan';
        }

        $oldStatus = $order->status;
        // Cập nhật trạng thái đơn hàng thành "Đã hủy"
        $order->status = '5';

        $user = $order->user;
        $message = "Đơn hàng <strong>{$order->sku}</strong> đã bị huỷ";
        $title = "Cập nhật đơn hàng";
        $user->notify(new OrderStatusUpdated($order, $message, $title));
        $order->save();

        OrderStatusChange::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'old_status' => $oldStatus,
            'new_status' => '5',
        ]);

        return ['success' => true, 'message' => 'Đơn hàng đã hoàn thành.'];
    }


    public function getCommentForProduct($orderId, $productId)
    {
        $userId = auth()->id();

        $comment = Comment::where('order_id', $orderId)
                    ->where('product_id', $productId)
                    ->where('user_id', $userId)
                    ->first();

        if ($comment == null) {
            $status = 'not_comment';  // Chưa comment

        } else {
            if ($comment->updated_at == null) {
                // Nếu created_at bằng updated_at -> Đã comment nhưng chưa sửa
                $status = 'commented';
            } else {
                // Nếu comment đã được sửa
                $status = 'updated';
            }
        }
        // dd($status);
        return [
            'comment' => $comment,
            'status' => $status,
        ];
    }

    public function getCommentById($id){
        return Comment::find($id);
    }

    public function searchOrders($keyword)
    {
        return Order::with('items')
            ->where('user_id', Auth::id())
            ->where('sku', 'LIKE', '%' . $keyword . '%') // Tìm kiếm theo mã đơn hàng
            ->get();
    }
}
