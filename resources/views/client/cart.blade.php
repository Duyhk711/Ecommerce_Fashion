@extends('layouts.client')

@section('css')
    <!-- Đặt CSS tùy chỉnh nếu cần -->
@endsection

@section('content')
    @include('client.component.page_header')

    <div class="container">
        <div class="row">
            <!--Cart Content-->
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 main-col">
                {{-- <div class="alert alert-success py-2 alert-dismissible fade show cart-alert" role="alert">
                    <i class="align-middle icon anm anm-truck icon-large me-2"></i>
                    <strong class="text-uppercase">Congratulations!</strong> You've got free shipping!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> --}}
                <!--End Alert msg-->
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                    {{-- @if (session('success'))
                        <div class="alert alert-success py-2 alert-dismissible fade show cart-alert" role="alert">
                            <i class="align-middle icon anm anm-truck icon-large me-2"></i>
                            <strong class="text-uppercase">Congratulations!</strong> You've got free shipping!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif --}}

                    <!--Cart Form-->
                    <form id="cart-form" class="cart-table table-bottom-brd">
                        @csrf
                        <table class="table align-middle">
                            <thead class="cart-row cart-header small-hide position-relative">
                                <tr>
                                    {{-- <th class="action">&nbsp;</th> --}}
                                    <th><input type="checkbox" id="checkAll"> Chọn tất cả</th>
                                    <th colspan="2" class="text-start">Sản phẩm</th>
                                    {{-- <th class="text-center">Biến thể</th> --}}
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <!-- Khung để thêm sản phẩm giỏ hàng -->
                                    <tr class="cart-row cart-flex position-relative">

                                        <td><input type="checkbox" class="cart-checkbox" data-price="{{ $item['price'] }}"
                                                data-quantity="{{ $item['quantity'] }}"></td>
                                        <td class="cart-image cart-flex-item">
                                            <a href="#">
                                                <img class="cart-image rounded-0 blur-up lazyload" src="{{$item['image']}}"
                                                    alt="Product" width="120" height="170" />
                                            </a>
                                        </td>
                                        <td class="cart-meta small-text-left cart-flex-item">
                                            <div class="list-view-item-title">
                                                <a
                                                    href="#">{{ $item['product_name'] ?? 'Sản phẩm không xác định' }}</a>
                                            </div>
                                            <div class="cart-meta-text">
                                                {{ $item['variant_attributes'] ?? 'Không có thuộc tính' }}
                                            </div>
                                            {{-- <div class="cart-price d-md-none">
                                                <span class="money fw-500" data-price="0.00">{{ isset($item['price']) ? number_format($item['price'], 0, ',', '.') . ' VND' : 'Giá không xác định' }}</span>
                                            </div> --}}
                                        </td>
                                        <td class="cart-price cart-flex-item text-center small-hide">
                                            <span class="money"
                                                data-price="0.00">{{ isset($item['price']) ? number_format($item['price'], 0, ',', '.') . ' VND' : 'Giá không xác định' }}</span>
                                        </td>
                                        <td class="cart-update-wrapper cart-flex-item text-end text-md-center">
                                            <div class="cart-qty d-flex justify-content-end justify-content-md-center">
                                                <div class="input-group" style="max-width: 150px;">
                                                    @if (isset($item['cart_item_id']))
                                                        <input type="hidden" name="cart_item_id"
                                                            value="{{ $item['cart_item_id'] }}">
                                                    @else
                                                        <input type="hidden" name="variant_id" value="{{ $item['id'] }}">
                                                    @endif

                                                    <button class=" btn-sm" type="button"
                                                        onclick="changeQuantity(this, -1)">-</button>
                                                    <input type="number"
                                                        class="form-control form-control-sm quantity-input text-center"
                                                        value="{{ $item['quantity'] ?? '0' }}" min="1"
                                                        data-price="{{ $item['price'] }}" style="max-width: 60px;">
                                                    <button class=" btn-sm" type="button"
                                                        onclick="changeQuantity(this, 1)">+</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart-delete text-center small-hide">
                                            <td>
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    @csrf
                                                    @if (isset($item['cart_item_id']))
                                                        <input type="hidden" name="cart_item_id" value="{{ $item['cart_item_id'] }}">
                                                    @else
                                                        <input type="hidden" name="product_variant_id" value="{{ $item['id'] }}">
                                                    @endif
                                                    <button type="submit" class="cart-remove remove-icon" data-bs-toggle="tooltip" title="Xóa">
                                                        <i class="icon anm anm-times-r me-1"></i> 
                                                    </button>
                                                </form>
                                            </td>
                                            {{-- <a href="#" class="cart-remove remove-icon">
                                                <i class="icon anm anm-times-r"></i>
                                            </a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-start">
                                        <a href="{{ route('shop') }}"
                                            class="btn btn-outline-secondary btn-sm cart-continue">
                                            <i class="icon anm anm-angle-left-r me-2 d-none"></i> Tiếp tục mua hàng
                                        </a>
                                    </td>
                                    {{-- <td colspan="3" class="text-end">
                                        <button type="submit" name="clear"
                                            class="btn btn-outline-secondary btn-sm small-hide">
                                            <i class="icon anm anm-times-r me-2 d-none"></i> Clear Shopping Cart
                                        </button>
                                        <button type="submit" name="update"
                                            class="btn btn-secondary btn-sm cart-continue ms-2">
                                            <i class="icon anm anm-sync-ar me-2 d-none"></i> Update Cart
                                        </button>
                                    </td> --}}
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                    <!--End Cart Form-->
                </div>
                <!--End Cart Content-->
            </div>
            <!--End Cart Content-->

            <!--Cart Sidebar-->
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 cart-footer">
                <div class="cart-info sidebar-sticky">
                    <div class="cart-order-detail cart-col">
                        {{-- <div class="row g-0 border-bottom pb-2">
                            <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Subtotal</strong></span>
                            <span class="col-6 col-sm-6 cart-subtotal text-end"><span class="money"
                                >0.00</span></span>
                        </div> --}}
                        <div class="row g-0 border-bottom py-2">
                            <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Giao hàng</strong></span>
                            <span class="col-6 col-sm-6 cart-subtotal text-end"><span class="money">Miễn phí giao hàng</span></span>
                        </div>
                        <div class="row g-0 pt-2">
                            <span class="col-6 col-sm-6 cart-subtotal-title fs-6"><strong>Tổng tiền</strong></span>
                            <span class="col-6 col-sm-6 cart-subtotal-title fs-5 cart-subtotal text-end text-primary"><b
                                    class="money" id="totalPrice">0.00</b></span>
                        </div>

                        <p class="cart-shipping mt-3"></p>
                        <p class="cart-shipping fst-normal freeShipclaim"><i
                                class="me-2 align-middle icon anm anm-truck-l"></i><b>ĐỦ ĐIỀU KIỆN</b> MIỄN PHÍ VẬN CHUYỂN</p>
                        <div class="customCheckbox cart-tearm">
                            <input type="checkbox" value="allen-vela" id="cart-tearm">
                            <label for="cart-tearm">Tôi đồng ý với các điều khoản và điều kiện</label>
                        </div>
                        <a href="{{ route('checkout') }}" id="cartCheckout"
                            class="btn btn-lg my-4 checkout w-100">THANH TOÁN</a>
                        <div class="paymnet-img text-center"><img
                                src="{{ asset('client/images/icons/safepayment.png') }}" alt="Payment" width="299"
                                height="28" /></div>
                    </div>
                </div>
            </div>
            <!--End Cart Sidebar-->
        </div>
    </div>
@endsection

@section('js')
   <script>
       const updateUrl = "{{ route('cart.update') }}";
       const csrfToken = "{{ csrf_token() }}";
   </script>
   <script src="{{ asset('client/js/cart/cart.js') }}"></script>
@endsection
