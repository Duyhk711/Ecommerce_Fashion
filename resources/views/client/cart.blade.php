@extends('layouts.client')
@section('css')
@endsection
@section('content')
    @include('client.component.page_header')
    <div class="container" style="max-width: 80%;">
        <!--Main Content-->
        <div class="container">
            <div class="row">
                <!--Cart Content-->
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 main-col">
                    <div class="alert alert-success py-2 alert-dismissible fade show cart-alert" role="alert">
                        <i class="align-middle icon anm anm-truck icon-large me-2"></i><strong
                            class="text-uppercase">Congratulations!</strong> You've got free shipping!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <!--End Alert msg-->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                        @if (session('success'))
                            <div class="alert alert-success py-2 alert-dismissible fade show cart-alert" role="alert">
                                <i class="align-middle icon anm anm-truck icon-large me-2"></i><strong
                                    class="text-uppercase">Congratulations!</strong> You've got free shipping!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!--Cart Form-->
                        <form action="{{ route('cart.update') }}" method="POST" class="cart-table table-bottom-brd">
                            @csrf
                            <table class="table align-middle">
                                <thead class="cart-row cart-header small-hide position-relative">
                                    <tr>
                                        <th class="action">&nbsp;</th>
                                        <th colspan="2" class="text-start">Product</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr class="cart-row cart-flex position-relative">
                                            <td class="cart-delete text-center small-hide">
                                                <a href="#" class="cart-remove remove-icon"
                                                    data-id="{{ $item['product_variant_id'] }}"
                                                    onclick="removeItemFromCart({{ $item['product_variant_id'] }})">
                                                    <i class="icon anm anm-times-r"></i>
                                                </a>
                                            </td>
                                            <td class="cart-image cart-flex-item">
                                                <a href="{{ route('productDetail', $item['product_variant_id']) }}">
                                                    <img class="cart-image rounded-0 blur-up lazyload"
                                                        src="{{ asset('images/products/' . $item['product_image']) }}"
                                                        alt="{{ $item['product_name'] }}" width="120" height="170" />
                                                </a>
                                            </td>
                                            <td class="cart-meta small-text-left cart-flex-item">
                                                <div class="list-view-item-title">
                                                    <a href="{{ route('productDetail', $item['product_variant_id']) }}">{{ $item['product_name'] }}</a>
                                                </div>
                                                <div class="cart-meta-text">
                                                    Color: {{ $item['color'] }}<br>Size: {{ $item['size'] }}<br>
                                                </div>
                                                <div class="cart-price d-md-none">
                                                    <span class="money fw-500"
                                                        data-price="{{ $item['price'] }}">{{ number_format($item['price'], 2) }}</span>
                                                </div>
                                            </td>
                                            <td class="cart-price cart-flex-item text-center small-hide">
                                                <span class="money"
                                                    data-price="{{ $item['price'] }}">{{ number_format($item['price'], 2) }}</span>
                                            </td>
                                            <td class="cart-update-wrapper cart-flex-item text-end text-md-center">
                                                <div class="cart-qty d-flex justify-content-end justify-content-md-center">
                                                    <div class="qtyField">
                                                        <a class="qtyBtn minus" href="#"><i
                                                                class="icon anm anm-minus-r"></i></a>
                                                        {{-- <input class="cart-qty-input qty" type="number" name="quantities[{{ $item['product_variant_id']}}]" value="{{ $item['quantity'] }}" min="1" /> --}}
                                                        <input type="number"
                                                            name="quantities[{{ $item['product_variant_id'] }}]"
                                                            value="{{ $item['quantity'] }}" min="1"
                                                            class="cart-qty-input qty" />
                                                        <a class="qtyBtn plus" href="#"><i
                                                                class="icon anm anm-plus-r"></i></a>
                                                    </div>
                                                </div>
                                                <a href="#" title="Remove"
                                                    class="removeMb d-md-none d-inline-block text-decoration-underline mt-2 me-3"
                                                    data-id="{{ $item['product_variant_id'] }}">Remove</a>
                                            </td>
                                            <td class="cart-price cart-flex-item text-center small-hide">
                                                <span class="money fw-500" data-price="{{ $item['price'] }}"
                                                    data-quantity="{{ $item['quantity'] }}">{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-start">
                                            <a href="{{ route('shop') }}"
                                                class="btn btn-outline-secondary btn-sm cart-continue"><i
                                                    class="icon anm anm-angle-left-r me-2 d-none"></i> Continue shopping</a>
                                        </td>
                                        <td colspan="3" class="text-end">
                                            <button type="submit" name="clear" class="btn btn-outline-secondary btn-sm small-hide">
                                                <i class="icon anm anm-times-r me-2 d-none"></i> Clear Shopping Cart
                                            </button>
                                            <button type="submit" name="update" class="btn btn-secondary btn-sm cart-continue ms-2">
                                                <i class="icon anm anm-sync-ar me-2 d-none"></i> Update Cart
                                            </button>
                                        </td>
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
                            <div class="row g-0 border-bottom pb-2">
                                <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Subtotal</strong></span>
                                <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                        class="money" id="cart-subtotal">{{ number_format($subtotal, 2) }}</span></span>
                            </div>

                            <div class="row g-0 border-bottom py-2">
                                <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Shipping</strong></span>
                                <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span
                                        class="money">Free shipping</span></span>
                            </div>
                            <div class="row g-0 pt-2">
                                <span class="col-6 col-sm-6 cart-subtotal-title fs-6"><strong>Total</strong></span>
                                <span
                                    class="col-6 col-sm-6 cart-subtotal-title fs-5 cart-subtotal text-end text-primary"><b
                                        class="money" id="cart-total">{{ number_format($total, 2) }}</b></span>
                            </div>

                            <p class="cart-shipping mt-3">Shipping &amp; taxes calculated at checkout</p>
                            <p class="cart-shipping fst-normal freeShipclaim"><i
                                    class="me-2 align-middle icon anm anm-truck-l"></i><b>FREE SHIPPING</b> ELIGIBLE</p>
                            <div class="customCheckbox cart-tearm">
                                <input type="checkbox" value="allen-vela" id="cart-tearm">
                                <label for="cart-tearm">I agree with the terms and conditions</label>
                            </div>
                            <a href="{{ route('checkout') }}" id="cartCheckout"
                                class="btn btn-lg my-4 checkout w-100">Proceed To Checkout</a>
                            <div class="paymnet-img text-center"><img
                                    src="{{ asset('client/images/icons/safepayment.png') }}" alt="Payment"
                                    width="299" height="28" /></div>
                        </div>
                    </div>
                </div>
                <!--End Cart Sidebar-->
            </div>
        </div>
        <!--End Main Content-->

        <!--Related Products-->
        <section class="section product-slider pb-0">
            <div class="container">
                <div class="section-header">
                    <h2>You may also like</h2>
                </div>
                <!--Product Grid-->
                <div class="product-slider-4items gp10 arwOut5 grid-products">
                    <div class="item col-item">
                        <div class="product-box">
                            <!-- Start Product Image -->
                            <div class="product-image">
                                <!-- Start Product Image -->
                                <a href="" class="product-img rounded-0">
                                    <!-- Image -->
                                    <img class="primary rounded-0 blur-up lazyload"
                                        data-src="{{ asset('client/images/products/cart-product-img1.jpg') }}"
                                        src="{{ asset('client/images/products/cart-product-img1.jpg') }}" alt="Product"
                                        title="Product" width="625" height="808" />
                                    <!-- End Image -->
                                    <!-- Hover Image -->
                                    <img class="hover rounded-0 blur-up lazyload"
                                        data-src="{{ asset('client/images/products/cart-product-img1.jpg') }}"
                                        src="{{ asset('client/images/products/cart-product-img1.jpg') }}" alt="Product"
                                        title="Product" width="625" height="808" />
                                    <!-- End Hover Image -->
                                </a>
                                <!-- End Product Image -->
                                <!-- Product label -->
                                <div class="product-labels"><span class="lbl pr-label2">Hot</span></div>
                                <!-- End Product label -->
                                <!--Product Button-->
                                <div class="button-set style1">
                                    <!--Cart Button-->
                                    <a href="#addtocart-modal" class="btn-icon addtocart add-to-cart-modal"
                                        data-bs-toggle="modal" data-bs-target="#addtocart_modal">
                                        <span class="icon-wrap d-flex-justify-center h-100 w-100" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Add to Cart"><i
                                                class="icon anm anm-cart-l"></i><span class="text">Add to
                                                Cart</span></span>
                                    </a>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <a href="#quickview-modal" class="btn-icon quickview quick-view-modal"
                                        data-bs-toggle="modal" data-bs-target="#quickview_modal">
                                        <span class="icon-wrap d-flex-justify-center h-100 w-100" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Quick View"><i
                                                class="icon anm anm-search-plus-l"></i><span class="text">Quick
                                                View</span></span>
                                    </a>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <a href="wishlist-style2.html" class="btn-icon wishlist" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Add To Wishlist"><i
                                            class="icon anm anm-heart-l"></i><span class="text">Add To
                                            Wishlist</span></a>
                                    <!--End Wishlist Button-->

                                </div>
                                <!--End Product Button-->
                            </div>
                            <!-- End Product Image -->
                            <!-- Start Product Details -->
                            <div class="product-details text-left">
                                <!-- Product Name -->
                                <div class="product-name">
                                    <a href="product-layout1.html">Denim Women Shorts</a>
                                </div>
                                <!-- End Product Name -->
                                <!-- Product Price -->
                                <div class="product-price">
                                    <span class="price old-price">$1</span><span class="price">$2</span>
                                </div>
                                <!-- End Product Price -->
                                <!-- Product Review -->
                                <div class="product-review">
                                    <i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                        class="icon anm anm-star-o"></i><i class="icon anm anm-star-o"></i><i
                                        class="icon anm anm-star-o"></i>
                                    <span class="caption hidden ms-1">3 Reviews</span>
                                </div>
                                <!-- End Product Review -->
                            </div>
                            <!-- End product details -->
                        </div>
                    </div>
                </div>
                <!--End Product Grid-->
            </div>
        </section>
        <!--End Related Products-->
    </div>
@endsection
@section('modal')
    <!-- Product Quickshop Modal-->
    <div class="quickshop-modal modal fade" id="quickshop_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form method="post" action="#" id="product-form-quickshop"
                        class="product-form align-items-center">
                        @csrf
                        <!-- Product Info -->
                        <div class="row g-0 item mb-3">
                            <a class="col-4 product-image" href="product-layout1.html"><img class="blur-up lazyload"
                                    data-src="{{ asset('client/images/products/addtocart-modal.jpg') }}"
                                    src="{{ asset('client/images/products/addtocart-modal.jpg') }}" alt="Product"
                                    title="Product" width="625" height="800" /></a>
                            <div class="col-8 product-details">
                                <div class="product-variant ps-3">
                                    <a class="product-title" href="product-layout1.html">Weave Hoodie Sweatshirt</a>
                                    <div class="priceRow mt-2 mb-3">
                                        <div class="product-price m-0">
                                            <span class="old-price">$114.00</span><span class="price">$99.00</span>
                                        </div>
                                    </div>
                                    <div class="qtyField">
                                        <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"></i></a>
                                        <input type="text" name="quantity" value="1" class="qty" />
                                        <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Product Info -->
                        <!-- Swatches Color -->
                        <div class="variants-clr swatches-image clearfix mb-3 swatch-0 option1" data-option-index="0">
                            <label class="label d-flex justify-content-center">Color:<span
                                    class="slVariant ms-1 fw-bold">Black</span></label>
                            <ul class="swatches d-flex-justify-center pt-1 clearfix">
                                <li class="swatch large radius available active">
                                    <img src="{{ asset('client/images/products/swatches/blue-red.jpg') }}" alt="image"
                                        width="70" height="70" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Blue" />
                                </li>
                                <li class="swatch large radius available">
                                    <img src="{{ asset('client/images/products/swatches/blue-red.jpg') }}" alt="image"
                                        width="70" height="70" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Black" />
                                </li>
                                <li class="swatch large radius available">
                                    <img src="{{ asset('client/images/products/swatches/blue-red.jpg') }}" alt="image"
                                        width="70" height="70" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Pink" />
                                </li>
                                <li class="swatch large radius available green">
                                    <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Green"></span>
                                </li>
                                <li class="swatch large radius soldout yellow">
                                    <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Yellow"></span>
                                </li>
                            </ul>
                        </div>
                        <!-- End Swatches Color -->
                        <!-- Swatches Size -->
                        <div class="variants-size swatches-size clearfix mb-4 swatch-1 option2" data-option-index="1">
                            <label class="label d-flex justify-content-center">Size:<span
                                    class="slVariant ms-1 fw-bold">S</span></label>
                            <ul class="size-swatches d-flex-justify-center pt-1 clearfix">
                                <li class="swatch large radius soldout">
                                    <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="XS">XS</span>
                                </li>
                                <li class="swatch large radius available active">
                                    <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="S">S</span>
                                </li>
                                <li class="swatch large radius available">
                                    <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="M">M</span>
                                </li>
                                <li class="swatch large radius available">
                                    <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="L">L</span>
                                </li>
                                <li class="swatch large radius available">
                                    <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="XL">XL</span>
                                </li>
                            </ul>
                        </div>
                        <!-- End Swatches Size -->
                        <!-- Product Action -->
                        <div class="product-form-submit d-flex-justify-center">
                            <button type="submit" name="add" class="btn product-cart-submit me-2">
                                <span>Add to cart</span>
                            </button>
                            <button type="submit" name="sold" class="btn btn-secondary product-sold-out d-none"
                                disabled="disabled">
                                Sold out
                            </button>
                            <button type="submit" name="buy" class="btn btn-secondary proceed-to-checkout">
                                Buy it now
                            </button>
                        </div>
                        <!-- End Product Action -->
                        <div class="text-center mt-3">
                            <a class="text-link" href="product-layout1.html">View More Details</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Quickshop Modal -->

    <!-- Product Addtocart Modal-->
    <div class="addtocart-modal modal fade" id="addtocart_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form method="post" action="#" id="product-form-addtocart"
                        class="product-form align-items-center">
                        @csrf
                        <h3 class="title mb-3 text-success text-center">
                            Added to cart Successfully!
                        </h3>
                        <div class="row d-flex-center text-center">
                            <div class="col-md-6">
                                <!-- Product Image -->
                                <a class="product-image" href="product-layout1.html"><img class="blur-up lazyload"
                                        data-src="{{ asset('client/images/products/addtocart-modal.jpg') }}"
                                        src="{{ asset('client/images/products/addtocart-modal.jpg') }}" alt="Product"
                                        title="Product" width="625" height="800" /></a>
                                <!-- End Product Image -->
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0">
                                <!-- Product Info -->
                                <div class="product-details">
                                    <a class="product-title" href="product-layout1.html">Cuff Beanie Cap</a>
                                    <p class="product-clr my-2 text-muted">Black / XL</p>
                                </div>
                                <div class="addcart-total rounded-5">
                                    <p class="product-items mb-2">
                                        There are <strong>1</strong> items in your cart
                                    </p>
                                    <p class="d-flex-justify-center">
                                        Total: <span class="price">$198.00</span>
                                    </p>
                                </div>
                                <!-- End Product Info -->
                                <!-- Product Action -->
                                <div class="product-form-submit d-flex-justify-center">
                                    <a href="#" class="btn btn-outline-primary product-continue w-100">Continue
                                        Shopping</a>
                                    <a href="cart-style1.html"
                                        class="btn btn-secondary product-viewcart w-100 my-2 my-md-3">View Cart</a>
                                    <a href="checkout-style1.html" class="btn btn-primary product-checkout w-100">Proceed
                                        to checkout</a>
                                </div>
                                <!-- End Product Action -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Addtocart Modal -->

    <!-- Product Quickview Modal-->
    <div class="quickview-modal modal fade" id="quickview_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3 mb-md-0">
                            <!-- Model Thumbnail -->
                            <div id="quickView" class="carousel slide">
                                <!-- Image Slide carousel items -->
                                <div class="carousel-inner">
                                    <div class="item carousel-item active" data-bs-slide-number="0">
                                        <img class="blur-up lazyload" data-src="assets/images/products/product2.jpg"
                                            src="{{ asset('client/images/products/product2.jpg') }}" alt="product"
                                            title="Product" width="625" height="808" />
                                    </div>
                                    <div class="item carousel-item" data-bs-slide-number="1">
                                        <img class="blur-up lazyload"
                                            data-src="{{ asset('client/images/products/product2-1.jpg') }}"
                                            src="{{ asset('client/images/products/product2-1.jpg') }}" alt="product"
                                            title="Product" width="625" height="808" />
                                    </div>
                                    <div class="item carousel-item" data-bs-slide-number="2">
                                        <img class="blur-up lazyload"
                                            data-src="{{ asset('client/images/products/product2-2.jpg') }}"
                                            src="{{ asset('client/images/products/product2-2.jpg') }}" alt="product"
                                            title="Product" width="625" height="808" />
                                    </div>
                                    <div class="item carousel-item" data-bs-slide-number="3">
                                        <img class="blur-up lazyload"
                                            data-src="{{ asset('client/images/products/product2-3.jpg') }}"
                                            src="{{ asset('client/images/products/product2-3.jpg') }}" alt="product"
                                            title="Product" width="625" height="808" />
                                    </div>
                                    <div class="item carousel-item" data-bs-slide-number="4">
                                        <img class="blur-up lazyload"
                                            data-src="{{ asset('client/images/products/product2-4.jpg') }}"
                                            src="{{ asset('client/images/products/product2-4.jpg') }}" alt="product"
                                            title="Product" width="625" height="808" />
                                    </div>
                                    <div class="item carousel-item" data-bs-slide-number="5">
                                        <img class="blur-up lazyload"
                                            data-src="{{ asset('client/images/products/product5.jpg') }}"
                                            src="{{ asset('client/images/products/product2-5.jpg') }}" alt="product"
                                            title="Product" width="625" height="808" />
                                    </div>
                                </div>
                                <!-- End Image Slide carousel items -->
                                <!-- Thumbnail image -->
                                <div class="model-thumbnail-img">
                                    <!-- Thumbnail slide -->
                                    <div class="carousel-indicators list-inline">
                                        <div class="list-inline-item active" id="carousel-selector-0"
                                            data-bs-slide-to="0" data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2.jpg') }}"
                                                src="{{ asset('client/images/products/product2.jpg') }}" alt="product"
                                                title="Product" width="625" height="808" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-1" data-bs-slide-to="1"
                                            data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-1.jpg') }}"
                                                src="{{ asset('client/images/products/product2-1.jpg') }}" alt="product"
                                                title="Product" width="625" height="808" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-2" data-bs-slide-to="2"
                                            data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-2.jpg') }}"
                                                src="{{ asset('client/images/products/product2-2.jpg') }}" alt="product"
                                                title="Product" width="625" height="808" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-3" data-bs-slide-to="3"
                                            data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-3.jpg') }}"
                                                src="{{ asset('client/images/products/product2-3.jpg') }}" alt="product"
                                                title="Product" width="625" height="808" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-4" data-bs-slide-to="4"
                                            data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-4.jpg') }}"
                                                src="{{ asset('client/images/products/product2-4.jpg') }}" alt="product"
                                                title="Product" width="625" height="808" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-5" data-bs-slide-to="5"
                                            data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-5.jpg') }}"
                                                src="{{ asset('client/images/products/product2-5.jpg') }}" alt="product"
                                                title="Product" width="625" height="808" />
                                        </div>
                                    </div>
                                    <!-- End Thumbnail slide -->
                                    <!-- Carousel arrow button -->
                                    <a class="carousel-control-prev carousel-arrow rounded-1" href="#quickView"
                                        data-bs-target="#quickView" data-bs-slide="prev"><i
                                            class="icon anm anm-angle-left-r"></i></a>
                                    <a class="carousel-control-next carousel-arrow rounded-1" href="#quickView"
                                        data-bs-target="#quickView" data-bs-slide="next"><i
                                            class="icon anm anm-angle-right-r"></i></a>
                                    <!-- End Carousel arrow button -->
                                </div>
                                <!-- End Thumbnail image -->
                            </div>
                            <!-- End Model Thumbnail -->
                            <div class="text-center mt-3">
                                <a href="product-layout1.html" class="text-link">View More Details</a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="product-arrow d-flex justify-content-between">
                                <h2 class="product-title">Product Quick View Popup</h2>
                            </div>
                            <div class="product-review d-flex mt-0 mb-2">
                                <div class="rating">
                                    <i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                        class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                        class="icon anm anm-star-o"></i>
                                </div>
                                <div class="reviews ms-2"><a href="#">6 Reviews</a></div>
                            </div>
                            <div class="product-info">
                                <p class="product-vendor">
                                    Vendor:<span class="text"><a href="#">Sparx</a></span>
                                </p>
                                <p class="product-type">
                                    Product Type:<span class="text">Caps</span>
                                </p>
                                <p class="product-sku">
                                    SKU:<span class="text">RF104456</span>
                                </p>
                            </div>
                            <div class="pro-stockLbl my-2">
                                <span class="d-flex-center stockLbl instock d-none"><i
                                        class="icon anm anm-check-cil"></i><span> In stock</span></span>
                                <span class="d-flex-center stockLbl preorder d-none"><i
                                        class="icon anm anm-clock-r"></i><span> Pre-order Now</span></span>
                                <span class="d-flex-center stockLbl outstock d-none"><i
                                        class="icon anm anm-times-cil"></i>
                                    <span>Sold out</span></span>
                                <span class="d-flex-center stockLbl lowstock" data-qty="15"><i
                                        class="icon anm anm-exclamation-cir"></i><span>
                                        Order now, Only
                                        <span class="items">10</span> left!</span></span>
                            </div>
                            <div class="product-price d-flex-center my-3">
                                <span class="price old-price">$135.00</span><span class="price">$99.00</span>
                            </div>
                            <div class="sort-description">
                                The standard chunk of Lorem Ipsum used since the 1500s is
                                reproduced below for those interested.
                            </div>
                            <form method="post" action="#" id="product_form--option" class="product-form">
                                @csrf
                                <div class="product-options d-flex-wrap">
                                    <div class="product-item swatches-image w-100 mb-3 swatch-0 option1"
                                        data-option-index="0">
                                        <label class="label d-flex align-items-center">Color:<span
                                                class="slVariant ms-1 fw-bold">Blue</span></label>
                                        <ul class="variants-clr swatches d-flex-center pt-1 clearfix">
                                            <li class="swatch large radius available active">
                                                <img src="{{ asset('client/images/products/swatches/blue-red.jpg') }}"
                                                    alt="image" width="70" height="70"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Blue" />
                                            </li>
                                            <li class="swatch large radius available">
                                                <img src="{{ asset('client/images/products/swatches/blue-red.jpg') }}"
                                                    alt="image" width="70" height="70"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Black" />
                                            </li>
                                            <li class="swatch large radius available">
                                                <img src="{{ asset('client/images/products/swatches/blue-red.jpg') }}"
                                                    alt="image" width="70" height="70"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Pink" />
                                            </li>
                                            <li class="swatch large radius available green">
                                                <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Green"></span>
                                            </li>
                                            <li class="swatch large radius soldout yellow">
                                                <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Yellow"></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-item swatches-size w-100 mb-3 swatch-1 option2"
                                        data-option-index="1">
                                        <label class="label d-flex align-items-center">Size:<span
                                                class="slVariant ms-1 fw-bold">S</span></label>
                                        <ul class="variants-size size-swatches d-flex-center pt-1 clearfix">
                                            <li class="swatch large radius soldout">
                                                <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="XS">XS</span>
                                            </li>
                                            <li class="swatch large radius available active">
                                                <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="S">S</span>
                                            </li>
                                            <li class="swatch large radius available">
                                                <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="M">M</span>
                                            </li>
                                            <li class="swatch large radius available">
                                                <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="L">L</span>
                                            </li>
                                            <li class="swatch large radius available">
                                                <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="XL">XL</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-action d-flex-wrap w-100 pt-1 mb-3 clearfix">
                                        <div class="quantity">
                                            <div class="qtyField rounded">
                                                <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"
                                                        aria-hidden="true"></i></a>
                                                <input type="text" name="quantity" value="1"
                                                    class="product-form__input qty" />
                                                <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-l"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="addtocart ms-3 fl-1">
                                            <button type="submit" name="add" class="btn product-cart-submit w-100">
                                                <span>Add to cart</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="wishlist-btn d-flex-center">
                                <a class="add-wishlist d-flex-center me-3" href="wishlist-style1.html"
                                    title="Add to Wishlist"><i class="icon anm anm-heart-l me-1"></i>
                                    <span>Add to Wishlist</span></a>
                                <a class="add-compare d-flex-center" href="compare-style1.html" title="Add to Compare"><i
                                        class="icon anm anm-random-r me-2"></i>
                                    <span>Add to Compare</span></a>
                            </div>
                            <!-- Social Sharing -->
                            <div class="social-sharing share-icon d-flex-center mx-0 mt-3">
                                <span class="sharing-lbl">Share :</span>
                                <a href="#" class="d-flex-center btn btn-link btn--share share-facebook"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Facebook"><i
                                        class="icon anm anm-facebook-f"></i><span
                                        class="share-title d-none">Facebook</span></a>
                                <a href="#" class="d-flex-center btn btn-link btn--share share-twitter"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Tweet on Twitter"><i
                                        class="icon anm anm-twitter"></i><span class="share-title d-none">Tweet</span></a>
                                <a href="#" class="d-flex-center btn btn-link btn--share share-pinterest"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Pin on Pinterest"><i
                                        class="icon anm anm-pinterest-p"></i>
                                    <span class="share-title d-none">Pin it</span></a>
                                <a href="#" class="d-flex-center btn btn-link btn--share share-linkedin"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Instagram"><i
                                        class="icon anm anm-linkedin-in"></i><span
                                        class="share-title d-none">Instagram</span></a>
                                <a href="#" class="d-flex-center btn btn-link btn--share share-whatsapp"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Share on WhatsApp"><i
                                        class="icon anm anm-envelope-l"></i><span
                                        class="share-title d-none">WhatsApp</span></a>
                                <a href="#" class="d-flex-center btn btn-link btn--share share-email"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Share by Email"><i
                                        class="icon anm anm-whatsapp"></i><span
                                        class="share-title d-none">Email</span></a>
                            </div>
                            <!-- End Social Sharing -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Product Quickview Modal-->
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const qtyInputs = document.querySelectorAll('.cart-qty-input');
            
            qtyInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const quantity = parseInt(this.value, 10);
                    const row = this.closest('tr');
                    const price = parseFloat(row.querySelector('.cart-price span.money').getAttribute('data-price'));
                    const totalCell = row.querySelector('.cart-price.cart-flex-item.text-center.small-hide span.money');
                    
                    if (!isNaN(quantity) && quantity > 0) {
                        const total = price * quantity;
                        totalCell.textContent = total.toFixed(2);
                        
                        // Cập nhật tổng phụ và tổng tiền
                        updateCartTotals();
                    }
                });
            });
            
            function updateCartTotals() {
                let subtotal = 0;
                document.querySelectorAll('.cart-price.cart-flex-item.text-center.small-hide span.money').forEach(cell => {
                    subtotal += parseFloat(cell.textContent);
                });

                document.getElementById('cart-subtotal').textContent = subtotal.toFixed(2);
                const total = subtotal;
                document.getElementById('cart-total').textContent = total.toFixed(2);
            }

            function removeItemFromCart(productVariantId) {
                fetch("{{ route('cart.remove') }}", {
                    method: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Token bảo mật của Laravel
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        product_variant_id: productVariantId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector(`[data-id="${productVariantId}"]`).closest('tr').remove();
                        updateCartTotals();
                    }
                })
                .catch(error => console.error('Error:', error));
            }

            // Thêm sự kiện vào nút xóa
            document.querySelectorAll('.cart-remove').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const productVariantId = this.getAttribute('data-id');
                    removeItemFromCart(productVariantId);
                });
            });
        });

    </script>
@endsection
