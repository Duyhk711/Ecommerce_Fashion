@extends('layouts.backend')
@section('title')
    Cập nhật banner
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Cập nhật Banners</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.banners.index') }}" style="color: inherit;">Banners</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Cập nhật banner</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
                <h2 class="content-heading pt-0">Cập nhật Banner</h2>

                <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-lg-12 col-xl-8 offset-xl-2">

                            <!-- Loại banner -->
                            <div class="mb-4">
                                <label class="form-label" for="type">Chọn loại banner</label>
                                <select name="type" id="type"
                                    class="form-select @error('type') is-invalid @enderror" required>
                                    <option value="">-- Select Type --</option>
                                    <option value="main" {{ old('type', $banner->type) == 'main' ? 'selected' : '' }}>
                                        Banner chính</option>
                                    <option value="sub" {{ old('type', $banner->type) == 'sub' ? 'selected' : '' }}>
                                        Banner phụ</option>
                                </select>
                                @error('type')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Vị trí (chỉ hiện khi type là 'sub') -->
                            <div class="mb-4" id="position-field"
                                style="display: {{ $banner->type == 'sub' ? 'block' : 'none' }};">
                                <label class="form-label" for="position">Position</label>
                                <select name="position" id="position"
                                    class="form-select @error('position') is-invalid @enderror">
                                    <option value="">-- Select Position --</option>
                                    <option value="top"
                                        {{ old('position', $banner->position) == 'top' ? 'selected' : '' }}>Top</option>
                                    <option value="middle"
                                        {{ old('position', $banner->position) == 'middle' ? 'selected' : '' }}>Middle
                                    </option>
                                    <option value="bottom"
                                        {{ old('position', $banner->position) == 'bottom' ? 'selected' : '' }}>Bottom
                                    </option>
                                </select>
                                @error('position')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mô tả -->
                            <div class="mb-4">
                                <label class="form-label" for="description">Mô tả</label>
                                <input type="text" name="description" id="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    value="{{ old('description', $banner->description) }}">
                                @error('description')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Các ảnh và liên kết -->
                            <div id="image-fields" class="mb-4">
                                <label class="form-label">Tải ảnh:</label>
                                @foreach ($banner->images as $image)
                                    <div class="row mb-3 image-row" data-id="{{ $image->id }}">
                                        <div class="col">
                                            <input type="file" name="images[]" class="form-control">
                                            <img src="{{ Storage::url($image->image) }}" alt="" width="100px">
                                            <input type="hidden" name="image_ids[]" value="{{ $image->id }}">
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <input type="text" name="link[]" class="form-control"
                                                placeholder="Nhập vào liên kết" value="{{ old('link', $image->link) }}">
                                                <button type="button" class="btn btn-alt remove-image_db"><i
                                                    class="fa fa-fw fa-times text-danger"></i></button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                @endforeach
                            </div>



                            <!-- Nút thêm ảnh, bị vô hiệu hóa nếu đã đủ 3 ảnh -->
                            <button type="button" class="btn btn-sm btn-alt-secondary add-image mb-4">
                                <i class="fa fa-plus"></i> Thêm ảnh
                            </button>

                            <div class="mb-5">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Cập nhật</button>
                                <a href="{{ route('admin.banners.index') }}" class="btn btn-sm btn-alt-secondary">
                                    <i class="fa fa-arrow-left"></i> Quay lại
                                </a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="removed_image_ids" id="removed_image_ids" value="">
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const positionField = document.getElementById('position-field');
        const positionSelect = document.getElementById('position');
        const imageFields = document.getElementById('image-fields');
        const addImageButton = document.querySelector('.add-image');

        function togglePositionField() {
            if (typeSelect.value === 'sub') {
                positionField.style.display = 'block';
                positionSelect.setAttribute('required', 'required');
            } else {
                positionField.style.display = 'none';
                positionSelect.removeAttribute('required');
            }
        }

        typeSelect.addEventListener('change', togglePositionField);

        // Sự kiện cho nút xóa ảnh từ DB
        document.querySelectorAll('.remove-image_db').forEach(button => {
            button.addEventListener('click', function() {
                const imageRow = button.closest('.image-row');
                imageRow.remove(); // Xóa dòng ảnh

                checkImageLimit(); // Kiểm tra lại số lượng ảnh sau khi xóa
            });
        });

        addImageButton.addEventListener('click', function() {
            let newField = document.createElement('div');
            newField.classList.add('row', 'mb-3');
            newField.innerHTML = `
                <div class="col">
                    <label class="form-label">Tải ảnh:</label>
                    <div class="input-group mb-3">
                        <input type="file" name="images[]" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <label class="form-label">Liên kết:</label>
                    <div class="input-group mb-3">
                        <input type="text" name="link[]" class="form-control" placeholder="Nhập vào liên kết">
                        <button type="button" class="btn btn-alt remove-image"><i class="fa fa-fw fa-times text-danger"></i></button>
                    </div>
                </div>
            `;
            imageFields.appendChild(newField);

            newField.querySelector('.remove-image').addEventListener('click', function() {
                newField.remove();
                checkImageLimit(); // Kiểm tra lại số lượng ảnh sau khi xóa
            });

            // Kiểm tra số lượng ảnh sau khi thêm
            checkImageLimit();
        });

        function checkImageLimit() {
            const imageRows = document.querySelectorAll('#image-fields .row'); // Lấy tất cả các dòng ảnh
            if (imageRows.length >= 3) {
                addImageButton.disabled = true; // Disable thêm ảnh nếu đã đủ 3
            } else {
                addImageButton.disabled = false; // Bật lại nếu chưa đủ
            }
        }

        checkImageLimit(); // Kiểm tra ngay khi load trang
    });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logic cho các nút xóa ảnh đã upload
            const removeImageButtons = document.querySelectorAll('.remove-image_db');
            const removedImageIds = []; // Mảng lưu trữ ID của ảnh đã bị xóa
            const removedImageIdsInput = document.getElementById('removed_image_ids'); // Lấy input ẩn

            removeImageButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const imageRow = this.closest('.image-row'); // Tìm dòng ảnh gần nhất

                    if (imageRow) {
                        const imageId = imageRow.getAttribute('data-id'); // Lấy ID ảnh

                        // Ẩn dòng ảnh
                        imageRow.style.display = 'none';

                        // Thêm ID ảnh vào mảng để gửi đi
                        if (!removedImageIds.includes(imageId)) {
                            removedImageIds.push(imageId); // Kiểm tra không thêm trùng
                        }

                        // Cập nhật giá trị của input ẩn
                        removedImageIdsInput.value = JSON.stringify(removedImageIds);
                    } else {
                        console.error("Không tìm thấy dòng ảnh.");
                    }
                });
            });

            // Thêm logic để gửi mảng removedImageIds khi gửi form
            const form = document.querySelector('form');
            form.addEventListener('submit', function() {
                removedImageIdsInput.value = JSON.stringify(
                removedImageIds); // Cập nhật một lần nữa trước khi gửi
            });
        });
    </script>
@endsection
