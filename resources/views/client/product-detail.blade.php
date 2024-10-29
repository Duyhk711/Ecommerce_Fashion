@extends('layouts.client')

@section('css')
    <link rel="stylesheet" href="{{ asset('client/css/product-detail.css') }}">
    <style>
        * {
            box-sizing: border-box;
        }

        .img-zoom-container {
            position: relative;
        }

        .img-zoom-lens {
            position: absolute;
            border: 1px solid #d4d4d4;
            /*set the size of the lens:*/
            width: 40px;
            height: 40px;
        }

        .img-zoom-result {
            display: none;
            position: absolute;
            border: none;
            pointer-events: none;
            /* Đảm bảo result không cản chuột */
            width: 150px;
            /* Kích thước kính lúp */
            height: 150px;
            border-radius: 50%;
            /* Hình tròn như kính lúp */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
    </style>
    <style>
        .modal {
            z-index: 1050 !important;
        }

        .modal-backdrop {
            z-index: 1040 !important;
        }

        .modal-content {
            width: 1000px;
            /* Adjust based on your needs */
            margin: 0 auto;
        }

        .table {
            width: 100%;
            /* Ensure the table takes the full width */
        }

        margin: 0 auto;
        /* Center the modal content */
    </style>

    <style>
        .rating-choose {
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 5px;
            padding-bottom: 5px;
            border: rgb(255, 187, 0) 1px, solid;
            text-align: center;
            margin-bottom: 10px;
            margin-right: 10px;
        }

        .rating-choose:hover {
            background: rgb(255, 248, 230);
            cursor: pointer;
        }

        .rating-choose.active {
            font-weight: bold;
            text-decoration: underline;
        }

        .d-none {
            display: none !important;
        }
    </style>
@endsection

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
                                    <img id="zoompro" class="zoompro"
                                        src="{{ asset('storage/' . $product->img_thumbnail) }}"
                                        data-zoom-image="{{ $product->img_thumbnail }}" alt="product" width="625"
                                        height="600" />
                                </div>
                                <!-- End Product Image -->
                                <!-- Product Label -->
                                <div class="product-labels">
                                    <span class="lbl pr-label1">New</span>
                                    <span class="lbl on-sale">Sale</span>
                                </div>
                                <!-- End Product Label -->
                                <!-- Product Buttons -->
                                {{-- <div class="product-buttons">
                                    <a href="#;" class="btn btn-primary prlightbox" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Zoom Image"><i
                                            class="icon anm anm-expand-l-arrows"></i></a>
                                </div> --}}
                                <!-- End Product Buttons -->
                            </div>
                            <!-- End Product Main -->

                            <!-- Product Thumb -->
                            <div class="product-thumb product-horizontal-thumb mt-3">
                                <div id="gallery" class="product-thumb-horizontal">
                                    @foreach ($product->images as $item)
                                        <a href="javascript:void(0);" data-image="{{ asset('storage/' . $item->image) }}"
                                            data-zoom-image="{{ asset('storage/' . $item->image) }}" class="thumbnail">
                                            <img class="blur-up lazyload" data-src="{{ asset('storage/' . $item->image) }}"
                                                src="{{ asset('storage/' . $item->image) }}" alt="product" width="625"
                                                height="808" />
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
                                <div class="reviewStar d-flex-center">
                                    <a class=" d-flex-center" href="#reviews">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i
                                                class="icon anm anm-star {{ $i < floor($averageRating) ? '' : 'anm-star-o' }}"></i>
                                        @endfor
                                        <span class="caption ms-2">{{ $totalRatings }} Đánh giá</span>
                                    </a>

                                </div>
                            </div>
                            <!-- End Product Reviews -->

                            <!-- Product Info -->
                            <div class="product-info">
                                <p class="product-stock d-flex">Tình trạng:
                                    <span class="pro-stockLbl ps-0">
                                        @if ($totalStock > 10)
                                            <span class="d-flex-center stockLbl instock text-uppercase">Còn hàng</span>
                                        @elseif($totalStock == 0)
                                            <span class="d-flex-center stockLbl text-danger text-uppercase">Hết hàng</span>
                                        @else
                                            <span class="d-flex-center stockLbl text-warning text-uppercase"> Sắp hết
                                                hàng</span>
                                        @endif
                                    </span>
                                </p>
                                {{-- <p class="product-vendor">Vendor:<span class="text"><a href="#">HVL</a></span> --}}
                                </p>
                                <p class="product-type">Chất liệu:<span class="text">{{ $product->material }}</span>
                                </p>
                                <p class="product-sku">MÃ:<span class="text">{{ $product->sku }}</span></p>
                            </div>
                            <!-- End Product Info -->

                            <!-- Product Price -->
                            <div class="product-price d-flex-center my-3">
                                <span class="price old-price"
                                    id="regular-price">{{ number_format($product->price_regular, 3, '.', 0) }}đ</span>
                                <span class="price"
                                    id="sale-price">{{ number_format($product->price_sale, 3, '.', 0) }}đ</span>
                            </div>
                            <!-- End Product Price -->
                            <hr>
                            <!-- Sort Description -->
                            <div class="sort-description">
                                {{ $product->description }}
                            </div>
                            <!-- End Sort Description -->
                        </div>
                        <!-- End Product Details -->

                        <!-- Product Form -->
                        <form method="POST" action="{{ route('cart.add') }} "
                            class="product-form product-form-border hidedropdown" id="product-form">
                            @csrf
                            <!-- Swatches -->
                            <div class="product-swatches-option">
                                <!-- Swatches Color -->
                                <div class="product-item swatches-image w-100 mb-4 swatch-0 option1" data-option-index="0">
                                    <label class="label d-flex align-items-center">Màu:<span
                                            class="slVariant ms-1 fw-bold"></span></label>
                                    <ul class="variants-clr swatches d-flex pt-1 clearfix" id="color-options">
                                        @foreach ($uniqueAttributes->where('attributeName', 'Color') as $color)
                                            <li class="swatch x-large available color-option"
                                                style="background-color: {{ $color['colorCode'] }}; width: 40px; height: 40px; border-radius: 50%;"
                                                data-color-code="{{ $color['colorCode'] }}"
                                                data-color-name="{{ $color['value'] }}"
                                                data-product-image="{{ $color['image'] }}"
                                                data-attribute-value-id="{{ $color['value'] }}" data-bs-toggle="tooltip"
                                                title="{{ $color['value'] }}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>


                                <!-- Swatches Size -->
                                <div class="product-item swatches-size w-100 mb-4 swatch-1 option2" data-option-index="1">
                                    <label class="label d-flex align-items-center">Kích cỡ:<span
                                            class="slVariant ms-1 fw-bold"></span></label>
                                    <ul class="variants-size size-swatches d-flex-center pt-1 clearfix" id="size-options">
                                        @foreach ($uniqueAttributes->where('attributeName', 'Size') as $size)
                                            <li class="swatch x-large available size-option"
                                                data-attribute-value-id="{{ $size['value'] }}">
                                                <span class="swatchLbl" data-bs-toggle="tooltip"
                                                    title="{{ $size['value'] }}">
                                                    {{ $size['value'] }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- End Swatches -->

                            <input type="hidden" name="color_id" id="color_id">
                            <input type="hidden" name="size_id" id="size_id">
                            <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_variant_id" id="product_variant_id">
                            <!-- Product Action -->
                            <div class="product-action w-100 d-flex-wrap my-3 my-md-4">
                                <!-- Product Quantity -->
                                <div class="product-form-quantity d-flex-center">
                                    <div class="qtyField">
                                        <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"></i></a>
                                        <input type="text" name="quantity" value="1"
                                            class="product-form-input qty" id="quantityInput" data-max-stock="0" />
                                        <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                                    </div>
                                </div>
                                <!-- End Product Quantity -->

                                <!-- Product Add -->
                                <div class="product-form-submit addcart fl-1 ms-3">
                                    <button type="submit" class="btn btn-secondary product-form-cart-submit">
                                        <span>Thêm giỏ hàng</span>
                                    </button>
                                </div>
                                <!-- End Product Add -->

                                <!-- Product Buy -->
                                <div class="product-form-submit buyit fl-1 ms-3">
                                    <button type="button" class="btn btn-primary" id="proceed-to-checkout">
                                        <span> Mua ngay </span>
                                    </button>
                                </div>
                                <!-- End Product Buy -->
                            </div>
                            <!-- End Product Action -->

                            <!-- Product Info link -->
                            <p class="infolinks d-flex-center justify-content-between">
                                <!-- Kiểm tra trạng thái yêu thích của sản phẩm -->
                                <a class="text-link wishlist {{ $isFavorite ? 'active' : '' }}" href="#"
                                    data-product-id="{{ $product->id }}">
                                    <!-- Biểu tượng trái tim viền -->
                                    <i style="font-size:15px"
                                        class="icon anm anm-heart-l me-2 favorite {{ $isFavorite ? 'd-none' : '' }}"></i>

                                    <!-- Biểu tượng trái tim đổ đầy -->
                                    <i style="color: #e96f84;font-size:15px"
                                        class="bi bi-heart-fill me-2 favorite {{ $isFavorite ? '' : 'd-none' }}"></i>
                                </a>

                                <a href="#sizeChartModal" class="text-link emaillink me-0" data-bs-toggle="modal"
                                    role="button">
                                    <i class="icon anm anm-question-cil me-2"></i>
                                    <span>Gợi ý size</span>
                                </a>

                                <a href="#productInquiry-modal" class="text-link emaillink me-0" data-bs-toggle="modal"
                                    data-bs-target="#productInquiry_modal">
                                    <i class="icon anm anm-question-cil me-2"></i>
                                    <span>Enquiry</span>
                                </a>
                            </p>
                            <!-- End Product Info link -->
                        </form>

                        <!-- End Product Form -->

                        <!-- Product Info -->

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
                    <li rel="description" class="active"><a class="tablink">Mô tả</a></li>
                    <li rel="shipping-return"><a class="tablink">Giao hàng &amp; Trả hàng</a></li>
                </ul>

                <div class="tab-container">
                    <!--Description-->
                    <h3 class="tabs-ac-style d-md-none active" rel="description">Description</h3>
                    <div id="description" class="tab-content">
                        <div class="product-description">
                            <div class="row">
                                <div class="col-12 col-sm-12 ">
                                    {!! $product->content !!}
                                </div>
                            </div>
                            <hr>
                            <div>
                                <div class="mt-5" id="ratings-comment">
                                    {{-- Đánh giá trung bình --}}
                                    <div class="d-flex">
                                        <div class="ratings-main">
                                            <div class="avg-rating d-flex-center mb-3">
                                                <h3 class="avg-mark">{{ number_format($averageRating, 1) }}/5</h3>
                                                <div class="avg-content ms-3">
                                                    <p class="text-rating">Đánh giá trung bình</p>
                                                    <div class="ratings-full product-review">
                                                        <a class="reviewLink d-flex-center" href="#reviews">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                <i
                                                                    class="icon anm anm-star {{ $i < floor($averageRating) ? '' : 'anm-star-o' }}"></i>
                                                            @endfor
                                                            <span class="caption ms-2">{{ $totalRatings }} đánh giá</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                {{-- Lọc đánh giá --}}
                                                <div class="d-flex mx-5 rating-filter">
                                                    <a href="{{ request()->fullUrlWithQuery(['rating' => 'all']) }}"
                                                        class="rating-choose {{ request('rating') == 'all' ? 'active' : '' }}">Tất
                                                        cả</a>
                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <a href="{{ request()->fullUrlWithQuery(['rating' => $i]) }}"
                                                            class="rating-choose {{ request('rating') == $i ? 'active' : '' }}">
                                                            {{ $i }} <i
                                                                class="icon anm anm-star text-warning"></i>
                                                            ({{ $ratingsPercentage[$i] ?? 0 }})
                                                        </a>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <br>
                                    {{-- Danh sách bình luận --}}
                                    <div class="review-inner" id="comment-list">
                                        @forelse ($comments as $comment)
                                            <div class="spr-review d-flex w-100">
                                                <div style="height: 65px;" class="me-2">
                                                    <img src="{{ $comment->user->avatar
                                                        ? asset('storage/' . $comment->user->avatar)
                                                        : 'https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg' }}"
                                                        alt="avatar"
                                                        style="width: 65px; height:65px; object-fit: cover;"
                                                        class="rounded-circle blur-up lazyloaded me-4" />
                                                </div>
                                                <div class="spr-review-content flex-grow-1">
                                                    <div
                                                        class="title-review d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <h5>{{ $comment->user->name }}</h5>
                                                            <span class="product-review spr-starratings">
                                                                @for ($i = 0; $i < 5; $i++)
                                                                    <i
                                                                        class="icon anm anm-star {{ $i < $comment->rating ? '' : 'anm-star-o' }}"></i>
                                                                @endfor
                                                            </span> |
                                                            {{ $comment->created_at->format('d-m-Y H:i') }}
                                                        </div>

                                                    </div>
                                                    <p>{{ $comment->comment }}</p>
                                                </div>
                                            </div> <br>
                                            <hr>
                                        @empty
                                            <p>Chưa có bình luận nào.</p>
                                        @endforelse
                                    </div>

                                    {{-- Phân trang --}}
                                    <div id="pagination-container" class="pagination d-flex justify-content-end">
                                        {{ $comments->withQueryString()->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Description-->

                    <!--Shipping &amp; Return-->
                    <h3 class="tabs-ac-style d-md-none" rel="shipping-return">Shipping &amp; Return</h3>
                    <div id="shipping-return" class="tab-content">
                        <h4>Giao hàng &amp; Trả hàng</h4>
                        <ul class="checkmark-info">
                            <li>Giao hàng: Trong vòng 24 giờ</li>
                            <li>Bảo hành thương hiệu 1 năm</li>
                            <li>Miễn phí vận chuyển cho tất cả các sản phẩm khi mua tối thiểu 500.000đ</li>
                            <li>Thời gian giao hàng quốc tế - 7-10 ngày làm việc</li>
                            <li>Có thể thanh toán khi nhận hàng</li>
                            <li>Trả hàng và đổi hàng dễ dàng trong vòng 30 ngày</li>
                        </ul>
                        <h4>Trả hàng miễn phí và dễ dàng</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                            but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        <h4>Tài trợ đặc biệt</h4>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                            alteration in some form, by injected humour, or randomised words which don't look even slightly
                            believable. If you are going to use a passage.</p>
                    </div>
                    <!--End Shipping &amp; Return-->
                </div>
            </div>
            <!--End Product Tabs-->
        </div>
        <!--End Main Content-->

        <!--Related Products-->
        <section class="section product-slider pb-0">
            <div class="container">
                <div class="section-header">
                    <p class="mb-1 mt-0">Khám Phá</p>
                    <h2>Sản phẩm cùng loại</h2>
                </div>

                <!--Product Grid-->
                <div class="grid-products grid-view-items gp10 arwOut5">
                    <div
                        class="row col-row product-options row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-3 row-cols-2">
                        @foreach ($relatedProducts as $products)
                            <div class="item col-item">
                                <div class="product-box">
                                    <!-- Start Product Image -->
                                    <div class="product-image">
                                        <a href="{{ route('productDetail', $products->slug) }}"
                                            class="product-img rounded-0">
                                            <img class="primary rounded-0 blur-up lazyload"
                                                data-src="{{ Storage::url($products->img_thumbnail) }}"
                                                src="{{ Storage::url($products->img_thumbnail) }}" alt="Product"
                                                title="{{ $products->name }}" width="625" height="808" />
                                            <img class="hover rounded-0 blur-up lazyload"
                                                data-src="{{ Storage::url($products->img_thumbnail) }}"
                                                src="{{ Storage::url($products->img_thumbnail) }}" alt="Product"
                                                title="{{ $products->name }}" width="625" height="808" />
                                        </a>
                                        <div class="product-labels"><span class="lbl pr-label2">Hot</span></div>
                                        {{-- <div class="button-set style1">
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
                                        </div> --}}
                                    </div>
                                    <div class="product-details text-center">
                                        <div class="product-vendor">{{ $products->catalogue->name }}</div>
                                        <div class="product-name">
                                            <a
                                                href="{{ route('productDetail', $products->slug) }}">{{ $products->name }}</a>
                                        </div>
                                        <div class="product-price">
                                            @if ($products->price_sale == 0)
                                                <span class="price">
                                                    {{ number_format($products->price_regular, 3, '.', 0) }}đ</span>
                                            @else
                                                <span
                                                    class="price old-price">{{ number_format($products->price_regular, 3, '.', 0) }}đ</span>
                                                <span
                                                    class="price">{{ number_format($products->price_sale, 3, '.', 0) }}đ</span>
                                            @endif
                                        </div>
                                        <div class="product-review">
                                            @php
                                                // Lấy đánh giá tương ứng cho sản phẩm hiện tại
                                                $relatedRating = $relatedRatings->firstWhere(
                                                    'product_id',
                                                    $products->id,
                                                );
                                                // Nếu không có đánh giá thì thiết lập mặc định là 0
                                                $averageRating = $relatedRating['average_rating'] ?? 0;
                                            @endphp

                                            <div class="related-product">
                                                <div class="star-rating">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <i
                                                            class="icon anm anm-star {{ $i < floor($averageRating) ? '' : 'anm-star-o' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>

                                        <p class="sort-desc hidden">There are many variations of passages of Lorem Ipsum
                                            available...</p>
                                        <ul class="variants-clr swatches">
                                            @foreach ($products->uniqueAttributes->where('attributeName', 'Color') as $color)
                                                <li class="swatch x-small available"
                                                    style="background-color: {{ $color['colorCode'] }}"
                                                    data-color-code="{{ $color['colorCode'] }}"
                                                    data-attribute-value-id="{{ $color['value'] }}"
                                                    data-bs-toggle="tooltip" title="{{ $color['value'] }}">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="view-collection text-center mt-4 mt-md-5">
                        <a href="{{ route('shop') }}" class="btn btn-secondary btn-lg">Xem thêm sản phẩm</a>
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

    {{-- popup --}}
    <div id="quantityPopup" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Thông báo</h2>
            <p id="popupMessage"></p>
        </div>
    </div>

    {{-- gợi ý size --}}
    <!-- Size Chart Modal -->
    <div class="modal fade" id="sizeChartModal" tabindex="-1" aria-labelledby="sizeChartModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="sizeChartModalLabel">Hướng dẫn chọn size</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Table with responsive wrapper to handle overflow -->
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center">
                            <thead class="table-dark">
                                <tr>
                                    <td>SIZE</td>
                                    <td>Chiều cao (cm)</td>
                                    <td>Cân nặng (kg)</td>
                                    <td>Rộng ngực (cm)</td>
                                    <td>Rộng mông (cm)</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>S (29)</td>
                                    <td>162-168</td>
                                    <td>57-62</td>
                                    <td>84-88</td>
                                    <td>85-89</td>
                                </tr>
                                <tr>
                                    <td>M (30)</td>
                                    <td>169-173</td>
                                    <td>63-67</td>
                                    <td>88-94</td>
                                    <td>90-94</td>
                                </tr>
                                <tr>
                                    <td>L (31)</td>
                                    <td>171-175</td>
                                    <td>68-72</td>
                                    <td>94-98</td>
                                    <td>95-99</td>
                                </tr>
                                <tr>
                                    <td>XL (32)</td>
                                    <td>173-177</td>
                                    <td>73-77</td>
                                    <td>98-104</td>
                                    <td>100-104</td>
                                </tr>
                                <tr>
                                    <td>XXL (33)</td>
                                    <td>175-179</td>
                                    <td>78-82</td>
                                    <td>104-107</td>
                                    <td>104-108</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- check người dùng đã chọn size hay màu chưa, và validate số lượng
     // chưa check số lượng của biến thể trong kho có đủ không --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedColorId = null;
            let selectedSizeId = null;
            let selectedProductVariantId = null;
            let variantDetails = @json($variantDetails); // Chuyển biến PHP sang JavaScript
            // Kiểm tra Flash Messages và hiển thị popup nếu có
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: '{{ session('error') }}',
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                });
            @endif

            // Lấy màu
            document.querySelectorAll('.variants-clr .swatch').forEach(item => {
                item.addEventListener('click', function() {
                    document.querySelectorAll('.variants-clr .swatch').forEach(swatch => {
                        swatch.classList.remove('selected');
                    });
                    item.classList.add('selected');
                    selectedColorId = item.getAttribute('data-attribute-value-id');
                    document.getElementById('color_id').value = selectedColorId;
                    updateProductVariantId(); // Cập nhật ID biến thể sản phẩm
                });
            });
            // Lấy kích thước
            document.querySelectorAll('.variants-size .swatch').forEach(item => {
                item.addEventListener('click', function() {
                    document.querySelectorAll('.variants-size .swatch').forEach(swatch => {
                        swatch.classList.remove('selected');
                    });
                    item.classList.add('selected');
                    selectedSizeId = item.getAttribute('data-attribute-value-id');
                    document.getElementById('size_id').value = selectedSizeId;
                    updateProductVariantId(); // Cập nhật ID biến thể sản phẩm
                });
            });
            // Hàm lấy ID biến thể dựa trên thuộc tính và giá trị
            function getAttributeValueId(colorId, sizeId) {
                for (let variant of variantDetails) {
                    let attributes = variant.attributes; // Giả định attributes chứa các thuộc tính của biến thể
                    let colorMatch = false;
                    let sizeMatch = false;
                    for (let attr of attributes) {
                        if (attr.attributeName === 'Color' && attr.value === colorId) {
                            colorMatch = true;
                        }
                        if (attr.attributeName === 'Size' && attr.value === sizeId) {
                            sizeMatch = true;
                        }
                    }
                    if (colorMatch && sizeMatch) {
                        return variant.id;
                    }
                }
                return null;
            }
            // Hàm cập nhật ID biến thể sản phẩm
            function updateProductVariantId() {
                if (selectedColorId && selectedSizeId) {
                    selectedProductVariantId = getAttributeValueId(selectedColorId, selectedSizeId);
                    if (selectedProductVariantId) {
                        document.getElementById('product_variant_id').value = selectedProductVariantId;
                    } else {
                        document.getElementById('product_variant_id').value = ''; // Clear if no match found
                    }
                }
            }
            // Xác thực số lượng
            const amountInput = document.getElementById('quantityInput');
            amountInput.addEventListener('input', function() {
                let qty = parseInt(this.value, 10);
                if (isNaN(qty) || qty < 1) {
                    this.value = 1;
                }
            });
            // Xử lý nút submit
            document.querySelector('.product-form').addEventListener('submit', function(event) {
                const colorId = document.getElementById('color_id').value;
                const sizeId = document.getElementById('size_id').value;
                const variantId = document.getElementById('product_variant_id').value;

                // Kiểm tra xem người dùng đã chọn màu, kích thước và biến thể chưa
                if (!colorId || !sizeId || !variantId) {
                    event.preventDefault();
                    // Hiển thị popup lỗi với SweetAlert2
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Bạn chưa chọn màu, kích thước hoặc biến thể sản phẩm!',
                        confirmButtonText: 'OK'
                    });
                }
            });
            // Mua ngay
            document.getElementById('proceed-to-checkout').addEventListener('click', function(event) {
                const colorElement = document.getElementById('color_id');
                const sizeElement = document.getElementById('size_id');
                const variantElement = document.getElementById('product_variant_id');

                const colorId = colorElement ? colorElement.value : null;
                const sizeId = sizeElement ? sizeElement.value : null;
                const variantId = variantElement ? variantElement.value : null;

                const form = document.getElementById('product-form');

                // Kiểm tra xem người dùng đã chọn màu, kích thước và biến thể chưa
                if (!colorId || !sizeId || !variantId) {
                    event.preventDefault();

                    // Hiển thị popup lỗi với SweetAlert2
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Bạn chưa chọn màu, kích thước hoặc biến thể sản phẩm!',
                        confirmButtonText: 'OK'
                    });

                    return; // Ngăn không cho tiếp tục thực hiện khi có lỗi
                }

                // Thay đổi action của form
                form.action = '{{ route('buyNow') }}';
                form.submit();
            });
        });

        // add favorite
        document.addEventListener('DOMContentLoaded', function() {
            const wishlistLinks = document.querySelectorAll('.wishlist');
            const wishlistCountElement = document.getElementById('wishlist-count');

            wishlistLinks.forEach(wishlistLink => {
                const productId = wishlistLink.getAttribute('data-product-id');
                let isFavorite = wishlistLink.classList.contains('active');

                // Thêm sự kiện click vào wishlist link
                wishlistLink.addEventListener('click', function(event) {
                    event.preventDefault();

                    const url = isFavorite ? `/wishlist/remove/${productId}` :
                        `/wishlist/add/${productId}`;
                    const method = isFavorite ? 'DELETE' : 'POST';

                    fetch(url, {
                            method: method,
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content'),
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                isFavorite = !isFavorite; // Đổi trạng thái yêu thích

                                // Toggle giữa biểu tượng viền và đổ đầy
                                const heartOutline = wishlistLink.querySelector('.anm-heart-l');
                                const heartFill = wishlistLink.querySelector('.bi-heart-fill');

                                if (isFavorite) {
                                    wishlistLink.classList.add('active');
                                    heartOutline.classList.add('d-none');
                                    heartFill.classList.remove('d-none');
                                    updateWishlistCount(1);
                                } else {
                                    wishlistLink.classList.remove('active');
                                    heartOutline.classList.remove('d-none');
                                    heartFill.classList.add('d-none');
                                    updateWishlistCount(-1);
                                }
                            } else {
                                alert('Lỗi: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi:', error);
                        });
                });
            });

            function updateWishlistCount(change) {
                let currentCount = parseInt(wishlistCountElement.textContent) || 0;
                currentCount += change;
                wishlistCountElement.textContent = currentCount;
            }
        });
    </script>

    {{-- select ảnh --}}
    <script>
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

    <script src="{{ asset('admin\js\plugins\slick-carousel\slick.js') }}"></script>

    {{-- check số lượng từng biến thể --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let variantDetails = @json($variantDetails);

            let selectedColor = null;
            let selectedSize = null;
            let maxStock = 0;

            // Xử lý khi người dùng chọn màu
            document.querySelectorAll('.color-option').forEach(function(colorOption) {
                colorOption.addEventListener('click', function() {
                    selectedColor = this.getAttribute('data-attribute-value-id');
                    updateSizeOptions();
                    updateStock();
                });
            });

            // Xử lý khi người dùng chọn size
            document.querySelectorAll('.size-option').forEach(function(sizeOption) {
                sizeOption.addEventListener('click', function() {
                    selectedSize = this.getAttribute('data-attribute-value-id');
                    updateColorOptions();
                    updateStock();
                });
            });

            // Cập nhật trạng thái các lựa chọn size dựa trên màu đã chọn
            function updateSizeOptions() {
                document.querySelectorAll('.size-option').forEach(function(sizeOption) {
                    let sizeId = sizeOption.getAttribute('data-attribute-value-id');
                    let variant = variantDetails.find(v => {
                        return v.attributes.some(attr => attr.attributeName === 'Color' && attr
                                .value == selectedColor) &&
                            v.attributes.some(attr => attr.attributeName === 'Size' && attr.value ==
                                sizeId);
                    });

                    if (variant && variant.stock > 0) {
                        sizeOption.classList.remove('soldout');
                    } else {
                        sizeOption.classList.add('soldout');
                    }
                });
            }

            // Cập nhật trạng thái các lựa chọn màu dựa trên size đã chọn
            function updateColorOptions() {
                document.querySelectorAll('.color-option').forEach(function(colorOption) {
                    let colorId = colorOption.getAttribute('data-attribute-value-id');
                    let variant = variantDetails.find(v => {
                        return v.attributes.some(attr => attr.attributeName === 'Color' && attr
                                .value == colorId) &&
                            v.attributes.some(attr => attr.attributeName === 'Size' && attr.value ==
                                selectedSize);
                    });

                    if (variant && variant.stock > 0) {
                        colorOption.classList.remove('disabled');
                    } else {
                        colorOption.classList.add('disabled');
                    }
                });
            }

            // Cập nhật số lượng tồn kho dựa trên lựa chọn size và color
            function updateStock() {
                if (selectedColor && selectedSize) {
                    let variant = variantDetails.find(v => {
                        return v.attributes.some(attr => attr.attributeName === 'Color' && attr.value ==
                                selectedColor) &&
                            v.attributes.some(attr => attr.attributeName === 'Size' && attr.value ==
                                selectedSize);
                    });

                    if (variant) {
                        maxStock = variant.stock;
                        document.querySelector('#quantityInput').setAttribute('data-max-stock', maxStock);
                        document.querySelector('#quantityInput').value = 1; // Reset lại số lượng về 1
                    }
                }

                enableButtons(); // Bật lại các nút
            }

            // Xử lý logic tăng/giảm số lượng
            document.querySelector('.qtyBtn.plus').addEventListener('click', function() {
                let quantityInput = document.querySelector('#quantityInput');
                let currentQty = parseInt(quantityInput.value);

                // Chỉ tăng nếu số lượng hiện tại nhỏ hơn maxStock và đã chọn màu và size
                if (currentQty < maxStock && selectedColor && selectedSize) {
                    quantityInput.value = currentQty + 1 - 1;
                } else if (!selectedColor || !selectedSize) {
                    showPopup('Vui lòng chọn màu và size trước.');
                } else {
                    showPopup('Sản phẩm này trong kho chỉ còn ' + maxStock + ' sản phẩm.');
                }
                enableButtons(); // Cập nhật trạng thái nút
            });

            document.querySelector('.qtyBtn.minus').addEventListener('click', function() {
                let quantityInput = document.querySelector('#quantityInput');
                let currentQty = parseInt(quantityInput.value);

                // Chỉ giảm nếu số lượng hiện tại lớn hơn 1 và đã chọn màu và size
                if (currentQty > 1 && selectedColor && selectedSize) {
                    quantityInput.value = currentQty - 1 + 1; // Giảm 1 đơn vị
                } else if (!selectedColor || !selectedSize) {
                    showPopup('Vui lòng chọn màu và size trước.');
                }
                enableButtons(); // Cập nhật trạng thái nút
            });

            // Ngăn người dùng nhập ký tự vào ô số lượng và xử lý khi nhập số lượng trực tiếp
            const quantityInput = document.getElementById('quantityInput');
            quantityInput.addEventListener('input', function() {
                // Chỉ cho phép nhập số
                this.value = this.value.replace(/[^0-9]/g, '');

                // Nếu đã chọn màu và size, kiểm tra số lượng
                if (selectedColor && selectedSize) {
                    if (parseInt(this.value) > maxStock) {
                        showPopup(`Sản phẩm này trong kho chỉ còn ${maxStock} sản phẩm.`);
                        this.value = maxStock; // Giới hạn lại giá trị về tối đa
                    }
                }

                // Đảm bảo không giảm xuống dưới 1
                if (parseInt(this.value) < 1) {
                    this.value = 1;
                }

                enableButtons(); // Cập nhật trạng thái nút
            });

            // Hàm vô hiệu hóa nút
            function disableButtons() {
                document.querySelector('.qtyBtn.plus').classList.add('disabled');
                document.querySelector('.qtyBtn.plus').setAttribute('disabled', 'disabled');
                document.querySelector('.qtyBtn.minus').classList.add('disabled');
                document.querySelector('.qtyBtn.minus').setAttribute('disabled', 'disabled');
            }

            // Hàm bật nút
            function enableButtons() {
                const currentQty = parseInt(quantityInput.value);

                // Vô hiệu hóa nút "+" nếu số lượng đã đạt tối đa hoặc chưa chọn màu và size
                if ((selectedColor && selectedSize && currentQty >= maxStock) || !selectedColor || !selectedSize) {
                    document.querySelector('.qtyBtn.plus').classList.add('disabled');
                    document.querySelector('.qtyBtn.plus').setAttribute('disabled', 'disabled');
                } else {
                    document.querySelector('.qtyBtn.plus').classList.remove('disabled');
                    document.querySelector('.qtyBtn.plus').removeAttribute('disabled');
                }

                // Vô hiệu hóa nút "-" nếu số lượng bằng 1 hoặc chưa chọn màu và size
                if ((currentQty <= 1) || !selectedColor || !selectedSize) {
                    document.querySelector('.qtyBtn.minus').classList.add('disabled');
                    document.querySelector('.qtyBtn.minus').setAttribute('disabled', 'disabled');
                } else {
                    document.querySelector('.qtyBtn.minus').classList.remove('disabled');
                    document.querySelector('.qtyBtn.minus').removeAttribute('disabled');
                }
            }
        });
    </script>


    {{-- popup --}}
    <script>
        function showPopup(message) {
            const modal = document.getElementById("quantityPopup");
            const messageElement = document.getElementById("popupMessage");
            messageElement.textContent = message;
            modal.style.display = "flex"; // Hiển thị popup

            // Đóng popup khi bấm vào dấu 'x'
            document.querySelector(".close").onclick = function() {
                modal.style.display = 'none';
            };

            // Đóng popup khi bấm nút OK
            document.querySelector(".btn").onclick = function() {
                modal.style.display = 'none';
            };

            // Đóng popup khi bấm ra ngoài
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            };
        }
    </script>

    {{-- Select attribute --}}
    <script>
        // Khi tài liệu đã sẵn sàng
        document.addEventListener('DOMContentLoaded', function() {
            const colorOptions = document.querySelectorAll('.color-option');
            const sizeOptions = document.querySelectorAll('.size-option');
            const colorSpan = document.querySelector('.label .slVariant'); // Span hiển thị màu
            const sizeSpan = document.querySelector('.swatches-size .slVariant'); // Span hiển thị size

            // Xử lý chọn màu
            colorOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Lấy mã màu từ data attribute
                    const colorName = this.getAttribute('data-color-name');
                    const colorCode = this.getAttribute('data-color-code');
                    // Cập nhật span hiển thị màu hoặc xóa nội dung nếu không chọn
                    colorSpan.textContent = colorName || '';
                });
            });

            // Xử lý chọn kích cỡ
            sizeOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Lấy kích cỡ từ data attribute
                    const sizeValue = this.querySelector('.swatchLbl').textContent.trim();

                    // Cập nhật span hiển thị kích cỡ hoặc xóa nội dung nếu không chọn
                    sizeSpan.textContent = sizeValue || '';
                });
            });
        });
    </script>

    {{-- select image attribute color --}}
    <script>
        document.querySelectorAll('.color-option').forEach(option => {
            option.addEventListener('click', function() {
                const productImage = this.getAttribute('data-product-image');
                const zoomImage = document.getElementById('zoompro');

                // Cập nhật ảnh và data-zoom-image
                zoomImage.src = `/storage/${productImage}`;
                zoomImage.setAttribute('data-zoom-image', `/storage/${productImage}`);
            });
        });
    </script>

    {{-- select price --}}
    <script>
        const variants = @json($variantDetails);

        let selectedColor = null;
        let selectedSize = null;

        // Lắng nghe sự kiện click trên màu
        document.querySelectorAll('.color-option').forEach(item => {
            item.addEventListener('click', function() {
                selectedColor = this.getAttribute('data-attribute-value-id');
                console.log(selectedColor);
                updatePrice();
            });
        });

        // Lắng nghe sự kiện click trên kích thước
        document.querySelectorAll('.size-option').forEach(item => {
            item.addEventListener('click', function() {
                selectedSize = this.getAttribute('data-attribute-value-id');
                console.log(selectedSize);
                updatePrice();
            });
        });



        // Hàm cập nhật giá
        function updatePrice() {
            if (selectedColor && selectedSize) {
                console.log("Variants: ", variants); // In ra mảng variants
                console.log("Selected Color: ", selectedColor);
                console.log("Selected Size: ", selectedSize);

                const selectedVariant = variants.find(variant => {
                    console.log("Checking Variant ID: ", variant.id); // In ra ID biến thể

                    // Lấy danh sách thuộc tính
                    const attributeValues = variant.attributeValues;
                    console.log("Attribute Values: ", attributeValues); // In ra các thuộc tính

                    // Kiểm tra thuộc tính màu
                    const hasColor = attributeValues.includes(selectedColor); // So sánh trực tiếp với giá trị màu
                    console.log("Has Color: ", hasColor);

                    // Kiểm tra thuộc tính kích thước
                    const hasSize = attributeValues.includes(
                        selectedSize); // So sánh trực tiếp với giá trị kích thước
                    console.log("Has Size: ", hasSize);

                    console.log(hasColor, hasSize);

                    return hasColor && hasSize;
                });

                // Cập nhật giá hiển thị
                if (selectedVariant) {
                    const regularPriceElement = document.getElementById('regular-price');
                    const salePriceElement = document.getElementById('sale-price');
                    // console.log(selectedVariant);

                    // Cập nhật giá
                    regularPriceElement.textContent = `${numberFormat(selectedVariant.price_regular, 3, '.', 0)}đ`;
                    salePriceElement.textContent = `${numberFormat(selectedVariant.price_sale, 3, '.', 0)}đ`;

                    // Kiểm tra giá để hiển thị
                    if (selectedVariant.price_sale < selectedVariant.price_regular) {
                        // Giá sale thấp hơn giá gốc
                        salePriceElement.style.display = 'inline'; // Hiện giá sale
                        regularPriceElement.style.textDecoration = 'line-through'; // Gạch giá gốc
                        regularPriceElement.style.color = 'gray'; // Gạch giá gốc
                        regularPriceElement.style.fontSize = '1.3em'; // Giảm kích thước chữ giá gốc
                        salePriceElement.style.color = 'red'; // Màu đỏ cho giá sale
                        salePriceElement.style.fontSize = '1.57em'; // Kích thước chữ cho giá sale
                    } else if (selectedVariant.price_sale === selectedVariant.price_regular) {
                        // Giá sale bằng giá gốc
                        regularPriceElement.style.textDecoration = 'none'; // Không gạch giá gốc
                        regularPriceElement.style.color = 'red'; // Màu đỏ cho giá gốc
                        regularPriceElement.style.fontSize = '1.57em'; // Tăng kích thước chữ cho giá gốc
                        salePriceElement.style.display = 'none'; // Ẩn giá sale
                    } else {
                        // Ẩn giá sale nếu không có giảm giá
                        salePriceElement.style.display = 'none';
                        regularPriceElement.style.textDecoration = 'none'; // Không gạch giá gốc
                    }
                } else {
                    console.log("Không tìm thấy biến thể với màu và kích thước đã chọn.");
                }
            } else {
                console.log("Vui lòng chọn màu và kích thước.");
            }

            function numberFormat(number, decimals, dec_point, thousands_sep) {
                // Chuyển đổi số thành chuỗi với số thập phân
                number = parseFloat(number).toFixed(decimals);

                // Phân tách phần nguyên và phần thập phân
                let parts = number.split('.');
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep); // Thêm dấu phân cách hàng nghìn

                // Kết hợp lại
                return parts.join(dec_point);
            }
        }
    </script>

    {{-- xuong dòng --}}
    <script>
        function toggleContent(element) {
            element.classList.toggle('expanded'); // Thêm/xóa class 'expanded' khi bấm
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Hàm cuộn đến khung bình luận với độ trễ
            function scrollToComments() {
                const commentBox = document.getElementById('ratings-comment');
                if (commentBox) {
                    commentBox.scrollIntoView({
                        behavior: 'smooth',
                        block: 'end'
                    });
                }
            }

            // Xử lý sự kiện khi chọn filter
            const filters = document.querySelectorAll('.rating-choose');
            filters.forEach(filter => {
                filter.addEventListener('click', function() {
                    // Lưu ý định cuộn vào sessionStorage
                    sessionStorage.setItem('scrollToComments', 'true');
                });
            });

            // Xử lý sự kiện phân trang
            const paginationLinks = document.querySelectorAll('.pagination a');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function() {
                    // Lưu ý định cuộn vào sessionStorage
                    sessionStorage.setItem('scrollToComments', 'true');
                });
            });

            // Kiểm tra nếu cần cuộn sau khi trang được load lại
            if (sessionStorage.getItem('scrollToComments') === 'true') {
                sessionStorage.removeItem('scrollToComments'); // Xóa flag sau khi cuộn
                setTimeout(scrollToComments, 300); // Cuộn với độ trễ sau khi trang tải
            }
        });
    </script>
@endsection
