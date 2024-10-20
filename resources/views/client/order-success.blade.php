@extends('layouts.client')

@section('content')
    @include('client.component.page_header')
    <div class="container" style="max-width: 90%;">
        <!--Main Content-->
        <div class="container">
            <!--Order success-->
            <div class="success-text checkout-card text-center mb-4 mb-md-5">
                <i class="icon anm anm-shield-check"></i>
                <h2>Cảm ơn bạn đã đặt hàng!</h2>
                <p class="mb-1">Thanh toán được xử lý thành công và đơn hàng của bạn đang được xử lý</p>
                <p class="mb-1">Bạn sẽ nhận được email xác nhận đơn hàng với chi tiết về đơn đặt hàng của bạn và liên kết
                    đến theo dõi tiến trình của nó.</p>
                {{-- <p class="text-order badge bg-success mt-3">Transaction ID: GHERT05764</p> --}}
            </div>
            <!--End Order success-->

            <div class="row checkout-form">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <!--Order Summary-->
                    <div class="block order-summary">
                        <div class="block-content">
                            <h3 class="title mb-3">Tóm tắt đơn hàng</h3>
                            <div class="table-responsive-sm table-bottom-brd order-table">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-start">Ảnh</th>
                                            <th class="text-start proName">Sản phẩm</th>
                                            <th class="text-center">SL</th>
                                            <th class="text-center">giá</th>
                                            <th class="text-center">Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($orderItems as $item)
                                            <tr>
                                                <td class="text-start"><a
                                                        href="{{ route('productDetail', $item->product_variant_id) }}"
                                                        class="thumb"><img class="rounded-0 blur-up lazyload"
                                                            data-src="{{ $item->variant_image }}"
                                                            src="{{ $item->variant_image }}" alt="product" title="product"
                                                            width="120" height="170" /></a></td>
                                                <td class="text-start proName">
                                                    <div class="list-view-item-title">
                                                        <a href="product-layout1.html">
                                                            {{ $item->product_name ?? 'Sản phẩm không xác định' }}
                                                        </a>
                                                    </div>
                                                    <div class="cart-meta-text">
                                                        {{ $item->variant_attributes ?? 'Không có thuộc tính' }}
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-center">
                                                    {{ isset($item->variant_price_sale) ? number_format($item->variant_price_sale, 3, '.', 0) . ' VND' : 'Giá không xác định' }}
                                                </td>
                                                @php
                                                    $total += $item->variant_price_sale * $item->quantity;
                                                @endphp
                                                <td class="text-center">
                                                    <strong>{{ number_format($item->variant_price_sale * $item->quantity, 3, '.', 0) }}
                                                        VND</strong>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Order Summary-->

                    <!--Cart Summary-->
                    <div class="cart-info mt-4 mb-4 mb-lg-0">
                        <div class="cart-order-detail cart-col">
                            <div class="row g-0 border-bottom pb-2">
                                <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Tổng cộng</strong></span>
                                <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                        class="money">{{ number_format($total, 3, '.', 0) }} VND</span></span>
                            </div>
                            <div class="row g-0 border-bottom py-2">
                                <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Phiếu giảm giá</strong></span>
                                <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                        class="money">-0 VND</span></span>
                            </div>
                            <div class="row g-0 border-bottom py-2">
                                <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Giao hàng</strong></span>
                                <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                        class="money">Miễn phí giao hàng</span></span>
                            </div>
                            <div class="row g-0 pt-2">
                                <span class="col-6 col-sm-6 cart-subtotal-title fs-6"><strong>Tổng</strong></span>
                                <span class="col-6 col-sm-6 cart-subtotal-title fs-5 cart-subtotal text-end text-primary"><b
                                        class="money">{{ number_format($order->total_price, 3, '.', 0) }}VND</b></span>
                            </div>
                        </div>
                    </div>
                    <!--Cart Summary-->
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <!--Order Address-->
                    <div class="block">
                        <div class="block-content">
                            <div class="row g-0">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="shipping-details mb-4 mb-sm-0">
                                        <h3 class="title mb-3">Chi tiết đơn hàng</h3>
                                        <p>Mã đơn: {{ $order->sku }}</p>
                                        <p>Ngày đặt: {{ $order->created_at }}</p>
                                        <p>Tổng: {{ number_format($order->total_price, 3, '.', 0) }} VND</p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="shipping-details mb-4 mb-sm-0">
                                        <h3 class="title mb-3">Địa chỉ giao hàng</h3>

                                        <p>{{ $order->customer_name }}</p>
                                        <p>{{ $order->customer_phone }}</p>
                                        <p>{{ $order->address_line2 ? $order->address_line2 . ', ' : '' }}{{ $order->address_line1 }}
                                        </p>
                                        <p>{{ $order->ward }} - {{ $order->district }} -
                                            {{ $order->city }}</p>
                                    </div>
                                </div>
                                {{-- <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="billing-details">
                                        <h3 class="title mb-3">Billing Address</h3>
                                        <p>No 40 Gallaxy Enque Street 133/2,</p>
                                        <p>New York,</p>
                                        <p>USA</p>
                                        <p>00004-1988</p>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <!--Order Address-->

                    {{-- <!--Order Method-->
                    <div class="block mt-4">
                        <div class="block-content">
                            <div class="row g-0">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="shipping-details mb-4 mb-sm-0">
                                        <h3 class="title mb-3">Shipping Method</h3>
                                        <p>Flat Rate - Fixeds</p>
                                        <p>Delivery Date: N/A</p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="billing-details">
                                        <h3 class="title mb-3">Payment Method</h3>
                                        <p>Check / Money order</p>
                                        <p>Cash on delivery</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Order Method--> --}}

                    <!--Order Details-->
                    {{-- <div class="block mt-4">
                        <div class="block-content">
                            <div class="row g-0">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="shipping-details mb-4 mb-sm-0">
                                        <h3 class="title mb-3">Order details</h3>
                                        <p>Order ID: GHERT05764</p>
                                        <p>Order Date: October 14, 2023</p>
                                        <p>Order Total: $311.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!--End Order Details-->

                    <!--Order Delivery-->
                    <div class="d-flex-wrap w-100 mt-4 text-center">
                        <a href="{{ route('home') }}"
                            class="d-inline-flex align-items-center btn btn-outline-primary me-2 mb-2 me-sm-3"><i
                                class="me-2 icon an an-angle-left-r"></i>Tiếp tục mua hàng</a>
                        {{-- <button type="button" class="d-inline-flex align-items-center btn me-2 mb-2 me-sm-3"><i
                                class="me-2 icon an an-print"></i>Print Order</button>
                        <button type="button" class="d-inline-flex align-items-center btn me-2 mb-2 me-sm-3"><i
                                class="me-2 icon an an-sync-ar"></i>Re-Order</button> --}}
                    </div>
                    <!--Order delivery-->
                </div>
            </div>
        </div>
    </div>
@endsection
