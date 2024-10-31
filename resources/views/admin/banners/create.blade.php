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
            <h2 class="content-heading pt-0">Add New Banner</h2>

            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-12 col-xl-8 offset-xl-2">

                        <div class="mb-4">
                            <label class="form-label" for="type">Type</label>
                            <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                <option value="">-- Select Type --</option>
                                <option value="main" {{ old('type') == 'main' ? 'selected' : '' }}>Main</option>
                                <option value="sub" {{ old('type') == 'sub' ? 'selected' : '' }}>Sub</option>
                            </select>
                            @error('type')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4" id="position-field" style="display: none;">
                            <label class="form-label" for="position">Position</label>
                            <select name="position" id="position" class="form-select @error('position') is-invalid @enderror">
                                <option value="">-- Select Position --</option>
                                <option value="top" {{ old('position') == 'top' ? 'selected' : '' }}>Top</option>
                                <option value="middle" {{ old('position') == 'middle' ? 'selected' : '' }}>Middle</option>
                                <option value="bottom" {{ old('position') == 'bottom' ? 'selected' : '' }}>Bottom</option>
                            </select>
                            @error('position')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label class="form-label" for="description">Description</label>
                            <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
                            @error('description')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="image-fields" class="mb-4">
                            <label class="form-label">Upload Images:</label>
                            <div class="input-group mb-3">
                                <input type="file" name="images[]" class="form-control @error('images.*') is-invalid @enderror" required>
                                <button type="button" class="btn btn-success add-image">Add</button>
                            </div>
                            @error('images.*')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Active Checkbox -->
                        {{-- <div class="mb-4 form-check">
                            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" {{ old('is_active') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div> --}}

                        <div class="mb-5">
                            <button type="submit" class="btn btn-outline-primary">Save</button>
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


@endsection
@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('type');
    const positionField = document.getElementById('position-field');
    const positionSelect = document.getElementById('position');
    const imageFields = document.getElementById('image-fields');
    const addImageButton = document.querySelector('.add-image');
    
    let maxImages = Infinity; 
    let positionSelected = false; 

    function togglePositionField() {
        if (typeSelect.value === 'sub') {
            positionField.style.display = 'block';
            document.getElementById('position').setAttribute('required', 'required');
            updateImageLimit();
            checkImageLimit();
        } else {
            positionField.style.display = 'none';
            document.getElementById('position').removeAttribute('required');
            document.getElementById('position').value = '';
            maxImages = Infinity; 
            addImageButton.disabled = false; 
        }
    }

    function updateImageLimit() {
        const position = positionSelect.value;

        switch (position) {
            case 'top':
                maxImages = 3;
                break;
            case 'middle':
                maxImages = 0;
                break;
            case 'bottom':
                maxImages = 0;
                break;
            default:
                maxImages = Infinity;
                break;
        }
    }

    function checkImageLimit() {
        const currentImageCount = imageFields.querySelectorAll('input[type="file"]').length;

        if (currentImageCount >= maxImages && maxImages !== Infinity) {
            addImageButton.disabled = true;
        } else {
            addImageButton.disabled = false;
        }
    }

    function checkPositionSelected() {
        positionSelected = positionSelect.value !== '';
        addImageButton.disabled = typeSelect.value === 'sub' && !positionSelected;
    }

    togglePositionField();
    checkImageLimit();

    typeSelect.addEventListener('change', function() {
        togglePositionField();
        checkPositionSelected();
    });

    positionSelect.addEventListener('change', function() {
        updateImageLimit();
        checkImageLimit();
        checkPositionSelected();
    });

    addImageButton.addEventListener('click', function () {
        if (maxImages === 0) {
            return; 
        }

        let newField = document.createElement('div');
        newField.classList.add('input-group', 'mb-3');
        newField.innerHTML = `
            <input type="file" name="images[]" class="form-control" required>
            <button type="button" class="btn btn-danger remove-image">Remove</button>
        `;
        imageFields.appendChild(newField);

        newField.querySelector('.remove-image').addEventListener('click', function () {
            newField.remove();
            checkImageLimit();
        });

        checkImageLimit();
    });

    imageFields.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-image')) {
            e.target.parentElement.remove();
            checkImageLimit();
        }
    });
});
</script>
<script src="{{ asset('admin/js/dashmix.app.min.js') }}"></script> 
@endsection
