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
        $order = $this->myOrderService->getOrderDetail($id);
        $commentDataArray = []; 
            foreach ($order->items as $item) {
                $commentData = $this->myOrderService->getCommentForProduct($id, $item->productVariant->product->id);
                $commentDataArray[$item->productVariant->product->id] = [
                    'comment' => $commentData['comment'],
                    'status' => $commentData['status'],
                    'product_id' => $item->productVariant->product->id
                ];
                $currentComments[$item->productVariant->product->id] = $commentData['comment'];
            }
            $productId = $order->items->first()->productVariant->product->id ?? null;
            $currentComment = null;
            // dd($productId);
            if ($productId !== null && isset($commentDataArray[$productId]) && isset($commentDataArray[$productId]['comment'])) {
                $currentComment = $commentDataArray[$productId]['comment']['id'];
            } else {
                $currentComment = null;
            }
            

            $commentDetails = $currentComment ? $this->myOrderService->getCommentById($currentComment) : null;

            // dd($commentDetails);
            // dd($commentDataArray[$productId]['comment']['id']);
            return view('client.my-account.order-detail', compact('order', 'commentDataArray', 'productId', 'currentComment','commentDetails'));
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
