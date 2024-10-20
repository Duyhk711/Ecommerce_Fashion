@extends('layouts.backend')

@section('css')
    <!-- Page JS Plugins CSS -->
    <!-- Link jQuery từ CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <style>
        .copy-btn {
            background: none;
            border: none;
            cursor: pointer;
            width: 10px;
            height: 10px;
            margin-left: 0px;
        }

        .copy-btn i {
            font-size: 16px;
        }

        .copy-btn:hover i {
            color: #0056b3;
        }

        .content-row {
            transition: height 0.3s ease;
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        /* Đảm bảo rằng bảng không bị thay đổi kích thước khi mở rộng */
        .table td,
        .table th {
            vertical-align: middle;
            white-space: nowrap;
            /* Giữ cho các nội dung không bị dãn ra theo chiều ngang */
        }


        /* Giữ chiều rộng của các cột, không cho phép co dãn */
        .table-fixed {
            table-layout: fixed;
            width: 100%;
        }

        .table-fixed td,
        .table-fixed th {
            word-wrap: break-word;
            /* Đảm bảo từ ngắt nếu quá dài */
            overflow: hidden;
            /* Giữ cho nội dung không làm dãn hàng */
        }

        .is-invalid {
            border: 1px solid red;

        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách Sản Phẩm</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#" style="color: inherit;">Sản phẩm</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách Sản Phẩm</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <div class="content ">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Danh sách Sản Phẩm</h3>
                <div class="block-options">
                    <div class="block-options-item">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-alt-secondary"
                            data-bs-toggle="tooltip" title="Add">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="block-content align-middle">
                <form method="GET" action="{{ route('admin.products.index') }}">
                    <div class="row mb-4 ">
                        <div class="col-md-2"></div>
                        <!-- Tìm kiếm theo tên  -->
                        <div class="col-md-6">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Tìm kiếm sản phẩm theo tên, sku">
                        </div>
                        
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-alt"><i class="fa fa-search"></i></button>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    
                </form>
            </div>
            <div class="block-content block-content-full">
                <!-- Table with data -->
                <table id="example" class="table  align-middle js-dataTable-full">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Đã cập nhật</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td class="fs-sm">
                                    <div class="d-flex align-items-center">
                                       
                                            <img src="{{Storage::url($product->img_thumbnail)  }}" alt="Ảnh sản phẩm" style="width: 60px;"
                                                class="">
                                      
                                        <div>
                                            <div class="pt-1 pd-2" style="font-weight: 500;">{{ $product->name }}</div>
                                            <div class="text-muted" style="font-size: 13px;">
                                                Phân loại: <span>{{ $product->catalogue->name }}</span>
                                            </div>
                                            <div class="text-muted" style="font-size: 13px;">
                                                Sku: <span>{{ $product->sku }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="fs-sm">{{ number_format($product->price_regular) }}₫</td>
                                <td class="fs-sm">{{ $product->total_stock }}</td>
                                <td class="fs-sm">{{ $product->updated_at }}</td>
                                <td class="fs-sm">
                                    @if ($product->is_active)
                                        <span class="text-success">Đang hoạt động</span>
                                    @else
                                        <span class="text-danger">Không hoạt động</span>
                                    @endif
                                </td>
                                <td class="text-center fs-sm">
                                    <div class="d-flex justify-content-center align-items-center">
                                        {{-- <a href="{{ route('admin.products.show', $product) }}"
                                            class="btn btn-sm btn-alt-secondary mx-1" data-bs-toggle="tooltip"
                                            title="Biến thể">
                                            <i class="fa fa-fw fa-tags" title="Biến thể"></i>
                                        </a> --}}
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                            class="btn btn-sm btn-alt-secondary mx-1 " data-bs-toggle="tooltip"
                                            title="Sửa">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                            class="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-alt-secondary mx-1"
                                                data-bs-toggle="tooltip" title="Xóa">
                                                <i class="fa fa-fw fa-times text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <!-- Hàng thứ hai chứa nội dung mở rộng -->
                            <tr>
                                <td colspan="6" class="content-row">
                                    <div class="row">
                                        <div class="col-3 text-muted fs-sm">Tổng mặt hàng: {{ $product->variant_count }}
                                        </div>
                                        <div class="col-6"></div>
                                        <div class="col-3 text-end">
                                            <a href="#" class="btn btn-sm btn-alt-secondary mx-1 toggle-content"
                                                data-target="#content-{{ $product->id }}" data-state="collapsed">
                                                <span class="toggle-text">Mở rộng</span>
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                        </div>
                                        <div id="content-{{ $product->id }}" class="content2 mt-1 mb-2"
                                            style="display: none;">
                                            <div class="row">
                                                <div class="col-10 text-end mb-2">
                                                    <!-- Nút chỉnh sửa hàng loạt -->
                                                    <button class="btn btn-sm btn-alt-secondary toggle-batch-edit">Chỉnh sửa
                                                        hàng loạt <i class="fa fa-angle-down"></i></button>
                                                </div>
                                                <div class="col-2 text-end">
                                                    <!-- Nút lưu và hủy, ban đầu ẩn đi -->
                                                    <button class="btn btn-sm btn-alt save-all-btn d-none">Lưu
                                                        </button>
                                                    <button class="btn btn-sm btn-alt cancel-btn d-none">Hủy</button>
                                                </div>
                                            </div>
                                            <div class="batch-edit-form d-none mt-3 mb-2">
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-3"></div>
                                                    <div class="col-2">
                                                        <div class="mb-2">
                                                            {{-- <label for="batch-price">Đơn giá</label> --}}
                                                            <input type="number" id="batch-price"
                                                                class="form-control fs-sm batch-input"
                                                                placeholder="Nhập vào đơn giá">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="mb-2">
                                                            {{-- <label for="batch-discount">Giá khuyến mãi</label> --}}
                                                            <input type="number" id="batch-price_sale"
                                                                class="form-control fs-sm batch-input"
                                                                placeholder="Giá khuyến mãi">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="mb-2">
                                                            {{-- <label for="batch-quantity">Số lượng</label> --}}
                                                            <input type="number" id="batch-stock"
                                                                class="form-control fs-sm batch-input"
                                                                placeholder="Nhập vào số lượng">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="mb-2">
                                                            <button class="btn btn-sm btn-alt apply-all">Áp dụng cho tất
                                                                cả</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tạo form để gửi tất cả biến thể -->
                                            <form class="variant-form-all" id="variant-form-{{ $product->id }}">
                                                @foreach ($product->variants as $variant)
                                                    @php
                                                        $color = null;
                                                        $size = null;
                                                        foreach ($variant->variantAttributes as $attribute) {
                                                            if ($attribute->attribute->name === 'Color') {
                                                                $color = $attribute->attributeValue->value;
                                                            }
                                                            if ($attribute->attribute->name === 'Size') {
                                                                $size = $attribute->attributeValue->value;
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="row d-flex justify-content-center variant-row"
                                                        data-variant-id="{{ $variant->id }}">
                                                        <div class="col-3 align-content-center">
                                                            <div class="mb-2">
                                                                <label for="quantity" class="text-muted">Biến thể:</label>
                                                                <span>{{ $color }}-{{ $size }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-2">
                                                            <div class="mb-2">
                                                                <label for="price_regular" class="text-muted fs-sm">Đơn
                                                                    giá</label>
                                                                <input type="number"
                                                                    name="variants[{{ $variant->id }}][price_regular]"
                                                                    class="form-control fs-sm batch-input price-regular"
                                                                    value="{{ $variant->price_regular }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-2">
                                                            <div class="mb-2">
                                                                <label for="price_sale" class="text-muted fs-sm">Giá
                                                                    khuyến mãi</label>
                                                                <input type="number"
                                                                    name="variants[{{ $variant->id }}][price_sale]"
                                                                    class="form-control fs-sm batch-input price-sale"
                                                                    value="{{ $variant->price_sale }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-2">
                                                            <div class="mb-2">
                                                                <label for="stock" class="text-muted fs-sm">Số
                                                                    lượng</label>
                                                                <input type="number"
                                                                    name="variants[{{ $variant->id }}][stock]"
                                                                    class="form-control fs-sm batch-input stock"
                                                                    value="{{ $variant->stock }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="">{{$products->links()}}</div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('admin/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('admin/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <!-- Nhúng jQuery từ CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Xử lý sự kiện khi người dùng nhấn vào các ô input
            $(document).on('focus', '.batch-input', function() {
                var $row = $(this).closest('.content2');
                $row.find('.save-all-btn, .cancel-btn').removeClass(
                'd-none'); // Hiển thị nút "Lưu" và "Hủy"
            });


            // Xử lý logic khi người dùng nhấn nút Lưu
            $(document).on('click', '.save-all-btn', function() {
                var $row = $(this).closest('.content2');
                // alert('Đã lưu các thay đổi!');
                $row.find('.save-all-btn, .cancel-btn').addClass('d-none');
            });

            // Xử lý logic khi người dùng nhấn nút Hủy
            $(document).on('click', '.cancel-btn', function() {
                var $row = $(this).closest('.content2');
                $row.find('.save-all-btn, .cancel-btn').addClass('d-none');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteBtns = document.querySelectorAll('.form-delete');

            for (const btn of deleteBtns) {
                btn.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: "Xác nhận xóa?",
                        text: "Nếu xóa bạn sẽ không thể khôi phục!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Đồng ý',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            }
        });
    </script>

    {{-- <script>
    // Hàm sao chép nội dung vào clipboard
    function copyToClipboard(element) {
        var temp = document.createElement("textarea");
        var content = document.querySelector(element).textContent.trim();
        temp.value = content;
        document.body.appendChild(temp);
        temp.select();
        document.execCommand("copy");
        document.body.removeChild(temp);
        alert("Đã sao chép: " + content);
    }
  </script> --}}

    <script>
        $(document).ready(function() {
            // Xử lý nút mở rộng/thu gọn
            $(document).on('click', '.toggle-content', function(e) {
                e.preventDefault();
                var target = $(this).data('target');
                var $icon = $(this).find('i');
                var $text = $(this).find('.toggle-text');
                var state = $(this).data('state');

                if (state === 'collapsed') {
                    $(target).slideDown(400); // Mở mượt mà
                    $(this).data('state', 'expanded');
                    $icon.removeClass('fa-angle-down').addClass('fa-angle-up');
                    $text.text('Thu gọn');
                } else {
                    $(target).slideUp(400); // Đóng mượt mà
                    $(this).data('state', 'collapsed');
                    $icon.removeClass('fa-angle-up').addClass('fa-angle-down');
                    $text.text('Mở rộng');
                }
            });

            // Hiển thị form chỉnh sửa hàng loạt
            $(document).on('click', '.toggle-batch-edit', function() {
                var $form = $(this).closest('.content').find('.batch-edit-form');
                $form.toggleClass('d-none'); // Hiển thị hoặc ẩn form nhập liệu
            });

            // Lưu thay đổi khi người dùng nhấn nút Lưu
            $(document).on('click', '.save-batch-edit', function() {
                alert('Đã lưu các thay đổi!');
                $(this).closest('.batch-edit-form').addClass('d-none'); // Ẩn form sau khi lưu
            });
        });
    </script>
    <script>
        const csrfToken = "{{ csrf_token() }}";
        $(document).ready(function() {
            // Xử lý sự kiện khi nhấn nút "Lưu tất cả"
            $(document).on('click', '.save-all-btn', function() {
                var $form = $(this).closest('.content2').find('.variant-form-all');
                var formData = $form.serialize(); // Thu thập dữ liệu từ tất cả các input trong form

                $.ajax({
                    url: '{{ route('admin.products.variant.update') }}',
                    method: 'POST',
                    data: formData,
                    headers: {
                        "X-CSRF-TOKEN": csrfToken, // CSRF Token cho Laravel
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            $form.closest('.content2').find('.save-all-btn, .cancel-btn')
                                .addClass('d-none');
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra trong quá trình cập nhật.');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Khi nhấn nút "Áp dụng cho tất cả"
            $('.apply-all').on('click', function() {
                // Lấy giá trị từ các trường nhập liệu chung
                var batchPrice = $('#batch-price').val();
                var batchPriceSale = $('#batch-price_sale').val();
                var batchStock = $('#batch-stock').val();

                var isValid = true; // Biến kiểm tra tính hợp lệ

                // Reset lại thông báo lỗi
                $('.batch-input').removeClass('is-invalid');

                // Kiểm tra giá trị của "Đơn giá"
                if (batchPrice !== '' && isNaN(batchPrice)) {
                    $('#batch-price').addClass('is-invalid'); // Thêm viền đỏ nếu không phải số
                    isValid = false;
                }

                // Kiểm tra giá trị của "Giá khuyến mãi"
                if (batchPriceSale !== '' && isNaN(batchPriceSale)) {
                    $('#batch-price_sale').addClass('is-invalid'); // Thêm viền đỏ nếu không phải số
                    isValid = false;
                }

                // Kiểm tra giá trị "Số lượng"
                if (batchStock !== '' && isNaN(batchStock)) {
                    $('#batch-stock').addClass('is-invalid'); // Thêm viền đỏ nếu không phải số
                    isValid = false;
                }

                // Kiểm tra nếu giá khuyến mãi lớn hơn giá gốc
                if (batchPriceSale !== '' && batchPrice !== '' && parseFloat(batchPriceSale) > parseFloat(
                        batchPrice)) {
                    $('#batch-price_sale').addClass(
                    'is-invalid'); // Thêm viền đỏ nếu giá khuyến mãi lớn hơn giá gốc
                    isValid = false;
                }

                // Nếu tất cả các trường hợp hợp lệ, cho phép áp dụng
                if (isValid) {
                    // Áp dụng giá trị cho tất cả các biến thể
                    $('.variant-row').each(function() {
                        if (batchPrice !== '') {
                            $(this).find('.price-regular').val(batchPrice);
                        }
                        if (batchPriceSale !== '') {
                            $(this).find('.price-sale').val(batchPriceSale);
                        }
                        if (batchStock !== '') {
                            $(this).find('.stock').val(batchStock);
                        }
                    });
                } else {
                    alert('Vui lòng kiểm tra lại các giá trị đã nhập.');
                }
            });
        });
    </script>
@endsection
