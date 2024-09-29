<?php 
namespace App\Services\Client;

use App\Models\Order;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class MyOrderService{

   
    public function getOrder()
    {
        // Lấy user_id của người dùng đang đăng nhập
        $userId = Auth::id();

        // Lấy danh sách đơn hàng của người dùng và tải thông tin đơn hàng chi tiết
        $orders = Order::with(['items.productVariant.product', 'items.productVariant.product.comments' => function($query) use ($userId) {
            $query->where('user_id', $userId); // Lọc bình luận theo user_id
        }]) // Tải thông tin các mục đơn hàng cùng với thông tin sản phẩm variant và bình luận
        ->where('user_id', $userId) // Lọc theo user_id
        ->get();
        
        return $orders; // Trả về danh sách đơn hàng
    }

    

}




?>