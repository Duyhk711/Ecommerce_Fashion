@extends('layouts.backend')

@section('css')
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
  <!-- Custom CSS -->
  <style>
    .attribute-value-group {
      border: 1px solid #dee2e6;
      border-radius: 0.375rem;
      padding: 1rem;
      margin-bottom: 1rem;
      background-color: #f8f9fa;
    }

    .attribute-value-group .btn {
      margin-right: 0.5rem;
    }

    .attribute-value-group .btn-remove {
      background-color: #dc3545;
      color: #fff;
    }

    .attribute-value-group .btn-remove:hover {
      background-color: #c82333;
    }

    .attribute-value-group .btn-add {
      background-color: #007bff;
      color: #fff;
    }

    .attribute-value-group .btn-add:hover {
      background-color: #0056b3;
    }

    .btn-add-group {
      background-color: #28a745;
      color: #fff;
    }

    .btn-add-group:hover {
      background-color: #218838;
    }

    .btn-remove-value {
      background-color: #dc3545;
      color: #fff;
    }

    .btn-remove-value:hover {
      background-color: #c82333;
    }
  </style>
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Giá trị thuộc tính</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.attributes.index') }}" style="color: inherit;">Giá trị thuộc tính</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm giá trị</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    <div class="block block-rounded">
        <div class="block-content">
            <form action="{{ route('admin.attribute_values.store') }}" method="POST">
                @csrf
                <h2 class="content-heading pt-0">Thêm mới thuộc tính</h2>

                <div id="attribute-values-container">
                    <!-- Nhóm thuộc tính mặc định -->
                    <div class="attribute-value-group" data-index="0">
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <label class="form-label" for="attribute_id_0">Thuộc Tính</label>
                                <select name="attribute_id[]" class="form-select" id="attribute_id_0" onchange="toggleColorPicker(0)" required>
                                    <option value="" disabled selected>Chọn Thuộc Tính</option>
                                    @foreach($attributes as $attribute)
                                        <option value="{{ $attribute->id }}" data-type="{{ $attribute->slug }}">{{ $attribute->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" for="value_0">Giá Trị</label>
                                <input type="text" name="value[]" class="form-control" id="value_0" placeholder="Nhập giá trị" required>
                                <div id="color-picker-container-0" class="d-none" >
                                    <label for="color_code_0" class="form-label">Mã Màu</label>
                                    <input type="color" name="color_code[]" style="width: 60px" class="form-control" id="color_code_0">
                                </div>
                            </div>
                        </div>

                        <!-- Thêm giá trị khác và xóa nhóm -->
                        <div class="values-container">
                            <button type="button" class="btn btn-alt-primary mb-4" onclick="addValue(0)">Thêm Giá Trị Khác</button>
                        </div>
                        {{-- <button type="button" class="btn btn-remove mb-4" onclick="removeGroup(0)">Xóa Nhóm</button> --}}
                        <hr>
                    </div>
                </div>

                <!-- Thêm thuộc tính khác -->
                <button type="button" class="btn btn-outline-primary mb-4" id="add-attribute-group">Thêm Thuộc Tính Khác</button>

                <!-- Tạo mới -->
                <div class="block-options mb-5">
                    <button type="submit" class="btn btn-outline-primary me-2">Thêm mới</button>
                    <a href="{{ route('admin.attribute_values.index') }}" class="btn btn-alt-secondary">
                        <i class="fa fa-arrow-left"></i> Quay lại
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    let groupIndex = 1;

    function addValue(index) {
        const group = document.querySelector(`.attribute-value-group[data-index="${index}"]`);
        if (group) {
            const attributeSelect = group.querySelector(`#attribute_id_${index}`);
            const type = attributeSelect.options[attributeSelect.selectedIndex]?.getAttribute('data-type');

            // Tạo phần tử giá trị bổ sung mới
            const newValueDiv = document.createElement('div');
            newValueDiv.classList.add('col-lg-6');
            newValueDiv.innerHTML = `
                <div class="input-group mb-3">
                    <input type="text" name="value[]" class="form-control" id="value_${index}_${group.querySelectorAll('input[name^="value"]').length}" placeholder="Nhập giá trị" required>
                    <div id="color-picker-container-${index}_${group.querySelectorAll('input[name^="value"]').length}" class="${type === 'mau-sac' ? '' : 'd-none'} ms-2">
                        <label for="color_code_${index}_${group.querySelectorAll('input[name^="value"]').length}" class="form-label">Mã Màu</label>
                        <input type="color" name="color_code[]" class="form-control" id="color_code_${index}_${group.querySelectorAll('input[name^="value"]').length}">
                    </div>
                    <button type="button" class="btn btn-remove-value text-danger" onclick="removeValue(this)">X</button>
                </div>
            `;

            group.querySelector('.values-container').appendChild(newValueDiv);
        }
    }

    function removeGroup(index) {
        const group = document.querySelector(`.attribute-value-group[data-index="${index}"]`);
        if (group) {
            group.remove();
        }
    }

    function removeValue(button) {
        button.parentElement.remove();
    }

    function toggleColorPicker(index) {
        const attributeSelect = document.getElementById(`attribute_id_${index}`);
        const colorPickerContainer = document.getElementById(`color-picker-container-${index}`);
        const selectedOption = attributeSelect.options[attributeSelect.selectedIndex];
        const type = selectedOption ? selectedOption.getAttribute('data-type') : '';

        if (type === 'mau-sac') {
            colorPickerContainer.classList.remove('d-none');
        } else {
            colorPickerContainer.classList.add('d-none');
        }
    }

    document.getElementById('add-attribute-group').addEventListener('click', function() {
        const container = document.getElementById('attribute-values-container');
        const newGroup = document.createElement('div');
        newGroup.classList.add('attribute-value-group');
        newGroup.setAttribute('data-index', groupIndex);
        newGroup.innerHTML = `
            <div class="row mb-4">
                <div class="col-lg-6">
                    <label class="form-label" for="attribute_id_${groupIndex}">Thuộc Tính</label>
                    <select name="attribute_id[]" class="form-select" id="attribute_id_${groupIndex}" onchange="toggleColorPicker(${groupIndex})" required>
                        <option value="" disabled selected>Chọn Thuộc Tính</option>
                        @foreach($attributes as $attribute)
                            <option value="{{ $attribute->id }}" data-type="{{ $attribute->slug }}">{{ $attribute->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="value_${groupIndex}">Giá Trị</label>
                    <input type="text" name="value[]" class="form-control" id="value_${groupIndex}" placeholder="Nhập giá trị" required>
                    <div id="color-picker-container-${groupIndex}" class="d-none">
                        <label for="color_code_${groupIndex}" class="form-label">Mã Màu</label>
                        <input type="color" name="color_code[]" class="form-control" id="color_code_${groupIndex}">
                    </div>
                </div>
            </div>
            <div class="values-container">
                <button type="button" class="btn btn-alt-primary mb-4" onclick="addValue(${groupIndex})">Thêm Giá Trị Khác</button>
            </div>
            <button type="button" class="btn btn-alt-danger mb-4" onclick="removeGroup(${groupIndex})">Xóa Nhóm</button>
            <hr>
        `;
        container.appendChild(newGroup);
        groupIndex++;
    });
</script>
@endsection
