@extends('layouts.client')

@section('css')
    <link rel="stylesheet" href="{{asset('client/css/product-detail.css')}}">
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
                                    <img id="zoompro" class="zoompro" src="{{ $product->img_thumbnail }}"
                                        data-zoom-image="{{ $product->img_thumbnail }}" alt="product" width="625"
                                        height="808" />
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
                                        <a href="javascript:void(0);" data-image="{{ $item->image }}"
                                            data-zoom-image="{{ $item->image }}" class="thumbnail">
                                            <img class="blur-up lazyload" data-src="{{ $item->image }}"
                                                src="{{ $item->image }}" alt="product" width="625" height="808" />
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
                                <span
                                    class="price old-price">{{ number_format($product->price_regular, 3, '.', 0) }}đ</span><span
                                    class="price">{{ number_format($product->price_sale, 3, '.', 0) }}đ</span>
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
                                    <label class="label d-flex align-items-center">Color:<span
                                            class="slVariant ms-1 fw-bold">Blue</span></label>
                                    <ul class="variants-clr swatches d-flex-center pt-1 clearfix" id="color-options">
                                        @foreach ($uniqueAttributes->where('attributeName', 'Color') as $color)
                                            <li class="swatch x-large available color-option"
                                                style="background-color: {{ $color['colorCode'] }}"
                                                data-color-code="{{ $color['colorCode'] }}"
                                                data-attribute-value-id="{{ $color['value'] }}" data-bs-toggle="tooltip"
                                                title="{{ $color['value'] }}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Swatches Size -->
                                <div class="product-item swatches-size w-100 mb-4 swatch-1 option2" data-option-index="1">
                                    <label class="label d-flex align-items-center">Size:<span
                                            class="slVariant ms-1 fw-bold">S</span></label>
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
                                            class="product-form-input qty" id="quantityInput" data-max-stock="0"/>
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
                                    <i class="icon anm anm-heart-l me-2"></i>
                                    <span>{{ $isFavorite ? 'Xoá khỏi sản phẩm yêu thích' : 'Thêm vào sản phẩm yêu thích' }}</span>
                                </a>
                                <a href="#shippingInfo-modal" class="text-link shippingInfo" data-bs-toggle="modal"
                                    data-bs-target="#shippingInfo_modal">
                                    <i class="icon anm anm-paper-l-plane me-2"></i>
                                    <span>Delivery & Returns</span>
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
                    <li rel="reviews"><a class="tablink">Đánh giá</a></li>
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

                    <!--Review-->
                    <h3 class="tabs-ac-style d-md-none" rel="reviews">Đánh giá</h3>
                    <div id="reviews" class="tab-content">
                        <div class="row">

                            {{-- đánh giá trung bình --}}
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-4">
                                <div class="ratings-main">
                                    <div class="avg-rating d-flex-center mb-3">
                                        <h3 class="avg-mark">{{ number_format($averageRating, 1) }}/5</h3>
                                        <div class="avg-content ms-3">
                                            <p class="text-rating">Đánh giá sản phẩm</p>
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
                                    </div>

                                    <div class="ratings-list">
                                        @foreach ($ratingsPercentage as $rating => $percentage)
                                            <div class="ratings-container d-flex align-items-center mt-1">
                                                <div class="ratings-full product-review m-0">
                                                    <a class="reviewLink d-flex align-items-center" href="#reviews">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            <i
                                                                class="icon anm anm-star {{ $i < $rating ? '' : 'anm-star-o' }}"></i>
                                                        @endfor
                                                    </a>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        aria-valuenow="{{ $percentage }}" aria-valuemin="0"
                                                        aria-valuemax="100" style="width:{{ $percentage }}%;"></div>
                                                </div>
                                                <div class="progress-value">{{ number_format($percentage, 1) }}%</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{-- Danh sách bình luận --}}
                            {{-- <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-4">
                                <div class="spr-reviews">
                                    <h3 class="spr-form-title">Đánh giá sản phẩm</h3>
                                    <div class="review-inner">
                                        @foreach ($comments['comments'] as $comment)
                                            <div class="spr-review d-flex w-100">
                                                <div class="spr-review-profile " style="width: 50px">
                                                    <img class=""
                                                        data-src="{{ asset($comment['user_image'] ? $comment['user_image'] : 'https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg') }}"
                                                        src="{{ asset($comment['user_image'] ? $comment['user_image'] : 'https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg') }}"
                                                        alt="" />
                                                </div>
                                                <div class="spr-review-content flex-grow-1">
                                                    <div class="d-flex justify-content-between flex-column mb-2">
                                                        <div
                                                            class="title-review d-flex align-items-center justify-content-between">
                                                            <div>
                                                                <h5
                                                                    class="spr-review-header-title text-transform-none mb-0 d-inline">
                                                                    {{ $comment['user_name'] }}
                                                                </h5> -
                                                                {{ $comment['created_at'] ? $comment['updated_at']->format('d-m-Y') : $comment['created_at']->format('d-m-Y') }}
                                                            </div>
                                                            <div>
                                                                <span class="product-review spr-starratings m-0">
                                                                    @if ($comment['rating'] == 'Không đánh giá')
                                                                        <span class="reviewLink">Không có đánh giá</span>
                                                                    @else
                                                                        <span class="reviewLink">
                                                                            @for ($i = 0; $i < 5; $i++)
                                                                                <i
                                                                                    class="icon anm anm-star {{ $i < $comment['rating'] ? '' : 'anm-star-o' }}"></i>
                                                                            @endfor
                                                                        </span>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <b class="head-font">{{ $comment['title'] }}</b>
                                                    <p class="spr-review-body text-truncate"
                                                        style="max-width: 350px; word-wrap: break-word;">
                                                        {{ $comment['body'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Hiển thị nút xem tất cả bình luận nếu có nhiều hơn 2 -->
                                        @if ($comments['total_comments'] > 2)
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-secondary " data-bs-toggle="modal"
                                                    data-bs-target="#allCommentsModal">
                                                    Xem tất cả({{ $comments['total_comments'] }})
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div> --}}
                            {{-- end list comment --}}

                            {{-- Form gửi bình luận --}}
                            <div>
                                @if ($canComment === 'not_logged_in')
                                    <span>Bạn cần <a href="{{ route('login') }}"><b>đăng nhập</b></a> để bình luận.</span>
                                @elseif ($canComment === 'not_purchased')
                                    <span>Bạn cần mua sản phẩm này để bình luận.</span>
                                @elseif ($canComment === 'purchased' || $canComment === 'new_purchase')
                                    <!-- Form bình luận -->
                                    <form id="commentForm" method="POST" action="{{ route('comments.store') }}"
                                        class="product-review-form new-review-form">
                                        @csrf
                                        <h3 class="spr-form-title">Viết bình luận</h3>
                                        <fieldset class="row spr-form-contact">
                                            <div class="col-sm-6 spr-form-review-title form-group">
                                                <label class="spr-form-label" for="review">Tiêu đề</label>
                                                <input class="spr-form-input spr-form-input-text" id="review"
                                                    type="text" name="comment_title" />
                                            </div>
                                            <div class="col-sm-6 spr-form-review-rating form-group">
                                                <label class="spr-form-label">Đánh giá</label>
                                                <div class="product-review pt-1">
                                                    <div class="review-rating">
                                                        <input type="radio" id="star1" name="rating"
                                                            value="1">
                                                        <label for="star1"><i class="icon anm anm-star-o"></i></label>
                                                        <input type="radio" id="star2" name="rating"
                                                            value="2">
                                                        <label for="star2"><i class="icon anm anm-star-o"></i></label>
                                                        <input type="radio" id="star3" name="rating"
                                                            value="3">
                                                        <label for="star3"><i class="icon anm anm-star-o"></i></label>
                                                        <input type="radio" id="star4" name="rating"
                                                            value="4">
                                                        <label for="star4"><i class="icon anm anm-star-o"></i></label>
                                                        <input type="radio" id="star5" name="rating"
                                                            value="5">
                                                        <label for="star5"><i class="icon anm anm-star-o"></i></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 spr-form-review-body form-group">
                                                <label class="spr-form-label" for="message">Nội dung<span
                                                        class="spr-form-review-body-charactersremaining"> tối đa (500) kí
                                                        tự</span></label>
                                                <div class="spr-form-input">
                                                    <textarea class="spr-form-input spr-form-input-textarea" required id="message" name="main_comment" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        </fieldset>
                                        <div class="spr-form-actions clearfix">
                                            <input type="submit" class="btn btn-primary spr-button spr-button-primary"
                                                value="Gửi đánh giá" />
                                        </div>
                                    </form>
                                @elseif ($canComment === 'commented')
                                    <span>Bạn đã bình luận cho sản phẩm này. Mua hàng mới để bình luận thêm.</span>
                                @endif
                            </div>
                            {{-- End form --}}

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
                                        <a href="{{ route('productDetail', $product->slug) }}"
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
                                            <a
                                                href="{{ route('productDetail', $product->slug) }}">{{ $product->name }}</a>
                                        </div>
                                        <div class="product-price">
                                            @if ($product->price_sale == 0)
                                                <span class="price">
                                                    {{ number_format($product->price_regular, 3, '.', 0) }}đ</span>
                                            @else
                                                <span
                                                    class="price old-price">{{ number_format($product->price_regular, 3, '.', 0) }}đ</span>
                                                <span
                                                    class="price">{{ number_format($product->price_sale, 3, '.', 0) }}đ</span>
                                            @endif
                                        </div>
                                        <div class="product-review">
                                            @php
                                                // Lấy đánh giá tương ứng cho sản phẩm hiện tại
                                                $relatedRating = $relatedRatings->firstWhere(
                                                    'product_id',
                                                    $product->id,
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
                                            @foreach ($uniqueAttributes->where('attributeName', 'Color') as $color)
                                                <li class="swatch x-small available color-option"
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

    <!-- Display more comments -->
    <div class="modal fade" id="allCommentsModal" tabindex="-1" aria-labelledby="allCommentsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="allCommentsModalLabel">Tất cả bình luận</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (isset($comments['all_comments']) && !empty($comments['all_comments']))
                        @foreach ($comments['all_comments'] as $comment)
                            <div class="spr-review  w-100">
                                <div class="row p-3">
                                    <div class="col-lg-1 mt-1 ">
                                        <img class="blur-up lazyload rounded-circle"
                                            data-src="{{ asset($comment['user_image'] ? $comment['user_image'] : 'https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg') }}"
                                            src="{{ asset($comment['user_image'] ? $comment['user_image'] : 'https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg') }}"
                                            alt="" width="80" height="80" />
                                    </div>
                                    <div class="col-lg-7">
                                        <strong>{{ $comment['user_name'] }}</strong> - {{ $comment['date'] }} <br>
                                        @if ($comment['title'] != null)
                                            <b>Tiêu đề: </b> {{ $comment['title'] }}
                                        @endif
                                        <p class="spr-review-body"
                                            style="overflow: hidden; max-width: 400px; word-wrap: break-word;">
                                            {{ $comment['body'] }}
                                        </p>
                                    </div>
                                    <div class="rating col-lg-4">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $comment['rating'])
                                                <span class="anm anm-star text-warning"></span> <!-- Sao đầy -->
                                            @else
                                                <span class="anm anm-star-o text-warning"></span> <!-- Sao rỗng -->
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <span>Hiện chưa có bình luận nào</span>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!-- End display more comments -->

    {{-- Edit comment modal --}}
    <div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5>Chỉnh sửa bình luận</h5>
                    <form id="editCommentForm" method="POST"
                        action="{{ isset($comment) ? route('comments.update', $comment['id']) : '#' }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="comment_id" id="comment_id" value="">
                        <div class="form-group mb-3">
                            <label for="edit_comment_title">Tiêu đề</label>
                            <input type="text" class="form-control" id="edit_comment_title" name="comment_title"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="edit_message">Nội dung</label>
                            <textarea class="form-control" id="edit_message" name="main_comment" rows="3" required></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label>Đánh giá</label>
                            <div class="review-rating">
                                <input type="radio" id="star1_edit" name="rating" value="1">
                                <label for="star1_edit"><i class="icon anm anm-star-o"></i></label>
                                <input type="radio" id="star2_edit" name="rating" value="2">
                                <label for="star2_edit"><i class="icon anm anm-star-o"></i></label>
                                <input type="radio" id="star3_edit" name="rating" value="3">
                                <label for="star3_edit"><i class="icon anm anm-star-o"></i></label>
                                <input type="radio" id="star4_edit" name="rating" value="4">
                                <label for="star4_edit"><i class="icon anm anm-star-o"></i></label>
                                <input type="radio" id="star5_edit" name="rating" value="5">
                                <label for="star5_edit"><i class="icon anm anm-star-o"></i></label>
                            </div>
                        </div>
                        <span>Lưu ý: bạn chỉ được sửa bình luận này 1 lần</span>
                        <br>
                        <div class="text-center mt-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Cập nhật bình luận</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    {{-- End edit comment modal --}}

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
                                        <input type="text" name="quantity" value="1" class="qty"/>
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
            const wishlistLink = document.querySelector('.wishlist');

            wishlistLink.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>

                const productId = this.getAttribute('data-product-id');
                const isFavorite = this.classList.contains('active');

                // Gửi yêu cầu POST hoặc DELETE để thêm/xóa yêu thích
                const url = isFavorite ? `/wishlist/remove/${productId}` : `/wishlist/add/${productId}`;
                const method = isFavorite ? 'DELETE' : 'POST';

                fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Thay đổi trạng thái của biểu tượng trái tim
                            if (isFavorite) {
                                this.classList.remove('active');
                                this.querySelector('span').textContent = 'Thêm vào sản phẩm yêu thích';
                            } else {
                                this.classList.add('active');
                                this.querySelector('span').textContent = 'Xoá khỏi sản phẩm yêu thích';
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
        document.addEventListener('DOMContentLoaded', function () {
        let variantDetails = @json($variantDetails);

        let selectedColor = null;
        let selectedSize = null;
        let maxStock = 0;

        // Xử lý khi người dùng chọn màu
        document.querySelectorAll('.color-option').forEach(function (colorOption) {
            colorOption.addEventListener('click', function () {
                selectedColor = this.getAttribute('data-attribute-value-id');
                updateSizeOptions();
                updateStock();
            });
        });

        // Xử lý khi người dùng chọn size
        document.querySelectorAll('.size-option').forEach(function (sizeOption) {
            sizeOption.addEventListener('click', function () {
                selectedSize = this.getAttribute('data-attribute-value-id');
                updateColorOptions();
                updateStock();
            });
        });

        // Cập nhật trạng thái các lựa chọn size dựa trên màu đã chọn
        function updateSizeOptions() {
            document.querySelectorAll('.size-option').forEach(function (sizeOption) {
                let sizeId = sizeOption.getAttribute('data-attribute-value-id');
                let variant = variantDetails.find(v => {
                    return v.attributes.some(attr => attr.attributeName === 'Color' && attr.value == selectedColor) &&
                        v.attributes.some(attr => attr.attributeName === 'Size' && attr.value == sizeId);
                });

                if (variant && variant.stock > 0) {
                    sizeOption.classList.remove('disabled');
                } else {
                    sizeOption.classList.add('disabled');
                }
            });
        }

        // Cập nhật trạng thái các lựa chọn màu dựa trên size đã chọn
        function updateColorOptions() {
            document.querySelectorAll('.color-option').forEach(function (colorOption) {
                let colorId = colorOption.getAttribute('data-attribute-value-id');
                let variant = variantDetails.find(v => {
                    return v.attributes.some(attr => attr.attributeName === 'Color' && attr.value == colorId) &&
                        v.attributes.some(attr => attr.attributeName === 'Size' && attr.value == selectedSize);
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
                    return v.attributes.some(attr => attr.attributeName === 'Color' && attr.value == selectedColor) &&
                        v.attributes.some(attr => attr.attributeName === 'Size' && attr.value == selectedSize);
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
        document.querySelector('.qtyBtn.plus').addEventListener('click', function () {
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

        document.querySelector('.qtyBtn.minus').addEventListener('click', function () {
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
        quantityInput.addEventListener('input', function () {
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

    {{-- select sao --}}
    <script>
        // Bắt tất cả các label và radio inputs
        const stars = document.querySelectorAll('.review-rating label');
        const inputs = document.querySelectorAll('.review-rating input[type="radio"]');

        // Lặp qua tất cả các label (sao)
        stars.forEach((star, index) => {
            // Thêm sự kiện click vào mỗi label (sao)
            star.addEventListener('click', function() {
                // Lấy giá trị của input tương ứng (lấy giá trị đánh giá)
                inputs[index].checked = true;

                // Reset lại tất cả các sao thành class `anm-star-o` (trắng)
                stars.forEach(s => s.querySelector('i').className = 'icon anm anm-star-o');

                // Tô vàng tất cả các sao từ vị trí hiện tại trở về trước (bao gồm sao vừa click)
                for (let i = 0; i <= index; i++) {
                    stars[i].querySelector('i').className = 'icon anm anm-star';
                }
            });
        });
    </script>

    {{-- Gửi bình luận --}}
    <script>
        $(document).ready(function() {
            $('#commentForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('comments.store') }}", // Đường dẫn tới route lưu comment
                    type: "POST",
                    data: $(this).serialize(), // Lấy tất cả dữ liệu từ form
                    success: function(response) {
                        if (response.success) {
                            // Hiển thị thông báo đã bình luận và disable form
                            $('#commentForm').html(
                                '<span>Bạn đã bình luận cho sản phẩm này.</span>');
                        } else {
                            alert('Đã có lỗi xảy ra!');
                        }
                    },
                    console.log(response);

                    error: function(response) {
                        alert('Đã có lỗi xảy ra!');
                    }
                });
            });
        });
    </script>

    {{-- display edit modal --}}
    <script>
        document.querySelectorAll('.edit-comment').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();
                const commentId = this.getAttribute('data-comment-id');
                const commentTitle = this.getAttribute('data-comment-title');
                const commentBody = this.getAttribute('data-comment-body');
                const commentRating = this.getAttribute('data-comment-rating');

                // Điền thông tin vào modal
                document.getElementById('comment_id').value = commentId;
                document.getElementById('edit_comment_title').value = commentTitle;
                document.getElementById('edit_message').value = commentBody;

                // Thiết lập giá trị đánh giá
                const starRating = document.querySelectorAll('input[name="rating"]');
                starRating.forEach(function(input) {
                    input.checked = (input.value == commentRating);
                });

                // Cập nhật action cho form với comment ID
                const form = document.getElementById('editCommentForm');
                form.setAttribute('action', `/comments/${commentId}`);

                // Hiển thị modal
                $('#editCommentModal').modal('show');
            });
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
            document.querySelector(".close").onclick = function () {
                modal.style.display = 'none';
            };

            // Đóng popup khi bấm nút OK
            document.querySelector(".btn").onclick = function () {
                modal.style.display = 'none';
            };

            // Đóng popup khi bấm ra ngoài
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            };
        }

    </script>
@endsection
