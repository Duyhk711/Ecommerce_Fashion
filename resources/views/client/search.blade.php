@extends('layouts.client')
@section('title')
    Tìm kiếm
@endsection
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
                                <a href="{{ route('productDetail', $product->slug) }}" class="product-img rounded-0">
                                    <!-- Image -->
                                    <img class="primary rounded-0 blur-up lazyload"
                                        data-src="{{ Storage::url($product->img_thumbnail) }}"
                                        src="{{ Storage::url($product->img_thumbnail) }}" alt="Product" title="Product"
                                        width="625" height="808" />
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
                                {{-- <div class="product-labels"><span class="lbl pr-label2">Hot</span></div> --}}
                                <!-- End Product label -->
                                <!--Product Button-->
                                <div class="button-set style1">
                                    <!--Cart Button-->
                                    <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                        @csrf 
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn-icon addtocart">
                                            <span class="icon-wrap d-flex-justify-center h-100 w-100"
                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                title="Add to Cart">
                                                <i class="icon anm anm-cart-l"></i>
                                                <span class="text">Add to Cart</span>
                                            </span>
                                        </button>
                                    </form>
                                    <!--End Cart Button-->

                                    <!--Wishlist Button-->
                                    <a class="btn-icon wishlist text-link wishlist {{ $product->isFavorite ? 'active' : '' }}"
                                        href="#" data-product-id="{{ $product->id }}"
                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="{{ $product->isFavorite ? 'Xóa khỏi yêu thích' : 'Thêm vào yêu thích' }}">
                                        <i style="font-size:15px"
                                            class="icon anm anm-heart-l  favorite {{ $product->isFavorite ? 'd-none' : '' }}"></i>
                                        <i style="color: #e96f84;font-size:15px"
                                            class="bi bi-heart-fill  favorite {{ $product->isFavorite ? '' : 'd-none' }}"></i>
                                    </a>
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
                                    <span class="price">{{ number_format($product->price_sale, 3, '.', 0) }}₫</span>
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
                                {{-- <p class="sort-desc hidden">There are many variations of passages of Lorem Ipsum
                                    available, but the majority have suffered alteration in some form, by injected
                                    humour, or randomised words which don't look even slightly believable. If you
                                    are going to use a passage...</p> --}}
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
@section('js')
<script>
    var isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    document.addEventListener('DOMContentLoaded', function() {
        const wishlistLinks = document.querySelectorAll('.wishlist');
        const wishlistCountElement = document.getElementById('wishlist-count');

        wishlistLinks.forEach(wishlistLink => {
            const productId = wishlistLink.getAttribute('data-product-id');
            let isFavorite = wishlistLink.classList.contains('active');

            // Thêm sự kiện click vào wishlist link
            wishlistLink.addEventListener('click', function(event) {
                event.preventDefault();

                if (!isLoggedIn) {
                    // Chuyển hướng sang trang đăng nhập nếu chưa đăng nhập
                    window.location.href = '/login';
                    return;
                }
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
    $('.add-to-cart-form').on('submit', function(event) {
        event.preventDefault(); // Ngăn chặn tải lại trang

        const form = $(this); // Lấy form hiện tại đang được submit

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    updateCartCount();
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: response.message || 'Sản phẩm đã được thêm vào giỏ hàng!',
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Có lỗi xảy ra!',
                        text: response.message || 'Xin vui lòng thử lại!',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                Swal.fire({
                    icon: 'error',
                    title: 'Có lỗi xảy ra!',
                    text: 'Xin vui lòng thử lại!',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

function updateCartCount() {
      $.ajax({
          url: '/cart/count', // Thay đổi đường dẫn này
          type: 'GET',
          success: function(data) {
              $('.cart-count').text(data.count); // Cập nhật số lượng vào phần tử .cart-count
          },
          error: function(xhr) {
              console.error('Error:', xhr);
          }
      });
  }
});



</script>
@endsection