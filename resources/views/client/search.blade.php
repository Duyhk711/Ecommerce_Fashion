@extends('layouts.client')

@section('content')
<div class="container">
    <div class=" mt-5"><h5 >Kết quả tìm kiếm cho: "{{ $query }}"</h5></div>
    @if($products->isEmpty())
        <div class="d-flex flex-column align-items-center">
            <img src="{{ asset('client/images/search-empty.png') }}" alt="Không tìm thấy sản phẩm!" width="384" height="384" class="mb-3">
            <h1>Không tìm thấy sản phẩm!</h1>
            <p class="mt-3">
                Vui lòng thay đổi tiêu chí tìm kiếm và thử lại, hoặc <br>
                truy cập Trang chủ để xem sản phẩm phổ biến nhất <br>
                của chúng tôi!
            </p>
        </div>
    @else
        <!-- Nội dung khi có sản phẩm -->
    
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
                                {{-- <div class="product-labels"><span class="lbl pr-label2">Hot</span></div> --}}
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
                                    <a href="#quickview-modal" class="btn-icon quickview quick-view-modal"
                                        data-bs-toggle="modal" data-bs-target="#quickview_modal">
                                        <span class="icon-wrap d-flex-justify-center h-100 w-100"
                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                            title="Quick View"><i class="icon anm anm-search-plus-l"></i><span
                                                class="text">Quick View</span></span>
                                    </a>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <a href="wishlist-style2.html" class="btn-icon wishlist"
                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add To Wishlist"><i class="icon anm anm-heart-l"></i><span
                                            class="text">Add To Wishlist</span></a>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <a href="compare-style2.html" class="btn-icon compare"
                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to Compare"><i class="icon anm anm-random-r"></i><span
                                            class="text">Add to Compare</span></a>
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

            </div>
            <!--End Product Grid-->
        </div>

      
    </div>
    @endif
</div>
@endsection