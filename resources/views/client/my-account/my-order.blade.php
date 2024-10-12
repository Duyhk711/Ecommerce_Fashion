@extends('client.my-account')
@section('css')
    <style>
        .status-menu {
            border-bottom: 2px solid #e0e0e0;
        }

        .nav-link {
            color: #000;
            transition: color 0.3s;
        }

        .nav-link.active {
            color: #fe2c55;
            border-bottom: 2px solid #fe2c55;
        }

        .nav-link:hover {
            color: #fe2c55;
        }

        .order-select-box {
            margin-bottom: 1.5rem;
            border: none;
            padding: 1.2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background: #fff;
            transition: transform 0.3s;
        }

        .order-select-box:hover {
            transform: scale(1.02);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
            font-weight: bold;

        }

        .status-label {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            /* font-weight: bold; */
            text-align: center;
        }

        .order-detail {
            font-size: 0.9rem;
            color: #555;
        }

        .btn-outline-danger {
            color: #dc3545;
            background-color: #fff;
            border-color: #dc3545;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }

        .product-image {
            width: 120px;
            height: 150px;
            border-radius: 0.25rem;

        }

        .product-item {
            width: 100%;
        }


        .product-info p {
            font-weight: normal;
        }

        .order-detail {
            font-size: 0.9rem;
            color: #555;
            flex: 1;

        }

        .total-price {
            margin-top: 1rem;
        }


        .search-container {
            display: flex;
            align-items: center;
        }

        .form-control {
            width: 250px;
            margin-right: 10px;
        }
    </style>
@endsection
@section('my-order')
    <div>
        <div class="orders-card mt-0 h-100">
            <div class="top-sec d-flex justify-content-between mb-4">
                <h2 class="mb-0">Đơn hàng của tôi</h2>
            </div>
            <div class="search-container d-flex justify-content-end mb-4">
                <form action="{{ route('my.order') }}" method="GET" class="d-flex align-items-center">
                    <input type="text" name="search" class="form-control me-2 rounded"
                        placeholder="Tìm kiếm mã đơn hàng..." aria-label="Search" value="{{ request('search') }}">
                    <button class="btn btn-danger rounded" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <!-- Thanh Menu Trạng Thái -->
            <div class="status-menu mb-4">
                <nav class="nav nav-fill">
                    <a class="nav-link {{ !$status ? 'active' : '' }}" href="{{ route('my.order') }}">Tất cả</a>
                    <a class="nav-link {{ $status == 'cho_thanh_toan' ? 'active' : '' }}"
                    href="{{ route('my.order', ['status' => 'cho_thanh_toan']) }}">Chờ thanh toán</a>
                    <a class="nav-link {{ $status == 'cho_xac_nhan' ? 'active' : '' }}"
                        href="{{ route('my.order', ['status' => 'cho_xac_nhan']) }}">Chờ xác nhận</a>
                    <a class="nav-link {{ $status == 'dang_chuan_bi' ? 'active' : '' }}"
                        href="{{ route('my.order', ['status' => 'dang_chuan_bi']) }}">Đang chuẩn bị</a>
                    <a class="nav-link {{ $status == 'dang_van_chuyen' ? 'active' : '' }}"
                        href="{{ route('my.order', ['status' => 'dang_van_chuyen']) }}">Đang vận chuyển</a>
                    <a class="nav-link {{ $status == 'hoan_thanh' ? 'active' : '' }}"
                        href="{{ route('my.order', ['status' => 'hoan_thanh']) }}">Đã giao hàng</a>
                    <a class="nav-link {{ $status == 'huy_don_hang' ? 'active' : '' }}"
                        href="{{ route('my.order', ['status' => 'huy_don_hang']) }}">Đã hủy</a>
                </nav>
            </div>
            @foreach ($orders as $item)
                <!-- Danh Sách Đơn Hàng -->
                <div class="order-book-section">
                    <div class="row g-4">

                        <div class="order-select-box">
                            <div class="order-header d-flex justify-content-between align-items-center">
                                <h2 class="m-0 font-size">Mã đơn hàng: {{ $item->sku }}</h2>
                                <span
                                    class="status-label
                                @if ($item->status == 'cho_xac_nhan') text-secondary
                                @elseif($item->status == 'da_xac_nhan') text-secondary
                                @elseif($item->status == 'dang_chuan_bi') text-warning
                                @elseif($item->status == 'dang_van_chuyen') text-primary
                                @elseif($item->status == 'hoan_thanh') text-success
                                @elseif($item->status == 'huy_don_hang') text-danger @endif">
                                    @switch($item->status)
                                        @case('cho_xac_nhan')
                                            Chờ xác nhận
                                        @break

                                        @case('da_xac_nhan')
                                            Đã xác nhận
                                        @break

                                        @case('dang_chuan_bi')
                                            Đang chuẩn bị
                                        @break

                                        @case('dang_van_chuyen')
                                            Đang vận chuyển
                                        @break

                                        @case('hoan_thanh')
                                            Đã giao hàng
                                        @break

                                        @case('huy_don_hang')
                                            Đã hủy
                                        @break

                                        @default
                                            Trạng thái không xác định
                                    @endswitch
                                </span>
                            </div>
                            <div class="order-detail d-flex align-items-start">
                                <div class="me-3">
                                    @foreach ($item->items as $orderItem)
                                        <div class="product-item d-flex mb-2">
                                            <img src="{{ $orderItem->variant_image }}" alt="Hình ảnh sản phẩm"
                                                class="product-image" />
                                            <div class="product-info ms-2">
                                                <p class="m-0">{{ $orderItem->product_name }}</p>
                                                <p class="m-0">Số lượng: {{ $orderItem->quantity }}</p>
                                                <p class="m-0">Giá:
                                                    {{ number_format($orderItem->variant_price_regular, 0, ',', '.') }}đ
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <p class="total-price">Tổng giá: {{ number_format($item->total_price, 0, ',', '.') }}đ</p>
                            <hr class="my-3">
                            <div class="bottom d-flex justify-content-start gap-2">

                                @if ($item->status != 'huy_don_hang')
                                    <a href="{{ route('orderDetail', ['id' => $item->id]) }}"
                                        class="order-link btn btn-gray btn-sm">
                                        Chi tiết
                                    </a>
                                @endif
                                @if (in_array($item->status, ['cho_xac_nhan', 'da_xac_nhan', 'dang_chuan_bi']))
                                    <div class="cancel-item" style="display: inline-block; margin-left: 10px;">
                                        <form action="{{ route('order.cancel', ['order_id' => $item->id]) }}"
                                            method="POST" id="cancelOrderForm-{{ $item->id }}">
                                            @csrf
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                onclick="confirmCancelOrder({{ $item->id }})">Hủy đơn hàng</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="pagination mt-4 text-center">
                {{ $orders->links() }}
            </div>
        </div>
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
