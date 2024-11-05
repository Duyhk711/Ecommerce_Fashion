@extends('layouts.backend')

@section('title')
    Thêm mới banner
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Thêm mới Banners</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.attributes.index') }}" style="color: inherit;">Banners</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm mới banners</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
                <h2 class="content-heading pt-0">Thêm mới banner</h2>

                <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-lg-12 col-xl-8 offset-xl-2">

                            <div class="mb-4">
                                <label class="form-label" for="type">Chọn loại banner</label>
                                <select name="type" id="type"
                                    class="form-select @error('type') is-invalid @enderror" required>
                                    <option value="">-- Chọn --</option>
                                    <option value="main" {{ old('type') == 'main' ? 'selected' : '' }}>Banner chính
                                    </option>
                                    <option value="sub" {{ old('type') == 'sub' ? 'selected' : '' }}>Banner phụ</option>
                                </select>
                                @error('type')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4" id="position-field" style="display: none;">
                                <label class="form-label" for="position">Vị trí</label>
                                <select name="position" id="position"
                                    class="form-select @error('position') is-invalid @enderror">
                                    <option value="">-- Chọn --</option>
                                    <option value="top" {{ old('position') == 'top' ? 'selected' : '' }}>Top</option>
                                    <option value="middle" {{ old('position') == 'middle' ? 'selected' : '' }}>Middle
                                    </option>
                                    <option value="bottom" {{ old('position') == 'bottom' ? 'selected' : '' }}>Bottom
                                    </option>
                                </select>
                                @error('position')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                           
                            <div id="image-fields" class="mb-4">
                                {{-- <div class="row">
                                    <div class="col">
                                        <label class="form-label">Tải ảnh:</label>
                                        <div class="input-group mb-3">
                                            <input type="file" name="images[]"
                                                class="form-control @error('images.*') is-invalid @enderror" required>

                                        </div>
                                        @error('images.*')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label class="form-label">Liên kết:</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="link[]" class="form-control"
                                                placeholder="Nhập vào liên kết">
                                        </div>
                                    </div>
                                </div> --}}
                            </div>

                            <button type="button" class="btn btn-sm btn-alt-secondary add-image mb-4"> <i class="fa fa-plus"></i> Thêm ảnh
                            </button>
                             <!-- Description -->
                             <div class="mb-4">
                                <label class="form-label" for="description">Mô tả</label>
                                <input type="text" name="description" id="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    value="{{ old('description') }}">
                                @error('description')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                           
                            <!-- Active Checkbox -->
                            {{-- <div class="mb-4 form-check">
                            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" {{ old('is_active') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div> --}}

                            <div class="mb-5">
                                <button type="submit" class="btn  btn-outline-primary me-2">Thêm mới</button>
                                <a href="{{ route('admin.banners.index') }}" class="btn  btn-alt-secondary">
                                    <i class="fa fa-arrow-left"></i> Quay lại
                                </a>
                            </div>
                        </div>
                    </div>
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

          let maxImages = 0;

          function updateMaxImages() {
              const type = typeSelect.value;
              const position = positionSelect.value;

              if (type === 'main') {
                  maxImages = 3; // Banner chính tối đa 3 ảnh
              } else if (type === 'sub') {
                  if (position === 'top') {
                      maxImages = 3; // Banner phụ top tối đa 3 ảnh
                  } else if (position === 'middle') {
                      maxImages = 1; // Banner phụ middle tối đa 1 ảnh
                  } else {
                      maxImages = 0; // Các vị trí khác không cho phép ảnh
                  }
              } else {
                  maxImages = 0; // Không có ảnh cho loại banner khác
              }
          }

          function checkImageLimit() {
              const currentImageCount = imageFields.querySelectorAll('.image-row').length;

              addImageButton.disabled = currentImageCount >= maxImages || maxImages === 0; // Tắt nút thêm nếu đã đủ ảnh
          }

          function togglePositionField() {
              if (typeSelect.value === 'sub') {
                  positionField.style.display = 'block';
                  document.getElementById('position').setAttribute('required', 'required');
              } else {
                  positionField.style.display = 'none';
                  document.getElementById('position').removeAttribute('required');
                  document.getElementById('position').value = '';
              }
              updateMaxImages(); // Cập nhật số lượng ảnh tối đa
              checkImageLimit(); // Kiểm tra số lượng ảnh hiện tại
          }

          function resetImageFields() {
              imageFields.innerHTML = ''; // Xóa tất cả các ảnh đã thêm
          }

          togglePositionField(); // Thiết lập ban đầu
          checkImageLimit(); // Kiểm tra số lượng ảnh ban đầu

          typeSelect.addEventListener('change', function() {
              resetImageFields(); // Xóa các ảnh khi thay đổi kiểu banner
              togglePositionField(); // Thay đổi kiểu banner
              updateMaxImages(); // Cập nhật giới hạn ảnh
              checkImageLimit(); // Kiểm tra số lượng ảnh sau khi thay đổi
          });

          positionSelect.addEventListener('change', function() {
              resetImageFields(); // Xóa các ảnh khi thay đổi vị trí
              updateMaxImages(); // Cập nhật giới hạn ảnh khi chọn vị trí
              checkImageLimit(); // Kiểm tra số lượng ảnh hiện tại
          });

          addImageButton.addEventListener('click', function() {
              const currentImageCount = imageFields.querySelectorAll('.image-row').length;

              if (currentImageCount >= maxImages) {
                  return; // Không thêm nếu đã đủ số lượng ảnh
              }

              let newField = document.createElement('div');
              newField.classList.add('row', 'mb-3', 'image-row'); // Thêm class image-row
              newField.innerHTML = `
                  <div class="col">
                      <label class="form-label">Tải ảnh:</label>
                      <div class="input-group mb-3">
                          <input type="file" name="images[]" class="form-control" required>
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

              checkImageLimit(); // Kiểm tra số lượng ảnh sau khi thêm
          });

          imageFields.addEventListener('click', function(e) {
              if (e.target && e.target.classList.contains('remove-image')) {
                  e.target.closest('.row').remove();
                  checkImageLimit(); // Kiểm tra lại số lượng ảnh sau khi xóa
              }
          });
      });
  </script>
@endsection
