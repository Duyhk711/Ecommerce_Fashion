@extends('layouts.backend')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/css/products/product-list.css') }}">
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Sản Phẩm đã xóa</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.products.index')}}" style="color: inherit;">Sản phẩm</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Sản phẩm đã xóa</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    <div class="block block-rounded table-responsive">
        <div class="block-header block-header-default">
            <h3 class="block-title">Danh sách sản phẩm đã xóa</h3>
            <div class="block-options">
                <div class="block-options-item">
                    <!-- Thêm icon "Quay lại danh sách sản phẩm" -->
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-alt-info"
                        data-bs-toggle="tooltip" title="">
                        <!-- Icon quay lại danh sách sản phẩm -->
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                </div>
                
            </div>

        </div>
        <div class="block-content block-content-full">
            <!-- Table with data -->
            <table id="" class="table  align-middle ">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Tên sản phẩm</th>
                        <th class="text-center">Giá</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Ngày xóa</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deletedProducts as $index => $product)
                        <tr>
                            <td class="text-center">{{ ($deletedProducts->currentPage() - 1) * $deletedProducts->perPage() + $index + 1 }}</td>
                            <td class="fs-sm">
                                <div class="d-flex align-items-center">
                                    <!-- Hình ảnh -->
                                    <div style="width: 60px; height: 100%;">
                                        <img src="{{ Storage::url($product->img_thumbnail) }}"
                                            alt="Ảnh sản phẩm"
                                            style="width: 100%; height: 100%; object-fit: cover;"
                                            class="img-fluid">
                                    </div>
        
                                    <!-- Thông tin sản phẩm, căn cách đều với hình ảnh -->
                                    <div class="ms-3" style="flex: 1;">
                                        <!-- Thêm flex: 1 để chiếm hết không gian còn lại -->
                                        <div class="pt-1 pd-2" style="font-weight: 500;">{{ $product->name }}
                                        </div>
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
                                    <span class="">{{ $product->total_stock }}</span>
                                @elseif ($product->total_stock > 0 && $product->total_stock <= 5)
                                    <span class="text-warning" data-bs-toggle="tooltip" title="Sắp hết hàng">
                                        {{ $product->total_stock }}</span>
                                @else
                                    <span class=" text-danger" data-bs-toggle="tooltip"
                                        title="Hết hàng">{{ $product->total_stock }}</span>
                                @endif 0
                            </td>
        
                            <td class="fs-sm">{{ $product->deleted_at->format('H:i d-m-Y') }}</td>
        
                            <td class="fs-sm text-center">
                                @if ($product->is_active)
                                    <span class="text-success">
                                        <i class="fa fa-check-circle text-success" data-bs-toggle="tooltip"
                                            title="Hoạt động"></i>
                                    </span>
                                @else
                                    <span class="text-danger">
                                        <i class="fa fa-ban text-danger" data-bs-toggle="tooltip"
                                            title="Không hoạt động"></i>
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
                                    @can('Khôi phục sản phẩm')
                                        <form action="{{ route('admin.products.restore', $product->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-alt-secondary"
                                                data-bs-toggle="tooltip" title="Khôi phục sản phẩm">
                                                <i class="fa fa-undo"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        <!-- Hàng thứ hai chứa nội dung mở rộng -->
                        <tr class="product-row">
                            <td colspan="7" class="content-row">
                                <div class="row mb-2">
                                    <div class="col-3 text-muted fs-sm">Tổng mặt hàng:
                                        {{ $product->variant_count }}
                                    </div>
                                    <div class="col-6"></div>
                                    <div class="col-3 text-end">
                                        <a href="#"
                                            class="btn btn-sm btn-alt mx-1 toggle-content text-muted"
                                            style="font-weight: 400;"
                                            data-target="#content-{{ $product->id }}"
                                            data-state="collapsed">
                                            <span class="toggle-text">Mở rộng</span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                    </div>
                                    <div id="content-{{ $product->id }}" class="content2 mt-1 mb-2"
                                        style="display: none;">
                                        <div class="row">
                                            @can('Chỉnh sửa sản phẩm')
                                                <div class="col-10 text-end mb-2">
                                                    <!-- Nút chỉnh sửa hàng loạt -->
                                                    <button
                                                        class="btn btn-sm btn-alt-secondary toggle-batch-edit">Chỉnh
                                                        sửa
                                                        hàng loạt <i class="fa fa-angle-down"></i></button>
                                                </div>
                                            @endcan
                                            <div class="col-2 text-end">
                                                <!-- Nút lưu và hủy, ban đầu ẩn đi -->
                                                <button class="btn btn-sm btn-alt save-all-btn d-none">Lưu
                                                </button>
                                                <button
                                                    class="btn btn-sm btn-alt cancel-btn d-none">Hủy</button>
                                            </div>
                                        </div>
                                        <div class="batch-edit-form d-none mt-3 mb-2"
                                            data-product-id="{{ $product->id }}">
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-3"></div>
                                                <div class="col-2">
                                                    <div class="mb-2">
                                                        <input type="number"
                                                            id="batch-price-{{ $product->id }}"
                                                            class="form-control fs-sm batch-input"
                                                            placeholder="Nhập vào đơn giá">
                                                        <span class="text-danger error-message"
                                                            id="error-price-{{ $product->id }}"></span><!-- Chỗ để hiển thị lỗi -->
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="mb-2">
                                                        <input type="number"
                                                            id="batch-price_sale-{{ $product->id }}"
                                                            class="form-control fs-sm batch-input"
                                                            placeholder="Giá khuyến mãi">
                                                        <span class="text-danger error-message"
                                                            id="error-price_sale-{{ $product->id }}"></span><!-- Chỗ để hiển thị lỗi -->
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="mb-2">
                                                        <input type="number"
                                                            id="batch-stock-{{ $product->id }}"
                                                            class="form-control fs-sm batch-input"
                                                            placeholder="Nhập vào số lượng">
                                                        <span class="text-danger error-message"
                                                            id="error-stock-{{ $product->id }}"></span>
                                                        <!-- Chỗ để hiển thị lỗi -->
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="mb-2">
                                                        <button class="btn btn-sm btn-alt apply-all"
                                                            data-product-id="{{ $product->id }}" disabled>Áp
                                                            dụng cho tất cả</button>
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
                                                <input type="hidden" name="product_id"
                                                    value="{{ $product->id }}">
                                                <div class="row d-flex justify-content-center variant-row"
                                                    data-variant-id="{{ $variant->id }}">
                                                    <div class="col-3 align-content-center">
                                                        <div class="mb-2">
                                                            <label for="quantity" class="text-muted">Biến
                                                                thể:</label>
                                                            <span>{{ $color }}-{{ $size }}</span>
                                                        </div>
                                                    </div>
        
                                                    <div class="col-2">
                                                        <div class="mb-2">
                                                            <label for="price_regular"
                                                                class="text-muted fs-sm">Đơn
                                                                giá</label>
                                                            <input type="number"
                                                                name="variants[{{ $variant->id }}][price_regular]"
                                                                class="form-control fs-sm batch-input price-regular"
                                                                value="{{ $variant->price_regular }}">
                                                        </div>
                                                    </div>
        
                                                    <div class="col-2">
                                                        <div class="mb-2">
                                                            <label for="price_sale"
                                                                class="text-muted fs-sm">Giá
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
            <div class="">{{ $deletedProducts->links() }}</div>
        </div>
    </div>
    
</div>

@endsection