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

            <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-12 col-xl-8 offset-xl-2">

                        <div class="mb-4">
                            <label class="form-label" for="type">Chọn loại banner</label>
                            <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                <option value="">-- Select Type --</option>
                                <option value="main" {{ old('type', $banner->type) == 'main' ? 'selected' : '' }}>Banner chính</option>
                                <option value="sub" {{ old('type', $banner->type) == 'sub' ? 'selected' : '' }}>Banner phụ</option>
                            </select>
                            @error('type')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4" id="position-field" style="display: none;">
                            <label class="form-label" for="position">Position</label>
                            <select name="position" id="position" class="form-select @error('position') is-invalid @enderror">
                                <option value="">-- Select Position --</option>
                                <option value="top" {{ old('position', $banner->position) == 'top' ? 'selected' : '' }}>Top</option>
                                <option value="middle" {{ old('position', $banner->position) == 'middle' ? 'selected' : '' }}>Middle</option>
                                <option value="bottom" {{ old('position', $banner->position) == 'bottom' ? 'selected' : '' }}>Bottom</option>
                            </select>
                            @error('position')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="link">Mô tả</label>
                            <input type="text" name="description" id="link" class="form-control @error('description') is-invalid @enderror" value="{{ old('link', $banner->link) }}">
                            @error('description')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="image-fields" class="mb-4">
                            <label class="form-label">Upload Images:</label>
                            <div class="input-group mb-3">
                                <input type="file" name="images[]" class="form-control @error('images.*') is-invalid @enderror">
                                <button type="button" class="btn btn-success add-image">Add</button>
                            </div>
                            @error('images.*')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror

                            @if($banner->images->count() > 0)
                                <label class="form-label">Existing Images:</label>
                                @foreach ($banner->images as $image)
                                <div class="input-group mb-3">
                                    <img src="{{ asset('storage/' . $image->image_url) }}" alt="Banner Image" width="100">
                                    <div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" name="remove_images[]" value="{{ $image->id }}" id="removeImage{{ $image->id }}">
                                        <label class="form-check-label text-danger" for="removeImage{{ $image->id }}">Remove</label>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>

                        {{-- <div class="mb-4 form-check">
                            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div> --}}

                        <div class="mb-5">
                            <button type="submit" class="btn btn-outline-primary">Save Changes</button>
                            <a href="{{ route('admin.banners.index') }}" class="btn btn-alt-secondary">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('type');
        const positionField = document.getElementById('position-field');

        // Function to toggle position field
        function togglePositionField() {
            if (typeSelect.value === 'sub') {
                positionField.style.display = 'block';
                document.getElementById('position').setAttribute('required', 'required');
            } else {
                positionField.style.display = 'none';
                document.getElementById('position').removeAttribute('required');
                document.getElementById('position').value = '';
            }
        }

        // Initial toggle based on current banner type
        togglePositionField();

        // Event listener for type selection
        typeSelect.addEventListener('change', togglePositionField);

        // Add Image Fields
        const imageFields = document.getElementById('image-fields');

        document.querySelector('.add-image').addEventListener('click', function () {
            let newField = document.createElement('div');
            newField.classList.add('input-group', 'mb-3');
            newField.innerHTML = `
                <input type="file" name="images[]" class="form-control">
                <button type="button" class="btn btn-danger remove-image">Remove</button>
            `;
            imageFields.appendChild(newField);

            // Add event listener to the new remove button
            newField.querySelector('.remove-image').addEventListener('click', function () {
                newField.remove();
            });
        });

        // Remove Image Fields
        imageFields.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-image')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>
@endsection
