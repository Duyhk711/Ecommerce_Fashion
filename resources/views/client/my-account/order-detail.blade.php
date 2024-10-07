@extends('client.my-account')

@section('css')
    {{-- CSS order-detail --}}
    <link rel="stylesheet" href="{{ asset('client/css/order-detail.css') }}">
    {{-- link icon  --}}
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('my-order')
    <div class="order-detail-container ">
        <!-- Header đơn hàng -->
        <div class="order-header">
            <a href="{{ route('my.order') }}" class="btn"> Quay lại</a>
            <h2>
                Mã đơn hàng: {{ $order->sku }}
                @php
                    $statusText = [
                        'cho_xac_nhan' => 'Chờ xác nhận',
                        'da_xac_nhan' => 'Đã xác nhận',
                        'dang_chuan_bi' => 'Đang chuẩn bị',
                        'dang_van_chuyen' => 'Đang vận chuyển',
                        'hoan_thanh' => 'Hoàn thành',
                        'huy_don_hang' => 'Hủy đơn hàng'
                    ];
                @endphp
                <span class="badge text-bg
                                        @if ($order->status == 'cho_xac_nhan') bg-secondary
                                        @elseif($order->status == 'da_xac_nhan') bg-secondary
                                        @elseif($order->status == 'dang_chuan_bi') bg-warning text-dark
                                        @elseif($order->status == 'dang_van_chuyen') bg-primary
                                        @elseif($order->status == 'hoan_thanh') bg-success
                                        @elseif($order->status == 'huy_don_hang') bg-danger @endif">
                    {{ $statusText[$order->status] ?? $order->status }}
                </span>
                @if ($order->status == 'cho_xac_nhan')
                    <div class="cancel-item" style="display: inline-block; margin-left: 10px;">
                        <form action="{{ route('order.cancel', ['order_id' => $order->id]) }}" method="POST"
                            id="cancelOrderForm-{{ $order->id }}">
                            @csrf
                            <button type="button" class="btn btn-danger btn-sm soft-btn"
                                onclick="confirmCancelOrder({{ $order->id }})">Hủy đơn hàng</button>
                        </form>
                    </div>
                @endif
            </h2>
            <p style="margin-top: 10px;">Ngày đặt hàng: {{ $order->created_at->format('H:i d/m/Y') }}</p>
        </div>
        <hr>

        <!-- Thông tin người nhận và theo dõi đơn hàng -->
        <div class="order-info">
            <div class="customer-info">
                <h3>Thông tin người nhận</h3>
                <p><strong>Người nhận:</strong> {{ $order->customer_name }}</p>
                <p><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
                <p><strong>Địa chỉ:</strong>
                    {{ $order->ward }},
                    {{ $order->district }},
                    {{ $order->city }}
                </p>
                @php
                    $paymentText = [
                        'cho_thanh_toan' => 'Chờ thanh toán',
                        'da_thanh_toan' => 'Đã thanh toán'
                    ];
                @endphp
                <p><strong>Trạng thái thanh toán:</strong> {{ $paymentText[$order->payment_status] ?? $order->payment_status }}</p>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
     <div class="order-items">
    <h3>Sản phẩm ({{ count($order->items) }})</h3>
    @foreach ($order->items as $item)
        <div class="product-item">
            <div class="product-image">
                <img src="{{ $item->productVariant->image  }}" alt="{{ $item->product_name }}"
                    width="100">
            </div>
            <div class="product-details">
                <p><strong>{{ $item->product_name }}</strong></p>
                <p>
                    @php
                        $size = '';
                        $color = '';
                    @endphp

                    @foreach ($item->productVariant->variantAttributes as $variantAttribute)
                        @if ($variantAttribute->attribute->name == 'Size')
                            @php $size = $variantAttribute->attributeValue->value; @endphp
                        @elseif ($variantAttribute->attribute->name == 'Color')
                            @php $color = $variantAttribute->attributeValue->value; @endphp
                        @endif
                    @endforeach

                    @if ($size || $color)
                        {{ $size }} @if ($size && $color)
                            |
                        @endif {{ $color }}
                    @else
                        <span style="color: red;">No size or color available.</span>
                    @endif
                </p>

            </div>

            <div class="product-price">
                <p>
                    <span style="text-decoration: line-through;">{{ number_format(($item->variant_price_regular * 1000), 0, '.', ',') }} đ</span>
                    <span style="color: red; font-weight: bold;">{{ number_format($item->variant_price_sale * 1000, 0, '.', ',') }} đ</span>
                </p>
                <p>SL: {{ $item->quantity }}</p>
                  <!-- Hiển thị nút đánh giá ở bên phải dưới sản phẩm -->
        @if ($order->status == 'hoan_thanh')
            <div class="review-button-container" style="text-align: right;">
                <a href="" class="btn btn-primary btn-sm">Xem bình luận</a>
            </div>
        @endif
            </div>

        </div>


    @endforeach
</div>


        <!-- Thông tin thanh toán -->
        <div class="order-total">
            <table>
                <tr>
                    <td>Tổng cộng:</td>
                    <td>{{ number_format($order->total_price * 1000, 0, '.', ',') }} đ</td>
                </tr>
                <tr>
                    <td>Giảm giá:</td>
                    <td>
                        @if ($order->voucher)
                            {{ number_format($order->voucher->discount_value * 1000, 0, '.', ',') }} đ
                        @else
                            0 đ
                        @endif
                    </td>
                </tr>
                <div>
                    <tr>
                        <td><strong>Tổng đã trả:</strong></td>
                        <td>
                            <strong class="total-amount" style="font-weight: normal;">
                                @php
                                    $discount = 0;
                                    if ($order->voucher) {
                                        if ($order->voucher->discount_type == 'percentage') {
                                            $discount = $order->total_price * ($order->voucher->discount_value / 100);
                                        } elseif ($order->voucher->discount_type == 'fixed') {
                                            $discount = $order->voucher->discount_value;
                                        }
                                    }
                                @endphp
                                {{ number_format(($order->total_price - $discount) * 1000, 0, '.', ',') }} đ
                            </strong>
                        </td>
                    </tr>
                </div>
            </table>
        </div>
    </div>
    <script>
        function confirmCancelOrder(orderId) {
            if (confirm("Bạn chắc chắn muốn hủy đơn hàng này?")) {
                document.getElementById('cancelOrderForm-' + orderId).submit();
            }
        }
    </script>
@endsection
