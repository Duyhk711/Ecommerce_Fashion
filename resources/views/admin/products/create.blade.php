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
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Thêm mới sản phẩm</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.products.index') }}" style="color: inherit;">Quản lý sản phẩm</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm mới sản phẩm</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    <div class="content ">
         {{-- Form bắt đầu --}}
        <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="row">
                        <!-- Cột bên trái: Nhập thông tin sản phẩm -->
                        <div class="col-8">
                            <!-- Tên sản phẩm -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên sản phẩm:</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Nhập tên sản phẩm">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
            
                            <!-- SKU -->
                            <div class="mb-3">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" class="form-control" name="sku" id="sku" value="{{ $sku }}" readonly>
                            </div>
            
                            <!-- Giá sản phẩm -->
                            <div class="row">
                                <!-- Giá gốc -->
                                <div class="col-6 mb-3">
                                    <label for="price_regular" class="form-label">Giá gốc:</label>
                                    <input type="number" class="form-control @error('price_regular') is-invalid @enderror" name="price_regular" id="price_regular" value="{{ old('price_regular') }}" placeholder="Nhập giá sản phẩm">
                                    @error('price_regular')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
            
                                <!-- Giá khuyến mãi -->
                                <div class="col-6 mb-3">
                                    <label for="price_sale" class="form-label">Giá khuyến mãi:</label>
                                    <input type="number" class="form-control @error('price_sale') is-invalid @enderror" name="price_sale" id="price_sale" value="{{ old('price_sale') }}" placeholder="Nhập giá khuyến mãi">
                                    @error('price_sale')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
            
                            <!-- Mô tả ngắn -->
                            <div class="mb-4">
                                <label for="description" class="form-label">Mô tả ngắn:</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" maxlength="200" placeholder="Nhập tối đa 200 ký tự...">{{ old('description') }}</textarea>
                                <small id="char-count" class="form-text text-muted">Còn lại 200 ký tự</small>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
            
                            <!-- Nội dung chi tiết -->
                            <div class="mb-3">
                                <label for="editor" class="form-label">Nội dung:</label>
                                <textarea name="content" id="editor" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
            
                        <!-- Cột bên phải: Thuộc tính sản phẩm và ảnh -->
                        <div class="col-4">
                            <!-- Input for Material -->
                            <div class="form-group mb-3">
                                <label class="form-label" for="materialInput">Chất liệu:</label>
                                <input type="text" class="form-control @error('material') is-invalid @enderror" name="material" id="materialInput" value="{{ old('material') }}" placeholder="Chất liệu sản phẩm">
                                @error('material')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
            
                            <!-- Danh mục -->
                            <div class="row form-group mb-3">
                                <label class="form-label" for="catalogue-select">Danh mục:</label>
                                <select class="form-select @error('catalogue-select') is-invalid @enderror" id="catalogue-select" name="catalogue-select">
                                    <option value="">Chọn danh mục</option>
                                    @foreach ($catalogues as $item)
                                        <option value="{{ $item->id }}" {{ old('catalogue-select') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('catalogue-select')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
            
                            <!-- Các thuộc tính sản phẩm -->
                            <div class="mb-4">
                                <label class="form-label">Thuộc tính sản phẩm</label>
                                <div class="row">
                                    <!-- Dòng 1 -->
                                    <div class="d-flex justify-content-between">
                                        <!-- Is active -->
                                        <div class="form-check form-switch form-check-inline col-md">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
            
                                        <!-- Is new -->
                                        <div class="form-check form-switch form-check-inline col-md">
                                            <input class="form-check-input" type="checkbox" id="is_new" name="is_new" {{ old('is_new', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_new">New</label>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row mt-2">
                                    <!-- Dòng 2 -->
                                    <div class="d-flex justify-content-between">
                                        <!-- Is hot deal -->
                                        <div class="form-check form-switch form-check-inline col-md">
                                            <input class="form-check-input" type="checkbox" id="is_hot_deal" name="is_hot_deal" {{ old('is_hot_deal') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_hot_deal">Hot deal</label>
                                        </div>
            
                                        <!-- Show home -->
                                        <div class="form-check form-switch form-check-inline col-md">
                                            <input class="form-check-input" type="checkbox" id="is_show_home" name="is_show_home" {{ old('is_show_home') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_show_home">Show home</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Nút tải ảnh chính -->
                            <div class="form-group image-preview" id="main-image-preview">
                                <label class="form-label">Tải lên ảnh chính:</label>
                                <div class="form-group">
                                    <label for="main-image-input" id="main-image-upload-btn" class="upload-btn btn btn-alt-primary me-1 mb-3 fs-sm">
                                        <i class="fa fa-fw fa-upload opacity-50 me-1 "></i> Tải lên
                                    </label>
                                    <input type="file" id="main-image-input" name="main_image" class="hidden-input" style="display: none;">
                                    @error('main_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="main-image-display"></div>
                                </div>
                            </div>
            
                            <!-- Tải lên ảnh phụ -->
                            <div class="form-group image-preview" id="sub-images-preview">
                                <label class="form-label">Tải lên ảnh phụ:</label>
                                <div class="form-group">
                                    <label for="sub-image-input" id="sub-image-upload-btn" class="upload-btn btn btn-alt-primary me-1 mb-3 fs-sm">
                                        <i class="fa fa-fw fa-upload opacity-50 me-1"></i> Tải lên
                                    </label>
                                    <input type="file" id="sub-image-input" name="sub_images[]" class="hidden-input" multiple style="display: none;">
                                    @error('sub_images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="sub-images-display"></div>
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
                                            <!-- Biến thể sẽ được tạo và hiển thị ở đây -->
                                            <input type="hidden" name="product_data" value="">
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
                <button type="submit" class="btn btn-outline-primary" >Tạo sản phẩm</button>
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


    <script src="{{asset('admin/js/Api/product.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lắng nghe sự kiện nhập (input) trên từng trường
            document.getElementById('name').addEventListener('input', function () {
                validateName();
            });
    
            document.getElementById('price_regular').addEventListener('input', function () {
                validatePriceRegular();
                validatePriceSale(); // Kiểm tra lại giá sale nếu có thay đổi giá gốc
            });
    
            document.getElementById('price_sale').addEventListener('input', function () {
                validatePriceSale();
            });
    
            document.getElementById('description').addEventListener('input', function () {
                validateDescription();
            });
    
            document.getElementById('catalogue-select').addEventListener('change', function () {
                validateCatalogue();
            });
    
            // Các hàm kiểm tra từng trường
    
            function validateName() {
                const name = document.getElementById('name');
                clearError(name);
                if (!name.value.trim()) {
                    showError(name, 'Tên sản phẩm không được để trống');
                }
            }
    
            function validatePriceRegular() {
                const priceRegular = document.getElementById('price_regular');
                clearError(priceRegular);
                if (!priceRegular.value.trim() || isNaN(priceRegular.value) || Number(priceRegular.value) <= 0) {
                    showError(priceRegular, 'Giá gốc phải là số và lớn hơn 0');
                }
            }
    
            function validatePriceSale() {
                const priceRegular = document.getElementById('price_regular');
                const priceSale = document.getElementById('price_sale');
                clearError(priceSale);
                if (priceSale.value.trim()) {
                    if (isNaN(priceSale.value) || Number(priceSale.value) >= Number(priceRegular.value)) {
                        showError(priceSale, 'Giá khuyến mãi phải nhỏ hơn giá gốc');
                    }
                }
            }
    
            function validateDescription() {
                const description = document.getElementById('description');
                clearError(description);
                if (!description.value.trim()) {
                    showError(description, 'Mô tả không được để trống');
                }
            }
    
            function validateCatalogue() {
                const catalogueSelect = document.getElementById('catalogue-select');
                clearError(catalogueSelect);
                if (catalogueSelect.value === 'Chọn danh mục') {
                    showError(catalogueSelect, 'Vui lòng chọn danh mục');
                }
            }
    
            // Hàm hiển thị lỗi
            function showError(input, message) {
                const error = document.createElement('div');
                error.className = 'invalid-feedback';
                error.style.color = 'red';
                error.textContent = message;
                input.classList.add('is-invalid');
                input.parentElement.appendChild(error);
            }
    
            // Hàm xóa lỗi cũ
            function clearError(input) {
                const error = input.parentElement.querySelector('.invalid-feedback');
                if (error) {
                    error.remove();
                }
                input.classList.remove('is-invalid');
            }
        });
    </script>
@endsection
