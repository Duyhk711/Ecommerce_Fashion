@extends('layouts.client')
@section('css')
    <style>
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
            <form action="">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <!--Nav step checkout-->
                        <div id="nav-tabs" class="step-checkout">
                            <ul class="nav nav-tabs step-items">
                                <li class="nav-item onactive active">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#steps1">Địa Chỉ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#steps2">Tóm Tắt</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#steps3">Thanh Toán</a>
                                </li>
                            </ul>
                        </div>
                        <!--End Nav step checkout-->

                        <!--Tab checkout content-->
                        <div class="tab-content checkout-form">
                            <div class="tab-pane active" id="steps1">
                                <!--Shipping Address-->
                                <div class="block shipping-address mb-4">
                                    <div class="block-content">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="title mb-3">Shipping Address</h3>
                                            <a style="padding-bottom: 16px" data-bs-toggle="offcanvas"
                                                href="#offcanvasRight" aria-controls="offcanvasRight">
                                                Thay đổi
                                            </a>

                                        </div>

                                        <fieldset>
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label for="customer_name" class="form-label">Họ tên <span
                                                            class="required">*</span></label>
                                                    <input name="customer_name" value="" id="customer_name"
                                                        type="text" required class="form-control">
                                                </div>
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label for="customer_phone" class="form-label">Số điện thoại <span
                                                            class="required">*</span></label>
                                                    <input name="customer_phone" value="" id="customer_phone"
                                                        type="tel" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label for="email" class="form-label">E-Mail <span
                                                            class="required">*</span></label>
                                                    <input name="email" value="" id="email" type="email"
                                                        required="" class="form-control">
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
                                                    <input name="address_line1" value="" id="address_line1"
                                                        type="text" required placeholder="Địa chỉ đường phố"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label for="address_line1"
                                                        class="form-label d-none d-sm-block">&nbsp;</label>
                                                    <input name="address_line2" value="" id="address_line2"
                                                        type="text"
                                                        placeholder="Số nhà, dãy phòng, căn hộ, v.v. (tùy chọn)"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12 col-lg-12 mb-0">
                                                    <div class="checkout-tearm customCheckbox">
                                                        <input id="checkout_tearm" name="tearm" type="checkbox"
                                                            value="checkout tearm" required />
                                                        <label for="checkout_tearm"> Save address to my account</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <!--End Shipping Address-->

                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary btnNext ms-1">Next</button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="steps2">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-7 col-lg-8">
                                        <!--Order Summary-->
                                        <div class="block order-summary">
                                            <div class="block-content">
                                                <h3 class="title mb-3">Tóm tắt đơn hàng</h3>
                                                <div class="table-responsive table-bottom-brd order-table">
                                                    <table class="table table-hover align-middle mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th class="action">&nbsp;</th>
                                                                <th class="text-start">Image</th>
                                                                <th class="text-start proName">Product</th>
                                                                <th class="text-center">Qty</th>
                                                                <th class="text-center">Price</th>
                                                                <th class="text-center">Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center cart-delete"><a href="#"
                                                                        class="btn btn-secondary cart-remove remove-icon position-static"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="Remove to Cart"><i
                                                                            class="icon anm anm-times-r"></i></a></td>
                                                                <td class="text-start"><a href="product-layout1.html"
                                                                        class="thumb"><img
                                                                            class="rounded-0 blur-up lazyload"
                                                                            data-src="assets/images/products/product1-120x170.jpg"
                                                                            src="assets/images/products/product1-120x170.jpg"
                                                                            alt="product" title="product" width="120"
                                                                            height="170" /></a></td>
                                                                <td class="text-start proName">
                                                                    <div class="list-view-item-title">
                                                                        <a href="product-layout1.html">Oxford Cuban
                                                                            Shirt</a>
                                                                    </div>
                                                                    <div class="cart-meta-text">
                                                                        Color: Black<br>Size: Small
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">2</td>
                                                                <td class="text-center">$99.00</td>
                                                                <td class="text-center"><strong>$198.00</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center cart-delete"><a href="#"
                                                                        class="btn btn-secondary cart-remove remove-icon position-static"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="Remove to Cart"><i
                                                                            class="icon anm anm-times-r"></i></a></td>
                                                                <td class="text-start"><a href="product-layout1.html"
                                                                        class="thumb"><img
                                                                            class="rounded-0 blur-up lazyload"
                                                                            data-src="assets/images/products/product2-120x170.jpg"
                                                                            src="assets/images/products/product2-120x170.jpg"
                                                                            alt="product" title="product" width="120"
                                                                            height="170" /></a></td>
                                                                <td class="text-start proName">
                                                                    <div class="list-view-item-title">
                                                                        <a href="product-layout1.html">Cuff Beanie Cap</a>
                                                                    </div>
                                                                    <div class="cart-meta-text">
                                                                        Color: Black<br>Size: Small
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">1</td>
                                                                <td class="text-center">$128.00</td>
                                                                <td class="text-center"><strong>$128.00</strong></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End Order Summary-->
                                        <!--Order Comment-->
                                        <div class="block order-comments my-4">
                                            <div class="block-content">
                                                <h3 class="title mb-3">Order Comment</h3>
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="form-group col-md-12 col-lg-12 col-xl-12 mb-0">
                                                            <textarea class="resize-both form-control" rows="3" placeholder="Place your comment here"></textarea>
                                                            <small class="mt-2 d-block">*Savings include promotions,
                                                                coupons,
                                                                rueBUCKS, and shipping (if applicable).</small>
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
                                                <h3 class="title mb-3">Apply Promocode</h3>
                                                <div id="coupon" class="coupon-dec">
                                                    <p>Got a promo code? Then you're a few randomly combined numbers &
                                                        letters
                                                        away from fab savings!</p>
                                                    <div class="input-group mb-0 d-flex">
                                                        <input id="coupon-code" required="" type="text"
                                                            class="form-control" placeholder="Promotion/Discount Code">
                                                        <button class="coupon-btn btn btn-primary"
                                                            type="submit">Apply</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End Apply Promocode-->
                                        <!--Cart Summary-->
                                        <div class="cart-info mb-4">
                                            <div class="cart-order-detail cart-col">
                                                <div class="row g-0 border-bottom pb-2">
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title"><strong>Subtotal</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                            class="money">$326.00</span></span>
                                                </div>
                                                <div class="row g-0 border-bottom py-2">
                                                    <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Coupon
                                                            Discount</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                            class="money">-$25.00</span></span>
                                                </div>
                                                <div class="row g-0 border-bottom py-2">
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title"><strong>Tax</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                            class="money">$10.00</span></span>
                                                </div>
                                                <div class="row g-0 border-bottom py-2">
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title"><strong>Shipping</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                            class="money">Free shipping</span></span>
                                                </div>
                                                <div class="row g-0 pt-2">
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title fs-6"><strong>Total</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title fs-5 cart-subtotal text-end text-primary"><b
                                                            class="money">$311.00</b></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Cart Summary-->
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary me-1 btnPrevious">Back</button>
                                    <button type="button" class="btn btn-primary ms-1 btnNext">Next</button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="steps3">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-7 col-lg-8">
                                        <!--Payment Methods-->
                                        <div class="block mb-3 payment-methods mb-4">
                                            <div class="block-content">
                                                <h3 class="title mb-3">Payment Methods</h3>
                                                <div class="payment-accordion-radio">
                                                    <div class="accordion" id="accordionExample">
                                                        <div class="accordion-item card mb-2">
                                                            <div class="card-header" id="headingOne">
                                                                <button class="card-link" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                                    aria-controls="collapseOne">
                                                                    <span class="customRadio clearfix mb-0">
                                                                        <input id="paymentRadio1" value="1"
                                                                            name="payment" type="radio" class="radio"
                                                                            checked="checked" />
                                                                        <label for="paymentRadio1" class="mb-0">Pay with
                                                                            credit card</label>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                                aria-labelledby="headingOne"
                                                                data-bs-parent="#accordionExample">
                                                                <div class="card-body px-0">
                                                                    <fieldset>
                                                                        <div class="row">
                                                                            <div
                                                                                class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                                                <label for="input-cardname">Name on Card
                                                                                    <span class="required">*</span></label>
                                                                                <input name="cardname" value=""
                                                                                    placeholder="" id="input-cardname"
                                                                                    class="form-control" type="text"
                                                                                    pattern="[0-9\-]*">
                                                                            </div>
                                                                            <div
                                                                                class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                                                <label>Credit Card Type <span
                                                                                        class="required">*</span></label>
                                                                                <select name="country_id"
                                                                                    class="form-control">
                                                                                    <option value="">Please Select
                                                                                    </option>
                                                                                    <option value="1">American Express
                                                                                    </option>
                                                                                    <option value="2">Visa Card
                                                                                    </option>
                                                                                    <option value="3">Master Card
                                                                                    </option>
                                                                                    <option value="4">Discover Card
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div
                                                                                class="form-group col-12 col-sm-4 col-md-4 col-lg-4">
                                                                                <label for="input-cardno">Credit Card
                                                                                    Number
                                                                                    <span class="required">*</span></label>
                                                                                <input name="cardno" value=""
                                                                                    placeholder="" id="input-cardno"
                                                                                    class="form-control" type="text"
                                                                                    pattern="[0-9\-]*">
                                                                            </div>
                                                                            <div
                                                                                class="form-group col-12 col-sm-4 col-md-4 col-lg-4">
                                                                                <label for="input-cvv">CVV Code <span
                                                                                        class="required">*</span></label>
                                                                                <input name="cvv" value=""
                                                                                    placeholder="" id="input-cvv"
                                                                                    class="form-control" type="text"
                                                                                    pattern="[0-9\-]*">
                                                                            </div>
                                                                            <div
                                                                                class="form-group col-12 col-sm-4 col-md-4 col-lg-4">
                                                                                <label>Expiration Date <span
                                                                                        class="required">*</span></label>
                                                                                <input type="date" name="exdate"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div
                                                                                class="form-group col-12 col-sm-4 col-md-4 col-lg-4 mb-0">
                                                                                <button class="btn btn-primary"
                                                                                    type="submit">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item card mb-2">
                                                            <div class="card-header" id="headingTwo">
                                                                <button class="card-link" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#collapseTwo" aria-expanded="false"
                                                                    aria-controls="collapseTwo">
                                                                    <span class="customRadio clearfix mb-0">
                                                                        <input id="paymentRadio2" value="2"
                                                                            name="payment" type="radio"
                                                                            class="radio" />
                                                                        <label for="paymentRadio2" class="mb-0">Pay with
                                                                            Paypal</label>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                                aria-labelledby="headingTwo"
                                                                data-bs-parent="#accordionExample">
                                                                <div class="card-body px-0">
                                                                    <p>Pay via PayPal you can pay with your credit card if
                                                                        you
                                                                        don't have a PayPal account.</p>
                                                                    <div class="input-group mb-0 d-flex">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="paypal@example.com"
                                                                            required="">
                                                                        <button class="btn btn-primary" type="submit">Pay
                                                                            99.00 USD</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item card mb-2">
                                                            <div class="card-header" id="headingThree">
                                                                <button class="card-link" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#collapseThree" aria-expanded="false"
                                                                    aria-controls="collapseThree">
                                                                    <span class="customRadio clearfix mb-0">
                                                                        <input id="paymentRadio3" value="3"
                                                                            name="payment" type="radio"
                                                                            class="radio" />
                                                                        <label for="paymentRadio3" class="mb-0">Cheque
                                                                            Payment</label>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                                aria-labelledby="headingThree"
                                                                data-bs-parent="#accordionExample">
                                                                <div class="card-body px-0">
                                                                    <p>Please send your cheque to Store Name, Store Street,
                                                                        Store Town, Store State / County, Store Postcode.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item card mb-0">
                                                            <div class="card-header" id="headingFour">
                                                                <button class="card-link" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#collapseFour" aria-expanded="false"
                                                                    aria-controls="collapseFour">
                                                                    <span class="customRadio clearfix mb-0">
                                                                        <input id="paymentRadio4" value="4"
                                                                            name="payment" type="radio"
                                                                            class="radio" />
                                                                        <label for="paymentRadio4" class="mb-0">Cash On
                                                                            Delivery</label>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                            <div id="collapseFour" class="accordion-collapse collapse"
                                                                aria-labelledby="headingFour"
                                                                data-bs-parent="#accordionExample">
                                                                <div class="card-body px-0">
                                                                    <p>Cash on delivery refers to an arrangement in which
                                                                        payment for a purchase is made directly by the
                                                                        purchaser
                                                                        to the person who delivers the item.</p>
                                                                </div>
                                                            </div>
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
                                                        class="col-6 col-sm-6 cart-subtotal-title"><strong>Subtotal</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                            class="money">$226.00</span></span>
                                                </div>
                                                <div class="row g-0 border-bottom py-2">
                                                    <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Coupon
                                                            Discount</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                            class="money">-$25.00</span></span>
                                                </div>
                                                <div class="row g-0 border-bottom py-2">
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title"><strong>Tax</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                            class="money">$10.00</span></span>
                                                </div>
                                                <div class="row g-0 border-bottom py-2">
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title"><strong>Shipping</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                                            class="money">Free shipping</span></span>
                                                </div>
                                                <div class="row g-0 pt-2">
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title fs-6"><strong>Total</strong></span>
                                                    <span
                                                        class="col-6 col-sm-6 cart-subtotal-title fs-5 cart-subtotal text-end text-primary"><b
                                                            class="money">$311.00</b></span>
                                                </div>

                                                <a href="order-success.html" id="cartCheckout"
                                                    class="btn btn-lg my-4 checkout w-100">Đặt hàng</a>
                                            </div>
                                        </div>
                                        <!--Cart Summary-->
                                    </div>
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
            <div class="address-item d-flex gap-2">
                <div class="check-icon">
                    <input type="radio" name="address" checked>
                </div>
                <div>
                    <div class="d-flex justify-content-sm-start gap-1">
                        <p class="language">việt</p>
                        <p class="phone">0813754231</p>
                    </div>
                    <div class="address">
                        địa chỉ: tờ 1 số nhà 93
                    </div>
                    <div class="address">
                        Mã vùng: Điện Biên - Thành Phố Điện Biên Phủ - Phường Thanh Bình
                    </div>
                    <div class="buttons">
                        <a href="#" class="button bg-white">Địa chỉ nhận hàng mặc định</a>
                    </div>
                </div>
            </div>

            <div class="address-item d-flex gap-2">
                <div class="check-icon">
                    <input type="radio" name="address">
                </div>
                <div>
                    <div class="d-flex justify-content-sm-start gap-1">
                        <p class="language">việt</p>
                        <p class="phone">0813754231</p>
                    </div>
                    <div class="address">
                        địa chỉ: tờ 1 số nhà 93
                    </div>
                    <div class="address">
                        Mã vùng: Điện Biên - Thành Phố Điện Biên Phủ - Phường Thanh Bình
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <button class="action-button cancel" data-bs-dismiss="offcanvas" aria-label="Close">HỦY</button>
                <button class="action-button save">LƯU</button>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            // Thêm lớp active cho tab hiện tại
            var checkoutList = document.getElementById("nav-tabs");
            var checkoutItems = checkoutList.getElementsByClassName("nav-item");

            for (var i = 0; i < checkoutItems.length; i++) {
                checkoutItems[i].addEventListener("click", function() {
                    var current = document.getElementsByClassName("onactive");
                    if (current.length > 0) {
                        current[0].classList.remove("onactive");
                    }
                    this.classList.add("onactive");
                });
            }

            // Cập nhật nav khi chuyển đổi tab
            function updateNav(newActiveItem) {
                const current = document.getElementsByClassName("onactive");
                if (current.length > 0) {
                    current[0].classList.remove("onactive");
                }
                newActiveItem.classList.add("onactive");
            }



            // Chuyển đến tab tiếp theo
            $('.btnNext').click(function() {
                const activeTab = $('.nav-link.active').closest('li');
                const nextTab = activeTab.next('li');

                if (nextTab.length > 0) {
                    const nextTabLinkEl = nextTab.find('a')[0];
                    const nextTabInstance = new bootstrap.Tab(nextTabLinkEl);
                    nextTabInstance.show();
                    updateNav(activeTab.next('li')[0]);
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
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");
        var Parameter = {
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
            method: "GET",
            responseType: "application/json",
        };
        var promise = axios(Parameter);
        promise.then(function(result) {
            renderCity(result.data);
        });

        function renderCity(data) {
            for (const x of data) {
                citis.options[citis.options.length] = new Option(x.Name, x.Id);
            }
            citis.onchange = function() {
                district.length = 1;
                ward.length = 1;
                if (this.value != "") {
                    const result = data.filter(n => n.Id === this.value);

                    for (const k of result[0].Districts) {
                        district.options[district.options.length] = new Option(k.Name, k.Id);
                    }
                }
            };
            district.onchange = function() {
                ward.length = 1;
                const dataCity = data.filter((n) => n.Id === citis.value);
                if (this.value != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

                    for (const w of dataWards) {
                        wards.options[wards.options.length] = new Option(w.Name, w.Id);
                    }
                }
            };
        }
    </script>
@endsection
