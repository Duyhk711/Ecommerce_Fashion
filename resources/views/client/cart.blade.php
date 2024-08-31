
@extends('layouts.client')
@section('content')

<body class="cart-page cart-style1-page">
    <!--Page Wrapper-->
    <div class="page-wrapper">
        <!--Top Header-->

        <!--End Top Header-->

        <!--Header-->

        <!--End Header-->
        <!--Mobile Menu-->

        <!--End Mobile Menu-->

        <!-- Body Container -->
        <div id="page-content">
            <!--Page Header-->
            <div class="page-header text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                            <div class="page-title">
                                <h1>Your Shopping Cart Style1</h1>
                            </div>
                            <!--Breadcrumbs-->
                            <div class="breadcrumbs"><a href="index.html" title="Back to the home page">Home</a><span class="main-title"><i class="icon anm anm-angle-right-l"></i>Your Shopping Cart Style1</span></div>
                            <!--End Breadcrumbs-->
                        </div>
                    </div>
                </div>
            </div>
            <!--End Page Header-->

            <!--Main Content-->
            <div class="container">
                <div class="row">
                    <!--Cart Content-->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 main-col">
                        <div class="alert alert-success py-2 alert-dismissible fade show cart-alert" role="alert">
                            <i class="align-middle icon anm anm-truck icon-large me-2"></i><strong class="text-uppercase">Congratulations!</strong> You've got free shipping!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <!--End Alert msg-->

                        <!--Cart Form-->
                        <form action="#" method="post" class="cart-table table-bottom-brd">
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

                                    <tr class="cart-row cart-flex position-relative">
                                        <td class="cart-delete text-center small-hide"><a href="#" class="cart-remove remove-icon position-static" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove to Cart"><i class="icon anm anm-times-r"></i></a></td>
                                        <td class="cart-image cart-flex-item">
                                            <a href="product-layout1.html"><img class="cart-image rounded-0 blur-up lazyload" data-src="assets/images/products/product2-120x170.jpg" src="assets/images/products/product2-120x170.jpg" alt="Sunset Sleep Scarf Top" width="120" height="170" /></a>
                                        </td>
                                        <td class="cart-meta small-text-left cart-flex-item">
                                            <div class="list-view-item-title">
                                                <a href="product-layout1.html">Cuff Beanie Cap</a>
                                            </div>
                                            <div class="cart-meta-text">
                                                Color: Black<br>Size: Small<br>Qty: 1
                                            </div>
                                            <div class="cart-price d-md-none">
                                                <span class="money fw-500">$128.00</span>
                                            </div>
                                        </td>
                                        <td class="cart-price cart-flex-item text-center small-hide">
                                            <span class="money">$128.00</span>
                                        </td>
                                        <td class="cart-update-wrapper cart-flex-item text-end text-md-center">
                                            <div class="cart-qty d-flex justify-content-end justify-content-md-center">
                                                <div class="qtyField">
                                                    <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"></i></a>
                                                    <input class="cart-qty-input qty" type="text" name="updates[]" value="1" pattern="[0-9]*" />
                                                    <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                                                </div>
                                            </div>
                                            <a href="#" title="Remove" class="removeMb d-md-none d-inline-block text-decoration-underline mt-2 me-3">Remove</a>
                                        </td>
                                        <td class="cart-price cart-flex-item text-center small-hide">
                                            <span class="money fw-500">$128.00</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-start"><a href="#" class="btn btn-outline-secondary btn-sm cart-continue"><i class="icon anm anm-angle-left-r me-2 d-none"></i> Continue shopping</a></td>
                                        <td colspan="3" class="text-end">
                                            <button type="submit" name="clear" class="btn btn-outline-secondary btn-sm small-hide"><i class="icon anm anm-times-r me-2 d-none"></i> Clear Shoping Cart</button>
                                            <button type="submit" name="update" class="btn btn-secondary btn-sm cart-continue ms-2"><i class="icon anm anm-sync-ar me-2 d-none"></i> Update Cart</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                        <!--End Cart Form-->

                        <!--Note with Shipping estimates-->
                        <div class="row my-4 pt-3">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-12 cart-col">
                                <div class="cart-note mb-4">
                                    <h5>Add a note to your order</h5>
                                    <label for="cart-note">Notes about your order, e.g. special notes for delivery.</label>
                                    <textarea name="note" id="cart-note" class="form-control cart-note-input" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-12 cart-col">
                                <div class="cart-discount">
                                    <h5>Discount Codes</h5>
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <label for="address_zip">Enter your coupon code if you have one.</label>
                                            <div class="input-group0">
                                                <input class="form-control" type="text" name="coupon" required />
                                                <input type="submit" class="btn text-nowrap mt-3" value="Apply Coupon" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-12 cart-col">
                                <div id="shipping-calculator" class="mt-4 mt-lg-0">
                                    <h5>Get shipping estimates</h5>
                                    <form class="estimate-form row row-cols-lg-3 row-cols-md-3 row-cols-1" action="#" method="post">
                                        <div class="form-group">
                                            <label for="address_country">Country</label>
                                            <select id="address_country" name="address[country]" data-default="United States">
                                                <option value="0" label="Select a country ... " selected="selected">Select a country...</option>
                                                <optgroup id="country-optgroup-Africa" label="Africa">
                                                    <option value="DZ" label="Algeria">Algeria</option>


                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="address_province">State</label>
                                            <select id="address_province" name="address[province]" data-default="">
                                                <option value="0" label="Select a state..." selected="selected">Select a state...</option>
                                                <option value="AL">Alabama</option>


                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="address_zip">Postal/Zip Code</label>
                                            <input type="text" id="address_zip" name="address[zip]" />
                                        </div>
                                        <div class="actionRow">
                                            <input type="button" class="btn btn-secondary get-rates" value="Calculate shipping" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--End Note with Shipping estimates-->
                    </div>
                    <!--End Cart Content-->

                    <!--Cart Sidebar-->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 cart-footer">
                        <div class="cart-info sidebar-sticky">
                            <div class="cart-order-detail cart-col">
                                <div class="row g-0 border-bottom pb-2">
                                    <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Subtotal</strong></span>
                                    <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span class="money">$226.00</span></span>
                                </div>
                                <div class="row g-0 border-bottom py-2">
                                    <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Coupon Discount</strong></span>
                                    <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span class="money">-$25.00</span></span>
                                </div>
                                <div class="row g-0 border-bottom py-2">
                                    <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Tax</strong></span>
                                    <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span class="money">$10.00</span></span>
                                </div>
                                <div class="row g-0 border-bottom py-2">
                                    <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Shipping</strong></span>
                                    <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end"><span class="money">Free shipping</span></span>
                                </div>
                                <div class="row g-0 pt-2">
                                    <span class="col-6 col-sm-6 cart-subtotal-title fs-6"><strong>Total</strong></span>
                                    <span class="col-6 col-sm-6 cart-subtotal-title fs-5 cart-subtotal text-end text-primary"><b class="money">$311.00</b></span>
                                </div>

                                <p class="cart-shipping mt-3">Shipping &amp; taxes calculated at checkout</p>
                                <p class="cart-shipping fst-normal freeShipclaim"><i class="me-2 align-middle icon anm anm-truck-l"></i><b>FREE SHIPPING</b> ELIGIBLE</p>
                                <div class="customCheckbox cart-tearm">
                                    <input type="checkbox" value="allen-vela" id="cart-tearm">
                                    <label for="cart-tearm">I agree with the terms and conditions</label>
                                </div>
                                <a href="checkout-style1.html" id="cartCheckout" class="btn btn-lg my-4 checkout w-100">Proceed To Checkout</a>
                                <div class="paymnet-img text-center"><img src="assets/images/icons/safepayment.png" alt="Payment" width="299" height="28" /></div>
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
                                    <a href="product-layout1.html" class="product-img rounded-0">
                                        <!-- Image -->
                                        <img class="primary rounded-0 blur-up lazyload" data-src="assets/images/products/product5.jpg" src="assets/images/products/product5.jpg" alt="Product" title="Product" width="625" height="808" />
                                        <!-- End Image -->
                                        <!-- Hover Image -->
                                        <img class="hover rounded-0 blur-up lazyload" data-src="assets/images/products/product5-1.jpg" src="assets/images/products/product5-1.jpg" alt="Product" title="Product" width="625" height="808" />
                                        <!-- End Hover Image -->
                                    </a>
                                    <!-- End Product Image -->
                                    <!-- Product label -->
                                    <div class="product-labels"><span class="lbl pr-label2">Hot</span></div>
                                    <!-- End Product label -->
                                    <!--Product Button-->
                                    <div class="button-set style1">
                                        <!--Cart Button-->
                                        <a href="#addtocart-modal" class="btn-icon addtocart add-to-cart-modal" data-bs-toggle="modal" data-bs-target="#addtocart_modal">
                                            <span class="icon-wrap d-flex-justify-center h-100 w-100" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Cart"><i class="icon anm anm-cart-l"></i><span class="text">Add to Cart</span></span>
                                        </a>
                                        <!--End Cart Button-->
                                        <!--Quick View Button-->
                                        <a href="#quickview-modal" class="btn-icon quickview quick-view-modal" data-bs-toggle="modal" data-bs-target="#quickview_modal">
                                            <span class="icon-wrap d-flex-justify-center h-100 w-100" data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="icon anm anm-search-plus-l"></i><span class="text">Quick View</span></span>
                                        </a>
                                        <!--End Quick View Button-->
                                        <!--Wishlist Button-->
                                        <a href="wishlist-style2.html" class="btn-icon wishlist" data-bs-toggle="tooltip" data-bs-placement="left" title="Add To Wishlist"><i class="icon anm anm-heart-l"></i><span class="text">Add To Wishlist</span></a>
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
                                        <i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i class="icon anm anm-star-o"></i><i class="icon anm anm-star-o"></i><i class="icon anm anm-star-o"></i>
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
        <!-- End Body Container -->

        <!--Footer-->

        <!--End Footer-->

        <!--Scoll Top-->
        <div id="site-scroll"><i class="icon anm anm-arw-up"></i></div>
        <!--End Scoll Top-->

        <!--MiniCart Drawer-->
        <div id="minicart-drawer" class="minicart-right-drawer offcanvas offcanvas-end" tabindex="-1">
            <!--MiniCart Empty-->
            <div id="cartEmpty" class="cartEmpty d-flex-justify-center flex-column text-center p-3 text-muted d-none">
                <div class="minicart-header d-flex-center justify-content-between w-100">
                    <h4 class="fs-6">Your cart (0 Items)</h4>
                    <button class="close-cart border-0" data-bs-dismiss="offcanvas" aria-label="Close"><i class="icon anm anm-times-r" data-bs-toggle="tooltip" data-bs-placement="left" title="Close"></i></button>
                </div>
                <div class="cartEmpty-content mt-4">
                    <i class="icon anm anm-cart-l fs-1 text-muted"></i>
                    <p class="my-3">No Products in the Cart</p>
                    <a href="index.html" class="btn btn-primary cart-btn">Continue shopping</a>
                </div>
            </div>
            <!--End MiniCart Empty-->

            <!--MiniCart Content-->
            <div id="cart-drawer" class="block block-cart">
                <div class="minicart-header">
                    <button class="close-cart border-0" data-bs-dismiss="offcanvas" aria-label="Close"><i class="icon anm anm-times-r" data-bs-toggle="tooltip" data-bs-placement="left" title="Close"></i></button>
                    <h4 class="fs-6">Your cart (2 Items)</h4>
                </div>
                <div class="minicart-content">
                    <ul class="m-0 clearfix">
                        <li class="item d-flex justify-content-center align-items-center">
                            <a class="product-image rounded-0" href="product-layout1.html">
                                <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/cart-product-img1.jpg" src="assets/images/products/cart-product-img1.jpg" alt="product" title="Product" width="120" height="170" />
                            </a>
                            <div class="product-details">
                                <a class="product-title" href="product-layout1.html">Women Sandals</a>
                                <div class="variant-cart my-2">Black / XL</div>
                                <div class="priceRow">
                                    <div class="product-price">
                                        <span class="price">$54.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="qtyDetail text-center">
                                <div class="qtyField">
                                    <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"></i></a>
                                    <input type="text" name="quantity" value="1" class="qty">
                                    <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                                </div>
                                <a href="#" class="edit-i remove"><i class="icon anm anm-pencil-ar" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>
                                <a href="#" class="remove"><i class="icon anm anm-times-r" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"></i></a>
                            </div>
                        </li>
                        <li class="item d-flex justify-content-center align-items-center">
                            <a class="product-image rounded-0" href="product-layout1.html">
                                <img class="rounded-0 blur-up lazyload" data-src="assets/images/products/cart-product-img2.jpg" src="assets/images/products/cart-product-img2.jpg" alt="product" title="Product" width="120" height="170" />
                            </a>
                            <div class="product-details">
                                <a class="product-title" href="product-layout1.html">High Waist Jeans</a>
                                <div class="variant-cart my-2">Yellow / M</div>
                                <div class="priceRow">
                                    <div class="product-price">
                                        <span class="price old-price">$114.00</span><span class="price">$99.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="qtyDetail text-center">
                                <div class="qtyField">
                                    <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"></i></a>
                                    <input type="text" name="quantity" value="1" class="qty">
                                    <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                                </div>
                                <a href="#" class="edit-i remove"><i class="icon anm anm-pencil-ar" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>
                                <a href="#" class="remove"><i class="icon anm anm-times-r" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="minicart-bottom">
                    <div class="shipinfo">
                        <div class="progress mb-2">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                        </div>
                        <div class="freeShipMsg"><i class="icon anm anm-truck-l fs-6 me-2 align-middle"></i>Only <span class="money" data-currency-usd="$199.00" data-currency="USD">$199.00</span> away from <b>Free Shipping</b></div>
                        <div class="freeShipMsg d-none"><i class="icon anm anm-truck-l fs-6 me-2 align-middle"></i>Congrats! You are eligible for <b>Free Shipping</b></div>
                    </div>
                    <div class="subtotal clearfix my-3">
                        <div class="totalInfo clearfix mb-1 d-none"><span>Shipping:</span><span class="item product-price">$10.00</span></div>
                        <div class="totalInfo clearfix mb-1 d-none"><span>Tax:</span><span class="item product-price">$0.00</span></div>
                        <div class="totalInfo clearfix"><span>Total:</span><span class="item product-price">$163.00</span></div>

                    </div>
                    <div class="agree-check customCheckbox">
                        <input id="prTearm" name="tearm" type="checkbox" value="tearm" required />
                        <label for="prTearm"> I agree with the </label><a href="#" class="ms-1 text-link">Terms &amp; conditions</a>
                    </div>
                    <div class="minicart-action d-flex mt-3">
                        <a href="checkout-style1.html" class="proceed-to-checkout btn btn-primary w-50 me-1">Check Out</a>
                        <a href="cart-style1.html" class="cart-btn btn btn-secondary w-50 ms-1">View Cart</a>
                    </div>
                </div>
            </div>
            <!--MiniCart Content-->
        </div>
        <!--End MiniCart Drawer-->

        <!-- Product Quickshop Modal-->

        <!-- End Product Quickshop Modal -->

        <!-- Product Addtocart Modal-->

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

                                <!-- End Model Thumbnail -->
                                <div class="text-center mt-3"><a href="product-layout1.html" class="text-link">View More Details</a></div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="product-arrow d-flex justify-content-between">
                                    <h2 class="product-title">Product Quick View Popup</h2>
                                </div>
                                <div class="product-review d-flex mt-0 mb-2">
                                    <div class="rating"><i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i class="icon anm anm-star-o"></i></div>
                                    <div class="reviews ms-2"><a href="#">6 Reviews</a></div>
                                </div>
                                <div class="product-info">
                                    <p class="product-vendor">Vendor:<span class="text"><a href="#">HVL</a></span></p>
                                    <p class="product-sku">SKU:<span class="text">RF104</span></p>
                                </div>
                                <div class="pro-stockLbl my-2">
                                    <span class="d-flex-center stockLbl instock d-none"><span> In stock</span></span>
                                    <span class="d-flex-center stockLbl preorder d-none"><span> Pre-order Now</span></span>
                                    <span class="d-flex-center stockLbl outstock d-none"><span>Sold out</span></span>
                                </div>
                                <div class="product-price d-flex-center my-3">
                                    <span class="price old-price">$135.00</span><span class="price">$129.00</span>
                                </div>
                                <div class="sort-description">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</div>
                                <form method="post" action="#" id="product_form--option" class="product-form">
                                    <div class="product-options d-flex-wrap">
                                        <div class="product-item swatches-image w-100 mb-3 swatch-0 option1" data-option-index="0">
                                            <label class="label d-flex align-items-center">Color:<span class="slVariant ms-1 fw-bold">Blue</span></label>
                                            <ul class="variants-clr swatches d-flex-center pt-1 clearfix">
                                                <li class="swatch large radius available blue"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="Blue"></span></li>
                                                <li class="swatch large radius available black"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="Black"></span></li>
                                                <li class="swatch large radius available pink"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="Pink"></span></li>
                                                <li class="swatch large radius available green"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="Green"></span></li>
                                                <li class="swatch large radius soldout yellow"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="Yellow"></span></li>
                                            </ul>
                                        </div>
                                        <div class="product-item swatches-size w-100 mb-3 swatch-1 option2" data-option-index="1">
                                            <label class="label d-flex align-items-center">Size:<span class="slVariant ms-1 fw-bold">S</span></label>
                                            <ul class="variants-size size-swatches d-flex-center pt-1 clearfix">
                                                <li class="swatch large radius soldout"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="XS">XS</span></li>
                                                <li class="swatch large radius available active"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="S">S</span></li>
                                                <li class="swatch large radius available"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="M">M</span></li>
                                                <li class="swatch large radius available"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="L">L</span></li>
                                                <li class="swatch large radius available"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="XL">XL</span></li>
                                            </ul>
                                        </div>
                                        <div class="product-action d-flex-wrap w-100 pt-1 mb-3 clearfix">
                                            <div class="quantity">
                                                <div class="qtyField">
                                                    <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r" aria-hidden="true"></i></a>
                                                    <input type="text" name="quantity" value="1" class="product-form__input qty">
                                                    <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-l" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="addtocart ms-3 fl-1">
                                                <button type="submit" name="add" class="btn product-cart-submit w-100"><span>Add to cart</span></button>
                                                <button type="submit" name="sold" class="btn btn-secondary product-sold-out w-100 d-none" disabled="disabled"><span>Sold out</span></button>
                                                <button type="submit" name="buy" class="btn btn-secondary proceed-to-checkout w-100 d-none"><span>Buy it now</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="wishlist-btn d-flex-center">
                                    <a class="add-wishlist d-flex-center me-3" href="wishlist-style1.html" title="Add to Wishlist"><i class="icon anm anm-heart-l me-1"></i> <span>Add to Wishlist</span></a>
                                    <a class="add-compare d-flex-center" href="compare-style1.html" title="Add to Compare"><i class="icon anm anm-random-r me-2"></i> <span>Add to Compare</span></a>
                                </div>
                                <!-- Social Sharing -->
                                <div class="social-sharing share-icon d-flex-center mx-0 mt-3">
                                    <span class="sharing-lbl">Share :</span>
                                    <a href="#" class="d-flex-center btn btn-link btn--share share-facebook" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Facebook"><i class="icon anm anm-facebook-f"></i><span class="share-title d-none">Facebook</span></a>
                                    <a href="#" class="d-flex-center btn btn-link btn--share share-twitter" data-bs-toggle="tooltip" data-bs-placement="top" title="Tweet on Twitter"><i class="icon anm anm-twitter"></i><span class="share-title d-none">Tweet</span></a>
                                    <a href="#" class="d-flex-center btn btn-link btn--share share-pinterest" data-bs-toggle="tooltip" data-bs-placement="top" title="Pin on Pinterest"><i class="icon anm anm-pinterest-p"></i> <span class="share-title d-none">Pin it</span></a>
                                    <a href="#" class="d-flex-center btn btn-link btn--share share-linkedin" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Instagram"><i class="icon anm anm-linkedin-in"></i><span class="share-title d-none">Instagram</span></a>
                                    <a href="#" class="d-flex-center btn btn-link btn--share share-whatsapp" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on WhatsApp"><i class="icon anm anm-envelope-l"></i><span class="share-title d-none">WhatsApp</span></a>
                                    <a href="#" class="d-flex-center btn btn-link btn--share share-email" data-bs-toggle="tooltip" data-bs-placement="top" title="Share by Email"><i class="icon anm anm-whatsapp"></i><span class="share-title d-none">Email</span></a>
                                </div>
                                <!-- End Social Sharing -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Product Quickview Modal-->


        <!-- Including Jquery/Javascript -->
        <!-- Plugins JS -->
        <script src="assets/js/plugins.js"></script>
        <!-- Main JS -->
        <script src="assets/js/main.js"></script>

    </div>
    <!--End Page Wrapper-->
</body>
@endsection


