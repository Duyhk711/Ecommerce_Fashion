@extends('layouts.client')

@section('content')
    <!--Home Slideshow-->
    <section class="slideshow slideshow-wrapper">
        <div class="home-slideshow slick-arrow-dots">
            @foreach($banners['mainBanners'] as $banner)
            @php
                $bannerImages = $banner->images;
            @endphp
             @foreach($bannerImages as $bannerImage)
                <div class="slide">
                    <div class="slideshow-wrap">
                        <picture>
                            <source media="(max-width:767px)"
                                srcset="{{ Storage::url($bannerImage->image) }}" width="1150"
                                height="800" />
                            <img class="blur-up lazyload" src="{{ Storage::url($bannerImage->image) }}"
                                alt="slideshow" title="" width="1920" height="795" />
                        </picture>
                        <div class="container">
                            <div class="slideshow-content slideshow-overlay middle-left">
                                <div class="slideshow-content-in">
                                    <div class="wrap-caption animation style1">
                                        <p class="ss-small-title">Elegant design</p>
                                        <h2 class="ss-mega-title">
                                            Making someone feel <br />pretty is an art
                                        </h2>
                                        <p class="ss-sub-title xs-hide">
                                            Perfectly designed to ensures ultimate comfort and
                                            style
                                        </p>
                                        <div class="ss-btnWrap">
                                            <a class="btn btn-primary" href="shop-grid-view.html">Shop Women</a>
                                            <a class="btn btn-secondary" href="shop-grid-view.html">Shop Men</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @endforeach
            {{-- <div class="slide">
                <div class="slideshow-wrap">
                    <picture>
                        <source media="(max-width:767px)"
                            srcset="{{ asset('client/images/slideshow/demo1-banner2-mbl.jpg') }}" width="1150"
                            height="800" />
                        <img class="blur-up lazyload" src="{{ asset('client/images/slideshow/demo1-banner2.jpg') }}"
                            alt="slideshow" title="" width="1920" height="795" />
                    </picture>
                    <div class="container">
                        <div class="slideshow-content slideshow-overlay middle-right">
                            <div class="slideshow-content-in">
                                <div class="wrap-caption animation style1">
                                    <h2 class="ss-mega-title">
                                        Spread Positive <br />Energy With Hema
                                    </h2>
                                    <p class="ss-sub-title xs-hide">
                                        The must-have closet essential women wardrobe for the
                                        year
                                    </p>
                                    <div class="ss-btnWrap d-flex-justify-start">
                                        <a class="btn btn-primary" href="shop-grid-view.html">Explore Now!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide">
                <div class="slideshow-wrap">
                    <picture>
                        <source media="(max-width:767px)"
                            srcset="{{ asset('client/images/slideshow/demo1-banner3-mbl.jpg') }}" width="1150"
                            height="800" />
                        <img class="blur-up lazyload" src="{{ asset('client/images/slideshow/demo1-banner3.jpg') }}"
                            alt="slideshow" title="" width="1920" height="795" />
                    </picture>
                    <div class="container">
                        <div class="slideshow-content slideshow-overlay middle-right">
                            <div class="slideshow-content-in">
                                <div class="wrap-caption animation style1">
                                    <h2 class="ss-mega-title">
                                        Design Your Next <br />Favourite Wear
                                    </h2>
                                    <p class="ss-sub-title xs-hide">
                                        The outfit that blend elegance and style for your
                                        casual wear
                                    </p>
                                    <div class="ss-btnWrap">
                                        <a class="btn btn-primary" href="shop-grid-view.html">Shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <!--End Home Slideshow-->
    <div class="container" style="max-width: 80%;">
        <!--Service Section-->
        <section class="section service-section pb-0">
            <div class="container">
                <div class="service-info row col-row row-cols-lg-4 row-cols-md-4 row-cols-sm-2 row-cols-2 text-center">
                    <div class="service-wrap col-item">
                        <div class="service-icon mb-3">
                            <i class="icon anm anm-phone-call-l"></i>
                        </div>
                        <div class="service-content">
                            <h3 class="title mb-2">Call us any time</h3>
                            <span class="text-muted">Contact us 24/7 hours a day</span>
                        </div>
                    </div>
                    <div class="service-wrap col-item">
                        <div class="service-icon mb-3">
                            <i class="icon anm anm-truck-l"></i>
                        </div>
                        <div class="service-content">
                            <h3 class="title mb-2">Pickup At Any Store</h3>
                            <span class="text-muted">Free shipping on orders over $65</span>
                        </div>
                    </div>
                    <div class="service-wrap col-item">
                        <div class="service-icon mb-3">
                            <i class="icon anm anm-credit-card-l"></i>
                        </div>
                        <div class="service-content">
                            <h3 class="title mb-2">Secured Payment</h3>
                            <span class="text-muted">We accept all major credit cards</span>
                        </div>
                    </div>
                    <div class="service-wrap col-item">
                        <div class="service-icon mb-3">
                            <i class="icon anm anm-redo-l"></i>
                        </div>
                        <div class="service-content">
                            <h3 class="title mb-2">Free Returns</h3>
                            <span class="text-muted">30-days free return policy</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Service Section-->

        <!--Collection banner-->
        <section class="section collection-banners pb-0">
            <div class="container">
                <div class="collection-banner-grid">
                    <div class="row sp-row">
                        @foreach($banners['topBanners'] as $banner)
                            @php
                                $bannerImages = $banner->images;
                                $imageIndex = 0; 
                                $selectedImage = $bannerImages->get($imageIndex);
                            @endphp
                            @if($selectedImage)
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 collection-banner-item">
                                    <div class="collection-item sp-col">
                                        <a href="shop-left-sidebar.html" class="zoom-scal">
                                            <div class="img">
                                                <img class="blur-up lazyload"
                                                    data-src="{{ Storage::url($selectedImage->image) }}"
                                                    src="{{ Storage::url($selectedImage->image) }}"
                                                    alt="Banner Image"
                                                    title="Banner Image"
                                                    style="height:723px ; width:100%"
                                                    />
                                            </div>
                                            <div class="details middle-right">
                                                <div class="inner">
                                                    <p class="mb-2">Trending Now</p>
                                                    <h3 class="title">Banner Title</h3>
                                                    <span class="btn btn-outline-secondary btn-md">Shop Now</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 collection-banner-item">
                                @php
                                    $bannerImages = $banner->images;
                                    $imageIndex = 1;
                                    $selectedImage = $bannerImages->get($imageIndex);
                                @endphp
                                @if($selectedImage)
                                    <div class="collection-item sp-col">
                                        <a href="shop-left-sidebar.html" class="zoom-scal">
                                            <div class="img">
                                                <img class="blur-up lazyload"
                                                    data-src="{{ Storage::url($selectedImage->image) }}"
                                                    src="{{ Storage::url($selectedImage->image) }}"
                                                    alt="Banner Image"
                                                    title="Banner Image"
                                                    style="height:350px ; width:100%"
                                                    />
                                            </div>
                                            <div class="details middle-left">
                                                <div class="inner">
                                                    <h3 class="title mb-2">Mens Wear</h3>
                                                    <p class="mb-3">Tailor-made with passion</p>
                                                    <span class="btn btn-outline-secondary btn-md">Shop Now</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif

                                @php
                                    $bannerImages = $banner->images;
                                    $imageIndex = 2; 
                                    $selectedImage = $bannerImages->get($imageIndex);
                                @endphp
                                @if($selectedImage)
                                    <div class="collection-item sp-col" >
                                        <a href="shop-left-sidebar.html" class="zoom-scal">
                                            <div class="img">
                                                <img class="blur-up lazyload"
                                                    data-src="{{ Storage::url($selectedImage->image) }}"
                                                    src="{{ Storage::url($selectedImage->image) }}"
                                                    alt="Banner Image"
                                                    title="Banner Image"
                                                    style="height:349px ; width:100%"
                                                    />
                                            </div>
                                            <div class="details middle-right">
                                                <div class="inner">
                                                    <p class="mb-2">Buy one get one free</p>
                                                    <h3 class="title">Kids Wear</h3>
                                                    <span class="btn btn-outline-secondary btn-md">Shop Now</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                 @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!--End Collection banner-->

        <!--Popular Categories-->
        {{-- <section class="section collection-slider pb-0">
            <div class="container">
                <div class="section-header">
                    <p class="mb-2 mt-0">Shop by category</p>
                    <h2>Popular Collections</h2>
                </div>

                <div class="collection-slider-5items gp15 arwOut5 hov-arrow">
                    <div class="category-item zoomscal-hov">
                        <a href="shop-left-sidebar.html" class="category-link clr-none">
                            <div class="zoom-scal zoom-scal-nopb rounded-3">
                                <img class="blur-up lazyload"
                                    data-src="{{ asset('client/images/collection/sub-collection1.jpg') }}"
                                    src="{{ asset('client/images/collection/sub-collection1.jpg') }}" alt="Men's Jakets"
                                    title="Men's Jakets" width="365" height="365" />
                            </div>
                            <div class="details mt-3 text-center">
                                <h4 class="category-title mb-0">Men's Jakets</h4>
                                <p class="counts">20 Products</p>
                            </div>
                        </a>
                    </div>
                    <div class="category-item zoomscal-hov">
                        <a href="{{route('shop')}}" class="category-link clr-none">
                            <div class="zoom-scal zoom-scal-nopb rounded-3">
                                <img class="blur-up lazyload"
                                    data-src="{{ asset('client/images/collection/sub-collection3.jpg') }}"
                                    src="{{ asset('client/images/collection/sub-collection3.jpg') }}" alt="Tops"
                                    title="Tops" width="365" height="365" />
                            </div>
                            <div class="details mt-3 text-center">
                                <h4 class="category-title mb-0">Tops</h4>
                                <p class="counts">13 Products</p>
                            </div>
                        </a>
                    </div>
                    <div class="category-item zoomscal-hov">
                        <a href="shop-left-sidebar.html" class="category-link clr-none">
                            <div class="zoom-scal zoom-scal-nopb rounded-3">
                                <img class="blur-up lazyload"
                                    data-src="{{ asset('client/images/collection/sub-collection5.jpg') }}"
                                    src="{{ asset('client/images/collection/sub-collection5.jpg') }}" alt="T-Shirts"
                                    title="T-Shirts" width="365" height="365" />
                            </div>
                            <div class="details mt-3 text-center">
                                <h4 class="category-title mb-0">T-Shirts</h4>
                                <p class="counts">18 Products</p>
                            </div>
                        </a>
                    </div>
                    <div class="category-item zoomscal-hov">
                        <a href="shop-left-sidebar.html" class="category-link clr-none">
                            <div class="zoom-scal zoom-scal-nopb rounded-3">
                                <img class="blur-up lazyload"
                                    data-src="{{ asset('client/images/collection/sub-collection6.jpg') }}"
                                    src="{{ asset('client/images/collection/sub-collection6.jpg') }}" alt="Shoes"
                                    title="Shoes" width="365" height="365" />
                            </div>
                            <div class="details mt-3 text-center">
                                <h4 class="category-title mb-0">Shoes</h4>
                                <p class="counts">11 Products</p>
                            </div>
                        </a>
                    </div>
                    <div class="category-item zoomscal-hov">
                        <a href="shop-left-sidebar.html" class="category-link clr-none">
                            <div class="zoom-scal zoom-scal-nopb rounded-3">
                                <img class="blur-up lazyload"
                                    data-src="{{ asset('client/images/collection/sub-collection9.jpg') }}"
                                    src="{{ asset('client/images/collection/sub-collection9.jpg') }}" alt="Shorts"
                                    title="Shorts" width="365" height="365" />
                            </div>
                            <div class="details mt-3 text-center">
                                <h4 class="category-title mb-0">Shorts</h4>
                                <p class="counts">28 Products</p>
                            </div>
                        </a>
                    </div>
                    <div class="category-item zoomscal-hov">
                        <a href="shop-left-sidebar.html" class="category-link clr-none">
                            <div class="zoom-scal zoom-scal-nopb rounded-3">
                                <img class="blur-up lazyload"
                                    data-src="{{ asset('client/images/collection/sub-collection2.jpg') }}"
                                    src="{{ asset('client/images/collection/sub-collection2.jpg') }}" alt="Sunglasses"
                                    title="Sunglasses" width="365" height="365" />
                            </div>
                            <div class="details mt-3 text-center">
                                <h4 class="category-title mb-0">Sunglasses</h4>
                                <p class="counts">24 Products</p>
                            </div>
                        </a>
                    </div>
                    <div class="category-item zoomscal-hov">
                        <a href="shop-left-sidebar.html" class="category-link clr-none">
                            <div class="zoom-scal zoom-scal-nopb rounded-3">
                                <img class="blur-up lazyload"
                                    data-src="{{ asset('client/images/collection/sub-collection4.jpg') }}"
                                    src="{{ asset('client/images/collection/sub-collection4.jpg') }}" alt="Girls Top"
                                    title="Girls Top" width="365" height="365" />
                            </div>
                            <div class="details mt-3 text-center">
                                <h4 class="category-title mb-0">Girls Top</h4>
                                <p class="counts">26 Products</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section> --}}
        <!--End Popular Categories-->

        <!--Products With Tabs-->
        <section class="section product-slider tab-slider-product">
            <div class="container">
                <div class="section-header d-none">
                    <h2>Special Offers</h2>
                    <p>Browse the huge variety of our best seller</p>
                </div>

                <div class="tabs-listing">
                    <ul class="nav nav-tabs style1 justify-content-center" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link head-font active" id="bestsellers-tab" data-bs-toggle="tab"
                                data-bs-target="#bestsellers" type="button" role="tab" aria-controls="bestsellers"
                                aria-selected="true">
                                Bestseller
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link head-font" id="newarrivals-tab" data-bs-toggle="tab"
                                data-bs-target="#newarrivals" type="button" role="tab" aria-controls="newarrivals"
                                aria-selected="false">
                                {{-- New Arrivals --}}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link head-font" id="toprated-tab" data-bs-toggle="tab"
                                data-bs-target="#toprated" type="button" role="tab" aria-controls="toprated"
                                aria-selected="false">
                                {{-- Top Rated --}}
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="productTabsContent">
                        <div class="tab-pane show active" id="bestsellers" role="tabpanel"
                            aria-labelledby="bestsellers-tab">
                            <!--Product Grid-->
                            <div class="grid-products grid-view-items">
                                <div class="row col-row product-options row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-3 row-cols-2">
                                    @foreach ($products as $product)
                                    <div class="item col-item">
                                        <div class="product-box">
                                            <!-- Start Product Image -->
                                            <div class="product-image">
                                                <!-- Start Product Image -->
                                                <a href="product-layout1.html" class="product-img rounded-0">
                                                    <!-- Image -->
                                                    <img class="primary rounded-0 blur-up lazyload"
                                                        data-src="{{$product->img_thumbnail}}"
                                                        src="{{asset('client/images/products/product5.jpg')}}" alt="Product" title="Product"
                                                        width="625" height="808" />
                                                    <!-- End Image -->
                                                    <!-- Hover Image -->
                                                    <img class="hover rounded-0 blur-up lazyload"
                                                        data-src="{{asset('client/images/products/product5-1.jpg')}}"
                                                        src="{{asset('client/images/products/product5-1.jpg')}}" alt="Product"
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
                                                        <span class="icon-wrap d-flex-justify-center h-100 w-100"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="Add to Cart"><i class="icon anm anm-cart-l"></i><span
                                                                class="text">Add to Cart</span></span>
                                                    </a>
                                                    <!--End Cart Button-->
                                                    <!--Quick View Button-->
                                                    {{-- <a href="#quickview-modal" class="btn-icon quickview quick-view-modal"
                                                        data-bs-toggle="modal" data-bs-target="#quickview_modal">
                                                        <span class="icon-wrap d-flex-justify-center h-100 w-100"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="Quick View"><i class="icon anm anm-search-plus-l"></i><span
                                                                class="text">Quick View</span></span>
                                                    </a> --}}
                                                    <!--End Quick View Button-->
                                                    <!--Wishlist Button-->
                                                    {{-- <a href="wishlist-style2.html" class="btn-icon wishlist"
                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="Add To Wishlist"><i class="icon anm anm-heart-l"></i><span
                                                            class="text">Add To Wishlist</span></a> --}}
                                                    <!--End Wishlist Button-->
                                                    <!--Compare Button-->
                                                    {{-- <a href="compare-style2.html" class="btn-icon compare"
                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="Add to Compare"><i class="icon anm anm-random-r"></i><span
                                                            class="text">Add to Compare</span></a> --}}
                                                    <!--End Compare Button-->
                                                </div>
                                                <!--End Product Button-->
                                            </div>
                                            <!-- End Product Image -->
                                            <!-- Start Product Details -->
                                            <div class="product-details text-center">
                                                <!--Product Vendor-->
                                                <div class="product-vendor">{{$product->catalogue->name}}</div>
                                                <!--End Product Vendor-->
                                                <!-- Product Name -->
                                                <div class="product-name">
                                                    <a href="product-layout1.html">{{$product->name}}</a>
                                                </div>
                                                <!-- End Product Name -->
                                                <!-- Product Price -->
                                                <div class="product-price">
                                                    <span class="price">{{$product->price_sale}}đ</span>
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
                                                <!--Sort Description-->
                                                <p class="sort-desc hidden">There are many variations of passages of Lorem Ipsum
                                                    available, but the majority have suffered alteration in some form, by injected
                                                    humour, or randomised words which don't look even slightly believable. If you
                                                    are going to use a passage...</p>
                                                <!--End Sort Description-->
                                                <!-- Variant -->
                                                <ul class="variants-clr swatches">
                                                    @if($product->variants->isNotEmpty())
                                                        @php
                                                            $colors = [];
                                                        @endphp
                                                        @foreach($product->variants as $variant)
                                                            @foreach($variant->variantAttributes as $variantAttribute)
                                                                @if($variantAttribute->attribute->slug === 'color')
                                                                    @php
                                                                        $colorCode = $variantAttribute->attributeValue->color_code;
                                                                    @endphp
                                                                    @if(!in_array($colorCode, $colors))
                                                                        @php
                                                                            $colors[] = $colorCode;
                                                                        @endphp
                                                                        <li class="swatch medium radius" style="background-color: {{ $colorCode }}">
                                                                            <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $variantAttribute->attributeValue->value }}"></span>
                                                                        </li>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                
                                                <!-- End Variant -->
                                                <!-- Product Button -->
                                                <div class="button-action hidden">
                                                    <div class="addtocart-btn">
                                                        <form class="addtocart" action="#" method="post">
                                                            <a href="#addtocart-modal" class="btn btn-md add-to-cart-modal"
                                                                data-bs-toggle="modal" data-bs-target="#addtocart_modal">
                                                                <i class="icon anm anm-cart-l me-2"></i><span class="text">Add
                                                                    to Cart</span>
                                                            </a>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- End Product Button -->
                                            </div>
                                            <!-- End product details -->
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="view-collection text-center mt-4 mt-md-5">
                                    <a href="{{route('shop')}}" class="btn btn-secondary btn-lg">View
                                        Collection</a>
                                </div>
                            </div>
                            <!--End Product Grid-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Products With Tabs-->

        <!--Parallax Banner-->
        <div class="section parallax-banner-style1 py-0">
            <div class="hero hero-large hero-overlay bg-size">
                @foreach($banners['middleBanners'] as $banner)
                    @php
                        $bannerImages = $banner->images;
                    @endphp
                    @foreach($bannerImages as $bannerImage)
                        <img class="bg-img" src="{{ Storage::url($bannerImage->image)}}"
                            alt="Clearance Sale - Flat 50% Off" width="1920" height="645" />
                            @endforeach
                            @endforeach
                        <div class="hero-inner d-flex-justify-center">
                            <div class="container">
                                <div class="wrap-text center text-white">
                                    <h1 class="hero-title text-white">
                                        Clearance Sale - Flat 50% Off
                                    </h1>
                                    <p class="hero-subtitle h3 text-white">
                                        Sale will end soon in
                                    </p>
                                    <!--Countdown Timer-->
                                    <div class="hero-saleTime d-flex-center text-center justify-content-center"
                                        data-countdown="2028/10/01"></div>
                                    <!--End Countdown Timer-->
                                    <p class="hero-details">
                                        Hema Multipurpose Template that will give you and your
                                        customers a smooth shopping experience which can be used for
                                        various kinds of stores such as fashion.
                                    </p>
                                    <a href="{{route('shop')}}" class="hero-btn btn btn-light">Shop now</a>
                                </div>
                            </div>
                        </div>
                   
            </div>
        </div>
        <!--End Parallax Banner-->

        <!--Testimonial Section-->
        {{-- <section class="section testimonial-slider style1">
            <div class="container">
                <div class="section-header">
                    <p class="mb-2 mt-0">Happy Customer</p>
                    <h2>Loved By Our Customers</h2>
                </div>

                <div class="testimonial-wraper">
                    <!--Testimonial Slider Items-->
                    <div class="testimonial-slider-3items gp15 slick-arrow-dots arwOut5">
                        <div class="testimonial-slide">
                            <div class="testimonial-content text-center">
                                <div class="quote-icon mb-3 mb-lg-4">
                                    <img class="blur-up lazyload mx-auto"
                                        data-src="{{ asset('client/images/icons/demo1-quote-icon.png') }}"
                                        src="{{ asset('client/images/icons/demo1-quote-icon.png') }}" alt="icon"
                                        width="40" height="40" />
                                </div>
                                <div class="content">
                                    <div class="text mb-2">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been the
                                            industry's standard dummy text 1500s.
                                        </p>
                                    </div>
                                    <div class="product-review my-3">
                                        <i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                            class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                            class="icon anm anm-star"></i>
                                        <span class="caption hidden ms-1">24 Reviews</span>
                                    </div>
                                </div>
                                <div class="auhimg d-flex-justify-center text-left">
                                    <div class="image">
                                        <img class="rounded-circle blur-up lazyload"
                                            data-src="{{ asset('client/images/users/testimonial1-65x.jpg') }}"
                                            src="{{ asset('client/images/users/testimonial1-65x.jpg') }}"
                                            alt="John Doe" width="65" height="65" />
                                    </div>
                                    <div class="auhtext ms-3">
                                        <h5 class="authour mb-1">John Doe</h5>
                                        <p class="text-muted">Founder &amp; CEO</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-slide">
                            <div class="testimonial-content text-center">
                                <div class="quote-icon mb-3 mb-lg-4">
                                    <img class="blur-up lazyload mx-auto"
                                        data-src="{{ asset('client/images/icons/demo1-quote-icon.png') }}"
                                        src="{{ asset('client/images/icons/demo1-quote-icon.png') }}" alt="icon"
                                        width="40" height="40" />
                                </div>
                                <div class="content">
                                    <div class="text mb-2">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been the
                                            industry's standard dummy text 1500s.
                                        </p>
                                    </div>
                                    <div class="product-review my-3">
                                        <i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                            class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                            class="icon anm anm-star-o"></i>
                                        <span class="caption hidden ms-1">15 Reviews</span>
                                    </div>
                                </div>
                                <div class="auhimg d-flex-justify-center text-left">
                                    <div class="image">
                                        <img class="rounded-circle blur-up lazyload"
                                            data-src="{{ asset('client/images/users/testimonial2-65x.jpg') }}"
                                            src="{{ asset('client/images/users/testimonial2-65x.jpg') }}"
                                            alt="Jessica Doe" width="65" height="65" />
                                    </div>
                                    <div class="auhtext ms-3">
                                        <h5 class="authour mb-1">Jessica Doe</h5>
                                        <p class="text-muted">Marketing</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-slide">
                            <div class="testimonial-content text-center">
                                <div class="quote-icon mb-3 mb-lg-4">
                                    <img class="blur-up lazyload mx-auto"
                                        data-src="{{ asset('client/images/icons/demo1-quote-icon.png') }}"
                                        src="{{ asset('client/images/icons/demo1-quote-icon.png') }}" alt="icon"
                                        width="40" height="40" />
                                </div>
                                <div class="content">
                                    <div class="text mb-2">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been the
                                            industry's standard dummy text 1500s.
                                        </p>
                                    </div>
                                    <div class="product-review my-3">
                                        <i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                            class="icon anm anm-star"></i><i class="icon anm anm-star-o"></i><i
                                            class="icon anm anm-star-o"></i>
                                        <span class="caption hidden ms-1">17 Reviews</span>
                                    </div>
                                </div>
                                <div class="auhimg d-flex-justify-center text-left">
                                    <div class="image">
                                        <img class="rounded-circle blur-up lazyload"
                                            data-src="{{ asset('client/images/users/testimonial3-65x.jpg') }}"
                                            src="{{ asset('client/images/users/testimonial3-65x.jpg') }}"
                                            alt="Rick Edward" width="65" height="65" />
                                    </div>
                                    <div class="auhtext ms-3">
                                        <h5 class="authour mb-1">Rick Edward</h5>
                                        <p class="text-muted">Developer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-slide rounded-3">
                            <div class="testimonial-content text-center">
                                <div class="quote-icon mb-3 mb-lg-4">
                                    <img class="blur-up lazyload mx-auto"
                                        data-src="{{ asset('client/images/icons/demo1-quote-icon.png') }}"
                                        src="{{ asset('client/images/icons/demo1-quote-icon.png') }}" alt="icon"
                                        width="40" height="40" />
                                </div>
                                <div class="content">
                                    <div class="text mb-2">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been the
                                            industry's standard dummy text 1500s.
                                        </p>
                                    </div>
                                    <div class="product-review my-3">
                                        <i class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                            class="icon anm anm-star-o"></i><i class="icon anm anm-star-o"></i><i
                                            class="icon anm anm-star-o"></i>
                                        <span class="caption hidden ms-1">29 Reviews</span>
                                    </div>
                                </div>
                                <div class="auhimg d-flex-justify-center text-left">
                                    <div class="image">
                                        <img class="rounded-circle blur-up lazyload"
                                            data-src="{{ asset('client/images/users/testimonial4-65x.jpg') }}"
                                            src="{{ asset('client/images/users/testimonial4-65x.jpg') }}"
                                            alt="Happy Buyer" width="65" height="65" />
                                    </div>
                                    <div class="auhtext ms-3">
                                        <h5 class="authour mb-1">Happy Buyer</h5>
                                        <p class="text-muted">Designer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Testimonial Slider Items-->
                </div>
            </div>
        </section> --}}
        <!--End Testimonial section-->

        <!--Blog Post-->
        {{-- <section class="section home-blog-post">
            <div class="container">
                <div class="section-header">
                    <p class="mb-2 mt-0">Latest post</p>
                    <h2>Most Recent News</h2>
                </div>

                <div class="blog-slider-3items gp15 arwOut5 hov-arrow">
                    <div class="blog-item">
                        <div class="blog-article zoomscal-hov">
                            <div class="blog-img">
                                <a class="featured-image zoom-scal" href="blog-details.html"><img
                                        class="blur-up lazyload"
                                        data-src="{{ asset('client/images/blog/post-img1.jpg') }}"
                                        src="{{ asset('client/images/blog/post-img1.jpg') }}"
                                        alt="New shop collection our shop" width="740" height="410" /></a>
                                <div class="date">
                                    <span class="dt">25</span>
                                    <span class="mt">Apr<br />
                                        <b>2023</b></span>
                                </div>
                            </div>
                            <div class="blog-content">
                                <h2 class="h3 mb-3">
                                    <a href="blog-details.html">New shop collection our shop</a>
                                </h2>
                                <p class="content">
                                    There are many variations of passages of Lorem Ipsum
                                    available, but the majority have suffered.
                                </p>
                                <a href="blog-details.html" class="btn btn-secondary btn-sm">Read more</a>
                            </div>
                        </div>
                    </div>
                    <div class="blog-item">
                        <div class="blog-article zoomscal-hov">
                            <div class="blog-img">
                                <a class="featured-image zoom-scal" href="blog-details.html"><img
                                        class="blur-up lazyload"
                                        data-src="{{ asset('client/images/blog/post-img2.jpg') }}"
                                        src="{{ asset('client/images/blog/post-img2.jpg') }}"
                                        alt="Gift ideas for everyone" width="740" height="410" /></a>
                                <div class="date">
                                    <span class="dt">31</span>
                                    <span class="mt">Mar<br />
                                        <b>2023</b></span>
                                </div>
                            </div>
                            <div class="blog-content">
                                <h2 class="h3 mb-3">
                                    <a href="blog-details.html">Gift ideas for everyone</a>
                                </h2>
                                <p class="content">
                                    There are many variations of passages of Lorem Ipsum
                                    available, but the majority suffered.
                                </p>
                                <a href="blog-details.html" class="btn btn-secondary btn-sm">Read more</a>
                            </div>
                        </div>
                    </div>
                    <div class="blog-item">
                        <div class="blog-article zoomscal-hov">
                            <div class="blog-img">
                                <a class="featured-image zoom-scal" href="blog-details.html"><img
                                        class="blur-up lazyload"
                                        data-src="{{ asset('client/images/blog/post-img3.jpg') }}"
                                        src="{{ asset('client/images/blog/post-img3.jpg') }}"
                                        alt="Sales with best collection" width="740" height="410" /></a>
                                <div class="date">
                                    <span class="dt">30</span>
                                    <span class="mt">Jan<br />
                                        <b>2023</b></span>
                                </div>
                            </div>
                            <div class="blog-content">
                                <h2 class="h3 mb-3">
                                    <a href="blog-details.html">Sales with best collection</a>
                                </h2>
                                <p class="content">
                                    There are many variations of passages of Lorem Ipsum
                                    available, but the majority.
                                </p>
                                <a href="blog-details.html" class="btn btn-secondary btn-sm">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!--End Blog Post-->
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
                                        <a class="qtyBtn minus" href="#;"><i
                                                class="icon anm anm-minus-r"></i></a>
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
                                    <img src="{{ asset('client/images/products/swatches/blue-red.jpg') }}"
                                        alt="image" width="70" height="70" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Blue" />
                                </li>
                                <li class="swatch large radius available">
                                    <img src="{{ asset('client/images/products/swatches/blue-red.jpg') }}"
                                        alt="image" width="70" height="70" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Black" />
                                </li>
                                <li class="swatch large radius available">
                                    <img src="{{ asset('client/images/products/swatches/blue-red.jpg') }}"
                                        alt="image" width="70" height="70" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Pink" />
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
                                    <a href="checkout-style1.html"
                                        class="btn btn-primary product-checkout w-100">Proceed to checkout</a>
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
                                                src="{{ asset('client/images/products/product2.jpg') }}"
                                                alt="product" title="Product" width="625" height="808" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-1" data-bs-slide-to="1"
                                            data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-1.jpg') }}"
                                                src="{{ asset('client/images/products/product2-1.jpg') }}"
                                                alt="product" title="Product" width="625" height="808" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-2" data-bs-slide-to="2"
                                            data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-2.jpg') }}"
                                                src="{{ asset('client/images/products/product2-2.jpg') }}"
                                                alt="product" title="Product" width="625" height="808" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-3" data-bs-slide-to="3"
                                            data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-3.jpg') }}"
                                                src="{{ asset('client/images/products/product2-3.jpg') }}"
                                                alt="product" title="Product" width="625" height="808" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-4" data-bs-slide-to="4"
                                            data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-4.jpg') }}"
                                                src="{{ asset('client/images/products/product2-4.jpg') }}"
                                                alt="product" title="Product" width="625" height="808" />
                                        </div>
                                        <div class="list-inline-item" id="carousel-selector-5" data-bs-slide-to="5"
                                            data-bs-target="#quickView">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('client/images/products/product2-5.jpg') }}"
                                                src="{{ asset('client/images/products/product2-5.jpg') }}"
                                                alt="product" title="Product" width="625" height="808" />
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
                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Green"></span>
                                            </li>
                                            <li class="swatch large radius soldout yellow">
                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Yellow"></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-item swatches-size w-100 mb-3 swatch-1 option2"
                                        data-option-index="1">
                                        <label class="label d-flex align-items-center">Size:<span
                                                class="slVariant ms-1 fw-bold">S</span></label>
                                        <ul class="variants-size size-swatches d-flex-center pt-1 clearfix">
                                            <li class="swatch large radius soldout">
                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="XS">XS</span>
                                            </li>
                                            <li class="swatch large radius available active">
                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="S">S</span>
                                            </li>
                                            <li class="swatch large radius available">
                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="M">M</span>
                                            </li>
                                            <li class="swatch large radius available">
                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="L">L</span>
                                            </li>
                                            <li class="swatch large radius available">
                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="XL">XL</span>
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
                                            <button type="submit" name="add"
                                                class="btn product-cart-submit w-100">
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
                                <a class="add-compare d-flex-center" href="compare-style1.html"
                                    title="Add to Compare"><i class="icon anm anm-random-r me-2"></i>
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
                                        class="icon anm anm-twitter"></i><span
                                        class="share-title d-none">Tweet</span></a>
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
