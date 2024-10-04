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

    public function index()
    {
        $orders = $this->orderService->getOrder();
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
        return view(self::PATH_VIEW.__FUNCTION__, compact('orderDetail', 'user','voucher','address','items',));
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
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
