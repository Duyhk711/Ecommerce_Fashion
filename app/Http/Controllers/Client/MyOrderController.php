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
}
