@extends('layouts.backend')
@section('title')
    Danh sách sản phẩm
@endsection
@section('css')
    <!-- Link jQuery từ CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" />

    <link rel="stylesheet" href="{{ asset('admin/css/products/product-list.css') }}">
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
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link active" id="products-tab" data-bs-toggle="tab" href="#products" role="tab">Danh sách</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="deleted-products-tab" data-bs-toggle="tab" href="#deleted-products" role="tab">Đã xóa</a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Tab sản phẩm thường -->
                <div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="products-tab">
                    <div class="block-content align-middle">
                        <form method="GET" id="filter-form" action="{{ route('admin.products.index') }}">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <!-- Tìm kiếm theo tên hoặc SKU -->
                                <div>
                                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                           placeholder="Tìm kiếm sản phẩm theo tên, sku">
                                </div>

                                <!-- Lọc theo giá (dropdown) -->
                                <div class="dropdown ms-3">
                                    <button class="btn btn-sm btn-alt dropdown-toggle p-2" style="font-weight: 400;border:1.5px solid #d1d7dd" type="button"
                                            id="priceFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Lọc theo giá
                                    </button>

                                    <div class="dropdown-menu p-3 " aria-labelledby="priceFilterDropdown">
                                        <div class="form-group">
                                            {{-- <label for="min_price">Giá từ</label> --}}
                                            <input type="number" name="min_price" style="font-size: 14px;" id="min_price" value="{{ request('min_price') }}" class="form-control" placeholder="Giá tối thiểu">
                                        </div>
                                        <div class="form-group mt-2">
                                            {{-- <label for="max_price">Giá đến</label> --}}
                                            <input type="number" name="max_price" style="font-size: 14px;" id="max_price" value="{{ request('max_price') }}" class="form-control" placeholder="Giá tối đa">
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-alt-secondary mt-3">Áp dụng</button>
                                    </div>
                                </div>

                                <!-- Lọc theo danh mục (category_id) -->
                                <div class="ms-3">
                                    <select name="catalogue_id" id="catalogue-select" class="form-select">
                                        <option value="">Tất cả danh mục</option>
                                        @foreach ($catalogues as $catalogue)
                                            <option value="{{ $catalogue->id }}" {{ request('catalogue_id') == $catalogue->id ? 'selected' : '' }}>
                                                {{ $catalogue->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Lọc theo trạng thái số lượng (stock_status) -->
                                <div class="ms-3">
                                    <select name="stock_status" class="form-select" id="stock-status-select">
                                        <option value="">Tất cả trạng thái</option>
                                        <option value="low" {{ request('stock_status') == 'low' ? 'selected' : '' }}>Sắp hết hàng</option>
                                        <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>Còn hàng</option>
                                        <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Hết hàng</option>
                                    </select>
                                </div>

                                <!-- Nút đặt lại -->
                                <div class="ms-3">
                                    <button type="button" class="btn btn-sm btn-alt-secondary p-2 px-4" id="reset-button">Đặt lại</button>
                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="block-content block-content-full">
                        <!-- Table with data -->
                        <table id="productTable" class="table   align-middle js-dataTable-full">
                            <thead>
                                <tr>
                                    <th class="text-center">Tên sản phẩm</th>
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Đã cập nhật</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="fs-sm">
                                            <div class="d-flex align-items-center">
                                                <!-- Hình ảnh -->
                                                <div class="image-container" style="width: 60px; height: height: 100%;; position: relative;">
                                                    <img src="{{ Storage::url($product->img_thumbnail) }}" alt="Ảnh sản phẩm" class="img-thumbnail">
                                                    <div class="overlay">
                                                        <i class="fa fa-eye eye-icon"></i>
                                                    </div>
                                                </div>

                                                <!-- Popup để hiển thị ảnh lớn -->
                                                <div class="popup" id="imagePopup">
                                                    <span class="close">&times;</span>
                                                    <img class="popup-content" id="popupImage" alt="Ảnh lớn">
                                                </div>

                                                <!-- Thông tin sản phẩm, căn cách đều với hình ảnh -->
                                                <div class="ms-3" style="flex: 1;">
                                                    <!-- Thêm flex: 1 để chiếm hết không gian còn lại -->
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
                                        <td class=" fs-sm">{{ number_format($product->price_regular, 3, '.', 0) }}₫</td>
                                        <td class="text-center fs-sm total-stock" data-id="{{ $product->id }}">
                                            @if ($product->total_stock > 5)
                                                <span class="" >{{ $product->total_stock }}</span>
                                            @elseif ($product->total_stock > 0 && $product->total_stock <= 5)
                                                <span class="text-warning" data-bs-toggle="tooltip"
                                                title="Sắp hết hàng"> {{ $product->total_stock }}</span>
                                            @else
                                                <span class=" text-danger " data-bs-toggle="tooltip"
                                                title="Hết hàng">{{ $product->total_stock }}</span>
                                            @endif
                                        </td>

                                        <td class="fs-sm">{{ $product->updated_at->format('H:i d-m-Y') }}</td>

                                        <td class="fs-sm text-center">
                                            @if ($product->is_active)
                                                <span class="text-success">
                                                    <i class="fa fa-check-circle text-success" data-bs-toggle="tooltip" title="Hoạt động"></i>
                                                </span>
                                            @else
                                                <span class="text-danger">
                                                    <i class="fa fa-ban text-danger"data-bs-toggle="tooltip" title="Không hoạt động"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center fs-sm">
                                            <div class="d-flex justify-content-center align-items-center">
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
                                    <tr class="product-row">
                                        <td colspan="6" class="content-row">
                                            <div class="row mb-2">
                                                <div class="col-3 text-muted fs-sm">Tổng mặt hàng: {{ $product->variant_count }}
                                                </div>
                                                <div class="col-6"></div>
                                                <div class="col-3 text-end">
                                                    <a href="#" class="btn btn-sm btn-alt mx-1 toggle-content text-muted"
                                                        style="font-weight: 400;" data-target="#content-{{ $product->id }}"
                                                        data-state="collapsed">
                                                        <span class="toggle-text">Mở rộng</span>
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                </div>
                                                <div id="content-{{ $product->id }}" class="content2 mt-1 mb-2"
                                                    style="display: none;">
                                                    <div class="row">
                                                        <div class="col-10 text-end mb-2">
                                                            <!-- Nút chỉnh sửa hàng loạt -->
                                                            <button class="btn btn-sm btn-alt-secondary toggle-batch-edit">Chỉnh
                                                                sửa
                                                                hàng loạt <i class="fa fa-angle-down"></i></button>
                                                        </div>
                                                        <div class="col-2 text-end">
                                                            <!-- Nút lưu và hủy, ban đầu ẩn đi -->
                                                            <button class="btn btn-sm btn-alt save-all-btn d-none">Lưu
                                                            </button>
                                                            <button class="btn btn-sm btn-alt cancel-btn d-none">Hủy</button>
                                                        </div>
                                                    </div>
                                                    <div class="batch-edit-form d-none mt-3 mb-2" data-product-id="{{ $product->id }}">
                                                        <div class="row d-flex justify-content-center">
                                                            <div class="col-3"></div>
                                                            <div class="col-2">
                                                                <div class="mb-2">
                                                                    <input type="number" id="batch-price-{{ $product->id }}" class="form-control fs-sm batch-input" placeholder="Nhập vào đơn giá">
                                                                    <span class="text-danger error-message" id="error-price-{{ $product->id }}"></span><!-- Chỗ để hiển thị lỗi -->
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="mb-2">
                                                                    <input type="number" id="batch-price_sale-{{ $product->id }}" class="form-control fs-sm batch-input" placeholder="Giá khuyến mãi">
                                                                    <span class="text-danger error-message" id="error-price_sale-{{ $product->id }}"></span><!-- Chỗ để hiển thị lỗi -->
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="mb-2">
                                                                    <input type="number" id="batch-stock-{{ $product->id }}" class="form-control fs-sm batch-input" placeholder="Nhập vào số lượng">
                                                                    <span class="text-danger error-message" id="error-stock-{{ $product->id }}"></span> <!-- Chỗ để hiển thị lỗi -->
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="mb-2">
                                                                    <button class="btn btn-sm btn-alt apply-all" data-product-id="{{ $product->id }}" disabled>Áp dụng cho tất cả</button>
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
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
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
                                        {{-- <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">{{ $products->links() }}</div>
                    </div>
                </div>

                {{-- SP DA XOA --}}
                <div class="tab-pane fade" id="deleted-products" role="tabpanel" aria-labelledby="deleted-products-tab">

                    <div class="block-content block-content-full">
                        <!-- Table with data -->
                        <table id="productTable" class="table  table-striped align-middle js-dataTable-full">
                            <thead>
                                <tr>
                                    <th class="text-center">Tên sản phẩm</th>
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Ngày xóa</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deletedProducts as $product)
                                    <tr>
                                        <td class="fs-sm">
                                            <div class="d-flex align-items-center">
                                                <!-- Hình ảnh -->
                                                <div style="width: 60px; height: 100%;">
                                                    <img src="{{ Storage::url($product->img_thumbnail) }}" alt="Ảnh sản phẩm"
                                                        style="width: 100%; height: 100%; object-fit: cover;" class="img-fluid">
                                                </div>

                                                <!-- Thông tin sản phẩm, căn cách đều với hình ảnh -->
                                                <div class="ms-3" style="flex: 1;">
                                                    <!-- Thêm flex: 1 để chiếm hết không gian còn lại -->
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
                                        <td class=" fs-sm">{{ number_format($product->price_regular) }}₫</td>
                                        <td class="text-center fs-sm total-stock" data-id="{{ $product->id }}">
                                            @if ($product->total_stock > 5)
                                                <span class="" >{{ $product->total_stock }}</span>
                                            @elseif ($product->total_stock > 0 && $product->total_stock <= 5)
                                                <span class="text-warning" data-bs-toggle="tooltip"
                                                title="Sắp hết hàng"> {{ $product->total_stock }}</span>
                                            @else
                                                <span class=" text-danger" data-bs-toggle="tooltip"
                                                title="Hết hàng">{{ $product->total_stock }}</span>
                                            @endif 0
                                        </td>

                                        <td class="fs-sm">{{ $product->deleted_at->format('H:i d-m-Y') }}</td>

                                        <td class="fs-sm text-center">
                                            @if ($product->is_active)
                                                <span class="text-success">
                                                    <i class="fa fa-check-circle text-success" data-bs-toggle="tooltip" title="Hoạt động"></i>
                                                </span>
                                            @else
                                                <span class="text-danger">
                                                    <i class="fa fa-ban text-danger" data-bs-toggle="tooltip" title="Không hoạt động"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center fs-sm">
                                            <div class="d-flex justify-content-center align-items-center">
                                                {{-- <a href="{{ route('admin.products.edit', $product) }}"
                                                    class="btn btn-sm btn-alt-secondary mx-1 " data-bs-toggle="tooltip"
                                                    title="Sửa">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a> --}}
                                                <form action="{{ route('admin.products.restore', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Khôi phục sản phẩm">
                                                        <i class="fa fa-undo"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Hàng thứ hai chứa nội dung mở rộng -->
                                    <tr class="product-row">
                                        <td colspan="6" class="content-row">
                                            <div class="row mb-2">
                                                <div class="col-3 text-muted fs-sm">Tổng mặt hàng: {{ $product->variant_count }}
                                                </div>
                                                <div class="col-6"></div>
                                                <div class="col-3 text-end">
                                                    <a href="#" class="btn btn-sm btn-alt mx-1 toggle-content text-muted"
                                                        style="font-weight: 400;" data-target="#content-{{ $product->id }}"
                                                        data-state="collapsed">
                                                        <span class="toggle-text">Mở rộng</span>
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                </div>
                                                <div id="content-{{ $product->id }}" class="content2 mt-1 mb-2"
                                                    style="display: none;">
                                                    <div class="row">
                                                        <div class="col-10 text-end mb-2">
                                                            <!-- Nút chỉnh sửa hàng loạt -->
                                                            <button class="btn btn-sm btn-alt-secondary toggle-batch-edit">Chỉnh
                                                                sửa
                                                                hàng loạt <i class="fa fa-angle-down"></i></button>
                                                        </div>
                                                        <div class="col-2 text-end">
                                                            <!-- Nút lưu và hủy, ban đầu ẩn đi -->
                                                            <button class="btn btn-sm btn-alt save-all-btn d-none">Lưu
                                                            </button>
                                                            <button class="btn btn-sm btn-alt cancel-btn d-none">Hủy</button>
                                                        </div>
                                                    </div>
                                                    <div class="batch-edit-form d-none mt-3 mb-2" data-product-id="{{ $product->id }}">
                                                        <div class="row d-flex justify-content-center">
                                                            <div class="col-3"></div>
                                                            <div class="col-2">
                                                                <div class="mb-2">
                                                                    <input type="number" id="batch-price-{{ $product->id }}" class="form-control fs-sm batch-input" placeholder="Nhập vào đơn giá">
                                                                    <span class="text-danger error-message" id="error-price-{{ $product->id }}"></span><!-- Chỗ để hiển thị lỗi -->
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="mb-2">
                                                                    <input type="number" id="batch-price_sale-{{ $product->id }}" class="form-control fs-sm batch-input" placeholder="Giá khuyến mãi">
                                                                    <span class="text-danger error-message" id="error-price_sale-{{ $product->id }}"></span><!-- Chỗ để hiển thị lỗi -->
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="mb-2">
                                                                    <input type="number" id="batch-stock-{{ $product->id }}" class="form-control fs-sm batch-input" placeholder="Nhập vào số lượng">
                                                                    <span class="text-danger error-message" id="error-stock-{{ $product->id }}"></span> <!-- Chỗ để hiển thị lỗi -->
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="mb-2">
                                                                    <button class="btn btn-sm btn-alt apply-all" data-product-id="{{ $product->id }}" disabled>Áp dụng cho tất cả</button>
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
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
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
                                        {{-- <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">{{ $products->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Nhúng jQuery từ CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
 {{-- <script src="{{ asset('admin/js/dashmix.app.min.js') }}"></script>  --}}
    <script>
        $(document).ready(function() {
            $('#productTable').DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {
            // Khởi tạo Select2 cho danh mục
            $('#catalogue-select').select2({
                placeholder: "Chọn danh mục",
                allowClear: true
            });

            // Khi chọn danh mục mới với Select2
            $('#catalogue-select').on('select2:select', function() {
                // Gửi form ngay khi người dùng chọn danh mục
                document.getElementById('filter-form').submit();
            });
        });


    </script>

    {{-- js lọc --}}
    <script>
        document.getElementById('stock-status-select').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });
    </script>

    <script>
        // Khi nhập từ khóa vào ô tìm kiếm
        let debounceTimeout;
        document.querySelector('input[name="search"]').addEventListener('keyup', function() {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(function() {
                document.getElementById('filter-form').submit();
            }, 1000);
        });
    </script>

    {{-- đặt lại --}}
    <script>
        document.getElementById('reset-button').addEventListener('click', function() {
            window.location.href = "{{ route('admin.products.index') }}";
        });
    </script>

    <script>
        $(document).ready(function() {
            // Xử lý sự kiện khi người dùng nhấn vào các ô input
            $(document).on('focus', '.batch-input', function() {
                var $row = $(this).closest('.content2');
                $row.find('.save-all-btn, .cancel-btn').removeClass(
                    'd-none');
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

    {{-- POPUP --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteBtns = document.querySelectorAll('.form-delete');

            for (const btn of deleteBtns) {
                btn.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: "Xác nhận xóa?",
                        text: "",
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

    {{-- SAVE VARIANT --}}
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
                var $parent = $(this).closest('.content2'); // Chọn phần tử cha gần nhất của sản phẩm
                var $form = $parent.find('.batch-edit-form');
                $form.toggleClass('d-none'); // Hiển thị hoặc ẩn form nhập liệu
            });

            // Lưu thay đổi khi người dùng nhấn nút Lưu
            $(document).on('click', '.save-batch-edit', function() {
                alert('Đã lưu các thay đổi!');
                $(this).closest('.batch-edit-form').addClass('d-none'); // Ẩn form sau khi lưu
            });
        });
    </script>

    {{-- UPDATE VARIANT --}}
    <script>
        const csrfToken = "{{ csrf_token() }}";
        $(document).ready(function() {
            // Xử lý sự kiện khi nhấn nút "Lưu tất cả"
            $(document).on('click', '.save-all-btn', function() {
                var $form = $(this).closest('.content2').find('.variant-form-all');
                var formData = $form.serialize(); // Thu thập dữ liệu từ tất cả các input trong form
                var productId = $form.find('input[name="product_id"]').val();
                console.log(productId);
                $.ajax({
                    url: '{{ route('admin.products.variant.update') }}',
                    method: 'POST',
                    data: formData,
                    headers: {
                        "X-CSRF-TOKEN": csrfToken, // CSRF Token cho Laravel
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);

                            $form.closest('.content2').find('.save-all-btn, .cancel-btn').addClass('d-none');

                            var $totalStockElement = $('td.total-stock[data-id="' + productId + '"]');

                            if ($totalStockElement.length) {
                                $totalStockElement.text(response.total_stock);
                                $totalStockElement.hide().show(0); // Buộc trình duyệt cập nhật lại (reflow)
                            } else {
                                console.error("Không tìm thấy phần tử total-stock với product_id: " + productId);
                            }
                            console.log(response);
                        } else {
                            toastr.error(response.message); // Hiển thị lỗi nếu status không phải là "success"
                        }
                    },
                    error: function(xhr) {
                        // Kiểm tra và hiển thị thông báo lỗi chi tiết từ phản hồi của server
                        if (xhr.status === 422) { // Lỗi xác thực
                            var errors = xhr.responseJSON.errors;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    toastr.error(errors[key][0]); // Hiển thị từng lỗi xác thực với màu đỏ
                                }
                            }
                        } else {
                            toastr.error('Có lỗi xảy ra trong quá trình cập nhật: ' + xhr.status + ' - ' + xhr.responseText);
                        }
                    }
                });
            });
        });

    </script>

    {{-- VALIDATE VARIANT APPLY ALL --}}
    <script>
        $(document).ready(function() {
            // Disable the apply button initially
            $('.apply-all').prop('disabled', true);

            // Function to validate the input fields for each product
            function validateInputs(productId) {
                var batchPrice = parseFloat($('#batch-price-' + productId).val());
                var batchPriceSale = parseFloat($('#batch-price_sale-' + productId).val());
                var batchStock = parseFloat($('#batch-stock-' + productId).val());

                var isValid = true; // Biến để kiểm tra nếu tất cả các input hợp lệ

                // Reset error messages and remove red borders for specific product
                $('#error-price-' + productId).text('');
                $('#error-price_sale-' + productId).text('');
                $('#error-stock-' + productId).text('');
                $('#batch-price-' + productId).removeClass('is-invalid');
                $('#batch-price_sale-' + productId).removeClass('is-invalid');
                $('#batch-stock-' + productId).removeClass('is-invalid');

                // Kiểm tra đơn giá (price) không âm nếu có giá trị nhập
                if (!isNaN(batchPrice) && batchPrice < 0) {
                    $('#error-price-' + productId).text('Đơn giá phải lớn hơn hoặc bằng 0.');
                    $('#batch-price-' + productId).addClass('is-invalid'); // Thêm viền đỏ
                    isValid = false;
                }

                // Kiểm tra giá khuyến mãi (priceSale) không âm và nhỏ hơn đơn giá nếu có nhập
                if (!isNaN(batchPriceSale)) {
                    if (batchPriceSale < 0) {
                        $('#error-price_sale-' + productId).text('Giá khuyến mãi phải lớn hơn hoặc bằng 0.');
                        $('#batch-price_sale-' + productId).addClass('is-invalid'); // Thêm viền đỏ
                        isValid = false;
                    } else if (batchPriceSale >= batchPrice && !isNaN(batchPrice)) {
                        $('#error-price_sale-' + productId).text('Giá khuyến mãi phải nhỏ hơn giá gốc.');
                        $('#batch-price_sale-' + productId).addClass('is-invalid'); // Thêm viền đỏ
                        isValid = false;
                    }
                }

                // Kiểm tra số lượng (stock) không âm nếu có giá trị nhập
                if (!isNaN(batchStock) && batchStock < 0) {
                    $('#error-stock-' + productId).text('Số lượng phải lớn hơn 0.');
                    $('#batch-stock-' + productId).addClass('is-invalid'); // Thêm viền đỏ
                    isValid = false;
                }

                // Nếu tất cả các input hợp lệ, enable nút áp dụng
                if (isValid) {
                    $('.apply-all[data-product-id="' + productId + '"]').prop('disabled', false);
                } else {
                    $('.apply-all[data-product-id="' + productId + '"]').prop('disabled', true);
                }
            }

            // Validate on input change for each product
            $('.batch-input').on('input', function() {
                var productId = $(this).closest('.batch-edit-form').data('product-id');
                validateInputs(productId);
            });

            // Xử lý khi nhấn nút "Áp dụng cho tất cả"
            $('.apply-all').on('click', function() {
                var productId = $(this).data('product-id');
                validateInputs(productId); // Validate trước khi áp dụng

                // Nếu hợp lệ thì giá trị sẽ được áp dụng cho tất cả các biến thể
                if (!$('.apply-all[data-product-id="' + productId + '"]').prop('disabled')) {
                    // Áp dụng giá trị cho tất cả các biến thể
                    $('.variant-row[data-variant-id]').each(function() {
                        var variantRow = $(this);
                        var batchPrice = parseFloat($('#batch-price-' + productId).val());
                        var batchPriceSale = parseFloat($('#batch-price_sale-' + productId).val());
                        var batchStock = parseFloat($('#batch-stock-' + productId).val());

                        // Chỉ áp dụng giá trị nếu có nhập liệu
                        if (!isNaN(batchPrice)) {
                            variantRow.find('.price-regular').val(batchPrice);
                        }
                        if (!isNaN(batchPriceSale)) {
                            variantRow.find('.price-sale').val(batchPriceSale);
                        }
                        if (!isNaN(batchStock)) {
                            variantRow.find('.stock').val(batchStock);
                        }
                    });
                } else {
                    alert('Vui lòng kiểm tra lại các giá trị đã nhập.');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Mở popup khi click vào ảnh
            $('.image-container').on('click', function() {
                const imageUrl = $(this).find('img').attr('src');
                $('#popupImage').attr('src', imageUrl);
                $('#imagePopup').fadeIn();
            });

            // Đóng popup khi click vào biểu tượng đóng
            $('.close').on('click', function() {
                $('#imagePopup').fadeOut();
            });

            // Đóng popup khi nhấn vào khoảng trống ngoài ảnh
            $('#imagePopup').on('click', function(e) {
                if (e.target === this) {  // Kiểm tra nếu click vào vùng popup mà không phải ảnh
                    $(this).fadeOut();
                }
            });

            // Đóng popup khi nhấn phím ESC
            $(document).on('keyup', function(e) {
                if (e.key === "Escape") {
                    $('#imagePopup').fadeOut();
                }
            });
        });
    </script>
@endsection
