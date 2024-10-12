@extends('layouts.backend')

@section('css')
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- image css -->
    <link rel="stylesheet" href="{{asset('admin/css/products/image-form.css')}}">

    {{-- <link rel="stylesheet" href="{{ asset('admin/js/plugins/simplemde/simplemde.min.css') }}"> --}}
@endsection
@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Chỉnh sửa sản phẩm</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.products.index') }}" style="color: inherit;">Quản lý sản phẩm</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa sản phẩm</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    <div class="content">
         {{-- Form bắt đầu --}}
        <form action="{{route('admin.products.update', $product)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="row">
                        <!-- Cột bên trái: Nhập thông tin sản phẩm -->
                        <div class="col-8">
                        
                                <!-- Tên sản phẩm -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên sản phẩm:</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}" placeholder="Nhập tên sản phẩm" >
                                </div>
            
                                <!-- SKU -->
                                <div class="mb-3">
                                    <label for="sku" class="form-label">SKU</label>
                                    <input type="text" class="form-control" name="sku" id="sku" value="{{ $product->sku }}" readonly>
                                </div>
            
                                <!-- Giá sản phẩm -->
                                <div class="row">
                                    <!-- Giá gốc -->
                                    <div class="col-6 mb-3">
                                        <label for="price_regular" class="form-label">Giá gốc:</label>
                                        <input type="text" class="form-control" name="price_regular" id="price_regular" value="{{ $product->price_regular }}" placeholder="Nhập giá sản phẩm">
                                    </div>
            
                                    <!-- Giá khuyến mãi -->
                                    <div class="col-6 mb-3">
                                        <label for="price_sale" class="form-label">Giá khuyến mãi:</label>
                                        <input type="text" class="form-control" name="price_sale" id="price_sale" value="{{ $product->price_sale }}" placeholder="Nhập giá khuyến mãi">
                                    </div>
                                </div>
            
                                <!-- Mô tả ngắn -->
                                <div class="mb-4">
                                    <label for="description" class="form-label">Mô tả ngắn:</label>
                                    <textarea class="form-control" id="description" name="description" rows="5" maxlength="200"
                                            placeholder="Nhập tối đa 200 ký tự...">{{ $product->description }}</textarea>
                                    <small id="char-count" class="form-text text-muted">Còn lại 200 ký tự</small>
                                </div>
            
                                <!-- Nội dung chi tiết -->
                                <div class="mb-3">
                                    <label for="editor" class="form-label">Nội dung:</label>
                                    <textarea name="content" id="editor">{{ $product->content }}</textarea>
                                </div>
                        </div>
            
                        <!-- Cột bên phải: Thuộc tính sản phẩm và ảnh -->
                        <div class="col-4">
                            <!-- Input for Material -->
                            <div class="form-group mb-3">
                                <label class="form-label" for="materialInput">Chất liệu:</label>
                                <input type="text" class="form-control" name="material" id="materialInput" value="{{ $product->material }}" placeholder="Chất liệu sản phẩm">
                            </div>
                            <!-- Danh mục -->
                            <div class="row form-group mb-3">
                                <label class="form-label" for="catalogue-select">Danh mục:</label>
                                <select class="form-select" id="catalogue-select" name="catalogue_id">
                                    <option selected>Chọn danh mục</option>
                                    @foreach ($catalogues as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $product->catalogue_id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
            
                            <!-- Các thuộc tính sản phẩm -->
                            <div class="mb-4">
                                <label class="form-label">Thuộc tính sản phẩm</label>
                                <div class="row">
                                    <!-- Dòng 1 -->
                                    <div class="d-flex justify-content-between">
                                        <!-- Is active -->
                                        <div class="form-check form-switch form-check-inline col-md">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ $product->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                  
                                        <!-- Is new -->
                                        <div class="form-check form-switch form-check-inline col-md">
                                            <input class="form-check-input" type="checkbox" id="is_new" name="is_new" {{ $product->is_new ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_new">New</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-2">
                                    <!-- Dòng 2 -->
                                    <div class="d-flex justify-content-between">
                                        <!-- Is hot deal -->
                                        <div class="form-check form-switch form-check-inline col-md">
                                            <input class="form-check-input" type="checkbox" id="is_hot_deal" name="is_hot_deal" {{ $product->is_hot_deal ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_hot_deal">Hot deal</label>
                                        </div>
                                
                                        <!-- Show home -->
                                        <div class="form-check form-switch form-check-inline col-md">
                                            <input class="form-check-input" type="checkbox" id="is_show_home" name="is_show_home" {{ $product->is_show_home ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_show_home">Show home</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <div class="form-group image-preview" id="main-image-preview">
                                <!-- Nút tải ảnh chính -->
                                <label class="form-label">Tải lên ảnh chính:</label>
                                <div class="form-group">
                                    <label for="main-image-input" id="main-image-upload-btn" class="upload-btn btn btn-alt-primary me-1 mb-3">
                                        <i class="fa fa-fw fa-upload opacity-50 me-1"></i> Tải lên
                                    </label>
                                    <!-- Ẩn trường nhập file -->
                                    <input type="file" id="main-image-input" name="main_image" class="hidden-input" style="display: none;">
                                    <!-- Khu vực hiển thị ảnh chính -->
                                    <div id="main-image-display">
                                        @if ($product->images && $product->images->isNotEmpty())
                                            @if ($mainImage = $product->images->firstWhere('is_main', 1))
                                                <img src="{{ Storage::url($mainImage->image) }}" alt="Main Image" class="img-fluid">
                                            @else
                                                <p>Không có hình ảnh chính</p>
                                            @endif
                                        @else
                                            <p>Không có hình ảnh</p>
                                        @endif
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            
                            <div class="form-group image-preview" id="sub-images-preview">
                                <label class="form-label">Tải lên ảnh phụ:</label>
                                <div class="form-group">
                                    <!-- Nút tải ảnh phụ -->
                                    <label for="sub-image-input" id="sub-image-upload-btn" class="upload-btn btn btn-alt-primary me-1 mb-3">
                                        <i class="fa fa-fw fa-upload opacity-50 me-1"></i> Tải lên
                                    </label>
                                    <!-- Ẩn trường nhập file -->
                                    <input type="file" id="sub-image-input" name="sub_images[]" class="hidden-input" multiple style="display: none;">
                                    
                                    <!-- Khu vực hiển thị ảnh phụ -->
                                    <div id="sub-images-display">
                                        @foreach ($product->images->where('is_main', 0) as $image)
                                            <div class="existing-sub-image-container sub-image-container" data-id="{{ $image->id }}">
                                                <img src="{{ Storage::url($image->image) }}" alt="Sub Image" class="img-fluid mb-2">
                                                <button type="button" class="remove-btn btn btn-danger btn-sm">X</button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="row">
                        <div class="col-12">
                            <!-- Vertical Block Tabs Default Style With Extra Info -->
                            <div class="block block-rounded row g-0">
                                <ul class="nav nav-tabs nav-tabs-block flex-md-column col-md-4 col-xxl-2" role="tablist">
                                    <li class="nav-item d-md-flex flex-md-column">
                                        <a href="#btabs-vertical-info-home"
                                           class="nav-link text-md-start active"
                                           id="btabs-vertical-info-home-tab"
                                           data-bs-toggle="tab"
                                           role="tab"
                                           aria-controls="btabs-vertical-info-home"
                                           aria-selected="true">
                                            <i class="fa fa-fw fa-list opacity-50 me-1 d-none d-sm-inline-block"></i>
                                            <span>Thuộc tính</span>
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item d-md-flex flex-md-column">
                                        <a href="#btabs-vertical-info-profile"
                                           class="nav-link text-md-start"
                                           id="btabs-vertical-info-profile-tab"
                                           data-bs-toggle="tab"
                                           role="tab"
                                           aria-controls="btabs-vertical-info-profile"
                                           aria-selected="false">
                                            <i class="fa fa-fw fa-tags opacity-50 me-1 d-none d-sm-inline-block"></i>
                                            <span>Biến thể</span>
                                        </a>
                                    </li>
                                </ul>
            
                                <!-- PRODUCT VARIANT -->
                                <div class="tab-content col-md-8 col-xxl-10">
                                    <!-- Thuộc tính tab -->
                                    <div class="block-content tab-pane active" id="btabs-vertical-info-home" role="tabpanel" aria-labelledby="btabs-vertical-info-home-tab" tabindex="0">
                                        <h4 class="fw-semibold">Thuộc tính</h4>
                                        <div class="actions">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-4 col-6">
                                                        <label class="form-label" for="val-select2">Chọn thuộc tính <span class="text-danger">*</span></label>
                                                        <select class="js-select2 form-select" id="val-select2"  style="width: 100%;" data-placeholder="Choose one..">
                                                            <option></option>
                                                            <!-- Các thuộc tính được load từ cơ sở dữ liệu -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="attributes-container">
                                                    <!-- Các thuộc tính sẽ được thêm vào đây khi chọn từ dropdown -->
                                                </div>
                                                <div class="btn">
                                                    <button id="save-attributes" class="btn btn-outline-primary">Lưu thuộc tính</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                    <!-- Biến thể tab -->
                                    <div class="block-content tab-pane" id="btabs-vertical-info-profile" role="tabpanel" aria-labelledby="btabs-vertical-info-profile-tab" tabindex="0">
                                        <a id="generate-variants" class="btn btn-alt-secondary mb-3">Tạo ra các biến thể</a>
                                        <div class="row">
                                            <div class="col-md-2 ms-auto text-end">
                                                <a id="apply-price-to-all" class="btn btn-alt-primary mb-5" style="display:none;">Thêm giá</a>
                                            </div>
                                        </div>
                                        
                                        <div id="variant-list" class="product-varian mb-2">
                                            @foreach($product->variants as $index => $variant)
                                                <div class="row justify-content-between align-items-center variant-item" style="border: 1px solid rgba(128, 128, 128, 0.318); padding: 10px 0" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $index }}" aria-expanded="false" aria-controls="collapse-{{ $index }}">
                                                    <div class="col-8 d-flex">
                                                        <div class="variant-number me-2"><strong>#{{ $index + 1 }}</strong></div>
                                        
                                                        @foreach($variant->attributes as $attribute)
                                                            {{-- Kiểm tra xem pivot và value có tồn tại trước khi truy cập --}}
                                                            <input type="text" class="form-control me-2" name="variant_attributes[{{ $index }}][]" 
                                                                value="{{ $attribute->pivot->values ?? 'Không có giá trị' }}" readonly>
                                                            <input type="hidden" name="variant_attributes[{{ $index }}][attribute_id]" value="{{ $attribute->id }}">
                                                            <input type="hidden" name="variant_attributes[{{ $index }}][value_id]" value="{{ $attribute->pivot->value_id ?? '' }}">
                                                        @endforeach
                                                    </div>
                                                    <div class="col-4 text-end">
                                                        <a href="#" class="text-danger remove-variant">Xoá</a>
                                                    </div>
                                                </div>
                                        
                                                <div class="collapse mt-3" id="collapse-{{ $index }}">
                                                    <div class="card card-body mb-3">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-3">
                                                                    <label>Mã sản phẩm:</label>
                                                                    <input type="text" class="form-control" name="variant_sku[{{ $index }}]" value="{{ $variant->sku }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-3">
                                                                    <label>Giá:</label>
                                                                    <input type="number" class="form-control" name="variant_price_regular[{{ $index }}]" value="{{ $variant->price_regular }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-3">
                                                                    <label>Giá khuyến mãi:</label>
                                                                    <input type="number" class="form-control" name="variant_price_sale[{{ $index }}]" value="{{ $variant->price_sale }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-3">
                                                                    <label>Số lượng trong kho:</label>
                                                                    <input type="number" class="form-control" name="variant_stock[{{ $index }}]" value="{{ $variant->stock }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        
                                        <div class="btn">
                                            <a href="#" class="btn btn-outline-primary" id="save-variants">Lưu biến thể</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Vertical Block Tabs Default Style With Extra Info -->
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="btn">
                <button type="submit" class="btn btn-outline-primary" >Cập nhật sản phẩm</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script> <!-- Thêm dòng này -->
    <script src="{{asset('admin/js/ui/product-ui/preview-image.js')}}"></script>
    
    {{-- SELECT2 --}}
    <script>
        $(document).ready(function() {
            $('.attributes-select').select2({
                placeholder: "Select attributes",
                allowClear: true,
                tags: true 
            });
        });

        $(document).ready(function() {
            // Khởi tạo Select2 cho danh mục
            $('#catalogue-select').select2({
                placeholder: "Chọn danh mục", 
                allowClear: true 
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            const maxLength = 200;

            // Lắng nghe sự kiện khi người dùng nhập vào textarea
            $('#description').on('input', function() {
                const length = $(this).val().length;
                const remaining = maxLength - length;

                // Cập nhật số ký tự còn lại
                $('#char-count').text('Còn lại ' + remaining + ' ký tự');
            });
        });
    </script>

    <script>
        const csrfToken = "{{ csrf_token() }}";
    </script>


    <script src="{{asset('admin/js/Api/product-edit.js')}}"></script>
@endsection
