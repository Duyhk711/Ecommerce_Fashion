@extends('layouts.client')
@section('title')
    Đặt hàng
@endsection
@section('css')
    <style>
        .font-uppercase {
            font-family: 'Quicksand', sans-serif;
        }

        .offcanvas-body {
            padding: 20px;
            padding-top: 0;
        }

        .offcanvas-body .check-icon input {
            margin-top: 5px;
        }

        .offcanvas-body .address-item {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            position: relative;
        }


        .offcanvas-body .language {
            font-weight: bold;
            margin: 0;
            padding: 0;
            /* Để tránh bị chồng lên */
        }

        .offcanvas-body .phone {
            color: #555;
        }

        .offcanvas-body .address {
            margin-top: 5px;
            color: #777;
            margin-bottom: 5px;
            font-size: 12px;
        }

        .offcanvas-body .label {
            background-color: #ff5722;
            color: white;
            padding: 3px 8px;
            border-radius: 5px;
            font-size: 12px;
            margin-right: 10px;
        }

        .offcanvas-body .buttons {
            margin-top: 5px;
        }

        .offcanvas-body .button {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 4px 6px;
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
            transition: background-color 0.3s;
            font-size: 12px;
        }

        .offcanvas-body .button:hover {
            background-color: #e0e0e0;
        }

        .offcanvas-body .action-buttons {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .offcanvas-body .action-button {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            margin-left: 10px;
            cursor: pointer;
        }

        .offcanvas-body .cancel {
            background-color: #f0f0f0;
            color: #555;
        }

        .offcanvas-body .save {
            background-color: #007bff;
            color: white;
        }

        .offcanvas-body .save:hover {
            background-color: #0056b3;
        }
    </style>
@endsection
@section('content')
    @include('client.component.page_header')
    <div class="container" style="max-width: 80%;">
        <!--Main Content-->
        <div class="container">
            <form action="{{ route('postCheckout') }}" method="POST" id="checkout">
                @csrf

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <!--Nav step checkout-->
                        <div id="nav-tabs" class="step-checkout">
                            <ul class="nav nav-tabs step-items">
                                <li class="nav-item onactive active">
                                    <a class="nav-link active" style="pointer-events: none;" data-bs-toggle="tab"
                                        href="#steps1">Giỏ hàng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" style="pointer-events: none;" data-bs-toggle="tab"
                                        href="#steps2">Địa Chỉ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" style="pointer-events: none;" data-bs-toggle="tab"
                                        href="#steps3">Thanh Toán</a>
                                </li>
                            </ul>
                        </div>
                        <!--End Nav step checkout-->

                        <!--Tab checkout content-->
                        <div class="tab-content checkout-form">
                            <div class="tab-pane active" id="steps1">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-7 col-lg-8">
                                        <!--Order Summary-->
                                        <div class="block order-summary">
                                            <div class="block-content">
                                                <h3 class="title mb-3">Tóm tắt đơn hàng</h3>
                                                <div class="table-responsive table-bottom-brd order-table">
                                                    <table class="table table-hover align-middle mb-0">
                                                        <thead>
                                                            <tr style="font-family: 'Quicksand', sans-serif">
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
                                                            <input type="hidden" name="cartItem"
                                                                value="{{ json_encode($dataCart) }}">
                                                            @foreach ($dataCart as $item)
                                                                <tr>
                                                                    <td class="text-start"><a
                                                                            href="{{ route('productDetail', $item['product_variant_id']) }}"
                                                                            class="thumb"><img
                                                                                class="rounded-0 blur-up lazyload"
                                                                                data-src="{{ Storage::url($item['image']) }}"
                                                                                src="{{ Storage::url($item['image']) }}"
                                                                                alt="product" title="product"
                                                                                width="120" height="170" /></a></td>
                                                                    <td class="text-start proName">
                                                                        <div class="list-view-item-title">
                                                                            <a href="product-layout1.html">
                                                                                {{ $item['product_name'] ?? 'Sản phẩm không xác định' }}
                                                                            </a>
                                                                        </div>
                                                                        <div class="cart-meta-text">
                                                                            {{ $item['variant_attributes'] ?? 'Không có thuộc tính' }}
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center">{{ $item['quantity'] }}</td>
                                                                    <td class="text-center">

                                                                        {{ isset($item['price']) ? number_format($item['price'], 3, '.', 0) . '₫' : 'Giá không xác định' }}
                                                                    </td>
                                                                    @php
                                                                        $total += $item['price'] * $item['quantity'];
                                                                    @endphp
                                                                    <td class="text-center">
                                                                        <strong>{{ number_format($item['price'] * $item['quantity'], 3, '.', '.') }}₫</strong>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End Order Summary-->
                                        <!--Order Comment-->
                                        <div class="block order-comments my-4">
                                            <div class="block-content">
                                                <h3 class="title mb-3">Ghi chú</h3>
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="form-group col-md-12 col-lg-12 col-xl-12 mb-0">
                                                            <textarea class="resize-both form-control" rows="3" placeholder="Viết ghi chú ở đáy" name="note"></textarea>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <!--End Order Comment-->
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-5 col-lg-4">
                                        <!--Apply Promocode-->
                                        <div class="block mb-3 apply-code mb-4">
                                            <div class="block-content">
                                                <h3 class="title mb-3">ÁP DỤNG MÃ KHUYẾN MẠI</h3>
                                                <div id="coupon" class="coupon-dec">
                                                    <p>Bạn có mã khuyến mãi? Sau đó, bạn chỉ còn một vài số và chữ cái được
                                                        kết hợp ngẫu nhiên để có được khoản tiết kiệm đáng kể!</p>
                                                    <div class="input-group mb-0 d-flex">
                                                        <input id="coupon-code" required="" type="text"
                                                            class="form-control" placeholder="Mã giảm giá"
                                                            list="voucher-list">
                                                        <datalist id="voucher-list">
                                                            <!-- Options sẽ được thêm bằng JavaScript -->
                                                        </datalist>
                                                        <button class="coupon-btn btn btn-primary" type="button"
                                                            onclick="applyCoupon()">Áp
                                                            dụng</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End Apply Promocode-->
                                        <!--Cart Summary-->
                                        <div class="cart-info mb-4">
                                            <div class="cart-order-detail cart-col">
                                                <div class="row g-0 border-bottom pb-2">
                                                    <span class="col-6 col-sm-6 cart-subtotal-title"><strong
                                                            class="font-uppercase">Tổng
                                                            cộng</strong></span>
                                                    <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end">
                                                        <span class="money">{{ number_format($total, 3, '.', '.') }}
                                                            ₫</span>
                                                    </span>
                                                </div>
                                                <div class="row g-0 border-bottom py-2">
                                                    <span class="col-6 col-sm-6 cart-subtotal-title"><strong
                                                            class="font-uppercase">Phiếu giảm giá</strong></span>
                                                    <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end">
                                                        <span class="money discount">0 ₫</span>
                                                    </span>
                                                </div>
                                                <div class="row g-0 border-bottom py-2">
                                                    <span class="col-6 col-sm-6 cart-subtotal-title font-uppercase"><strong
                                                            class="font-uppercase">Giao
                                                            hàng</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                            class="money font-uppercase">Miễn phí giao hàng</span></span>
                                                </div>
                                                <div class="row g-0 pt-2">
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title fs-6 font-uppercase"><strong>Tổng</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title fs-5 cart-subtotal text-end text-primary">
                                                        <b class="money total_price">{{ number_format($total, 3, '.', '.') }}
                                                            ₫</b>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Cart Summary-->
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary ms-1 btnNext">Next</button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="steps2">
                                <!--Shipping Address-->
                                <div class="block shipping-address mb-4">
                                    <div class="block-content">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="title mb-3">Shipping Address</h3>
                                            @auth
                                                @if (Auth::check() && !$dataAddress->isEmpty())
                                                    <a style="padding-bottom: 16px" data-bs-toggle="offcanvas"
                                                        href="#offcanvasRight" aria-controls="offcanvasRight">
                                                        Thay đổi
                                                    </a>
                                                @endif
                                            @endauth

                                        </div>

                                        <fieldset>
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label for="customer_name" class="form-label">Họ tên <span
                                                            class="required">*</span></label>
                                                    <input name="customer_name" id="customer_name" type="text"
                                                        required class="form-control"
                                                        value="{{ $address == '' ? old('customer_name') : $address->customer_name }}">
                                                </div>
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label for="customer_phone" class="form-label">Số điện thoại <span
                                                            class="required">*</span></label>
                                                    <input name="customer_phone" id="customer_phone" type="number"
                                                        required class="form-control"
                                                        value="{{ $address == '' ? old('customer_phone') : $address->customer_phone }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label for="email" class="form-label">E-Mail <span
                                                            class="required">*</span></label>
                                                    <input name="customer_email"
                                                        value="{{ Auth::check() ? Auth::user()->email : old('customer_email') }}"
                                                        id="email" type="email" required=""
                                                        class="form-control">
                                                </div>
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label for="city" class="form-label">Tỉnh/Thành phố <span
                                                            class="required">*</span></label>
                                                    <select id="city" name="city" data-default="city"
                                                        class="form-control">
                                                        <option value="" selected>
                                                            Chọn tỉnh thành</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label for="district" class="form-label">Quận/Huyện <span
                                                            class="required">*</span></label>
                                                    <select id="district" name="district" class="form-control">
                                                        <option value="" selected>
                                                            Chọn quận huyện</option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label for="ward" class="form-label">Phường/Xã <span
                                                            class="required">*</span></label>
                                                    <select id="ward" name="ward" class="form-control">
                                                        <option value="" selected>
                                                            Chọn phường xã</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label for="address_line1" class="form-label">Địa chỉ <span
                                                            class="required">*</span></label>
                                                    <input name="address_line1" id="address_line1" type="text"
                                                        required placeholder="Địa chỉ đường phố" class="form-control"
                                                        value="{{ $address == '' ? old('address_line') : $address->address_line1 }}">
                                                </div>
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label for="address_line1"
                                                        class="form-label d-none d-sm-block">&nbsp;</label>
                                                    <input name="address_line2" id="address_line2" type="text"
                                                        placeholder="Số nhà, dãy phòng, căn hộ, v.v. (tùy chọn)"
                                                        class="form-control"
                                                        value="{{ $address == '' ? old('address_line2') : $address->address_line2 }}">
                                                </div>
                                            </div>
                                            {{-- <div class="row">
                                                <div class="form-group col-md-12 col-lg-12 mb-0">
                                                    <div class="checkout-tearm customCheckbox">
                                                        <input id="checkout_tearm" name="tearm" type="checkbox"
                                                            value="checkout tearm" required />
                                                        <label for="checkout_tearm"> Save address to my account</label>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </fieldset>
                                    </div>
                                </div>
                                <!--End Shipping Address-->

                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary me-1 btnPrevious">Back</button>
                                    <button type="button" class="btn btn-primary btnNext ms-1">Next</button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="steps3">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-7 col-lg-8">
                                        <!--Payment Methods-->
                                        <div class="block mb-3 payment-methods mb-4">
                                            <div class="block-content">
                                                <h3 class="title mb-3 font-uppercase">Phương thức thanh toán</h3>
                                                <div class="payment-accordion-radio">
                                                    <div class="accordion mb-3" id="accordionExample">
                                                        <div class="accordion-item card mb-0">
                                                            <span class="customRadio clearfix mb-0">
                                                                <input id="paymentRadio4" value="COD"
                                                                    name="payment_method" type="radio" class="radio"
                                                                    checked="checked" />
                                                                <label for="paymentRadio4" class="mb-0">Thanh
                                                                    toán khi nhận hàng</label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="accordion" id="accordionExample">
                                                        <div class="accordion-item card mb-0">
                                                            <span class="customRadio clearfix mb-0">
                                                                <input id="paymentRadio1" value="THANH_TOAN_ONLINE"
                                                                    name="payment_method" type="radio"
                                                                    class="radio" />
                                                                <label for="paymentRadio1" class="mb-0">Thanh
                                                                    toán VNPay</label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End Payment Methods-->
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-5 col-lg-4">
                                        <!--Cart Summary-->
                                        <div class="cart-info">
                                            <div class="cart-order-detail cart-col">
                                                <div class="row g-0 border-bottom pb-2">
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title font-uppercase"><strong>Tổng
                                                            cộng</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end">
                                                        <span
                                                            class="money">{{ number_format($total, 3, '.', '.') }}₫</span>
                                                    </span>
                                                </div>
                                                <div class="row g-0 border-bottom py-2">
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title font-uppercase"><strong>Phiếu
                                                            giảm
                                                            giá</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end">
                                                        <span class="money discount">0 ₫</span>
                                                    </span>
                                                </div>
                                                <div class="row g-0 border-bottom py-2">
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title font-uppercase"><strong>Giao
                                                            hàng</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end font-uppercase"><span
                                                            class="money">Miễn phí giao hàng</span></span>
                                                </div>
                                                <div class="row g-0 pt-2">
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title fs-6 font-uppercase"><strong>Tổng
                                                            phải
                                                            trả</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title fs-5 cart-subtotal text-end text-primary">
                                                        <b class="money total_price">{{ number_format($total, 3, '.', '.') }}
                                                            ₫</b>
                                                    </span>
                                                </div>
                                                <input type="hidden" value="{{ $total }}" id="total_price"
                                                    name="total_price">
                                                <input type="hidden" value="{{ $total }}" id="total_price_old">
                                                <input type="hidden" value="0" id="discount" name="discount">
                                                <input type="hidden" value="" id="voucher_id" name="voucher_id">

                                                <button type="submit" id="cartCheckout"
                                                    class="btn btn-lg my-4 checkout w-100">Đặt hàng</button>
                                                <script>
                                                    document.getElementById('cartCheckout').addEventListener('click', function(event) {
                                                        // if (validateCheckout()) {
                                                        // document.getElementById('checkout').submit();
                                                        // }
                                                        document.getElementById('checkout').submit();
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <!--Cart Summary-->
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <button type="button" class="btn btn-secondary me-1 btnPrevious">Back</button>
                                </div>
                            </div>
                        </div>
                        <!--End Tab checkout content-->
                    </div>
                </div>
            </form>
        </div>
        <!--End Main Content-->
    </div>
@endsection
@section('modal')
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Địa chỉ nhận hàng</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form method="GET" action="{{ route('checkout') }}">
                @foreach ($dataAddress as $add)
                    <div class="address-item d-flex gap-2">
                        <div class="check-icon">
                            <input type="radio" value="{{ $add->id }}" name="address"
                                @if ($add->id == $address->id) checked @endif>
                        </div>
                        <div>
                            <div class="d-flex justify-content-sm-start gap-1">
                                <p class="language">{{ $add->customer_name }}</p>
                                <p class="phone">{{ $add->customer_phone }}</p>
                            </div>
                            <div class="address">
                                {{ $add->address_line2 }} {{ $add->address_line1 }}
                            </div>
                            <div class="address">
                                Mã vùng: {{ $add->ward }} - {{ $add->district }} - {{ $add->city }}
                            </div>
                            @if ($add->is_default == 1)
                                <div class="buttons">
                                    <a href="#" class="button bg-white">Địa chỉ nhận hàng mặc định</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach


                <div class="action-buttons">
                    <button class="action-button cancel" data-bs-dismiss="offcanvas" aria-label="Close">HỦY</button>
                    <button class="action-button save">LƯU</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    // Điều hướng về trang chủ sau khi thông báo thành công
                    window.location.href = '/';
                });
            @endif

        })
    </script>
    <script>
        $(document).ready(function() {
            // Thêm lớp active cho tab hiện tại
            var checkoutList = document.getElementById("nav-tabs");
            var checkoutItems = checkoutList.getElementsByClassName("nav-item");
            // Hàm lấy giá trị của tham số URL
            function getQueryParam(param) {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get(param);
            }

            // Đặt tab mặc định nếu có tham số address
            function setDefaultTab() {
                const addressParam = getQueryParam("address");
                if (addressParam) {
                    const defaultTab = checkoutItems[1]; // Nav-item số 1 (index 1)
                    const activeTabLink = defaultTab.querySelector(".nav-link");
                    const tabInstance = new bootstrap.Tab(activeTabLink);
                    tabInstance.show();
                    updateNav(defaultTab);
                } else {
                    const firstTab = checkoutItems[0]; // Nav-item mặc định (index 0)
                    const activeTabLink = firstTab.querySelector(".nav-link");
                    const tabInstance = new bootstrap.Tab(activeTabLink);
                    tabInstance.show();
                    updateNav(firstTab);
                }
            }

            // Gọi hàm thiết lập tab mặc định
            setDefaultTab();

            // for (var i = 0; i < checkoutItems.length; i++) {
            //     checkoutItems[i].addEventListener("click", function() {
            //         var current = document.getElementsByClassName("onactive");
            //         if (current.length > 0) {
            //             current[0].classList.remove("onactive");
            //         }
            //         this.classList.add("onactive");
            //         // console.log("Current nav-item index:", getActiveNavIndex());
            //     });
            // }
            // Hàm lấy chỉ số của nav-item hiện tại
            function getActiveNavIndex() {
                const itemsArray = Array.from(checkoutItems); // Chuyển NodeList thành mảng
                const activeItem = document.querySelector(".onactive");
                return activeItem ? itemsArray.indexOf(activeItem) : -1; // Trả về -1 nếu không tìm thấy
            }

            // Cập nhật nav khi chuyển đổi tab
            function updateNav(newActiveItem) {
                const current = document.getElementsByClassName("onactive");
                if (current.length > 0) {
                    current[0].classList.remove("onactive");
                }
                newActiveItem.classList.add("onactive");

            }

            function validateField(input, field) {
                const value = input.value.trim();
                let errorMessage = '';

                // Kiểm tra nếu input rỗng
                if (!value) {
                    errorMessage = field.message;
                }

                // Kiểm tra định dạng số điện thoại
                if (field.id === 'customer_phone' && value && !/^0[0-9]{9,10}$/.test(value)) {
                    errorMessage = 'Số điện thoại không hợp lệ';
                }

                // Kiểm tra định dạng email
                if (field.id === 'email' && value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                    errorMessage = 'Email không hợp lệ';
                }

                // Hiển thị hoặc xóa lỗi
                if (errorMessage) {
                    showError(input, errorMessage);
                } else {
                    clearError(input);
                }
            }

            // Hiển thị lỗi dưới input
            function showError(input, message) {
                let errorElement = input.nextElementSibling;

                // Tạo phần tử lỗi nếu chưa có
                if (!errorElement || !errorElement.classList.contains('error-message')) {
                    errorElement = document.createElement('div');
                    errorElement.classList.add('error-message', 'text-danger', 'mt-1');
                    input.parentElement.appendChild(errorElement);
                }

                errorElement.textContent = message;
                input.classList.add('is-invalid');
            }

            // Xóa lỗi
            function clearError(input) {
                const errorElement = input.nextElementSibling;
                if (errorElement && errorElement.classList.contains('error-message')) {
                    errorElement.remove();
                }
                input.classList.remove('is-invalid');
            }



            // Chuyển đến tab tiếp theo
            $('.btnNext').click(function() {
                const activeTabIndex = getActiveNavIndex();
                if (activeTabIndex != 1) {
                    const activeTab = $('.nav-link.active').closest('li');
                    const nextTab = activeTab.next('li');

                    if (nextTab.length > 0) {
                        const nextTabLinkEl = nextTab.find('a')[0];
                        const nextTabInstance = new bootstrap.Tab(nextTabLinkEl);
                        nextTabInstance.show();
                        updateNav(activeTab.next('li')[0]);
                    }
                } else {
                    const fields = [{
                            id: 'customer_name',
                            message: 'Vui lòng nhập họ tên'
                        },
                        {
                            id: 'customer_phone',
                            message: 'Vui lòng nhập số điện thoại'
                        },
                        {
                            id: 'email',
                            message: 'Vui lòng nhập email'
                        },
                        {
                            id: 'city',
                            message: 'Vui lòng chọn tỉnh/thành phố'
                        },
                        {
                            id: 'district',
                            message: 'Vui lòng chọn quận/huyện'
                        },
                        {
                            id: 'ward',
                            message: 'Vui lòng chọn phường/xã'
                        },
                        {
                            id: 'address_line1',
                            message: 'Vui lòng nhập địa chỉ'
                        },
                    ];

                    hasError = false;
                    // Kiểm tra từng trường
                    fields.forEach(field => {
                        const input = document.getElementById(field.id);
                        validateField(input, field);
                        if (input.classList.contains('is-invalid')) {
                            hasError = true;
                        }
                    });

                    if (!hasError) {
                        const activeTab = $('.nav-link.active').closest('li');
                        const nextTab = activeTab.next('li');

                        if (nextTab.length > 0) {
                            const nextTabLinkEl = nextTab.find('a')[0];
                            const nextTabInstance = new bootstrap.Tab(nextTabLinkEl);
                            nextTabInstance.show();
                            updateNav(activeTab.next('li')[0]);
                        }
                    }
                }

            });

            // Quay lại tab trước đó
            $('.btnPrevious').click(function() {
                const activeTab = $('.nav-link.active').closest('li');
                const prevTab = activeTab.prev('li');

                if (prevTab.length > 0) {
                    const prevTabLinkEl = prevTab.find('a')[0];
                    const prevTabInstance = new bootstrap.Tab(prevTabLinkEl);
                    prevTabInstance.show();
                    updateNav(activeTab.prev('li')[0]);
                    // console.log("Current nav-item index after Previous:", getActiveNavIndex());
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");

        // Giá trị được lưu trong database
        var selectedCity = '{{ $address == '' ? '' : $address->city }}';
        var selectedDistrict = '{{ $address == '' ? '' : $address->district }}';
        var selectedWard = '{{ $address == '' ? '' : $address->ward }}';

        axios.get("/address.json")
            .then(function(result) {
                renderCity(result.data);
                setDefaultValues();
            })
            .catch(function(error) {
                console.error("Lỗi khi tải dữ liệu:", error);
            });

        function renderCity(data) {
            // citis.innerHTML = ""; // Reset các option của thành phố
            data.forEach(city => {
                citis.options[citis.options.length] = new Option(city.Name, city.Name);
            });

            // Gọi hàm cập nhật quận/huyện nếu có giá trị đã chọn
            citis.onchange = function() {
                updateDistricts(data);
            };

            // Cập nhật quận/huyện nếu có giá trị đã chọn
            if (selectedCity) {
                citis.value = selectedCity;
                citis.onchange(); // Cập nhật quận/huyện
            }
        }

        function updateDistricts(data) {
            districts.innerHTML = `<option value="" selected>
                                                            Chọn quận huyện</option>`; // Reset quận/huyện
            wards.innerHTML = `<option value="" selected>
                                                            Chọn phường xã</option>`; // Reset phường/xã

            if (citis.value) {
                const cityData = data.find(n => n.Name === citis.value);
                if (cityData) {
                    cityData.Districts.forEach(district => {
                        districts.options[districts.options.length] = new Option(district.Name, district.Name);
                    });
                }
            }

            districts.onchange = function() {
                updateWards(data);
            };

            // Cập nhật phường/xã nếu có giá trị đã chọn
            if (selectedDistrict) {
                districts.value = selectedDistrict;
                districts.onchange();
            }
        }

        function updateWards(data) {
            wards.innerHTML = `<option value="" selected>
                                                            Chọn phường xã</option>`; // Reset phường/xã

            const cityData = data.find(n => n.Name === citis.value);
            // console.log('City data for wards:', cityData); // Kiểm tra dữ liệu thành phố
            if (districts.value && cityData) {
                const districtData = cityData.Districts.find(d => d.Name === districts.value);
                // console.log('District data:', districtData); // Kiểm tra dữ liệu quận/huyện
                if (districtData) {
                    districtData.Wards.forEach(ward => {
                        wards.options[wards.options.length] = new Option(ward.Name, ward.Name);
                    });
                }
            }

            // Đặt giá trị đã chọn cho phường/xã
            if (selectedWard) {
                wards.value = selectedWard;
            }
        }

        function setDefaultValues() {
            if (selectedCity) {
                citis.value = selectedCity;
                citis.onchange(); // Cập nhật quận/huyện
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        // document.getElementById('checkout').addEventListener('submit', function(event) {

        //     const customer_name = document.getElementById('customer_name');
        //     const customer_phone = document.getElementById('customer_phone');
        //     const email = document.getElementById('email');
        //     const city = document.getElementById('city');
        //     const district = document.getElementById('district');
        //     const ward = document.getElementById('ward');
        //     const address_line1 = document.getElementById('address_line1');

        //     if (customer_name.value == '') {
        //         event.preventDefault(); // Prevent navigation
        //         // Hiển thị popup lỗi với SweetAlert2
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Lỗi',
        //             text: 'Vui lòng nhập họ và tên',
        //             confirmButtonText: 'OK'
        //         });
        //         return false;
        //     }

        //     if (customer_phone.value == '') {
        //         event.preventDefault(); // Prevent navigation
        //         // Hiển thị popup lỗi với SweetAlert2
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Lỗi',
        //             text: 'Vui lòng nhập số điện thoại',
        //             confirmButtonText: 'OK'
        //         });
        //         return false;
        //     }

        //     if (email.value == '') {
        //         event.preventDefault(); // Prevent navigation
        //         // Hiển thị popup lỗi với SweetAlert2
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Lỗi',
        //             text: 'Vui lòng nhập email',
        //             confirmButtonText: 'OK'
        //         });
        //         return false;
        //     }

        //     if (city.value == '') {
        //         event.preventDefault(); // Prevent navigation
        //         // Hiển thị popup lỗi với SweetAlert2
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Lỗi',
        //             text: 'Vui lòng chọn Tỉnh/Thành phố',
        //             confirmButtonText: 'OK'
        //         });
        //         return false;
        //     }
        //     if (district.value == '') {
        //         event.preventDefault(); // Prevent navigation
        //         // Hiển thị popup lỗi với SweetAlert2
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Lỗi',
        //             text: 'Vui lòng chọn Quận/Huyện',
        //             confirmButtonText: 'OK'
        //         });
        //         return false;
        //     }
        //     if (ward.value == '') {
        //         event.preventDefault(); // Prevent navigation
        //         // Hiển thị popup lỗi với SweetAlert2
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Lỗi',
        //             text: 'Vui lòng chọn Phường/Xã',
        //             confirmButtonText: 'OK'
        //         });
        //         return false;
        //     }
        //     if (address_line1.value == '') {
        //         event.preventDefault(); // Prevent navigation
        //         // Hiển thị popup lỗi với SweetAlert2
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Lỗi',
        //             text: 'Vui lòng nhập địa chỉ cụ thế',
        //             confirmButtonText: 'OK'
        //         });
        //         return false;
        //     }

        // });

        function validateCheckout() {
            let customer_name = document.getElementById('customer_name');
            let customer_phone = document.getElementById('customer_phone');
            let email = document.getElementById('email');
            let city = document.getElementById('city');
            let district = document.getElementById('district');
            let ward = document.getElementById('ward');
            let address_line1 = document.getElementById('address_line1');

            if (customer_name.value == '') {
                event.preventDefault(); // Prevent navigation
                // Hiển thị popup lỗi với SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng nhập họ và tên',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            if (customer_phone.value == '') {
                event.preventDefault(); // Prevent navigation
                // Hiển thị popup lỗi với SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng nhập số điện thoại',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            if (email.value == '') {
                event.preventDefault(); // Prevent navigation
                // Hiển thị popup lỗi với SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng nhập email',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            if (city.value == '') {
                event.preventDefault(); // Prevent navigation
                // Hiển thị popup lỗi với SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng chọn Tỉnh/Thành phố',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            if (district.value == '') {
                event.preventDefault(); // Prevent navigation
                // Hiển thị popup lỗi với SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng chọn Quận/Huyện',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            if (ward.value == '') {
                event.preventDefault(); // Prevent navigation
                // Hiển thị popup lỗi với SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng chọn Phường/Xã',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            if (address_line1.value == '') {
                event.preventDefault(); // Prevent navigation
                // Hiển thị popup lỗi với SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng nhập địa chỉ cụ thế',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            return true;
        }
    </script>
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: '{{ $errors->first() }}', // Lấy lỗi đầu tiên
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    {{-- Voucher --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let priceOrder = document.getElementById('total_price').value;
            console.log(priceOrder);

            fetch('/api/available-vouchers')
                .then(response => response.json())
                .then(data => {
                    // console.log(data);
                    const datalist = document.getElementById('voucher-list');
                    data.forEach(voucher => {
                        if (voucher.minimum_order_value <= priceOrder) {
                            const option = document.createElement('option');
                            option.value = voucher.code;
                            option.text =
                                `Giảm (${voucher.discount_type === 'percentage' ? voucher.discount_value + '%' : voucher.discount_value*1000 + 'đ'})`;
                            datalist.appendChild(option);
                        }
                    });
                })
                .catch(error => console.error('Error loading vouchers:', error));
        });

        document.querySelector('.coupon-btn').addEventListener('click', function() {
            const code = document.getElementById('coupon-code').value;
            let priceOrder = document.getElementById('total_price_old').value;

            fetch('/apply-coupon', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        code: code,
                        order_total: priceOrder
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let discountItem = document.querySelectorAll('.discount');
                        let totalPriceItem = document.querySelectorAll('.total_price');
                        let totalPrice = document.getElementById('total_price_old').value;
                        // console.log(discount);
                        discountItem.forEach((item) => {
                            let dis = data.discount * 1000
                            item.textContent = `${dis.toLocaleString('de-DE')}₫`
                        });
                        totalPriceItem.forEach((item) => {
                            let dis = (totalPrice - data.discount) * 1000
                            item.textContent = `${dis.toLocaleString('de-DE')}₫`
                        });

                        document.getElementById('discount').value = data.discount;
                        document.getElementById('voucher_id').value = data.voucher_id;
                        document.getElementById('total_price').value = totalPrice - data.discount;
                        // discount.innerHTML = data.discount;
                        // console.log(`Giảm giá: ${data.voucher}`);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: data.message, // Lấy lỗi đầu tiên
                            confirmButtonText: 'OK'
                        });
                        // alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
