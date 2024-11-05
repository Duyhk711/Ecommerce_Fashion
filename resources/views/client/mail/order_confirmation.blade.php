<!DOCTYPE html>
<html lang="en">

<head>
    <title>Xác nhận đơn hàng</title>
</head>

<body>
    <h2>Cảm ơn bạn đã đặt hàng tại polyshop!</h2>
    <p>Mã đơn hàng: {{ $order->session_id }}</p>
    <p>Người nhận: {{ $order->customer_name }}</p>
    <p>Số điện thoại: {{ $order->customer_phone }}</p>
    <p>Địa chỉ: {{ $order->address_line1 }}, {{ $order->ward }}, {{ $order->district }},
        {{ $order->ward }}</p>
    <p>Ngày đặt: {{ $order->created_at }}</p>
    <p>Tổng tiền: {{ $order->total_price }} VND</p>
    {{-- @if ($order->user_id != '') --}}
    <a href="{{ route('orderOneDetail', ['id' => $order->id]) }}">Xem chi tiết đơn hàng</a>
    {{-- @else
        <a href="hudhsuu">Xem chi tiết đơn hàng</a>
    @endif --}}

</body>

</html>
