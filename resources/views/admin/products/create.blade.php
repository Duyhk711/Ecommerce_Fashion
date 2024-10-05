@extends('layouts.backend')

@section('css')

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}

    <link rel="stylesheet" href="{{ asset('admin/js/plugins/simplemde/simplemde.min.css') }}">
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
                            <a href="{{ route('admin.attributes.index') }}" style="color: inherit;">Quản lý sản phẩm</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm mới sản phẩm</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
                <div class="row">
                    <div class="col-8">
                        {{-- <form action="" method="post"> --}}

                            <!-- Tên sản phẩm -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Nhập tên sản phẩm" required>
                            </div>

                            <!-- sku -->
                            <div class="mb-3">
                                <label for="sku" class="form-label">Sku</label>
                                <input type="text" class="form-control" name="sku" id="sku"
                                    value="{{ $sku }}" readonly>
                            </div>

                            <div class="row">
                                <!-- price regular -->
                                <div class="col-6 mb-3">
                                    <label for="price_regular" class="form-label">Giá gốc</label>
                                    <input type="text" class="form-control" name="price_regular" id="price_regular">
                                </div>
                                <!-- price sale -->
                                <div class="col-6 mb-3">
                                    <label for="price_sale" class="form-label">Giá khuyến mãi</label>
                                    <input type="text" class="form-control" name="price_sale" id="price_sale">
                                </div>
                            </div>

                            <label for="description" class="form-label">Mô tả ngắn</label>
                            <div class="mb-4">
                                <textarea class="form-control" id="description" name="description" rows="5" maxlength="200"
                                    placeholder="Nhập tối đa 200 ký tự..."></textarea>
                                <small id="char-count" class="form-text text-muted">Còn lại 200 ký tự</small>
                            </div>

                            {{-- mota --}}
                            <label for="" class="form-label">Nội dung</label>
                            <textarea name="content" id="editor"></textarea>
                        {{-- </form> --}}


                    </div>
                    <!-- Select để chọn thuộc tính -->
                    <div class="col-4">
                        {{-- danh mục --}}
                        <div class="mb-3">
                            <label class="form-label" for="catalogue-select">Catalogues</label>
                            <select class="form-select" id="catalogue-select" name="catalogue-select">
                                <option selected="">Chọn danh mục</option>
                                @foreach ($catalogues as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Inline Switches</label>
                            <div class="space-x-2">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="example-switch-inline1" name="is_active" checked>
                                    <label class="form-check-label" for="example-switch-inline1">Is active</label>
                                </div>
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="example-switch-inline2" name="is_new" checked>
                                    <label class="form-check-label" for="example-switch-inline2">is_new</label>
                                </div>
                            </div>
                            <div class="space-x-2">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="example-switch-inline1" name="is_hot_deal">
                                    <label class="form-check-label" for="example-switch-inline1">is_hot_deal</label>
                                </div>
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="example-switch-inline2" name="is_show_home">
                                    <label class="form-check-label" for="example-switch-inline2">show home</label>
                                </div>
                            </div>
                        </div>

                        <!-- Chọn ảnh chính -->
                        <div>
                            <label for="main_image">Chọn ảnh chính:</label>
                            <input type="file" id="main_image" name="main_image" accept="image/*">
                            <div id="main-image-preview" style="margin-top: 10px;">
                                <!-- Ảnh chính sẽ được hiện lên ở đây -->
                            </div>
                        </div>

                        <!-- Chọn ảnh phụ -->
                        <div style="margin-top: 20px;">
                            <label for="gallery_images">Chọn ảnh phụ:</label>
                            <input type="file" id="gallery_images" name="gallery_images[]" multiple accept="image/*">
                            <div id="gallery-preview" style="margin-top: 10px;">
                                <!-- Các ảnh phụ sẽ được hiện lên ở đây -->
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
                              <button class="nav-link text-md-start active" id="btabs-vertical-info-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-vertical-info-home" role="tab" aria-controls="btabs-vertical-info-home" aria-selected="true">
                                <i class="fa fa-fw fa-home opacity-50 me-1 d-none d-sm-inline-block"></i>
                                <span>Thuộc tính</span>
                                {{-- <span class="d-none d-md-block fs-xs fw-medium opacity-75 mt-md-2">
                                  Check out your main activity and any pending notifications
                                </span> --}}
                              </button>
                            </li>
                            <li class="nav-item d-md-flex flex-md-column">
                              <button class="nav-link text-md-start" id="btabs-vertical-info-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-vertical-info-profile" role="tab" aria-controls="btabs-vertical-info-profile" aria-selected="false">
                                <i class="fa fa-fw fa-user-circle opacity-50 me-1 d-none d-sm-inline-block"></i>
                                <span>Biến thể</span>
                                {{-- <span class="d-none d-md-block fs-xs fw-medium opacity-75 mt-md-2">
                                  Update your public information and promote your projects
                                </span> --}}
                              </button>
                            </li>
                          </ul>
                          {{-- PRODUCT VARIANT --}}
                          <div class="tab-content col-md-8 col-xxl-10">
                            {{-- thuoctinh --}}
                            <div class="block-content tab-pane active" id="btabs-vertical-info-home" role="tabpanel" aria-labelledby="btabs-vertical-info-home-tab" tabindex="0">
                                <h4 class="fw-semibold">Thuộc tính</h4>
                                <div class="actions">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-4 col-6">
                                                <label class="form-label" for="val-select2">Chọn thuộc tính <span class="text-danger">*</span></label>
                                                <select class="js-select2 form-select" id="val-select2" name="attribute_id" style="width: 100%;" data-placeholder="Choose one..">
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
                            
                        
                            <div class="block-content tab-pane" id="btabs-vertical-info-profile" role="tabpanel" aria-labelledby="btabs-vertical-info-profile-tab" tabindex="0">
                                <h4 class="fw-semibold">Tạo biến thể</h4>
                                <button id="generate-variants" class="btn btn-outline-primary mb-5">Tạo ra các biến thể</button>
                                <div id="variant-list" class="product-varian mb-2">
                                    <!-- Biến thể sẽ được tạo và hiển thị ở đây -->
                                </div>
                                <div class="btn">
                                    <button class="btn btn-outline-primary" id="save-variants">Lưu biến thể</button>
                                </div>
                            </div>
                            
                        </div>
                        
                        </div>
                        <!-- END Vertical Block Tabs Default Style With Extra Info -->
                      </div>
                </div>
                <div class="btn">
                    <button class="btn btn-outline-primary" id="save-product">Tạo sản phẩm</button>
                </div>


            </div>
        </div>

    </div>
@endsection
@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

    {{-- <script src="{{ asset('admin/js/plugins/ckeditor/ckeditor.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="{{asset('admin/js/plugins/dropzone/min/dropzone.min.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    {{-- <script>
        CKEDITOR.replace('editor');
        // 
    </script> --}}
   
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

    {{-- UP IMAGE --}}
    <script>
         const csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{asset('admin/js/Api/product.js')}}"></script>
@endsection
