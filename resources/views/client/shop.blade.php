@extends('layouts.client')
@section('title')
    Cửa hàng
@endsection
@section('css')
    <style>
        .product-name a {
            display: inline-block;
            width: 100%;
            /* Đảm bảo phần tử chiếm toàn bộ chiều rộng */
            white-space: nowrap;
            /* Không cho phép xuống dòng */
            overflow: hidden;
            /* Ẩn văn bản thừa */
            text-overflow: ellipsis;
            /* Thêm dấu "..." vào phần cuối nếu vượt quá */
            max-width: 20ch;
            /* Giới hạn tối đa 5 từ, với mỗi từ khoảng 4 ký tự */
        }

        .price-filter input[type="text"] {
            height: 34px;
            padding: 0 10px;
            text-align: center;
            font-size: 13px;
            width: 140px;
        }
    </style>
@endsection
@section('content')
    @include('client.component.page_header')
    <div class="container" style="max-width: 80%;">
        <!--Main Content-->
        <div class="container">

            <!--Category Slider-->
            <div class="collection-slider-6items gp10 slick-arrow-dots sub-collection section pt-0">
                @foreach ($categories as $catalogue)
                    @if ($catalogue->is_active)
                        <div class="category-item zoomscal-hov">
                            <a href="{{ route('shop', ['slug' => $catalogue->slug]) }}" class="category-link clr-none">
                                <div class="zoom-scal zoom-scal-nopb rounded-0">
                                    <img class="rounded-0 blur-up lazyload"
                                        data-src="{{ asset('storage/' . $catalogue->cover) }}"
                                        src="{{ asset('storage/' . $catalogue->cover) }}" alt="{{ $catalogue->name }}"
                                        title="{{ $catalogue->name }}" width="365" height="365" />
                                </div>
                                <div class="details text-center">
                                    <h4 class="category-title mb-0">{{ $catalogue->name }}</h4>
                                    <p class="counts">{{ $catalogue->children->count() }} Sản phẩm</p>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>

            <!--End Category Slider-->
            <div class="row">
                <!--Sidebar-->
                <div class="col-12 col-sm-12 col-md-12 col-lg-3 sidebar sidebar-bg filterbar">
                    <div class="closeFilter d-block d-lg-none"><i class="icon anm anm-times-r"></i></div>
                    <div class="sidebar-tags sidebar-sticky clearfix">
                        <!--Categories-->
                        <div class="sidebar-widget clearfix categories filterBox filter-widget">
                            <div class="widget-title">
                                <h2>Danh mục</h2>
                            </div>
                            <div class="widget-content filterDD">
                                <ul class="sidebar-categories scrollspy morelist clearfix">
                                    @foreach ($categories as $category)
                                        <li class="lvl1 sub-level more-item">
                                            <a href="javascript:void(0);"
                                                class="site-nav category-filter">{{ $category->name }}</a>
                                            @if ($category->children->isNotEmpty())
                                                <ul class="sublinks">
                                                    @foreach ($category->children as $subcategory)
                                                        <li class="lvl2">
                                                            <a href="javascript:void(0);" class="site-nav category-filter"
                                                                data-id="{{ $subcategory->id }}"
                                                                onclick="toggleCategory(this); filterProducts();">{{ $subcategory->name }}
                                                                <span
                                                                    class="count">({{ $subcategory->products_count }})</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!--Categories-->

                        <!--Price Filter-->
                        <div class="sidebar-widget filterBox filter-widget">
                            <div class="widget-title">
                                <h2>Lọc theo giá</h2>
                            </div>
                            <form class="widget-content price-filter filterDD" id="priceFilter" method="GET">
                                <div id="slider-range" class="mt-2"></div>
                                <input type="hidden" name="price" id="priceRange" />
                                <div class="row">
                                    <div class="col-6">
                                        <input id="amount" type="text" name="price_text" readonly />
                                    </div>
                                    <div class="col-6 text-right">
                                        <button class="btn btn-sm" type="submit"
                                            onclick="filterProducts();">Lọc</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--End Price Filter-->

                        <!--Color Swatches-->
                        {{-- <div class="sidebar-widget filterBox filter-widget">
                            <div class="widget-title">
                                <h2>Màu</h2>
                            </div>
                            <div class="widget-content filter-color filterDD">
                                <ul class="swatch-list swatches d-flex-center clearfix pt-0">
                                    @foreach ($colorValues as $color)
                                        <li class="swatch large radius available"
                                            style="background-color: {{ $color->color_code }};"
                                            data-id="{{ $color->id }}"
                                            onclick="this.classList.toggle('selected'); filterProducts();">
                                            <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $color->value }}"></span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div> --}}
                        <!--End Color Swatches-->

                        <!--Size Swatches-->
                        <div class="sidebar-widget filterBox filter-widget">
                            <div class="widget-title">
                                <h2>Kích cỡ</h2>
                            </div>
                            <div class="widget-content filter-size filterDD">
                                <ul class="swatch-list size-swatches d-flex-center clearfix">
                                    @foreach ($sizeValues as $size)
                                        <li class="swatch large radius available" data-id="{{ $size->id }}"
                                            onclick="this.classList.toggle('selected'); filterProducts();">
                                            <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $size->value }}">
                                                {{ $size->value }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!--End Size Swatches-->
                        <!--Banner-->
                        <div class="sidebar-widget static-banner p-0">
                            <a href="shop-left-sidebar.html"><img class="rounded-0 blur-up lazyload"
                                    data-src="{{ asset('client/images/banners/shop-banner.jpg') }}"
                                    src="{{ asset('client/images/banners/shop-banner.jpg') }}" alt="image"
                                    width="274" height="367"></a>
                        </div>
                        <!--End Banner-->
                    </div>
                </div>
                <!--End Sidebar-->

                <!--Products-->
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 main-col">
                    <!--Toolbar-->
                    <div class="toolbar toolbar-wrapper shop-toolbar">
                        <div class="row align-items-center">
                            <div
                                class="col-4 col-sm-2 col-md-4 col-lg-4 text-left filters-toolbar-item d-flex order-1 order-sm-0">
                                <button type="button"
                                    class="btn btn-filter icon anm anm-sliders-hr d-inline-flex d-lg-none me-2"><span
                                        class="d-none">Filter</span></button>
                                <div class="filters-item d-flex align-items-center">
                                    <label class="mb-0 me-2 d-none d-lg-inline-block">Xem dưới dạng:</label>
                                    <div class="grid-options view-mode d-flex">
                                        <a class="icon-mode mode-list d-block" data-col="1"></a>
                                        <a class="icon-mode mode-grid grid-2 d-block" data-col="2"></a>
                                        <a class="icon-mode mode-grid grid-3 d-md-block" data-col="3"></a>
                                        <a class="icon-mode mode-grid grid-4 d-lg-block active" data-col="4"></a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-12 col-sm-4 col-md-4 col-lg-4 text-center product-count order-0 order-md-1 mb-3 mb-sm-0">
                                <span class="toolbar-product-count">Đang xem: {{ session('perPage') }} sản phẩm</span>
                            </div>
                            @php
                                $page = 'shop';
                                if (isset($filter) && $filter == 'filter') {
                                    $page = 'filter';
                                }
                            @endphp
                            <form method="GET" action="{{ route($page) }}"
                                class="col-8 col-sm-6 col-md-4 col-lg-4 text-right filters-toolbar-item d-flex justify-content-end order-2 order-sm-2">
                                <div class="filters-item d-flex align-items-center">
                                    <label for="ShowBy"
                                        class="mb-0 me-2 text-nowrap d-none d-sm-inline-flex">Hiển thị:</label>
                                    <select name="ShowBy" id="ShowBy" class="filters-toolbar-show"
                                        onchange="this.form.submit()">
                                        <option value="10" {{ request('ShowBy') == '10' ? 'selected' : '' }}>
                                            10
                                        </option>
                                        <option value="15" {{ request('ShowBy') == '15' ? 'selected' : '' }}>
                                            15
                                        </option>
                                        <option value="20" {{ request('ShowBy') == '20' ? 'selected' : '' }}>
                                            20
                                        </option>
                                        <option value="25" {{ request('ShowBy') == '25' ? 'selected' : '' }}>
                                            25
                                        </option>
                                        <option value="30" {{ request('ShowBy') == '30' ? 'selected' : '' }}>
                                            30
                                        </option>
                                    </select>
                                </div>
                                <div class="filters-item d-flex align-items-center ms-2 ms-lg-3">
                                    <label for="SortBy" class="mb-0 me-2 text-nowrap d-none">Sort by:</label>
                                    <select name="SortBy" id="SortBy" class="filters-toolbar-sort"
                                        onchange="this.form.submit()">
                                        <option value="featured" {{ request('SortBy') == 'featured' ? 'selected' : '' }}>
                                            Nổi bật</option>
                                        <option value="title-ascending"
                                            {{ request('SortBy') == 'title-ascending' ? 'selected' : '' }}>Theo thứ
                                            tự
                                            bảng
                                            chữ cái(A-Z)
                                        </option>
                                        <option value="title-descending"
                                            {{ request('SortBy') == 'title-descending' ? 'selected' : '' }}>Theo
                                            thứ tự
                                            bảng chữ cái(Z-A)
                                        </option>
                                        <option value="price-ascending"
                                            {{ request('SortBy') == 'price-ascending' ? 'selected' : '' }}>Giá thấp
                                            đến
                                            cao
                                        </option>
                                        <option value="price-descending"
                                            {{ request('SortBy') == 'price-descending' ? 'selected' : '' }}>Giá cao
                                            đến
                                            thấp
                                        </option>
                                        <option value="created-ascending"
                                            {{ request('SortBy') == 'created-ascending' ? 'selected' : '' }}>Sản
                                            phẩm
                                            mới
                                        </option>
                                        <option value="created-descending"
                                            {{ request('SortBy') == 'created-descending' ? 'selected' : '' }}>Sản
                                            phẩm
                                            cũ
                                        </option>
                                    </select>
                                </div>
                                @foreach (request()->query() as $key => $value)
                                    @if ($key !== 'ShowBy' && $key !== 'SortBy')
                                        <!-- Không gửi lại các tham số từ form -->
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endif
                                @endforeach
                            </form>
                        </div>
                    </div>
                    <!--End Toolbar-->

                    <!--Product Grid-->
                    <div class="grid-products grid-view-items">
                        <div class="row col-row product-options row-cols-lg-4 row-cols-md-3 row-cols-sm-3 row-cols-2">
                            @foreach ($products as $product)
                                <div class="item col-item">
                                    <div class="product-box">
                                        <!-- Start Product Image -->
                                        <div class="product-image">
                                            <!-- Start Product Image -->
                                            <a href="{{ route('productDetail', $product->slug) }}"
                                                class="product-img rounded-0">
                                                <!-- Image -->
                                                <img class="primary rounded-0 blur-up lazyload"
                                                    data-src="{{ Storage::url($product->img_thumbnail) }}"
                                                    src="{{ Storage::url($product->img_thumbnail) }}" alt="Product"
                                                    title="Product" width="625" height="808" />
                                                <!-- End Image -->
                                                <!-- Hover Image -->
                                                <img class="hover rounded-0 blur-up lazyload"
                                                    data-src="{{ Storage::url($product->img_thumbnail) }}"
                                                    src="{{ Storage::url($product->img_thumbnail) }}" alt="Product"
                                                    title="Product" width="625" height="808" />
                                                <!-- End Hover Image -->
                                            </a>
                                            <!-- End Product Image -->
                                            <!-- Product label -->
                                            <div class="product-labels"><span class="lbl pr-label2">Hot</span></div>
                                            <!-- End Product label -->
                                            <!--Product Button-->
                                            {{-- <div class="button-set style1">
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
                                            </div> --}}
                                            <!--End Product Button-->
                                        </div>
                                        <!-- End Product Image -->
                                        <!-- Start Product Details -->
                                        <div class="product-details text-center">
                                            <!--Product Vendor-->
                                            <div class="product-vendor">{{ $product->catalogue->name }}</div>
                                            <!--End Product Vendor-->
                                            <!-- Product Name -->
                                            <div class="product-name">
                                                <a href="{{ route('productDetail', $product->slug) }}" data-bs-toggle="tooltip" title="{{$product->name}}">
                                                    {{ $product->name }}
                                                </a>
                                            </div>
                                            {{-- <!-- End Product Name -->
                                            <!-- Product Price --> --}}
                                            <div class="product-price">
                                                @if ($product->price_sale == 0 || $product->price_sale == $product->price_regular || $product->price_sale == null)
                                                    <span class="price"> {{ number_format($product->price_regular, 3, '.', 0) }}đ</span>
                                                @else
                                                    <span
                                                        class="price old-price">{{ number_format($product->price_regular, 3, '.', 0) }}₫</span>
                                                    <span
                                                        class="price">{{ number_format($product->price_sale, 3, '.', 0) }}₫</span>
                                                @endif

                                                {{-- <span class="price">{{ number_format($product->price_sale, 3, '.', 0) }}₫</span> --}}
                                            </div>
                                            <!-- End Product Price -->
                                            <!-- Product Review -->
                                            <div class="product-review">
                                                @php
                                                    // Lấy đánh giá tương ứng cho sản phẩm hiện tại
                                                    $rating = $ratings->firstWhere(
                                                        'product_id',
                                                        $product->id,
                                                    );
                                                    // Nếu không có đánh giá thì thiết lập mặc định là 0
                                                    $averageRating = $rating['average_rating'] ?? 0;
                                                @endphp

                                                @for ($i = 0; $i < 5; $i++)
                                                    <i
                                                        class="icon anm anm-star {{ $i < floor($averageRating) ? '' : 'anm-star-o' }}"></i>
                                                @endfor
                                            </div>
                                            <!-- End Product Review -->
                                            <!--Sort Description-->
                                            <p class="sort-desc hidden">There are many variations of passages of Lorem
                                                Ipsum
                                                available, but the majority have suffered alteration in some form, by
                                                injected
                                                humour, or randomised words which don't look even slightly believable. If
                                                you
                                                are going to use a passage...</p>
                                            <!--End Sort Description-->
                                            <!-- Variant -->
                                            <ul class="variants-clr swatches">
                                                @if ($product->variants->isNotEmpty())
                                                    @php
                                                        $colors = [];
                                                    @endphp
                                                    @foreach ($product->variants as $variant)
                                                        @foreach ($variant->variantAttributes as $variantAttribute)
                                                            @if ($variantAttribute->attribute->slug === 'color')
                                                                @php
                                                                    $colorCode =
                                                                        $variantAttribute->attributeValue->color_code;
                                                                @endphp
                                                                @if (!in_array($colorCode, $colors))
                                                                    @php
                                                                        $colors[] = $colorCode;
                                                                    @endphp
                                                                    <li class="swatch medium radius"
                                                                        style="background-color: {{ $colorCode }}">
                                                                        <span class="swatchLbl" data-bs-toggle="tooltip"
                                                                            data-bs-placement="top"
                                                                            title="{{ $variantAttribute->attributeValue->value }}"></span>
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
                                                            <i class="icon anm anm-cart-l me-2"></i><span
                                                                class="text">Add
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
                        @if ($products->lastPage() > 1)
                            <!-- Pagination -->
                            <nav class="clearfix pagination-bottom mb-2">
                                <ul class="pagination justify-content-center">
                                    @if (!$products->onFirstPage())
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $products->appends(request()->except('page'))->url(1) }}"
                                                aria-label="Trang đầu">&laquo;</a>
                                            <!-- Trang đầu -->
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $products->appends(request()->except('page'))->previousPageUrl() }}"
                                                aria-label="Trang trước">&lt;</a>
                                            <!-- Trang trước -->
                                        </li>
                                    @endif

                                    @php
                                        $currentPage = $products->currentPage();
                                        $lastPage = $products->lastPage();

                                        // Xác định các trang hiển thị
                                        $start = max(1, $currentPage - 1); // Bắt đầu từ trang hiện tại - 1
                                        $end = min($lastPage, $currentPage + 1); // Kết thúc ở trang hiện tại + 1

                                        // Điều chỉnh cho trang đầu
                                        if ($currentPage == 1) {
                                            $start = 1; // Nếu ở trang 1, bắt đầu từ 1
                                            $end = min(3, $lastPage); // Hiển thị tối đa đến trang 3
                                        } elseif ($currentPage == $lastPage) {
                                            $start = max(1, $lastPage - 2); // Nếu ở trang cuối, hiển thị 2 trang trước
                                        }
                                    @endphp

                                    <!-- Hiển thị các trang -->
                                    @for ($i = $start; $i <= $end; $i++)
                                        <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                            <a class="page-link"
                                                href="{{ $products->appends(request()->except('page'))->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor


                                    @if ($products->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $products->appends(request()->except('page'))->nextPageUrl() }}"
                                                aria-label="Trang tiếp">&gt;</a>
                                            <!-- Trang tiếp -->
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $products->appends(request()->except('page'))->url($lastPage) }}"
                                                aria-label="Trang cuối">&raquo;</a>
                                            <!-- Trang cuối -->
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                            <!-- End Pagination -->
                        @endif
                    </div>
                    <!--End Product Grid-->
                </div>
                <!--End Products-->
            </div>
        </div>
        <!--End Main Content-->
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
    <!--JavaScript-->
    <script>
        function toggleCategory(element) {
            // Thêm hoặc bỏ lớp 'selected' khi nhấp
            element.classList.toggle('selected');
        }

        function filterProducts() {
            let selectedCategories = [];

            // Lấy các danh mục đã chọn
            document.querySelectorAll('.category-filter.selected').forEach(item => {
                selectedCategories.push(item.getAttribute('data-id'));
            });

            let priceRange = document.getElementById('priceRange').value;

            let selectedColors = [];
            document.querySelectorAll('.filter-color .swatch.selected').forEach(color => {
                selectedColors.push(color.dataset.id);
            });

            let selectedSizes = [];
            document.querySelectorAll('.filter-size .swatch.selected').forEach(size => {
                selectedSizes.push(size.dataset.id);
            });

            let params = new URLSearchParams();
            if (selectedCategories.length) {
                params.append('categories', selectedCategories);
            } else if (priceRange) {
                params.append('price', priceRange);
            } else if (selectedColors.length) {
                params.append('colors', selectedColors);
            } else if (selectedSizes.length) {
                params.append('size', selectedSizes);
            }

            // Điều hướng đến URL mới với các tham số
            window.location.href = '/filterproduct?' + params.toString();
        }
    </script>
@endsection
