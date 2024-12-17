<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Services\Client\MyOrderService;
use App\Notifications\OrderStatusUpdated;
use App\Services\ProductService;

class MyOrderController extends Controller
{
    protected $myOrderService;
    protected $userService;
    protected $productService;

    public function __construct(MyOrderService $myOrderService, UserService $userService, ProductService $productService)
    {
        $this->myOrderService = $myOrderService;
        $this->userService = $userService;
        $this->productService = $productService;
    }

    public function myOrders(Request $request)
    {
        $pageTitle = 'Đơn hàng';
        $currentUser = $this->userService->getCurrentUser();
        $status = $request->query('status');
        $searchTerm = $request->input('search');
        $orders = $this->myOrderService->getOrder($status, $searchTerm);
        // dd($orders);
        return view('client.my-account.my-order', compact('orders', 'currentUser', 'status', 'pageTitle'));
    }

    public function show($id)
    {
        $pageTitle = 'Chi tiết đơn hàng';
        $currentUser = $this->userService->getCurrentUser();
        $order = $this->myOrderService->getOrderDetail($id);
        $commentDataArray = [];
        foreach ($order->items as $item) {
            $commentData = $this->myOrderService->getCommentForProduct($id, $item->productVariant->product->id);
            $commentDataArray[$item->productVariant->product->id] = [
                'comment' => $commentData['comment'],
                'status' => $commentData['status'],
                'product_id' => $item->productVariant->product->id,
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
        // dd($order);
        // dd($commentDataArray[$productId]['comment']['id']);
        return view('client.my-account.order-detail', compact('order', 'commentDataArray', 'productId', 'currentComment', 'commentDetails', 'currentUser'));
    }

    public function showOne($id)
    {
        $order = $this->myOrderService->getOrderDetail($id);
        $commentDataArray = [];
        foreach ($order->items as $item) {
            $commentData = $this->myOrderService->getCommentForProduct($id, $item->productVariant->product->id);
            $commentDataArray[$item->productVariant->product->id] = [
                'comment' => $commentData['comment'],
                'status' => $commentData['status'],
                'product_id' => $item->productVariant->product->id,
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

        // dd($order);
        // dd($commentDataArray[$productId]['comment']['id']);
        return view('client.order-detail', compact('order', 'commentDataArray', 'productId', 'currentComment', 'commentDetails'));
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

    public function orderSuccess(Request $request, $order_id)
    {
        // Gọi service để đổi đơn hàng thành đã nhận
        $result = $this->myOrderService->orderSuccess($order_id);

        // Kiểm tra kết quả
        if ($result['success']) {
            return redirect()->route('my.order')->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    public function removeOrder(Request $request, $order_id)
    {
        // Gọi service để hủy đơn hàng
        $result = $this->myOrderService->cancelOrder($order_id);
        // Kiểm tra kết quả
        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }
}
