<?php

namespace App\Http\Controllers\Admin;

use App\Events\OrderUpdated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderStatusUpdated;
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
        $this->middleware('permission:xem danh sách đơn hàng|Chỉnh sửa trạng thái đơn hàng', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        $status = $request->get('status');
        $payment_status = $request->get('payment_status');
        $order_search = $request->get('order_search');
        $order_date_start = $request->get('order_date_start');
        $order_date_end = $request->get('order_date_end');
        $orders = $this->orderService->getOrder(
            $status,
            10,
            $payment_status,
            $order_date_start,
            $order_date_end,
            $order_search
        );
        return view(self::PATH_VIEW . __FUNCTION__, compact('orders'));
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

        return view(self::PATH_VIEW . __FUNCTION__, compact('orderDetail', 'user', 'voucher', 'address', 'items', 'statusChanges', 'paymentStatusMessage'));
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
        $order = $this->orderService->updateOrderStatus($id, $request->input('status'), auth()->id());
        if ($order->user_id) {

            // In đậm SKU
            $message = "Đơn hàng <strong>{$order->sku}</strong> ";

            // Kiểm tra trạng thái và thêm thông báo tương ứng
            switch ($order->status) {
                case 1:
                    $statusMessage = "Đơn hàng đã đặt thành công, đang chờ xác nhận từ cửa hàng";
                    break;
                case 2:
                    $statusMessage = "đã được xác nhận và đang chờ giao cho đơn vị vận chuyển";
                    break;
                case 3:
                    $statusMessage = "đang trên đường giao tới bạn";
                    break;
                case 4:
                    $statusMessage = "đã giao thành công, vui lòng xác nhận đã nhận được hàng để đánh giá đơn hàng";
                    break;
                case 'huy_don_hang':
                    $statusMessage = "đã bị hủy";
                    break;
                default:
                    $statusMessage = "trạng thái không xác định";
                    break;
            }

            // Thêm trạng thái vào thông báo
            $message .= $statusMessage . ".";
            $user = $order->user;
            $title = "Cập nhật đơn hàng";
            $user->notify(new OrderStatusUpdated($order, $message, $title));
        }

        broadcast(new OrderUpdated($order))->toOthers();
        $this->orderService->sendMailNotifyOrderUpdate($order);
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
