@extends('layouts.client')

@section('content')
    @include('client.component.page_header')
    <div class="container" style="max-width: 80%;">
        <!--Main Content-->
        <div class="container">
            <!--Product Content-->
            <div class="product-single">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 product-layout-img mb-4 mb-md-0">
                        <!-- Product Horizontal -->
                        <div class="product-details-img product-horizontal-style">
                            <!-- Product Main -->
                            <div class="zoompro-wrap">
                                <!-- Product Image -->
                                <div class="zoompro-span">
                                    <img id="zoompro" class="zoompro" src="{{ $product->img_thumbnail }}" 
                                        data-zoom-image="{{ $product->img_thumbnail }}" alt="product" width="625" height="808" />
                                </div>
                                <!-- End Product Image -->
                                <!-- Product Label -->
                                <div class="product-labels">
                                    <span class="lbl pr-label1">New</span>
                                    <span class="lbl on-sale">Sale</span>
                                </div>
                                <!-- End Product Label -->
                                <!-- Product Buttons -->
                                <div class="product-buttons">
                                    <a href="#;" class="btn btn-primary prlightbox" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Zoom Image"><i
                                            class="icon anm anm-expand-l-arrows"></i></a>
                                </div>
                                <!-- End Product Buttons -->
                            </div>
                            <!-- End Product Main -->

                            <!-- Product Thumb -->
                            <div class="product-thumb product-horizontal-thumb mt-3">
                                <div id="gallery" class="product-thumb-horizontal">
                                    @foreach ($product->images as $item)
                                        <a href="javascript:void(0);" data-image="{{ $item->image }}" data-zoom-image="{{ $item->image }}" class="thumbnail">
                                            <img class="blur-up lazyload" data-src="{{ $item->image }}" src="{{ $item->image }}" alt="product" width="625" height="808" />
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <!-- End Product Thumb -->
                        </div>
                        <!-- End Product Horizontal -->
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 product-layout-info">
                        <!-- Product Details -->
                        <div class="product-single-meta">
                            <h2 class="product-main-title">{{ $product->name }}</h2>
                            <!-- Product Reviews -->
                            <div class="product-review d-flex-center mb-3">
                                <div class="reviewStar d-flex-center"><i class="icon anm anm-star"></i><i
                                        class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                        class="icon anm anm-star"></i><i class="icon anm anm-star-o"></i><span
                                        class="caption ms-2">24 Reviews</span></div>
                                <a class="reviewLink d-flex-center" href="#reviews">Write a Review</a>
                            </div>
                            <!-- End Product Reviews -->
                            <!-- Product Info -->
                            <div class="product-info">
                                <p class="product-stock d-flex">Availability:
                                    <span class="pro-stockLbl ps-0">
                                        @if ($totalStock > 10)
                                            <span class="d-flex-center stockLbl instock text-uppercase">In stock</span>
                                        @elseif($totalStock == 0)
                                            <span class="d-flex-center stockLbl text-danger text-uppercase">Sould out</span>
                                        @else
                                            <span class="d-flex-center stockLbl text-warning text-uppercase">Low
                                                stock</span>
                                        @endif
                                    </span>
                                </p>
                                <p class="product-vendor">Vendor:<span class="text"><a href="#">HVL</a></span>
                                </p>
                                <p class="product-type">Product Type:<span class="text">{{ $product->material }}</span>
                                </p>
                                <p class="product-sku">SKU:<span class="text">{{ $product->sku }}</span></p>
                            </div>

                            <!-- End Product Info -->
                            <!-- Product Price -->
                            <div class="product-price d-flex-center my-3">
                                <span class="price old-price">${{ $product->price_regular }}</span><span
                                    class="price">${{ $product->price_sale }}</span>
                            </div>
                            <!-- End Product Price -->
                            <hr>
                            <!-- Sort Description -->
                            <div class="sort-description">
                                {{ $product->description }}
                            </div>
                            <!-- End Sort Description -->
                            <hr>
                            <!-- Countdown -->
                            <h3 class="text-uppercase mb-0">Hurry up! Sales Ends In</h3>
                            <div class="product-countdown d-flex-center text-center my-3" data-countdown="2028/12/12">
                            </div>
                            <!-- End Countdown -->
                        </div>
                        <!-- End Product Details -->

                        <!-- Product Form -->
                        <form method="POST" action="{{ route('cart.add') }} " class="product-form product-form-border hidedropdown">
                            @csrf
                            <!-- Swatches -->
                            <div class="product-swatches-option">
                                <!-- Swatches Color -->
                                <div class="product-item swatches-image w-100 mb-4 swatch-0 option1" data-option-index="0">
                                    <label class="label d-flex align-items-center">Color:<span
                                            class="slVariant ms-1 fw-bold">Blue</span></label>
                                    <ul class="variants-clr swatches d-flex-center pt-1 clearfix">
                                        @foreach ($uniqueAttributes->where('attributeName', 'Color') as $color)
                                            <li class="swatch x-large available"
                                                data-color-code="{{ $color['colorCode'] }}"
                                                style="background-color: {{ $color['colorCode'] }}; width: 35px; height: 35px;"
                                                data-bs-toggle="tooltip" data-bs-placement="top" data-attribute-value-id="{{ $color['value'] }}"
                                                title="{{ $color['value'] }}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Swatches Size -->
                                <div class="product-item swatches-size w-100 mb-4 swatch-1 option2" data-option-index="1">
                                    <label class="label d-flex align-items-center">Size:<span
                                            class="slVariant ms-1 fw-bold">S</span></label>
                                    <ul class="variants-size size-swatches d-flex-center pt-1 clearfix">
                                        @foreach ($uniqueAttributes->where('attributeName', 'Size') as $size)
                                            <li class="swatch x-large available" data-attribute-value-id="{{ $size['value'] }}">
                                                <span class="swatchLbl" data-bs-toggle="tooltip" 
                                                data-attribute-value-id="{{ $size['value'] }}"
                                                    title="{{ $size['value'] }}">
                                                    {{ $size['value'] }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                            <!-- End Swatches -->
                            <input type="hidden" name="color_id" id="color_id" >
                            <input type="hidden" name="size_id" id="size_id" >
                            <!-- Product Action -->
                            <div class="product-action w-100 d-flex-wrap my-3 my-md-4">
                                <!-- Product Quantity -->
                                <div class="product-form-quantity d-flex-center">
                                    <div class="qtyField">
                                        <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"></i></a>
                                        <input type="text" name="quantity" value="1"
                                            class="product-form-input qty" id="quantityInput"/>
                                        <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                                    </div>
                                </div>
                                <!-- End Product Quantity -->
                                <!-- Product Add -->
                                <div class="product-form-submit addcart fl-1 ms-3">
                                    <button type="submit" class="btn btn-secondary product-form-cart-submit">
                                        <span>Add to cart</span>
                                    </button>
                                    {{-- <button type="button" name="add"
                                        class="btn btn-secondary product-form-sold-out d-none" disabled="disabled">
                                        <span>Out of stock</span>
                                    </button>
                                    <button type="button" name="add"
                                        class="btn btn-secondary product-form-pre-order d-none">
                                        <span>Pre-order Now</span>
                                    </button> --}}
                                </div>
                                <!-- Product Add -->
                                <!-- Product Buy -->
                                <div class="product-form-submit buyit fl-1 ms-3">
                                    <button type="button" class="btn btn-primary proceed-to-checkout">
                                        <span> Buy it now </span>
                                    </button>
                                </div>
                                <!-- End Product Buy -->
                            </div>
                            <!-- End Product Action -->

                            <!-- Product Info link -->
                            <p class="infolinks d-flex-center justify-content-between">
                                <a class="text-link wishlist" href="wishlist-style1.html"><i
                                        class="icon anm anm-heart-l me-2"></i> <span>Add to Wishlist</span></a>
                                <a href="#shippingInfo-modal" class="text-link shippingInfo" data-bs-toggle="modal"
                                    data-bs-target="#shippingInfo_modal"><i class="icon anm anm-paper-l-plane me-2"></i>
                                    <span>Delivery &amp; Returns</span></a>
                                <a href="#productInquiry-modal" class="text-link emaillink me-0" data-bs-toggle="modal"
                                    data-bs-target="#productInquiry_modal"><i class="icon anm anm-question-cil me-2"></i>
                                    <span>Enquiry</span></a>
                            </p>
                            <!-- End Product Info link -->
                        </form>
                        <!-- End Product Form -->

                        <!-- Product Info -->
                        <div class="userViewMsg featureText" data-user="20" data-time="11000"><i
                                class="icon anm anm-eye-r"></i><b class="uersView">21</b> People are Looking for this
                            Product</div>
                        <div class="shippingMsg featureText"><i class="icon anm anm-clock-r"></i>Estimated Delivery
                            Between <b id="fromDate">Wed, May 1</b> and <b id="toDate">Tue, May 7</b>.</div>
                        <div class="freeShipMsg featureText" data-price="199"><i class="icon anm anm-truck-r"></i>Spent
                            <b class="freeShip"><span class="money" data-currency-usd="$199.00"
                                    data-currency="USD">$199.00</span></b> More for Free shipping
                        </div>
                        <!-- End Product Info -->

                        <!-- Social Sharing -->
                        <div class="social-sharing d-flex-center mt-2 lh-lg">
                            <span class="sharing-lbl fw-600">Share :</span>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-facebook"><i
                                    class="icon anm anm-facebook-f"></i><span class="share-title">Facebook</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-twitter"><i
                                    class="icon anm anm-twitter"></i><span class="share-title">Tweet</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-pinterest"><i
                                    class="icon anm anm-pinterest-p"></i> <span class="share-title">Pin it</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-linkedin"><i
                                    class="icon anm anm-linkedin-in"></i><span class="share-title">Linkedin</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-email"><i
                                    class="icon anm anm-envelope-l"></i><span class="share-title">Email</span></a>
                        </div>
                        <!-- End Social Sharing -->
                    </div>
                </div>
            </div>
            <!--Product Content-->

            <!--Product Tabs-->
            <div class="tabs-listing section pb-0">
                <ul class="product-tabs style2 list-unstyled d-flex-wrap d-flex-justify-center d-none d-md-flex">
                    <li rel="description" class="active"><a class="tablink">Description</a></li>
                    <li rel="shipping-return"><a class="tablink">Shipping &amp; Return</a></li>
                    <li rel="reviews"><a class="tablink">Reviews</a></li>
                </ul>

                <div class="tab-container">
                    <!--Description-->
                    <h3 class="tabs-ac-style d-md-none active" rel="description">Description</h3>
                    <div id="description" class="tab-content">
                        <div class="product-description">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                    {{ $product->content }}
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                        suffered alteration in some form, by injected humour, or randomised words which
                                        don't look even slightly believable.</p>
                                    <h4 class="mb-3">Features</h4>
                                    <ul class="checkmark-info">
                                        <li>High quality fabric, very comfortable to touch and wear.</li>
                                        <li>This cardigan sweater is cute for no reason,perfect for travel and casual.</li>
                                        <li>It can tie in front-is forgiving to you belly or tie behind.</li>
                                        <li>Light weight and perfect for layering.</li>
                                    </ul>
                                    <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                                        interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by
                                        Cicero are also reproduced in their exact original form, accompanied by English
                                        versions from the 1914 translation by H. Rackham.</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <img data-src="assets/images/content/product-detail-img.jpg"
                                        src="assets/images/content/product-detail-img.jpg" alt="image" width="600"
                                        height="600" />
                                </div>
                            </div>
                        </div>
                        <!--Size Chart-->
                        <h3 class="tabs-ac-style d-md-none" rel="description">Size Chart</h3>
                        <div id="description" class="tab-content">
                            <h4 class="mb-2">Ready to Wear Clothing</h4>
                            <p class="mb-4">This is a standardised guide to give you an idea of what size you will need,
                                however some brands may vary from these conversions.</p>
                            <div class="size-chart-tbl table-responsive px-1">
                                <table class="table-bordered align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>XXS - XS</th>
                                            <th>XS - S</th>
                                            <th>S - M</th>
                                            <th>M - L</th>
                                            <th>L - XL</th>
                                            <th>XL - XXL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>UK</th>
                                            <td>6</td>
                                            <td>8</td>
                                            <td>10</td>
                                            <td>12</td>
                                            <td>14</td>
                                            <td>16</td>
                                        </tr>
                                        <tr>
                                            <th>US</th>
                                            <td>2</td>
                                            <td>4</td>
                                            <td>6</td>
                                            <td>8</td>
                                            <td>10</td>
                                            <td>12</td>
                                        </tr>
                                        <tr>
                                            <th>Italy (IT)</th>
                                            <td>38</td>
                                            <td>40</td>
                                            <td>42</td>
                                            <td>44</td>
                                            <td>46</td>
                                            <td>48</td>
                                        </tr>
                                        <tr>
                                            <th>France (FR/EU)</th>
                                            <td>34</td>
                                            <td>36</td>
                                            <td>38</td>
                                            <td>40</td>
                                            <td>42</td>
                                            <td>44</td>
                                        </tr>
                                        <tr>
                                            <th>Denmark</th>
                                            <td>32</td>
                                            <td>34</td>
                                            <td>36</td>
                                            <td>38</td>
                                            <td>40</td>
                                            <td>42</td>
                                        </tr>
                                        <tr>
                                            <th>Russia</th>
                                            <td>40</td>
                                            <td>42</td>
                                            <td>44</td>
                                            <td>46</td>
                                            <td>48</td>
                                            <td>50</td>
                                        </tr>
                                        <tr>
                                            <th>Germany</th>
                                            <td>32</td>
                                            <td>34</td>
                                            <td>36</td>
                                            <td>38</td>
                                            <td>40</td>
                                            <td>42</td>
                                        </tr>
                                        <tr>
                                            <th>Japan</th>
                                            <td>5</td>
                                            <td>7</td>
                                            <td>9</td>
                                            <td>11</td>
                                            <td>13</td>
                                            <td>15</td>
                                        </tr>
                                        <tr>
                                            <th>Australia</th>
                                            <td>6</td>
                                            <td>8</td>
                                            <td>10</td>
                                            <td>12</td>
                                            <td>14</td>
                                            <td>16</td>
                                        </tr>
                                        <tr>
                                            <th>Korea</th>
                                            <td>33</td>
                                            <td>44</td>
                                            <td>55</td>
                                            <td>66</td>
                                            <td>77</td>
                                            <td>88</td>
                                        </tr>
                                        <tr>
                                            <th>China</th>
                                            <td>160/84</td>
                                            <td>165/86</td>
                                            <td>170/88</td>
                                            <td>175/90</td>
                                            <td>180/92</td>
                                            <td>185/94</td>
                                        </tr>
                                        <tr>
                                            <th>Jeans</th>
                                            <td>24-25</td>
                                            <td>26-27</td>
                                            <td>27-28</td>
                                            <td>29-30</td>
                                            <td>31-32</td>
                                            <td>32-33</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--End Size Chart-->
                    </div>
                    <!--End Description-->


                    <!--Shipping &amp; Return-->
                    <h3 class="tabs-ac-style d-md-none" rel="shipping-return">Shipping &amp; Return</h3>
                    <div id="shipping-return" class="tab-content">
                        <h4>Shipping &amp; Return</h4>
                        <ul class="checkmark-info">
                            <li>Dispatch: Within 24 Hours</li>
                            <li>1 Year Brand Warranty</li>
                            <li>Free shipping across all products on a minimum purchase of $50.</li>
                            <li>International delivery time - 7-10 business days</li>
                            <li>Cash on delivery might be available</li>
                            <li>Easy 30 days returns and exchanges</li>
                        </ul>
                        <h4>Free and Easy Returns</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                            but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        <h4>Special Financing</h4>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                            alteration in some form, by injected humour, or randomised words which don't look even slightly
                            believable. If you are going to use a passage.</p>
                    </div>
                    <!--End Shipping &amp; Return-->
                    <!--Review-->
                    <h3 class="tabs-ac-style d-md-none" rel="reviews">Review</h3>
                    <div id="reviews" class="tab-content">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-4">
                                <div class="ratings-main">
                                    <div class="avg-rating d-flex-center mb-3">
                                        <h4 class="avg-mark">5.0</h4>
                                        <div class="avg-content ms-3">
                                            <p class="text-rating">Average Rating</p>
                                            <div class="ratings-full product-review">
                                                <a class="reviewLink d-flex-center" href="#reviews"><i
                                                        class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                                        class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                                        class="icon anm anm-star-o"></i><span class="caption ms-2">24
                                                        Ratings</span></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ratings-list">
                                        <div class="ratings-container d-flex align-items-center mt-1">
                                            <div class="ratings-full product-review m-0">
                                                <a class="reviewLink d-flex align-items-center" href="#reviews"><i
                                                        class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                                        class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                                        class="icon anm anm-star-o"></i></a>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="99"
                                                    aria-valuemin="0" aria-valuemax="100" style="width:99%;"></div>
                                            </div>
                                            <div class="progress-value">99%</div>
                                        </div>
                                        <div class="ratings-container d-flex align-items-center mt-1">
                                            <div class="ratings-full product-review m-0">
                                                <a class="reviewLink d-flex align-items-center" href="#reviews"><i
                                                        class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                                        class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                                        class="icon anm anm-star-o"></i></a>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="75"
                                                    aria-valuemin="0" aria-valuemax="100" style="width:75%;"></div>
                                            </div>
                                            <div class="progress-value">75%</div>
                                        </div>
                                        <div class="ratings-container d-flex align-items-center mt-1">
                                            <div class="ratings-full product-review m-0">
                                                <a class="reviewLink d-flex align-items-center" href="#reviews"><i
                                                        class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                                        class="icon anm anm-star"></i><i
                                                        class="icon anm anm-star-o"></i><i
                                                        class="icon anm anm-star-o"></i></a>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="50"
                                                    aria-valuemin="0" aria-valuemax="100" style="width:50%;"></div>
                                            </div>
                                            <div class="progress-value">50%</div>
                                        </div>
                                        <div class="ratings-container d-flex align-items-center mt-1">
                                            <div class="ratings-full product-review m-0">
                                                <a class="reviewLink d-flex align-items-center" href="#reviews"><i
                                                        class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                                        class="icon anm anm-star-o"></i><i
                                                        class="icon anm anm-star-o"></i><i
                                                        class="icon anm anm-star-o"></i></a>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100" style="width:25%;"></div>
                                            </div>
                                            <div class="progress-value">25%</div>
                                        </div>
                                        <div class="ratings-container d-flex align-items-center mt-1">
                                            <div class="ratings-full product-review m-0">
                                                <a class="reviewLink d-flex align-items-center" href="#reviews"><i
                                                        class="icon anm anm-star"></i><i
                                                        class="icon anm anm-star-o"></i><i
                                                        class="icon anm anm-star-o"></i><i
                                                        class="icon anm anm-star-o"></i><i
                                                        class="icon anm anm-star-o"></i></a>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="5"
                                                    aria-valuemin="0" aria-valuemax="100" style="width:5%;"></div>
                                            </div>
                                            <div class="progress-value">05%</div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="spr-reviews">
                                    <h3 class="spr-form-title">Customer Reviews</h3>
                                    <div class="review-inner">
                                        <div class="spr-review d-flex w-100">
                                            <div class="spr-review-profile flex-shrink-0">
                                                <img class="blur-up lazyload" data-src="assets/images/users/user-img1.jpg"
                                                    src="assets/images/users/user-img1.jpg" alt="" width="200"
                                                    height="200" />
                                            </div>
                                            <div class="spr-review-content flex-grow-1">
                                                <div class="d-flex justify-content-between flex-column mb-2">
                                                    <div
                                                        class="title-review d-flex align-items-center justify-content-between">
                                                        <h5 class="spr-review-header-title text-transform-none mb-0">
                                                            Eleanor Pena</h5>
                                                        <span class="product-review spr-starratings m-0"><span
                                                                class="reviewLink"><i class="icon anm anm-star"></i><i
                                                                    class="icon anm anm-star"></i><i
                                                                    class="icon anm anm-star"></i><i
                                                                    class="icon anm anm-star"></i><i
                                                                    class="icon anm anm-star"></i></span></span>
                                                    </div>
                                                </div>
                                                <b class="head-font">Good and High quality</b>
                                                <p class="spr-review-body">There are many variations of passages of Lorem
                                                    Ipsum available, but the majority have suffered alteration in some form,
                                                    by injected humour.</p>
                                            </div>
                                        </div>
                                        <div class="spr-review d-flex w-100">
                                            <div class="spr-review-profile flex-shrink-0">
                                                <img class="blur-up lazyload"
                                                    data-src="assets/images/users/testimonial1.jpg"
                                                    src="assets/images/users/testimonial1.jpg" alt=""
                                                    width="200" height="200" />
                                            </div>
                                            <div class="spr-review-content flex-grow-1">
                                                <div class="d-flex justify-content-between flex-column mb-2">
                                                    <div
                                                        class="title-review d-flex align-items-center justify-content-between">
                                                        <h5 class="spr-review-header-title text-transform-none mb-0">
                                                            Courtney Henry</h5>
                                                        <span class="product-review spr-starratings m-0"><span
                                                                class="reviewLink"><i class="icon anm anm-star"></i><i
                                                                    class="icon anm anm-star"></i><i
                                                                    class="icon anm anm-star"></i><i
                                                                    class="icon anm anm-star-o"></i><i
                                                                    class="icon anm anm-star-o"></i></span></span>
                                                    </div>
                                                </div>
                                                <b class="head-font">Feature Availability</b>
                                                <p class="spr-review-body">The standard chunk of Lorem Ipsum used since the
                                                    1500s is reproduced below for those interested. Sections 1.10.32 and
                                                    1.10.33</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-4">
                                <form method="post" action="#" class="product-review-form new-review-form">
                                    <h3 class="spr-form-title">Write a Review</h3>
                                    <p>Your email address will not be published. Required fields are marked *</p>
                                    <fieldset class="row spr-form-contact">
                                        <div class="col-sm-6 spr-form-contact-name form-group">
                                            <label class="spr-form-label" for="nickname">Name <span
                                                    class="required">*</span></label>
                                            <input class="spr-form-input spr-form-input-text" id="nickname"
                                                type="text" name="name" required />
                                        </div>
                                        <div class="col-sm-6 spr-form-contact-email form-group">
                                            <label class="spr-form-label" for="email">Email <span
                                                    class="required">*</span></label>
                                            <input class="spr-form-input spr-form-input-email " id="email"
                                                type="email" name="email" required />
                                        </div>
                                        <div class="col-sm-6 spr-form-review-title form-group">
                                            <label class="spr-form-label" for="review">Review Title </label>
                                            <input class="spr-form-input spr-form-input-text " id="review"
                                                type="text" name="review" />
                                        </div>
                                        <div class="col-sm-6 spr-form-review-rating form-group">
                                            <label class="spr-form-label">Rating</label>
                                            <div class="product-review pt-1">
                                                <div class="review-rating">
                                                    <a href="#;"><i class="icon anm anm-star-o"></i></a><a
                                                        href="#;"><i class="icon anm anm-star-o"></i></a><a
                                                        href="#;"><i class="icon anm anm-star-o"></i></a><a
                                                        href="#;"><i class="icon anm anm-star-o"></i></a><a
                                                        href="#;"><i class="icon anm anm-star-o"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 spr-form-review-body form-group">
                                            <label class="spr-form-label" for="message">Body of Review <span
                                                    class="spr-form-review-body-charactersremaining">(1500) characters
                                                    remaining</span></label>
                                            <div class="spr-form-input">
                                                <textarea class="spr-form-input spr-form-input-textarea" id="message" name="message" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="spr-form-actions clearfix">
                                        <input type="submit" class="btn btn-primary spr-button spr-button-primary"
                                            value="Submit Review" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End Review-->
                </div>
            </div>
            <!--End Product Tabs-->
        </div>
        <!--End Main Content-->

        <!--Related Products-->
        <section class="section product-slider pb-0">
            <div class="container">
                <div class="section-header">
                    <p class="mb-1 mt-0">Discover Similar</p>
                    <h2>Related Products</h2>
                </div>

                <!--Product Grid-->
                <div class="grid-products grid-view-items">
                    <div
                        class="row col-row product-options row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-3 row-cols-2">
                        @foreach ($relatedProducts as $product)
                            <div class="item col-item">
                                <div class="product-box">
                                    <!-- Start Product Image -->
                                    <div class="product-image">
                                        <a href="{{ route('productDetail', $product->id) }}"
                                            class="product-img rounded-0">
                                            <img class="primary rounded-0 blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product5.jpg') }}"
                                                src="{{ asset('client/images/products/product5.jpg') }}" alt="Product"
                                                title="{{ $product->name }}" width="625" height="808" />
                                            <img class="hover rounded-0 blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product5-1.jpg') }}"
                                                src="{{ asset('client/images/products/product5-1.jpg') }}" alt="Product"
                                                title="{{ $product->name }}" width="625" height="808" />
                                        </a>
                                        <div class="product-labels"><span class="lbl pr-label2">Hot</span></div>
                                        <div class="button-set style1">
                                            <a href="#addtocart-modal" class="btn-icon addtocart add-to-cart-modal"
                                                data-bs-toggle="modal" data-bs-target="#addtocart_modal">
                                                <span class="icon-wrap d-flex-justify-center h-100 w-100"
                                                    data-bs-toggle="tooltip" data-bs-placement="left"
                                                    title="Add to Cart"><i class="icon anm anm-cart-l"></i><span
                                                        class="text">Add to Cart</span></span>
                                            </a>
                                            <a href="#quickview-modal" class="btn-icon quickview quick-view-modal"
                                                data-bs-toggle="modal" data-bs-target="#quickview_modal">
                                                <span class="icon-wrap d-flex-justify-center h-100 w-100"
                                                    data-bs-toggle="tooltip" data-bs-placement="left"
                                                    title="Quick View"><i class="icon anm anm-search-plus-l"></i><span
                                                        class="text">Quick View</span></span>
                                            </a>
                                            <a href="wishlist-style2.html" class="btn-icon wishlist"
                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                title="Add To Wishlist"><i class="icon anm anm-heart-l"></i><span
                                                    class="text">Add To Wishlist</span></a>
                                            <a href="compare-style2.html" class="btn-icon compare"
                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                title="Add to Compare"><i class="icon anm anm-random-r"></i><span
                                                    class="text">Add to Compare</span></a>
                                        </div>
                                    </div>
                                    <div class="product-details text-center">
                                        <div class="product-vendor">{{ $product->catalogue->name }}</div>
                                        <div class="product-name">
                                            <a href="{{ route('productDetail', $product->id) }}">{{ $product->name }}</a>
                                        </div>
                                        <div class="product-price">
                                            <span class="price">{{ $product->price_sale }}đ</span>
                                        </div>
                                        <div class="product-review">
                                            <i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                                class="icon anm anm-star-o"></i><i class="icon anm anm-star-o"></i><i
                                                class="icon anm anm-star-o"></i>
                                            <span class="caption hidden ms-1">3 Reviews</span>
                                        </div>
                                        <p class="sort-desc hidden">There are many variations of passages of Lorem Ipsum
                                            available...</p>
                                        <ul class="variants-clr swatches">
                                            @if ($product->variants->isNotEmpty())
                                                @foreach ($product->variants as $variant)
                                                    @foreach ($variant->variantAttributes as $variantAttribute)
                                                        @if ($variantAttribute->attribute->slug === 'color')
                                                            <li class="swatch medium radius"
                                                                style="background-color: {{ $variantAttribute->attributeValue->color_code }}">
                                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{ $variantAttribute->attributeValue->value }}"></span>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="view-collection text-center mt-4 mt-md-5">
                        <a href="{{ route('shop') }}" class="btn btn-secondary btn-lg">View Collection</a>
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
                                            <img class="carousel-indicator-img"
                                                data-src="{{ asset('client/images/products/product2.jpg') }}"
                                                src="{{ asset('client/images/products/product2.jpg') }}" alt="product"
                                                title="Product" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-1" data-bs-slide-to="1"
                                            data-bs-target="#quickView">
                                            <img class="carousel-indicator-img"
                                                data-src="{{ asset('client/images/products/product2-1.jpg') }}"
                                                src="{{ asset('client/images/products/product2-1.jpg') }}" alt="product"
                                                title="Product" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-2" data-bs-slide-to="2"
                                            data-bs-target="#quickView">
                                            <img class="carousel-indicator-img"
                                                data-src="{{ asset('client/images/products/product2-2.jpg') }}"
                                                src="{{ asset('client/images/products/product2-2.jpg') }}" alt="product"
                                                title="Product" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-3" data-bs-slide-to="3"
                                            data-bs-target="#quickView">
                                            <img class="carousel-indicator-img"
                                                data-src="{{ asset('client/images/products/product2-3.jpg') }}"
                                                src="{{ asset('client/images/products/product2-3.jpg') }}" alt="product"
                                                title="Product" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-4" data-bs-slide-to="4"
                                            data-bs-target="#quickView">
                                            <img class="carousel-indicator-img"
                                                data-src="{{ asset('client/images/products/product2-4.jpg') }}"
                                                src="{{ asset('client/images/products/product2-4.jpg') }}" alt="product"
                                                title="Product" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-5" data-bs-slide-to="5"
                                            data-bs-target="#quickView">
                                            <img class="carousel-indicator-img"
                                                data-src="{{ asset('client/images/products/product2-5.jpg') }}"
                                                src="{{ asset('client/images/products/product2-5.jpg') }}" alt="product"
                                                title="Product" />
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
        let selectedColorId = null;
        let selectedSizeId = null;

        // Handle color selection
        document.querySelectorAll('.variants-clr .swatch').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.variants-clr .swatch').forEach(swatch => {
                    swatch.classList.remove('selected');
                });
                item.classList.add('selected');
                selectedColorId = item.getAttribute('data-attribute-value-id');
                document.getElementById('color_id').value = selectedColorId;
            });
        });

        // Handle size selection
        document.querySelectorAll('.variants-size .swatch').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.variants-size .swatch').forEach(swatch => {
                    swatch.classList.remove('selected');
                });
                item.classList.add('selected');
                selectedSizeId = item.getAttribute('data-attribute-value-id');
                document.getElementById('size_id').value = selectedSizeId;
            });
        });

        // Validate quantity input
        const amountInput = document.getElementById('quantityInput');
        amountInput.addEventListener('input', function() {
            let qty = parseInt(this.value);
            if (isNaN(qty) || qty < 1) { // Ensure the minimum quantity is 1
                this.value = 1;
            }
        });

        // Handle form submission
        document.querySelector('.product-form').addEventListener('submit', function(event) {
            // Prevent form submission if color or size is not selected
            if (!document.getElementById('color_id').value || !document.getElementById('size_id').value) {
                event.preventDefault();
                alert('Please select both color and size.');
                return; // Stop further execution if validation fails
            }

            // Otherwise, let the form submit to the Laravel controller
        });
    });


    </script>

    <script>
        // select ảnh
        document.addEventListener('DOMContentLoaded', function() {
            const thumbnails = document.querySelectorAll('.thumbnail');
            const mainImage = document.getElementById('zoompro');

            thumbnails.forEach(function(thumbnail) {
                thumbnail.addEventListener('click', function(event) {
                    event.preventDefault();
                    const newImage = thumbnail.getAttribute('data-image');
                    const newZoomImage = thumbnail.getAttribute('data-zoom-image');
                    
                    mainImage.setAttribute('src', newImage);
                    mainImage.setAttribute('data-zoom-image', newZoomImage);
                });
            });
        });

    </script>

    <script src="{{asset('admin\js\plugins\slick-carousel\slick.js')}}"></script>
@endsection
