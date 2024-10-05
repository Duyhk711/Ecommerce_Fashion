<?php

namespace App\Http\Controllers\Client;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Client\MyOrderService;

class MyOrderController extends Controller
{
    protected $myOrderService;

    public function __construct(MyOrderService $myOrderService)
    {
        $this->myOrderService = $myOrderService;
    }

    public function myOrders()
    {
        $orders = $this->myOrderService->getOrder();

        return view('client.my-account.my-order', compact('orders'));
    }
    public function show($id)
    {
        $order = $this->myOrderService->getOrderDetail($id); // Gọi phương thức từ service

        return view('client.my-account.order-detail', compact('order'));
    }
    public function cancelOrder(Request $request, $order_id)
    {
        // Gọi service để hủy đơn hàng
        $result = $this->myOrderService->cancelOrder($order_id);

        // Kiểm tra kết quả
        if ($result['success']) {
            return redirect()->route('my.order')->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }
}
