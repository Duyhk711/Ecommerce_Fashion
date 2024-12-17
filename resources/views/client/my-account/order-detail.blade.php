@extends('client.my-account')

@section('css')
    {{-- CSS order-detail --}}
    {{-- <link rel="stylesheet" href="{{ asset('client/css/order-detail.css') }}"> --}}
    {{-- link icon  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .review-rating {
            display: flex;
            flex-direction: row;
            /* Để các sao ngược lại */
            justify-content: flex-start;
        }

        .review-rating input[type="radio"] {
            display: none;
            /* Ẩn các input radio */
        }

        .review-rating label {
            font-size: 2em;
            /* Kích thước của icon sao */
            cursor: pointer;
            /* Con trỏ trỏ vào sao khi di chuột */
        }

        /* Icon sao mặc định (chưa được chọn) sẽ có class anm-star-o */
        .review-rating label i {
            color: #ccc;
            /* Màu trắng mặc định cho sao */
        }

        /* Khi sao được chọn (anm-star) */
        .review-rating label .anm-star {
            color: #ffcc00;
            /* Màu vàng cho sao được chọn */
        }
    </style>
    <style>
        /* form-control */
        /* Global reset for input, textarea, and select to make them consistent */
        input, textarea, select {
            box-sizing: border-box;
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        /* Style for input, textarea, select focus state */
        input:focus, textarea:focus, select:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        /* Optional: Disabled state */
        input:disabled, textarea:disabled, select:disabled {
            background-color: #e9ecef;
            opacity: 1;
        }

        /* Optional: Styling for valid state */
        input.is-valid, textarea.is-valid, select.is-valid {
            border-color: #28a745;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%2328a745'%3e%3cpath fill-rule='evenodd' d='M16 2l-8 8-4-4-1 1 5 5 9-9z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        /* Optional: Styling for invalid state */
        input.is-invalid, textarea.is-invalid, select.is-invalid {
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23dc3545'%3e%3cpath d='M12.293 4.293a1 1 0 010 1.414L9.414 8l2.879 2.879a1 1 0 11-1.414 1.414L8 9.414l-2.879 2.879a1 1 0 11-1.414-1.414L6.586 8 3.707 5.121a1 1 0 111.414-1.414L8 6.586l2.879-2.879a1 1 0 011.414 0z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        /* Add margin to form-group to space out elements */
        .form-group {
            margin-bottom: 1rem;
        }

        /* Optional: Adding some styling for labels */
        label {
            display: inline-block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }
         .btn-outline-danger {
            color: #dc3545;
            background-color: #fff;
            border-color: #dc3545;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }
    </style>
@endsection

@section('my-order')
    <div class="order-detail-container ">
        <!-- Header đơn hàng -->
        <div class="order-header">
            <p>
                Mã vận đơn: <strong>{{ $order->sku }}</strong>
                @php
                    $statusText = [
                        '1' => 'Chờ xác nhận',
                        '2' => 'Chờ vận chuyển',
                        '3' => 'Đang vận chuyển',
                        '4' => 'Đã giao',
                        '5' => 'Hoàn thành',
                        'huy_don_hang' => 'Hủy đơn hàng'
                    ];
                @endphp
                <span class="badge text-bg
                    @if ($order->status == '1') bg-secondary
                    @elseif($order->status == '2') bg-info
                    @elseif($order->status == '3') bg-primary text-dark
                    @elseif($order->status == '4') bg-success
                    @elseif($order->status == '5') bg-success
                    @elseif($order->status == 'huy_don_hang') bg-danger
                    @endif">
                    {{ $statusText[$order->status] ?? $order->status }}
                </span>
                @if ($order->status == '1')
                    <div class="cancel-item" style="display: inline-block; margin-left: 10px;">
                        <form action="{{ route('order.cancel', ['order_id' => $order->id]) }}" method="POST"
                            id="cancelOrderForm-{{ $order->id }}">
                            @csrf
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                onclick="confirmCancelOrder({{ $order->id }})">Hủy đơn hàng</button>
                        </form>
                    </div>
                @endif
            </p>
            <p style="margin-top: 10px;">Ngày đặt hàng:  {{ $order->created_at->format('H:i d/m/Y') }}</p>
        </div>
        <hr>

        <!-- Thông tin người nhận và theo dõi đơn hàng -->
        <div class="order-info">
            <div class="customer-info">
                <h3 class="block-title">Thông tin người nhận</h3>
                <p><b class="fw-bolder">Người nhận:</b> {{ $order->customer_name }}</p>
                <p><b class="fw-bolder">Số điện thoại:</b> {{ $order->customer_phone }}</p>
                <p><b class="fw-bolder">Địa chỉ:</b>
                    {{ $order->ward }},
                    {{ $order->district }},
                    {{ $order->city }}
                </p>
                @php
                    $paymentText = [
                        'cho_thanh_toan' => 'Chờ thanh toán',
                        'da_thanh_toan' => 'Đã thanh toán',
                        'huy_thanh_toan' => 'Hủy thanh toán'
                    ];
                @endphp
                @php
                $paymentMethodText = [
                        'COD' => 'Thanh toán khi nhận hàng',
                        'THANH_TOAN_ONLINE' => 'Thanh toán qua VNPay'
                    ];
                @endphp
                <p><b class="fw-bolder">Trạng thái thanh toán:</b> {{ $paymentText[$order->payment_status] ?? $order->payment_status }}</p>
                <p><b class="fw-bolder">Hình thức thanh toán:</b> {{ $paymentMethodText[$order->payment_method] ?? $order->payment_method }}</p>
            </div>
        </div> <br>

        <!-- Danh sách sản phẩm -->
        <div class="order-items">
            <h3>Sản phẩm ({{ count($order->items) }})</h3>
            <table style="width: 100%; table-layout: fixed;" class="table table-hover">
                <tr>
                    <th class="text-start color fw-normal text-capitalize" style="width: 50%">Sản phẩm</th>
                    <th class="text-end color fw-normal text-capitalize" style="width: 25%">Đơn giá</th>
                    <th class="text-end color fw-normal text-capitalize" style="width: 25%">Tổng đơn giá</th>
                </tr>

                @foreach ($order->items as $item)
                <tr>
                    <td>
                        <div class="product-item d-flex" style="width: 100%;">
                            <div class="product-image ">
                                <img src="{{ asset('storage/' . $item->productVariant->image) }}" alt="{{ $item->product_name }}"
                                    width="100">
                            </div>

                            <div class="product-details mx-3" style="flex-grow: 1;">
                                <strong style="display: inline-block; max-width: 300px; word-wrap: break-word;">
                                    <a href="{{route('productDetail', $item->productVariant->product->slug)}}">{{ $item->product_name }}</a>
                                </strong> <br>
                                    @php
                                        $size = '';
                                        $color = '';
                                    @endphp

                                    @foreach ($item->productVariant->variantAttributes as $variantAttribute)
                                        @if ($variantAttribute->attribute->name == 'Size')
                                            @php $size = $variantAttribute->attributeValue->value; @endphp
                                        @elseif ($variantAttribute->attribute->name == 'Color')
                                            @php $color = $variantAttribute->attributeValue->value; @endphp
                                        @endif
                                    @endforeach
                                    Loại:
                                    @if ($size || $color)
                                        {{ $size }} @if ($size && $color)
                                            |
                                        @endif {{ $color }}
                                    @else
                                        <span style="color: red;">No size or color available.</span>
                                    @endif
                                <p>SL: {{ $item->quantity }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="text-end">
                        <div class="product-price">
                            <p>
                                @php
                                    $price_sale = $item->variant_price_sale;
                                    $price_regular = $item->variant_price_regular;
                                @endphp
                                @if ($price_regular == $price_sale )
                                    <span style="">{{ number_format(($price_regular * 1000), 0, '.', ',') }} ₫</span>
                                @else
                                    <span style="text-decoration: line-through;">{{ number_format(($price_regular * 1000), 0, '.', ',') }} ₫</span>
                                    <span style="color: red; font-weight: bold;">{{ number_format($price_sale * 1000, 0, '.', ',') }} ₫</span>
                                @endif
                            </p>
                        </div>
                    </td>
                    <td class="text-end">
                        @if ($price_regular == $price_sale )
                            <strong style="">{{ number_format(($price_regular * $item->quantity * 1000), 0, '.', ',') }} ₫</strong>
                        @else
                            <strong style="">{{ number_format(($price_sale * $item->quantity * 1000), 0, '.', ',') }} ₫</strong>
                        @endif

                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        @if ($order->status == '5')
                            @if ($commentDataArray[$item->productVariant->product->id]['status'] == "not_comment")
                                <div class="review-button-container" style="text-align: right;">
                                    <a href="#" class="btn btn-primary btn-sm rounded-2 w-30 fw-normal"
                                        data-bs-toggle="modal"
                                        data-bs-target="#reviewModal"
                                        data-product-id="{{ $item->productVariant->product->id }}"
                                        data-order-id="{{ $order->id }}"
                                        data-user-id="{{ Auth::id() }}"
                                        data-status="{{ $commentDataArray[$item->productVariant->product->id]['status'] }}">
                                        <i class="fas fa-star mb-1 me-1"></i>Cần đánh giá
                                    </a>
                                </div>
                            @elseif($commentDataArray[$item->productVariant->product->id]['status'] == "commented")
                            <div class="review-button-container" style="text-align: right;">
                                <a href="#" class="btn btn-primary btn-sm rounded-2 w-30 fw-normal"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal"
                                    data-product-id="{{ $item->productVariant->product->id }}"
                                    data-order-id="{{ $order->id }}"
                                    data-user-id="{{ Auth::id() }}"
                                    data-comment="{{ $commentDataArray[$item->productVariant->product->id]['comment']['id'] ?? '' }}"
                                    data-title="{{ $commentDataArray[$item->productVariant->product->id]['comment']['title'] ?? '' }}"
                                    data-content-comment="{{ $commentDataArray[$item->productVariant->product->id]['comment']['comment'] ?? '' }}"
                                    data-rating="{{ $commentDataArray[$item->productVariant->product->id]['comment']['rating'] ?? '' }}"
                                    data-status="{{ $commentDataArray[$item->productVariant->product->id]['status'] }}">
                                    <i class="fas fa-star mb-1 me-1"></i>Sửa đánh giá
                                </a>
                            </div>
                            @elseif($commentDataArray[$item->productVariant->product->id]['status'] == "updated")
                            <div class="review-button-container" style="text-align: right;">
                                <a href="#" class="btn btn-primary btn-sm rounded-2 w-30 fw-normal"
                                    data-bs-toggle="modal"
                                    data-bs-target="#getModal"
                                    data-product-id="{{ $item->productVariant->product->id }}"
                                    data-order-id="{{ $order->id }}"
                                    data-user-id="{{ Auth::id() }}"
                                    {{-- data-comment="39" --}}
                                    data-comment="{{$commentDataArray[$item->productVariant->product->id]['comment']['id'] ?? '' }}"
                                    data-status="{{ $commentDataArray[$item->productVariant->product->id]['status'] }}">
                                    <i class="fas fa-star mb-1 me-1"></i>Xem đánh giá
                                </a>
                            </div>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <!-- Thông tin thanh toán -->
        <div class="order-total">
            <table>
                <tr>
                    <td class="text-end" style="width: 75%" colspan="2">Tổng cộng:</td>
                    <td class="text-end">{{ number_format(($order->total_price + $order->discount) * 1000, 0, '.', ',') }}₫</td>
                </tr>
                <tr>
                    <td class="text-end" style="width: 75%" colspan="2">Giảm giá:</td>
                    <td class="text-end">
                        @if ($order->voucher)
                            {{ number_format($item->discount * 1000, 0, '.', ',') }}₫
                        @else
                            0₫
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-end" style="width: 75%" colspan="2"><strong>Tổng đã trả:</strong></td>
                    <td class="text-end">
                        <strong class="total-amount" style="font-weight: normal;">
                            @if ($order->payment_status == 'da_thanh_toan')
                                <strong>{{ number_format($order->total_price * 1000, 0, '.', ',') }} ₫</strong>
                            @else
                                0₫
                            @endif
                        </strong>
                    </td>
                </tr>
            </table>
             <a href="{{ route('my.order') }}" class="btn btn-sm mb-2 fw-normal" style="height: 30px"> Quay lại</a>
        </div>
    </div>
@endsection

@section('modal')
  <!-- Form để gửi đánh giá mới -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Đánh giá sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="newCommentForm">
                        <form id="commentForm" method="POST" action="">
                            @csrf
                            <input type="hidden" name="order_id" id="modal-order-id">
                            <input type="hidden" name="user_id" id="modal-user-id">
                            <input type="hidden" name="product_id" id="modal-product-id">

                            <div id="newCommentContainer">
                                <input type="text" name="title" class="form-control mb-2" placeholder="Tiêu đề">
                                <textarea name="comment" class="form-control" rows="5" cols="30" placeholder="Bình luận"></textarea>
                                <label class="spr-form-label">Đánh giá</label>
                                <div class="product-review pt-1">
                                    <div class="review-rating">
                                        <input type="radio" id="star1" name="rating" value="1">
                                        <label for="star1"><i class="icon anm anm-star-o"></i></label>
                                        <input type="radio" id="star2" name="rating" value="2">
                                        <label for="star2"><i class="icon anm anm-star-o"></i></label>
                                        <input type="radio" id="star3" name="rating" value="3">
                                        <label for="star3"><i class="icon anm anm-star-o"></i></label>
                                        <input type="radio" id="star4" name="rating" value="4">
                                        <label for="star4"><i class="icon anm anm-star-o"></i></label>
                                        <input type="radio" id="star5" name="rating" value="5">
                                        <label for="star5"><i class="icon anm anm-star-o"></i></label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Gửi đánh giá</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form gửi cập nhật --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Đánh giá sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="editCommentForm">
                        <form id="editForm" method="POST" action="">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="product_id" id="edit-product-id">
                            <input type="hidden" name="order_id" id="edit-order-id">
                            <input type="hidden" name="comment_id" id="edit-comment-id">
                            <input type="hidden" name="user_id" id="edit-user-id">

                            <input type="text" name="title" class="form-control mb-2" id="edit-title" placeholder="Tiêu đề">
                            <textarea name="comment" class="form-control" rows="5" id="edit-comment" placeholder="Bình luận"></textarea>

                            <label class="spr-form-label">Đánh giá</label>
                            <div class="review-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}">
                                    <label for="star{{ $i }}">
                                        <i class="icon anm anm-star-o"></i>
                                    </label>
                                @endfor
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Cập nhật đánh giá</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- get dữ liệu --}}
    <div class="modal fade" id="getModal" tabindex="-1" aria-labelledby="getModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="getModalLabel">Đánh giá sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="review-inner">
                        <div class="spr-review d-flex w-100">
                            <div class="spr-review-profile" style="width: 50px">
                                <img id="user-image" src="" alt="Avatar" />
                            </div>
                            <div class="spr-review-content flex-grow-1">
                                <div class="d-flex justify-content-between flex-column mb-2">
                                    <div class="title-review d-flex align-items-center justify-content-between">
                                        <h5 class="spr-review-header-title text-transform-none mb-0 d-inline"></h5>
                                        <div>
                                            <span id="reviewLink" class="product-review spr-starratings m-0">

                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <p class="spr-review-body text-truncate" style="max-width: 350px; word-wrap: break-word;"></p>
                                <p class="updated-at text-muted" style="font-size: 0.8em;"></p> <!-- Thêm dòng này để hiển thị thời gian cập nhật -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@vite(['resources/js/app.js'])
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Hủy đơn hàng --}}
    <script>
        function confirmCancelOrder(orderId) {
            if (confirm("Bạn chắc chắn muốn hủy đơn hàng này?")) {
                document.getElementById('cancelOrderForm-' + orderId).submit();
            }
        }
    </script>

    {{-- binh luan --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Modal cho thêm đánh giá
            var reviewModal = document.getElementById('reviewModal');
            reviewModal.addEventListener('show.bs.modal', function (event) {
                var triggerElement = event.relatedTarget; // Thẻ <a> kích hoạt modal

                var productId = triggerElement.getAttribute('data-product-id');
                var orderId = triggerElement.getAttribute('data-order-id');
                var userId = triggerElement.getAttribute('data-user-id');
                var status = triggerElement.getAttribute('data-status');

                if (status === "not_comment") {
                    document.getElementById('modal-product-id').value = productId;
                    document.getElementById('modal-order-id').value = orderId;
                    document.getElementById('modal-user-id').value = userId;
                    document.getElementById('commentForm').action = "/comments";
                }
            });

            // Modal cho chỉnh sửa đánh giá
            var editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function (event) {
                var triggerElement = event.relatedTarget;

                var productId = triggerElement.getAttribute('data-product-id');
                var orderId = triggerElement.getAttribute('data-order-id');
                var commentId = triggerElement.getAttribute('data-comment');
                var userId = triggerElement.getAttribute('data-user-id');

                var titleData = triggerElement.getAttribute('data-title');
                var commentData = triggerElement.getAttribute('data-content-comment');
                var ratingData = triggerElement.getAttribute('data-rating');

                // console.log(commentId);

                document.getElementById('edit-product-id').value = productId;
                document.getElementById('edit-order-id').value = orderId;
                document.getElementById('edit-comment-id').value = commentId;
                document.getElementById('edit-user-id').value = userId;

                document.getElementById('edit-title').value = titleData;
                document.getElementById('edit-comment').value = commentData;

                // Cập nhật giá trị rating
                var ratingStars = document.getElementsByName('rating');

                ratingStars.forEach(star => {
                    var starIcon = star.nextElementSibling.querySelector('i'); // Lấy icon sao kế bên input
                    if (parseInt(star.value) <= parseInt(ratingData)) {
                        // Nếu giá trị sao nhỏ hơn hoặc bằng ratingData thì chuyển thành sao vàng
                        starIcon.classList.remove('anm-star-o');
                        starIcon.classList.add('anm-star');
                    } else {
                        // Nếu không thì giữ sao trắng
                        starIcon.classList.remove('anm-star');
                        starIcon.classList.add('anm-star-o');
                    }
                });
                document.getElementById('editForm').action = "/comments/" + commentId;
            });

            // modal cho xem đánh giá
            var getModal = document.getElementById('getModal');
            getModal.addEventListener('show.bs.modal', function (event) {
                var triggerElement = event.relatedTarget;
                var commentId = triggerElement.getAttribute('data-comment');

                // Lấy dữ liệu từ API
                fetch(`/comments/show/${commentId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Comment not found');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.status === 'success') {
                            // Điền thông tin vào modal nếu có comment
                            document.querySelector('#getModal .spr-review-header-title').textContent = data.user_name;
                            document.querySelector('#getModal .spr-review-body').textContent = data.comment;

                            const reviewLinkElement = document.getElementById('reviewLink');
                            if (reviewLinkElement) {
                            // Hàm renderStars để hiển thị sao
                            const renderStars = (rating) => {
                                let stars = '';
                                for (let i = 0; i < 5; i++) {
                                    stars += `<i class="icon anm anm-star ${i < rating ? '' : 'anm-star-o'}"></i>`;
                                }
                                return stars;
                            };

                            // Hiển thị sao từ rating
                            if (data.rating === null || data.rating == 0) {
                                reviewLinkElement.innerHTML = 'Không có đánh giá';
                            } else {
                                // Hiển thị sao từ rating
                                reviewLinkElement.innerHTML = renderStars(data.rating);
                            }
                            console.log(reviewLinkElement.innerHTML); // Kiểm tra nội dung đã được cập nhật
                        }

                            // Cập nhật avatar và thời gian cập nhật
                            document.getElementById('user-image').src = data.avatar; // Cập nhật avatar
                            document.querySelector('#getModal .updated-at').textContent = `${data.updated_at}`; // Cập nhật thời gian
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.querySelector('#getModal .spr-review-header-title').textContent = 'Không có đánh giá';
                        document.querySelector('#getModal .spr-review-body').textContent = 'Hiện tại chưa có đánh giá nào cho sản phẩm này.';
                        const reviewLinkElement = document.querySelector('#getModal .product-review span.reviewLink');
                        if (reviewLinkElement) {
                            reviewLinkElement.innerHTML = renderStars(0);
                        }
                        document.getElementById('user-image').src = ''; // Reset avatar
                    });
            });
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

    {{-- popup --}}
    <script>
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        @endif

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endsection
