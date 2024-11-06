<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class VNPayController extends Controller
{
    public function createPayment(Request $request)
    {
        $order = Order::find($request->order_id);

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('orderSuccess', [], true);
        // $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_TmnCode = "LZB2WY75"; //Mã website tại VNPAY
        $vnp_HashSecret = "3UVBW2SNJWID1RC0L2FKA8UR5YGAM0VV"; //Chuỗi bí mật

        $vnp_TxnRef = $order->session_id; // Mã giao dịch chính là ID đơn hàng
        $vnp_OrderInfo = "Thanh toán đơn hàng #" . $order->session_id;
        // dd($order);
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = intval($order->total_price) * 100 * 1000; // Số tiền (đơn vị VND)
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        // dd($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        // dd($hashdata);
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // Log::info('VNPay Amount: ' . $vnp_Amount);

        // dd($vnp_Url);

        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {   
        // dd($request->all());
        $vnp_SecureHash = $request->get('vnp_SecureHash');
        $inputData = $request->except('vnp_SecureHash');

        ksort($inputData);
        $hashdata = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
        }

        // dd($request->except('vnp_SecureHash'), $inputData, $hashdata);
        $vnp_HashSecret = "3UVBW2SNJWID1RC0L2FKA8UR5YGAM0VV";
        $secureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        // dd($request->except('vnp_SecureHash'), $inputData, $vnp_SecureHash, $secureHash);
        if ($request->get('vnp_ResponseCode') == '00') {
            // dd('ok');
            // Thanh toán thành công, cập nhật trạng thái đơn hàng
            $order = Order::where('session_id', $request->get('vnp_TxnRef'))->first();
            $order->payment_status = 'da_thanh_toan';
            $order->status = '1';
            $order->save();
            $orderItems = OrderItem::where('order_id', $order->id)->get();

            return view('client.order-success', compact('orderItems', 'order'))->with('success', 'Giao dịch thành công!');
        } else {
            // dd('ko ok');
            // Thanh toán thất bại
            $order = Order::where('session_id', $request->get('vnp_TxnRef'))->first();
            $orderItems = OrderItem::where('order_id', $order->id)->get();
            return view('client.order-success', compact('orderItems', 'order'))->with('error', 'Giao dịch không thành công!');
        }

    }
}
