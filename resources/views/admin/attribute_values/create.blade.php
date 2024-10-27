@extends('layouts.backend')

@section('title')
    Thêm mới giá trị
@endsection
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

        .btn-red {
            color: red !important;
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
                            <div class="row justify-content-center mb-4">
                                <div class="col-10">
                                    <label class="form-label" for="attribute_id_0">Thuộc Tính</label>
                                    <select name="attribute_id[]" class="form-select attribute-select" id="attribute_id_0"
                                        onchange="toggleColorPicker(0)" required>
                                        <option value="" disabled selected>Chọn Thuộc Tính</option>
                                        @foreach ($attributes as $attribute)
                                            <option value="{{ $attribute->id }}" data-type="{{ $attribute->slug }}">
                                                {{ $attribute->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-center values-container" id="values-container-0">
                                <!-- Chỗ để thêm giá trị của thuộc tính -->
                            </div>

                            <!-- Thêm giá trị khác -->
                            <div class="ms-7">
                                <button type="button" class="btn btn-sm btn-alt-secondary mb-4" onclick="addValue(0)"><i
                                        class="fa fa-plus"></i>Thêm Giá Trị Khác</button>
                            </div>

                            <hr>
                        </div>
                    </div>

                    <!-- Thêm thuộc tính khác -->
                    <div class="">
                        <button type="button" class="btn btn-sm btn-alt-secondary mb-4" id="add-attribute-group"> <i
                                class="fa fa-plus"></i>Thêm Thuộc Tính Khác</button>
                    </div>

                    <!-- Tạo mới -->
                    <div class="block-options mb-5 text-center">
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
        let attributeIndex = 1; // Biến đếm cho số lượng thuộc tính đã thêm
        let selectedAttributes = []; // Mảng lưu trữ các thuộc tính đã chọn

        // Hàm để hiển thị hoặc ẩn input chọn mã màu nếu thuộc tính là 'Color'
        function toggleColorPicker(index) {
    const selectElement = document.getElementById(`attribute_id_${index}`);
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const type = selectedOption.getAttribute('data-type');

    const valuesContainer = document.getElementById(`values-container-${index}`);
    valuesContainer.innerHTML = ''; // Xóa các giá trị đã nhập trước đó

    if (type === 'color') {
        valuesContainer.innerHTML += `
            <div class="row mb-3 value-row justify-content-center">
                <div class="col-7">
                    <label for="" class="form-label">Nhập giá trị</label>
                    <input type="text" name="value[]" class="form-control" placeholder="Nhập giá trị" required>
                </div>
                <div class="col-2">
                     <label for="" class="form-label">Chọn mã màu</label>
                    <input type="color" name="color_code[]" class="form-control" style="width: 60px;" required>
                </div>
                <div class="col-1  text-center">
                    <button type="button" class="btn btn-alt btn-red mt-2" onclick="removeValue(this)">x</button>
                </div>
            </div>
        `;
    } else {
        valuesContainer.innerHTML += `
            <div class="row mb-3 value-row justify-content-center">
                <div class="col-9">
                     <label for="" class="form-label">Nhập giá trị</label>
                    <input type="text" name="value[]" class="form-control" placeholder="Nhập giá trị" required>
                </div>
                <input type="hidden" name="color_code[]" value="null"> <!-- Set color_code to null -->
                <div class="col-1 text-center">
                    <button type="button" class="btn btn-alt btn-red mt-2" onclick="removeValue(this)">x</button>
                </div>
            </div>
        `;
        updateAttributeOptions();
    }
}


        // Hàm để xóa một giá trị
        function removeValue(button) {
            // Xóa ô nhập giá trị khi nhấn nút x
            const valueRow = button.closest('.value-row');
            valueRow.remove();
        }

        // Hàm để cập nhật các thuộc tính có thể chọn dựa trên các thuộc tính đã chọn
        function updateAttributeOptions() {
            const attributeSelects = document.querySelectorAll('.attribute-select');
            const selectedAttributeValues = selectedAttributes.filter(attribute => attribute); // Loại bỏ các giá trị rỗng

            attributeSelects.forEach((select, index) => {
                const currentSelected = select.value;
                [...select.options].forEach(option => {
                    if (selectedAttributeValues.includes(option.value) && option.value !==
                        currentSelected) {
                        option.disabled = true; // Nếu đã chọn thuộc tính này ở nơi khác, disable nó
                    } else {
                        option.disabled = false; // Cho phép chọn lại nếu nó chưa được chọn
                    }
                });
            });
        }

        // Hàm để thêm một nhóm giá trị cho thuộc tính
        function addValue(index) {
    const valuesContainer = document.getElementById(`values-container-${index}`);
    const selectElement = document.getElementById(`attribute_id_${index}`); // Lấy thuộc tính đã chọn
    const attributeId = selectElement.value; // Lấy id của thuộc tính

    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const type = selectedOption.getAttribute('data-type'); // Lấy loại thuộc tính (color/size)

    if (type === 'color') {
        // Nếu thuộc tính là màu sắc, thêm value và color_code
        valuesContainer.insertAdjacentHTML('beforeend', `
            <div class="row mb-3 value-row justify-content-center">
                <div class="col-7">
                    <input type="text" name="value[]" class="form-control" placeholder="Nhập giá trị" required>
                </div>
                <div class="col-2">
                    <input type="color" name="color_code[]" class="form-control" style="width: 60px;" required>
                </div>
                <input type="hidden" name="attribute_id[]" value="${attributeId}"> <!-- Gán attribute_id -->
                <div class="col-1 text-center">
                    <button type="button" class="btn btn-alt btn-red mt-2" onclick="removeValue(this)">x</button>
                </div>
            </div>
        `);
    } else {
        // Nếu thuộc tính không phải màu sắc (ví dụ: size), thêm value và gán color_code là null
        valuesContainer.insertAdjacentHTML('beforeend', `
            <div class="row mb-3 value-row justify-content-center">
                <div class="col-9">
                    <input type="text" name="value[]" class="form-control" placeholder="Nhập giá trị" required>
                </div>
                <input type="hidden" name="color_code[]" value="null"> <!-- Set color_code to null -->
                <input type="hidden" name="attribute_id[]" value="${attributeId}"> <!-- Gán attribute_id -->
                <div class="col-1 text-center">
                    <button type="button" class="btn btn-alt btn-red mt-2" onclick="removeValue(this)">x</button>
                </div>
            </div>
        `);
    }
}




        // Hàm để thêm nhóm thuộc tính mới và ẩn nút ngay sau khi được nhấn
        // Hàm để thêm nhóm thuộc tính mới
        function addAttributeGroup() {
            const container = document.getElementById('attribute-values-container');
            const newGroup = document.createElement('div');
            newGroup.classList.add('attribute-value-group');
            newGroup.setAttribute('data-index', attributeIndex);
            newGroup.setAttribute('id', `attribute-group-${attributeIndex}`);

            newGroup.innerHTML = `
        <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
                <label class="form-label" for="attribute_id_${attributeIndex}">Thuộc Tính</label>
                <select name="attribute_id[]" class="form-select attribute-select" id="attribute_id_${attributeIndex}"
                    onchange="toggleColorPicker(${attributeIndex})" required>
                    <option value="" disabled selected>Chọn Thuộc Tính</option>
                    @foreach ($attributes as $attribute)
                        <option value="{{ $attribute->id }}" data-type="{{ $attribute->slug }}">
                            {{ $attribute->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row justify-content-center values-container" id="values-container-${attributeIndex}">
            <!-- Chỗ để thêm giá trị của thuộc tính -->
        </div>

        <div class="ms-7">
            <button type="button" class="btn btn-sm btn-alt-secondary mb-4" onclick="addValue(${attributeIndex})"><i class="fa fa-plus"></i> Thêm Giá Trị Khác</button>
        </div>

        <div class="col text-end">
            <button type="button" class="btn btn-alt btn-red mb-4" onclick="removeAttributeGroup(${attributeIndex})">x</button>
        </div>

        <hr>
    `;

            container.appendChild(newGroup);
            attributeIndex++; // Tăng chỉ số khi thêm nhóm mới
            document.getElementById('add-attribute-group').style.display = 'none';
        }

        function removeAttributeGroup(index) {
            const group = document.getElementById(`attribute-group-${index}`);
            group.remove();
            selectedAttributes.splice(index, 1); // Xóa thuộc tính đã chọn khỏi mảng
            updateAttributeOptions(); // Cập nhật lại các lựa chọn thuộc tính
        }

        // Gán sự kiện cho nút thêm thuộc tính
        document.getElementById('add-attribute-group').addEventListener('click', addAttributeGroup);
    </script>
@endsection
