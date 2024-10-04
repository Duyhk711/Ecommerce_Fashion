@extends('client.my-account')

@section('my-order')
    <div>
        <div class="orders-card mt-0 h-100">
            <div class="top-sec d-flex-justify-center justify-content-between mb-4">
                <h2 class="mb-0">Đơn hàng của tôi</h2>
            </div>

            <div class="table-bottom-brd table-responsive">
                <table class="table align-middle text-center order-table">
                    <thead>
                        <tr class="table-head text-nowrap">
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">PTTT</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                            <tr>
                                <td><span class="id">{{ $item->sku }}</span></td>
                                {{-- Hiển thị tổng số lượng sản phẩm --}}
                                <td>
                                    <span class="name">{{ $item->items->count() }}</span>
                                </td>
                                {{-- Tổng tiền của đơn hàng --}}
                                <td><span class="price fw-500">{{ number_format($item->total_price, 0, ',', '.') }}đ</span>
                                </td>
                                {{-- Trạng thái đơn hàng với màu sắc --}}
                                <td>
                                    <span
                                        class="badge text-bg
                                                @if ($item->status == 'Chờ xác nhận') bg-secondary text-dark
                                                @elseif($item->status == 'Đang chuẩn bị') bg-secondary
                                                @elseif($item->status == 'Đã chuẩn bị') bg-warning text-dark
                                                @elseif($item->status == 'Đang vận chuyển') bg-primary
                                                @elseif($item->status == 'Đã giao hàng') bg-success 
                                                @elseif($item->status == 'Đơn hàng đã hủy') bg-danger @endif">
                                        {{ $item->status }}
                                    </span>

                                </td>
                                {{-- Trạng thái thanh toán --}}
                                <td><span
                                        class="badge rounded-pill bg-success custom-badge">{{ ucfirst($item->payment_status) }}</span>
                                </td>
                                {{-- Cột hành động: Nút đánh giá hoặc chi tiết đơn hàng --}}
                                <td class="cursor-pointer">
                                    {{-- Icon xem chi tiết đơn hàng --}}
                                    <a href="{{ route('orderDetail', ['id' => $item->id]) }}" class="order-link">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24">
                                            <circle cx="12" cy="12" r="10" fill="#ffffff" stroke="#000000"
                                                stroke-width="2" />
                                            <path d="M12 8v8M8 12h8" stroke="#000000" stroke-width="2"
                                                stroke-linecap="round" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
