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
                        <th scope="col">Mặt hàng</th>
                        <th scope="col">Tổng</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">PTTT</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <td><span class="id">{{$item->sku}}</span></td>
                            <td>
                                @php
                                    $totalQuantity = $item->items->sum('quantity');
                                @endphp
                                <span class="name">{{$totalQuantity}}</span>
                            </td>
                            <td><span class="price fw-500">{{number_format($item->total_price, 3, '.', 0)}}đ</span></td>
                            <td><span class="badge rounded-pill bg-success custom-badge">{{$item->status}}</span></td>
                            <td><span class="badge rounded-pill bg-success custom-badge">{{$item->payment_method}}</span></td>
                            <td class="cursor-pointer" 
                                data-bs-toggle="modal" 
                                data-bs-target="#orderModal" 
                                data-order="{{ json_encode($item) }}" 
                                data-items="{{ json_encode($item->items) }}"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <circle cx="12" cy="12" r="10" fill="#ffffff" stroke="#000000" stroke-width="2"/>
                                    <path d="M12 8v8M8 12h8" stroke="#000000" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </td>                                                                                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

