<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    const PATH_VIEW = 'admin.orders.';
    /**
     * Display a listing of the resource.
     */

    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $status = $request->get('status');
        $orders = $this->orderService->getOrder($status, 6);
        // dd($orders);
        return view(self::PATH_VIEW.__FUNCTION__, compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        
        $orderDetail = $this->orderService->getOrderDetail($id);
        $user = $orderDetail->user; 
        $voucher = $orderDetail->voucher; 
        $address = $orderDetail->address; 
        $items = $orderDetail->items;
        $statusChanges = $orderDetail->statusChanges;
        $paymentStatusMessage = '';
        if ($orderDetail->payment_status == 'da_thanh_toan') {
            $paymentStatusMessage = 'Đơn hàng đã được thanh toán.';
        }

        return view(self::PATH_VIEW.__FUNCTION__, compact('orderDetail', 'user','voucher','address','items','statusChanges', 'paymentStatusMessage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       try {
        $this->orderService->updateOrderStatus($id, $request->input('status'), auth()->id());
        return redirect()->back()->with('success', 'Thay đổi trạng thái thành công');
       } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
       }

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
