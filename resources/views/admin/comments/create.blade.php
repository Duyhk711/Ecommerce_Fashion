@extends('layouts.backend')

@section('css')

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="{{asset('admin/js/plugins/simplemde/simplemde.min.css')}}">
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
                        <a href="{{ route('admin.comments.index') }}" style="color: inherit;">Quản lý sản phẩm</a>
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
                <div class="col-">
                    <form action="{{ route('admin.comments.store') }}" method="post">
                    @csrf
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Tên người dùng</label>
                            <input type="text" class="form-control" name="user_id" id="user_id" required placeholder="Nhập tên sản phẩm" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="product_id" id="product_id" required placeholder="Nhập tên sản phẩm" required>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Bình luận</label>
                            <input type="text" class="form-control" name="comment" id="comment" required placeholder="Nhập tên sản phẩm" required>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Đánh giá</label>
                            <input type="number" class="form-control" name="rating" id="rating"  min="1" max="5" required placeholder="Nhập tên sản phẩm" required>
                        </div>
                        <button type="submit" class="btn btn-outline-primary" style="margin-top: 20px;">Thêm</button>

                    </form>


                </div>

            </div>
        </div>
    </div>
</div>
<div class="block block-rounded">
    <div class="block-content">
        <div class="row">
            <div class="col">
        
            </div>

        </div>
    </div>
    <!-- END Vertical Block Tabs Default Style -->
</div>
</div>
</div>
</div>

</div>

@endsection
@section('js')
{{-- <script src="{{asset('js/dashmix.app.min.js')}}"></script> --}}
<script src="{{asset('admin/js/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>
<script>
    $(document).ready(function() {
        // Hàm xử lý khi thay đổi thuộc tính
        $('#attributeSelect').change(function() {
            var selectedValue = $(this).val();
            var dynamicFields = $('#dynamicFields');

            // Nếu đã chọn một thuộc tính thì tạo Select2 tương ứng
            if (selectedValue === 'color' && !$('#colorField').length) {
                // Tạo Select2 cho màu sắc
                dynamicFields.append(`
                <div id="colorField" class="attribute-field">
                    <label for="colorSelect">Màu sắc</label>
                    <select id="colorSelect" class="form-control" multiple="multiple">
                        <option value="red">Đỏ</option>
                        <option value="blue">Xanh dương</option>
                        <option value="green">Xanh lá</option>
                        <option value="yellow">Vàng</option>
                    </select>
                    <button type="button" class="remove-attribute btn btn-danger btn-sm">X</button>
                </div>
            `);

                // Khởi tạo Select2 cho màu sắc
                $('#colorSelect').select2({
                    placeholder: "Chọn màu sắc",
                    allowClear: true
                });
            } else if (selectedValue === 'size' && !$('#sizeField').length) {
                // Tạo Select2 cho size
                dynamicFields.append(`
                <div id="sizeField" class="attribute-field">
                    <label for="sizeSelect">Size</label>
                    <select id="sizeSelect" class="form-control" multiple="multiple">
                        <option value="s">S</option>
                        <option value="m">M</option>
                        <option value="l">L</option>
                        <option value="xl">XL</option>
                    </select>
                    <button type="button" class="remove-attribute btn btn-danger btn-sm">X</button>
                </div>
            `);

                // Khởi tạo Select2 cho size
                $('#sizeSelect').select2({
                    placeholder: "Chọn size",
                    allowClear: true
                });
            }

            // Đặt lại giá trị của select box về mặc định
            $(this).val('');
        });

        // Hàm xử lý khi nhấn nút "X" để xóa thuộc tính
        $('#dynamicFields').on('click', '.remove-attribute', function() {
            $(this).parent().remove();
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImageInput = document.getElementById('main_image');
        const galleryImagesInput = document.getElementById('gallery_images');
        const mainImagePreview = document.getElementById('main-image-preview');
        const galleryPreview = document.getElementById('gallery-preview');

        // Hiển thị ảnh chính khi chọn
        mainImageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    mainImagePreview.innerHTML = `
                    <h3>Ảnh chính:</h3>
                    <img src="${e.target.result}" alt="Ảnh chính" style="max-width: 100px; border: 2px solid green; border-radius: 8px;">
                `;
                };
                reader.readAsDataURL(file);
            } else {
                mainImagePreview.innerHTML = ''; // Xóa ảnh khi không chọn ảnh
            }
        });

        // Hiển thị ảnh phụ khi chọn
        galleryImagesInput.addEventListener('change', function() {
            galleryPreview.innerHTML = ''; // Xóa ảnh phụ cũ
            const files = this.files;

            for (const file of files) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    galleryPreview.innerHTML += `
                    <div style="display: inline-block; margin-right: 10px; margin-bottom: 10px;">
                        <img src="${e.target.result}" alt="Ảnh phụ" style="width: 100px;height:80px border: 1px solid gray; border-radius: 8px;">
                    </div>
                `;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>

<script>
    // Khởi tạo CKEditor sau khi tải script
    CKEDITOR.replace('editor1');
</script>
@endsection