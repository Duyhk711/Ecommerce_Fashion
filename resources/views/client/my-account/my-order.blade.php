@extends('client.my-account')
@section('css')
    <style>
        .status-menu {
            overflow-x: auto;  /* Cho phép cuộn ngang */
            -webkit-overflow-scrolling: touch;  /* Cuộn mượt mà trên thiết bị cảm ứng */
            margin: 0 auto;  /* Căn giữa */
            /* scroll-behavior: smooth; */
        }

        /* Tùy chỉnh các thanh cuộn ngang */


        .status-menu .nav {
            display: inline-flex;  /* Hiển thị các mục trong một hàng */
            width: max-content;  /* Chiều rộng tối đa của thanh cuộn */
        }

        .status-menu .nav-link {
            padding: 10px 15px;
            text-decoration: none;
            white-space: nowrap;  /* Đảm bảo các mục không bị xuống dòng */
            transition: color 0.3s ease;
        }

        .nav-link {
            color: #000;
            transition: color 0.3s;
        }

        .nav-link.active {
            color: #fe2c55;
            /* border-bottom: 2px solid #fe2c55; */
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
            width: 60px;
            height: auto;
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

        /* Thêm hiệu ứng cho phần collapse */
        .collapse {
            transition: height 0.4s ease-out, opacity 0.4s ease;
        }
        .collapse.show {
            opacity: 1;
        }
        .collapse:not(.show) {
            opacity: 0;
            height: 0;
            overflow: hidden;
        }

        /* Hiệu ứng cho nút Xem thêm/Ẩn */
        .toggle-btn {
            transition: color 0.3s ease;
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
            <div class="status-menu mb-4 custom-scrollbar">
                <nav class="nav nav-fill">
                    <a class="nav-link {{ !$status ? 'active' : '' }}" href="{{ route('my.order') }}">Tất cả</a>
                    <a class="nav-link {{ $status == 'cho_thanh_toan' ? 'active' : '' }}"
                        href="{{ route('my.order', ['status' => 'cho_thanh_toan']) }}">Chờ thanh toán</a>
                    <a class="nav-link {{ $status == '1' ? 'active' : '' }}"
                        href="{{ route('my.order', ['status' => '1']) }}">Chờ xác nhận</a>
                    <a class="nav-link {{ $status == '2' ? 'active' : '' }}"
                        href="{{ route('my.order', ['status' => '2']) }}">Chờ vận chuyển</a>
                    <a class="nav-link {{ $status == '3' ? 'active' : '' }}"
                        href="{{ route('my.order', ['status' => '3']) }}">Đang vận chuyển</a>
                    <a class="nav-link {{ $status == '4' ? 'active' : '' }}"
                        href="{{ route('my.order', ['status' => '4']) }}">Đã giao</a>
                    <a class="nav-link {{ $status == '5' ? 'active' : '' }}"
                        href="{{ route('my.order', ['status' => '5']) }}">Hoàn thành</a>
                    <a class="nav-link {{ $status == 'huy_don_hang' ? 'active' : '' }}"
                        href="{{ route('my.order', ['status' => 'huy_don_hang']) }}">Đã hủy</a>
                </nav>
            </div>
            @foreach ($orders as $item)
                <div class="order-book-section mb-4">
                    <div class="order-select-box">
                        <div class="order-header d-flex justify-content-between align-items-center">
                            <h2 class="m-0 font-size">Mã đơn hàng: {{ $item->sku }}</h2>
                                <span class="status-label
                                    @if ($item->status == '1') text-secondary
                                    @elseif($item->status == '2') text-info
                                    @elseif($item->status == '3') text-warning
                                    @elseif($item->status == '4') text-primary
                                    @elseif($item->status == 'huy_don_hang') text-danger @endif">
                                        @switch($item->status)
                                            @case('1')
                                                Chờ xác nhận
                                            @break

                                            @case('2')
                                                Chờ vận chuyển
                                            @break

                                            @case('3')
                                                Đang vận chuyển
                                            @break

                                            @case('4')
                                                Đã giao
                                            @break

                                            @case('5')
                                                Hoàn thành
                                            @break

                                            @case('huy_don_hang')
                                                Đã hủy
                                            @break

                                            @default
                                                Trạng thái không xác định
                                        @endswitch
                                </span>
                        </div>

                        @php
                            $firstItem = $item->items->first();
                            $remainingItems = $item->items->skip(1); // Bỏ qua sản phẩm đầu tiên
                        @endphp

                        <!-- Hiển thị sản phẩm đầu tiên -->
                        <div class="order-detail d-flex align-items-start">
                            <div class="me-3">
                                <div class="product-item d-flex mb-2">
                                    <img src="{{ Storage::url($firstItem->variant_image) }}" alt="Hình ảnh sản phẩm" class="product-image" width="80"/>
                                    <div class="product-info ms-2">
                                        <p class="m-0">{{ $firstItem->product_name }}</p>
                                        <p class="m-0">Số lượng: {{ $firstItem->quantity }}</p>
                                        <p class="m-0">Giá: {{ number_format($firstItem->variant_price_sale, 3, '.', 0) }}₫</p>
                                    </div>
                                </div>
                            </div>
                        </div>

<<<<<<< HEAD
                                @if ($item->payment_status == 'cho_thanh_toan' && $item->payment_method == 'THANH_TOAN_ONLINE')
                                    {{-- <a href="{{ route('', ['id' => $item->id]) }}"
                                        class="order-link btn btn-success btn-sm">
                                        Thanh toán
                                    </a> --}}
                                @endif
                                @if ($item->status != 'huy_don_hang')
                                    <a href="{{ route('orderDetail', ['id' => $item->id]) }}"
                                        class="order-link btn btn-gray btn-sm">
                                        Chi tiết
                                    </a>
                                @endif
                                @if (in_array($item->status, ['1', '2']))
                                    <div class="cancel-item" style="display: inline-block; margin-left: 10px;">
                                        <form action="{{ route('order.cancel', ['order_id' => $item->id]) }}"
                                            method="POST" id="cancelOrderForm-{{ $item->id }}">
                                            @csrf
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                onclick="confirmCancelOrder({{ $item->id }})">Hủy đơn hàng</button>
                                        </form>
=======
                        <!-- Hiển thị các sản phẩm còn lại -->
                        @if ($item->items->count() > 1)
                            <div class="collapse" id="collapseOrder{{ $item->id }}">
                                <div class="order-detail d-flex align-items-start">
                                    <div class="me-3">
                                        @foreach ($remainingItems as $orderItem)
                                            <div class="product-item d-flex mb-2">
                                                <img src="{{ Storage::url($orderItem->variant_image) }}" alt="Hình ảnh sản phẩm" class="product-image" width="80"/>
                                                <div class="product-info ms-2">
                                                    <p class="m-0">{{ $orderItem->product_name }}</p>
                                                    <p class="m-0">Số lượng: {{ $orderItem->quantity }}</p>
                                                    <p class="m-0">Giá: {{ number_format($orderItem->variant_price_sale, 3, '.', 0) }}₫</p>
                                                </div>
                                            </div>
                                        @endforeach
>>>>>>> 93e97caa48e86a21600217c8a1057759d2dc2215
                                    </div>
                                </div>
                            </div>

                            <!-- Nút Xem thêm / Ẩn ở dưới cùng -->
                            <div class="text-end">
                                <button class="btn-link text-decoration-none toggle-btn text-primary" data-bs-toggle="collapse" data-bs-target="#collapseOrder{{ $item->id }}" aria-expanded="false" aria-controls="collapseOrder{{ $item->id }}">
                                    Xem thêm
                                </button>
                            </div>
                        @endif

                        <p class="total-price">Tổng giá: {{ number_format($item->total_price, 3, '.', '.') }}₫</p>
                        <hr class="my-3">
                        <div class="bottom d-flex justify-content-start gap-2">
                            @if ($item->payment_status == 'cho_thanh_toan' && $item->payment_method == 'THANH_TOAN_ONLINE' && $item->status != 'huy_don_hang')
                                <a href="{{ route('vnpay.payment', ['order_id' => $item->id]) }}"
                                    class="order-link btn btn-success btn-sm">
                                    Thanh toán
                                </a>
                            @endif
                            @if ($item->status != 'huy_don_hang')
                                <a href="{{ route('orderDetail', ['id' => $item->id]) }}"
                                    class="order-link btn btn-gray btn-sm">
                                    Chi tiết
                                </a>
                            @endif
                            @if ($item->status == '4')
                                <div class="cancel-item" style="display: inline-block; margin-left: 10px;">
                                    <form action="{{ route('order.success', ['order_id' => $item->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="order-link btn btn-success btn-sm">Đã nhận được hàng</button>
                                    </form>
                                </div>
                            @endif
                            @if (in_array($item->status, ['1']))
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
            @endforeach
            <div class="pagination mt-4 text-center mb-2 d-flex justify-content-end">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
    </div>
    @vite(['resources/js/app.js'])
    <script>
        function confirmCancelOrder(orderId) {
            if (confirm("Bạn chắc chắn muốn hủy đơn hàng này?")) {
                document.getElementById('cancelOrderForm-' + orderId).submit();
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const targetCollapse = document.querySelector(this.getAttribute('data-bs-target'));

                    targetCollapse.addEventListener('transitionend', () => {
                        if (targetCollapse.classList.contains('show')) {
                            this.textContent = 'Ẩn';
                        } else {
                            this.textContent = 'Xem thêm';
                        }
                    }, { once: true }); // Chạy chỉ một lần để tránh lặp lại
                });
            });
        });
    </script>
@endsection
