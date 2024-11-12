@extends('layouts.client')
@section('title')
    Giỏ hàng
@endsection
@section('css')
    <!-- Đặt CSS tùy chỉnh nếu cần -->
    <!-- CSS cho Modal Popup -->
    <style>
        .btn-delete {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .btn-delete:focus {
            outline: none;
        }

        .btn-delete i {
            color: red;
        }

        /* Chrome, Safari, Edge, Opera */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="checkbox"]:checked {
            accent-color: #d66174;
        }

        /* Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }

        p,
        .color {
            color: #88837f;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        th {
            font-weight: normal;
            text-transform: none;
        }
    </style>
@endsection

@section('content')
    @include('client.component.page_header')

    <div class="container">
        <form id="cart-form" class="cart-table table-bottom-brd" method="GET" action="{{ route('checkout') }}">
            @csrf
            @if (count($cartItems) == 0)
                <div class="cart-empty mb-3">
                    <div class="text-center">
                        <!-- Hình ảnh giỏ hàng trống -->
                        <img src="{{ asset('client/images/empty-cart.png') }}" alt="Giỏ hàng trống" class="img-fluid"
                            style="max-width: 300px;">
                        <h3 class="mt-3">Giỏ hàng của bạn đang trống!</h3>
                        <p>Hãy tiếp tục mua sắm và thêm sản phẩm vào giỏ hàng của bạn.</p>
                        <!-- Nút tiếp tục mua sắm -->
                        <a href="{{ route('shop') }}" class="btn btn-primary mt-4">Tiếp tục mua sắm</a>
                    </div>
                </div>
            @else
                <!-- Cart content here if not empty -->
                <div class="row">
                    <!--Cart Content-->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 main-col">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                            <table class="table align-middle">
                                <thead class="cart-row cart-header small-hide position-relative">
                                    <tr>
                                        <th class="color"><input type="checkbox" id="checkAll"> Chọn tất cả</th>
                                        <th colspan="2" class="text-start">Sản phẩm</th>
                                        <th class="text-center color">Đơn giá</th>
                                        <th class="text-center color">Số lượng</th>
                                        <th class="text-center color">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <!-- Khung để thêm sản phẩm giỏ hàng -->

                                        <tr class="cart-row cart-flex position-relative">
                                            <td><input type="checkbox" class="cart-checkbox" name="selected_items[]"
                                                    value="{{ $item['product_variant_id'] }}"
                                                    data-price="{{ $item['price'] }}"
                                                    data-quantity="{{ $item['quantity'] }}"></td>
                                            <td class="cart-image cart-flex-item">
                                                <a href="#">
                                                    <img class="cart-image rounded-0 blur-up lazyload"
                                                        src="{{ asset('storage/'. $item['image']) }}" alt="Product" width="120"
                                                        height="170" />
                                                </a>
                                            </td>
                                            <td class="cart-meta small-text-left cart-flex-item">
                                                <div class="list-view-item-title">
                                                    <a href="#"
                                                        style="font-weight: 500;">{{ $item['product_name'] ?? 'Sản phẩm không xác định' }}</a>
                                                </div>
                                                <div class="cart-meta-text">
                                                    <p> {{ $item['variant_attributes'] ?? 'Không có thuộc tính' }}</p>
                                                </div>
                                            </td>
                                            <td class="cart-price cart-flex-item text-center small-hide">
                                                <span class="money"
                                                    data-price="0.00">{{ isset($item['price']) * 1000 ? number_format($item['price'] * 1000, 0, ',', '.') . '₫' : 'Giá không xác định' }}</span>
                                            </td>
                                            <td class="cart-update-wrapper cart-flex-item text-end text-md-center">
                                                <div class="cart-qty d-flex justify-content-end justify-content-md-center">
                                                    <div class="input-group" style="max-width: 150px;">
                                                        @if (isset($item['cart_item_id']))
                                                            <input type="hidden" name="cart_item_id"
                                                                value="{{ $item['cart_item_id'] }}">
                                                        @else
                                                            <input type="hidden" name="product_variant_id"
                                                                value="{{ $item['product_variant_id'] }}">
                                                        @endif
                                                        <input type="hidden" class="max-stock"
                                                            value="{{ $item['stock'] }}">
                                                        <!-- Thêm số lượng tồn kho -->

                                                        <!-- Nút giảm số lượng (-) -->
                                                        <button class=" btn-sm decrease-quantity" type="button"
                                                            onclick="changeQuantity(this, -1)"
                                                            {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>-</button>

                                                        <!-- Input hiển thị số lượng sản phẩm -->
                                                        <input type="number"
                                                            class="form-control form-control-sm quantity-input text-center"
                                                            value="{{ $item['quantity'] ?? '0' }}" min="1"
                                                            data-price="{{ $item['price'] }}" style="max-width: 60px; ">

                                                        <!-- Nút tăng số lượng (+), vô hiệu hóa nếu đạt số lượng tồn kho -->
                                                        <button class=" btn-sm increase-quantity" type="button"
                                                            onclick="changeQuantity(this, 1)"
                                                            {{ $item['quantity'] >= $item['stock'] ? 'disabled' : '' }}>+</button>

                                                    </div>
                                                </div>
                                            </td>

                                            {{-- <td class="cart-delete text-center small-hide"> --}}
                                            <td class="text-center">
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    @csrf
                                                    @if (isset($item['cart_item_id']))
                                                        <input type="hidden" name="cart_item_id"
                                                            value="{{ $item['cart_item_id'] }}">
                                                    @else
                                                        <input type="hidden" name="product_variant_id"
                                                            value="{{ $item['product_variant_id'] }}">
                                                    @endif
                                                    <button type="submit" class="cart-remove remove-icon btn-delete"
                                                        data-bs-toggle="tooltip" title="Xóa">
                                                        <i class="icon anm anm-times-r me-1"></i>
                                                    </button>
                                                </form>
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
                                    </tr>
                                </tfoot>
                            </table>

                            <!--End Cart Form-->
                        </div>
                        <!--End Cart Content-->
                    </div>
                    <!--End Cart Content-->

                    <!--Cart Sidebar-->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 cart-footer">
                        <div class="cart-info sidebar-sticky">
                            <div class="cart-order-detail cart-col">
                                <div class="row g-0 border-bottom py-2">
                                    <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Giao hàng</strong></span>
                                    <span class="col-6 col-sm-6 cart-subtotal text-end"><span class="money">Miễn phí giao
                                            hàng</span></span>
                                </div>
                                <div class="row g-0 pt-2">
                                    <span class="col-6 col-sm-6 cart-subtotal-title fs-6"><strong>Tổng tiền</strong></span>
                                    <span
                                        class="col-6 col-sm-6 cart-subtotal-title fs-5 cart-subtotal text-end text-primary"><b
                                            class="money" id="totalPrice"
                                            style="color: red; font-weight: 500">0₫</b></span>
                                </div>

                                <p class="cart-shipping mt-3"></p>
                                <p class="cart-shipping fst-normal freeShipclaim"><i
                                        class="me-2 align-middle icon anm anm-truck-l"></i><b>ĐỦ ĐIỀU KIỆN</b> MIỄN PHÍ VẬN
                                    CHUYỂN
                                </p>
                                <div class="customCheckbox cart-tearm">
                                    <input type="checkbox" value="allen-vela" id="cart-tearm">
                                    <label for="cart-tearm">Tôi đồng ý với các điều khoản và điều kiện</label>
                                </div>
                                <button type="submit" id="cartCheckout" class="btn btn-lg my-4 checkout w-100">THANH
                                    TOÁN</button>
                                <div class="paymnet-img text-center"><img
                                        src="{{ asset('client/images/icons/safepayment.png') }}" alt="Payment"
                                        width="299" height="28" /></div>
                            </div>
                        </div>
                    </div>
                    <!--End Cart Sidebar-->
                    <!-- Modal Popup -->
                    <div id="quantityPopup" class="modal" style="display: none;">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <p id="popupMessage"></p>
                        </div>
                    </div>
                </div>
            @endif

        </form>
    </div>
@endsection

@section('js')
    <script>
        const updateUrl = "{{ route('cart.update') }}";
        const csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('client/js/cart/cart.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('cart-form').addEventListener('submit', function(event) {
            const selectedItems = [];
            document.querySelectorAll('.cart-checkbox:checked').forEach(function(checkbox) {
                selectedItems.push(checkbox.value); // Lưu lại ID của sản phẩm đã chọn
            });

            const checkBox = document.getElementById('cart-tearm');

            if (selectedItems.length === 0) {
                event.preventDefault();

                // Hiển thị popup lỗi với SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng chọn ít nhất một sản phẩm.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (!checkBox.checked) {
                event.preventDefault(); // Prevent navigation
                // Hiển thị popup lỗi với SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng đồng ý với các điều khoản và điều kiện trước khi tiến hành thanh toán.',
                    confirmButtonText: 'OK'
                });
                return;
            }
        });
    </script>
@endsection
