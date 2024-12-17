<!DOCTYPE html>
<html lang="en">

<head>
    <title>Xác nhận đơn hàng</title>
</head>

<body>
    <strong>Cập nhật đơn hàng</strong>

    @php
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
    @endphp
    <p>Đơn hàng <strong>{{ $order->sku }}</strong> {{$statusMessage}}</p>
    <a href="{{ route('orderOneDetail', ['id' => $order->id]) }}">Xem chi tiết đơn hàng</a>
    {{-- @else
        <a href="hudhsuu">Xem chi tiết đơn hàng</a>
    @endif --}}

</body>

</html>
