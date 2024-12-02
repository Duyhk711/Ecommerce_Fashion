@extends('layouts.backend')
@section('title')
    Cập nhật sản phẩm
@endsection
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- image css -->
    {{-- <link rel="stylesheet" href="{{ asset('admin/css/products/image-form.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('admin/css/products/form-edit.css') }}">

    <style>
       .custom-file2 {
    position: absolute; /* Hoặc relative, tùy thuộc vào bố cục */
    width: 100px;
    height: 70px; /* Tự động chiếm toàn bộ kích thước cha */
    opacity: 0; /* Ẩn hoàn toàn input file */
    cursor: pointer; /* Thay đổi con trỏ khi di chuột */
    margin: 0; /* Xóa khoảng cách không cần thiết */
}
.custom-file2 input[type="file"]{
    width: 100px !important;
    height: 70px !important; 
}
    </style>
@endsection
@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Cập nhật sản phẩm</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.products.index') }}" style="color: inherit;">Sản phẩm</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Cập nhật sản phẩm</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    <div class="content fs-sm">
        {{-- Form bắt đầu --}}
        <form id="myForm" action="{{ route('admin.products.update', $product->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="block block-rounded">
                <div class="block-content">
                    <h2 class="content-heading pt-0">Cập nhật sản phẩm</h2>
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif  --}}
                    <div class="row">
                        <!-- Cột bên trái -->
                        <div class="col-8">
                            <!-- Tên sản phẩm -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên sản phẩm<span
                                        class="text-danger">*</span>:</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" value="{{ old('name', $product->name) }}"
                                    placeholder="Nhập tên sản phẩm">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- SKU -->
                            <div class="mb-3">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" class="form-control" name="sku" id="sku"
                                    value="{{ $product->sku }}" readonly>
                            </div>

                            <!-- Giá sản phẩm -->
                            <div class="row">
                                <!-- Giá gốc -->
                                <div class="col-6 mb-3">
                                    <label for="price_regular" class="form-label">Giá gốc<span
                                            class="text-danger">*</span>:</label>
                                    <input type="number" class="form-control @error('price_regular') is-invalid @enderror"
                                        name="price_regular" id="price_regular"
                                        value="{{ old('price_regular', $product->price_regular) }}"
                                        placeholder="Nhập giá sản phẩm">
                                    @error('price_regular')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Giá khuyến mãi -->
                                <div class="col-6 mb-3">
                                    <label for="price_sale" class="form-label">Giá khuyến mãi:</label>
                                    <input type="number" class="form-control @error('price_sale') is-invalid @enderror"
                                        name="price_sale" id="price_sale"
                                        value="{{ old('price_sale', $product->price_sale) }}"
                                        placeholder="Nhập giá khuyến mãi">
                                    @error('price_sale')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Mô tả ngắn -->
                            <div class="mb-4">
                                <label for="description" class="form-label">Mô tả ngắn:</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="5" maxlength="200" placeholder="Nhập tối đa 200 ký tự...">{{ old('description', $product->description) }}</textarea>
                                <small id="char-count" class="form-text text-muted">Còn lại 200 ký tự</small>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nội dung chi tiết -->
                            <div class="mb-3">
                                <label for="editor" class="form-label">Nội dung:</label>
                                <textarea name="content" id="editor" class="form-control @error('content') is-invalid @enderror">{{ old('content', $product->content) }}</textarea>
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
                                <input type="text" class="form-control @error('material') is-invalid @enderror"
                                    name="material" id="materialInput" value="{{ old('material', $product->material) }}"
                                    placeholder="Chất liệu sản phẩm">
                                @error('material')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Danh mục -->
                            <div class="row form-group mb-3">
                                <label class="form-label" for="catalogue-select">Danh mục<span
                                        class="text-danger">*</span>:</label>
                                <select class="form-select @error('catalogue-select') is-invalid @enderror"
                                    id="catalogue-select" name="catalogue_id">
                                    <option value="">Chọn danh mục</option>
                                    @foreach ($catalogues as $catalogue)
                                        <option value="{{ $catalogue->id }}"
                                            {{ $product->catalogue_id == $catalogue->id ? 'selected' : '' }}>
                                            {{ $catalogue->name }}</option>
                                    @endforeach
                                </select>
                                @error('catalogue-select')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Các thuộc tính sản phẩm -->
                            <div class="mb-4">
                                <label class="form-label">Trạng thái sản phẩm</label>
                                <div class="row">
                                    <!-- Dòng 1 -->
                                    <div class="d-flex justify-content-between">
                                        <!-- Is active -->
                                        <input type="hidden" name="is_active" value="0">
                                        <div class="form-check form-switch form-check-inline col-md">
                                            <input class="form-check-input" type="checkbox" id="is_active"
                                                name="is_active" value="1"
                                                {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>

                                        <!-- Is new -->
                                        <input type="hidden" name="is_new" value="0">
                                        <div class="form-check form-switch form-check-inline col-md">
                                            <input class="form-check-input" type="checkbox" id="is_new"
                                                name="is_new" value="1"
                                                {{ old('is_new', $product->is_new) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_new">New</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <!-- Dòng 2 -->
                                    <div class="d-flex justify-content-between">
                                        <!-- Is hot deal -->
                                        <input type="hidden" name="is_hot_deal" value="0">
                                        <div class="form-check form-switch form-check-inline col-md">
                                            <input class="form-check-input" type="checkbox" id="is_hot_deal"
                                                name="is_hot_deal" value="1"
                                                {{ old('is_hot_deal', $product->is_hot_deal) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_hot_deal">Hot deal</label>
                                        </div>

                                        <!-- Show home -->
                                        <input type="hidden" name="is_show_home" value="0">
                                        <div class="form-check form-switch form-check-inline col-md">
                                            <input class="form-check-input" type="checkbox" id="is_show_home"
                                                name="is_show_home" value="1"
                                                {{ old('is_show_home', $product->is_show_home) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_show_home">Show home</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Nút tải ảnh chính -->
                            <div class="form-group image-preview" id="main-image-preview">
                                <label class="form-label">Tải lên ảnh chính<span class="text-danger">*</span>:</label>
                                <div class="custom-file">
                                    <input type="file" name="img_thumbnail" class="form-control-file"
                                        id="main-image-input">
                                    <label class="custom-file-label" for="main-image-input"></label>
                                </div>
                                <div id="main-image-container"></div> <!-- Hiển thị ảnh chính -->
                            </div>

                            <!-- Tải lên ảnh phụ -->
                            <div class="form-group image-preview" id="sub-images-preview">
                                <label class="form-label">Tải lên ảnh phụ<span class="text-danger">*</span>:</label>
                                <div class="custom-file">
                                    <input type="file" name="images[]" class="form-control-file"
                                        id="sub-images-input">
                                    <label class="custom-file-label" for="sub-images-input"></label>
                                    <input type="hidden" id="deleted-images" name="deleted_images" value="[]">
                                </div>
                                <div id="sub-images-container">

                                </div> <!-- Hiển thị các ảnh phụ -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="block block-rounded">
                <div class="block-content">
                    <div class="row">
                        <div class="col-12">
                            <h5>Thuộc tính sản phẩm<span class="text-danger">*</span></h5>
                            <div id="attributes-section" class="mb-3"></div>

                            <button type="button" id="add-attribute-btn" class="btn btn-sm btn-alt button-css mb-3"><i
                                    class="fa fa-plus"></i>Thêm thuộc tính</button>

                            <!-- Biến thể -->


                            <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
                                <h5 class="d-inline">Danh sách biến thể</h5>
                                <div></div> <!-- Tạo khoảng trống để căn chỉnh -->

                                <div class=" fake-dropdown">
                                    <button class="btn btn-sm btn-alt-secondary toggle-dropdown p-2" type="button">
                                        Chỉnh sửa hàng loạt<i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- Nội dung sổ xuống, sẽ được hiển thị khi nhấn vào nút -->
                            <div class=" dropdown-content" style="display: none;">
                                <div class="row">
                                    <div class="col-md-2">
                                        {{-- <label for="apply_to">Áp dụng cho</label> --}}
                                        <select id="apply_to" class="form-select">
                                            <option value="all">Tất cả</option>
                                            <option value="new">Biến thể mới</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" id="bulk_price" class="form-control input-hover"
                                            placeholder="Giá bán lẻ">
                                        <span class="error-message text-danger" id="error-bulk-price"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" id="bulk_price_sale" class="form-control input-hover"
                                            placeholder="Giá khuyến mãi">
                                        <span class="error-message text-danger" id="error-bulk-price-sale"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" id="bulk_stock" class="form-control input-hover"
                                            placeholder="Số lượng">
                                        <span class="error-message text-danger" id="error-bulk-stock"></span>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" id="apply-bulk-edit"
                                            class="btn btn-sm btn-alt-secondary w-100 p-2">Áp dụng</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 mb-3">
                                <button type="button" id="generate-variants-btn"
                                    class="btn btn-sm btn-alt button-css mb-3"><i class="fa fa-plus"></i>Tạo biến
                                    thể</button>
                            </div>
                            <!-- Danh sách biến thể dưới dạng bảng -->
                            <table class="table table-hover variant-table">
                                <thead>
                                    <tr>
                                        <th>Kích cỡ</th>
                                        <th>Màu sắc</th>
                                        <th>Giá gốc<span class="text-danger">*</span></th>
                                        <th>Giá sale<span class="text-danger">*</span></th>
                                        <th>Số lượng<span class="text-danger">*</span></th>
                                        <th>SKU</th>
                                        <th>Ảnh<span class="text-danger">*</span></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="variant-container">
                                    <!-- Hiển thị các biến thể đã có trong DB -->
                                    <div id="deleted-variants-container"></div>
                                    @foreach ($product->variants as $variant)
                                        <tr class="variant variant-existing" data-size="{{ $variant->size }}"
                                            data-color="{{ $variant->color }}" data-variant-id="{{ $variant->id }}">
                                            <input type="hidden" name="variant_ids[]" value="{{ $variant->id }}">
                                            <td>{{ $variant->size }}</td>
                                            <td>{{ $variant->color }}</td>
                                            <td>
                                                <input type="number" name="variant_prices[]" class="form-control"
                                                    value="{{ $variant->price_regular }}" required>
                                                <span class="error-message text-danger"
                                                    id="error-variant-price-{{ $variant->id }}"></span>
                                            </td>

                                            <td>
                                                <input type="number" name="variant_sale_prices[]" class="form-control"
                                                    value="{{ $variant->price_sale }}">
                                                <span class="error-message text-danger"
                                                    id="error-variant-sale-price-{{ $variant->id }}"></span>
                                            </td>
                                            <td>
                                                <input type="number" name="variant_stocks[]" class="form-control"
                                                    value="{{ $variant->stock }}" required>
                                                <span class="error-message text-danger"
                                                    id="error-variant-stock-{{ $variant->id }}"></span>
                                            </td>
                                            <td><input type="text" name="variant_skus[]" class="form-control"
                                                    value="{{ $variant->sku }}" readonly></td>
                                            <td>
                                                <input type="file" name="variant_images[]" class="form-control-file"
                                                    style="width: 100px;">
                                                {{-- <label class="custom-file-label" for="variant-image-input"></label> --}}
                                                <img src="{{ Storage::url($variant->image) }}" class="img-preview"
                                                    alt="Preview" style="width: 50px; height: 50px; object-fit: cover;">
                                            </td>
                                            <td class="variant-actions">
                                                <button type="button" class="delete-variant"
                                                    data-variant-id="{{ $variant->id }}">
                                                    <i class="fa fa-fw fa-times text-danger"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- <button type="submit" class="btn btn-success">Lưu sản phẩm</button> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn">
                <button type="submit" class="btn btn-outline-primary mb-3">Cập nhật sản phẩm</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Nhúng Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

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

    {{-- DESCRIPTIONS EDITOR --}}
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

    {{-- SELECT2 ATTRIBUTE --}}
    <script>
        $(document).ready(function() {
            // Biến chứa danh sách các thuộc tính đã được sử dụng và các giá trị của chúng
            const usedAttributes = @json($usedAttributes);
            const attributes = @json($attributes); // Danh sách thuộc tính từ server

            // Khởi tạo Select2 cho các thuộc tính
            function initSelect2() {
                $('.select2-tags').select2({
                    tags: true,
                    placeholder: 'Chọn hoặc nhập giá trị',
                    allowClear: true,
                    tokenSeparators: [',', ' ']
                });
            }

            let selectedAttributes = new Set();

            // Hàm hiển thị các thuộc tính đã được sử dụng
            function loadUsedAttributes() {
                const attributeSection = $('#attributes-section');
                let attributeCount = 0;

                // Lặp qua từng thuộc tính đã được sử dụng
                for (const [attributeId, valueIds] of Object.entries(usedAttributes)) {
                    const attribute = attributes.find(attr => attr.id == attributeId);

                    if (!attribute) {
                        continue; // Nếu thuộc tính không tồn tại trong danh sách attributes, bỏ qua
                    }

                    // Tạo các option giá trị cho thuộc tính
                    const valueOptions = attribute.values.map(val => {
                        const isSelected = valueIds.includes(val.id) ? 'selected' : '';
                        return `<option value="${val.id}" ${isSelected}>${val.value}</option>`;
                    }).join('');

                    // Thêm thuộc tính vào giao diện
                    let attributeSelect = `
                <div class="row form-group attribute-group position-relative mt-3 p-3" style="background-color: #f5f5f5">
                    <!-- Label và Select cho Thuộc tính -->
                    <div class="col-12">
                        <label for="attributes_${attributeCount}">Thuộc tính</label>
                        <select class="form-control attribute-select" name="attribute_ids[]" data-index="${attributeCount}" required>
                            <option value="${attribute.id}" selected>${attribute.name}</option>
                        </select>
                    </div>

                    <!-- Label và Select cho Giá trị -->
                    <div class="col-12 form-group mt-2 value-section">
                        <label for="values_${attributeCount}">Giá trị</label>
                        <select name="values[${attributeCount}][]" class="form-control select2-tags" multiple="multiple">
                            ${valueOptions}
                        </select>
                    </div>

                    <!-- Nút xóa được đặt lên góc phải -->
                    <span class="remove-attribute-btn position-absolute" style="top: 0; right: 0 !important; cursor: pointer; font-size: 20px; color: red;">&times;</span>
                </div>
            `;

                    attributeSection.append(attributeSelect);
                    selectedAttributes.add(parseInt(attribute.id)); // Đánh dấu thuộc tính đã được chọn
                    attributeCount++;
                }

                initSelect2(); // Khởi tạo lại Select2 cho các thuộc tính đã thêm
            }

            // Gọi hàm để load các thuộc tính đã được sử dụng khi trang tải
            $(document).ready(function() {
                loadUsedAttributes();
            });

            // Thêm thuộc tính động khi nhấn nút "Thêm thuộc tính"
            $('#add-attribute-btn').on('click', function() {
                const attributeSection = $('#attributes-section');
                const attributeCount = $('.attribute-select').length;

                if (attributeCount >= 50) {
                    alert('Bạn không thể tạo quá 50 biến thể.');
                    return;
                }

                const attributeOptions = attributes.map(attr => {
                    return selectedAttributes.has(attr.id) ? '' :
                        `<option value="${attr.id}">${attr.name}</option>`;
                }).join('');

                let attributeSelect = `
            <div class="row form-group attribute-group position-relative mt-3 p-3" style="background-color: #f5f5f5">
                <!-- Label và Select cho Thuộc tính -->
                <div class="col-12">
                    <label for="attributes_${attributeCount}">Thuộc tính</label>
                    <select class="form-control attribute-select" name="attribute_ids[]" data-index="${attributeCount}" required>
                        <option value="">Chọn thuộc tính</option>
                        ${attributeOptions}
                    </select>
                </div>

                <!-- Label và Select cho Giá trị -->
                <div class="col-12 form-group mt-2 value-section">
                    <label for="values_${attributeCount}">Giá trị</label>
                    <select name="values[${attributeCount}][]" class="form-control select2-tags" multiple="multiple"></select>
                </div>

                <!-- Nút xóa được đặt lên góc phải -->
                <span class="remove-attribute-btn position-absolute" style="top: 0; right: 0 !important; cursor: pointer; font-size: 20px; color: red;">&times;</span>
            </div>
        `;

                attributeSection.append(attributeSelect);
                initSelect2(); // Khởi tạo lại Select2 cho các thuộc tính mới
            });

            // Khi chọn thuộc tính, hiển thị các giá trị thuộc tính
            $(document).on('change', '.attribute-select', function() {
                const attributeId = $(this).val();
                const index = $(this).data('index');
                const valueSection = $(this).closest('.attribute-group').find('.value-section select');

                if (!attributeId) {
                    return;
                }

                const attribute = attributes.find(attr => attr.id == attributeId);
                const valueOptions = attribute.values.map(val =>
                    `<option value="${val.id}">${val.value}</option>`).join('');
                valueSection.html(valueOptions);

                selectedAttributes.add(parseInt(attributeId)); // Đánh dấu thuộc tính đã chọn

                // Disable attribute select after selection
                $(this).prop('disabled', true);
            });

            // Xóa thuộc tính
            $(document).on('click', '.remove-attribute-btn', function() {
                const attributeGroup = $(this).closest('.attribute-group');
                const attributeId = attributeGroup.find('.attribute-select').val();

                // Loại bỏ thuộc tính khỏi danh sách các thuộc tính đã chọn
                selectedAttributes.delete(parseInt(attributeId));

                // Xóa nhóm thuộc tính
                attributeGroup.remove();
            });

            // Tạo tổ hợp biến thể khi nhấn nút "Tạo biến thể"
            $(document).ready(function() {
                const existingVariants = new Set(); // Sử dụng Set để lưu trữ tổ hợp không trùng lặp

                // Khi trang được tải, lưu các biến thể đã có từ DB vào Set
                $('.variant-existing').each(function() {
                    const size = $(this).data('size'); // Lấy giá trị kích cỡ từ dữ liệu HTML
                    const color = $(this).data('color'); // Lấy giá trị màu sắc từ dữ liệu HTML

                    // Luôn sắp xếp `size` và `color` theo thứ tự chữ cái
                    const sortedCombination = [size, color].sort().join(
                        ','); // Sắp xếp và tạo tổ hợp
                    existingVariants.add(sortedCombination); // Thêm tổ hợp vào Set để kiểm tra
                    console.log(`Tổ hợp từ DB: ${sortedCombination}`);
                });

                // Tạo tổ hợp biến thể khi nhấn nút "Tạo biến thể"
                $('#generate-variants-btn').on('click', function() {
                    const variantsContainer = $('#variant-container');
                    let attributesData = [];

                    // Lấy thuộc tính đã chọn
                    $('.attribute-group').each(function() {
                        const attributeId = $(this).find('.attribute-select').val();
                        const values = $(this).find('.select2-tags').val();
                        if (values.length > 0) {
                            attributesData.push({
                                attributeId,
                                values
                            });
                        }
                    });

                    if (attributesData.length === 0) {
                        alert('Vui lòng chọn ít nhất một thuộc tính và giá trị.');
                        return;
                    }

                    // Tính toán tổng số tổ hợp
                    let totalCombinations = attributesData.reduce((total, attr) => total * attr
                        .values.length, 1);

                    // Kiểm tra giới hạn 50 biến thể
                    if (totalCombinations > 50) {
                        const confirmContinue = confirm(
                            'Số lượng biến thể vượt quá giới hạn cho phép (tối đa 50 biến thể mỗi lần). Bạn có muốn chỉ tạo 50 biến thể không?'
                            );
                        if (!confirmContinue) {
                            return; // Hủy tạo biến thể nếu người dùng không đồng ý
                        }
                    }

                    let combinations = generateCombinations(attributesData.map(attr => attr
                        .values));

                    // Tạo biến thể từ tổ hợp giá trị
                    let variantIndex2 = $('.variant').length; // Lấy số lượng biến thể hiện có

                    combinations.forEach((combination) => {
                        // Lấy giá trị của kích cỡ và màu sắc từ tổ hợp
                        const size = getAttributeValueName(attributesData[0].attributeId,
                            combination[0]);
                        const color = getAttributeValueName(attributesData[1].attributeId,
                            combination[1]);

                        // Luôn sắp xếp `size` và `color` theo thứ tự chữ cái
                        const currentCombination = [size, color].sort().join(
                            ','); // Sắp xếp và tạo tổ hợp

                        // Kiểm tra xem tổ hợp này đã tồn tại chưa (cả từ DB và các biến thể mới)
                        if (existingVariants.has(currentCombination)) {
                            console.log(`Tổ hợp ${currentCombination} đã tồn tại, bỏ qua.`);
                            return; // Nếu tổ hợp đã tồn tại, không tạo mới
                        }

                        // Nếu không tồn tại, thêm biến thể mới vào danh sách
                        console.log(`Tổ hợp ${currentCombination} chưa tồn tại, thêm mới.`);
                        existingVariants.add(
                            currentCombination); // Thêm tổ hợp vào Set để tránh tạo lại

                        const sku =
                            `PRD-${Math.random().toString(36).substring(2, 10).toUpperCase()}`; // Tạo SKU ngẫu nhiên

                        // Hiển thị các giá trị thuộc tính đã được chọn (kích cỡ và màu sắc)
                        let variantHtml = `
                <tr class="variant variant-new" data-size="${size}" data-color="${color}">
                   <td>${size}</td>
                    <td>${color}</td>
                    <td><input type="number" name="new_variant_prices[]" class="form-control variant-input" required>  <span class="error-message text-danger"></span></td>
                    <td><input type="number" name="new_variant_sale_prices[]" class="form-control variant-input">  <span class="error-message text-danger"></span></td>
                    <td><input type="number" name="new_variant_stocks[]" class="form-control variant-input" required>  <span class="error-message text-danger"></span></td>
                    <td><input type="text" name="new_variant_skus[]" class="form-control variant-input" value="${sku}" readonly></td>
                    <td>
                        <div class="custom-file2">
                            <input type="file" name="new_variant_images[]" class=" variant-image-input" >
                        </div>
                        <div id="variant-image-container">
                            <img src="" class="img-preview" alt="" style="width: 50px; height: 50px; object-fit: cover;">
                        </div>
                    </td>
                    <td class="variant-actions">
                        <button type="button" class="delete-variant"> <i class="fa fa-fw fa-times text-danger"></i></button>
                    </td>
                </tr>
            `;

                        // Thêm biến thể mới vào cuối danh sách biến thể
                        variantsContainer.append(variantHtml);

                        // Lưu thông tin thuộc tính của từng biến thể
                        combination.forEach((valueId, attrIndex) => {
                            const attributeId = attributesData[attrIndex]
                                .attributeId;
                            const variantIndex2 = 0;
                            $(`<input type="hidden" name="new_values[${variantIndex2}][${attrIndex}][attribute_id]" value="${attributeId}">`)
                                .appendTo(variantsContainer);
                            $(`<input type="hidden" name="new_values[${variantIndex2}][${attrIndex}][attribute_value_id]" value="${valueId}">`)
                                .appendTo(variantsContainer);
                        });

                        variantIndex2++; // Tăng chỉ số cho biến thể tiếp theo
                    });
                });
            });

            // Hàm tạo tổ hợp các giá trị thuộc tính
            function generateCombinations(valuesArray, prefix = []) {
                if (!valuesArray.length) {
                    return [prefix];
                }

                let combinations = [];
                let firstArray = valuesArray[0];
                let restArrays = valuesArray.slice(1);

                firstArray.forEach(value => {
                    combinations = combinations.concat(generateCombinations(restArrays, [...prefix,
                        value
                    ]));
                });

                return combinations;
            }

            // Lấy tên giá trị thuộc tính
            function getAttributeValueName(attributeId, valueId) {
                const attribute = attributes.find(attr => attr.id == attributeId);
                if (attribute) {
                    const value = attribute.values.find(val => val.id == valueId);
                    return value ? value.value : '';
                }
                return '';
            }


            // Hiển thị preview ảnh khi người dùng chọn ảnh
            // $(document).on('change', 'input[name="new_variant_images[]"]', function(e) {
            //     const reader = new FileReader();
            //     const imgPreview = $(this).closest('td').find('.img-preview');

            //     reader.onload = function(e) {
            //         imgPreview.attr('src', e.target.result);
            //     }

            //     reader.readAsDataURL(this.files[0]);
            // });
            $(document).on('change', '.variant-image-input', function(e) {
                const reader = new FileReader();
                const imgPreview = $(this).closest('td').find('.img-preview'); // Tìm ảnh trong cùng td

                reader.onload = function(e) {
                    imgPreview.attr('src', e.target.result); // Gán ảnh mới
                }

                if (this.files && this.files[0]) {
                    reader.readAsDataURL(this.files[0]);
                }
            });
            // Chỉnh sửa hàng loạt giá và số lượng
            // Sự kiện khi nhấn vào nút để mở dropdown
            $('.toggle-dropdown').on('click', function() {
                // Hiển thị hoặc ẩn nội dung bên dưới
                $('.dropdown-content').slideToggle();
            });


            // Xóa biến thể
            $(document).ready(function() {
                // Khi nhấn nút "Xóa" của một biến thể
                $(document).on('click', '.delete-variant', function() {
                    const variantId = $(this).closest('tr').data(
                        'variant-id'); // Lấy ID của biến thể

                    if (variantId) {
                        // Tạo input ẩn cho biến thể bị xóa nếu chưa tồn tại
                        if (!$(`input[name="deleted_variant_ids[]"][value="${variantId}"]`)
                            .length) {
                            $('<input>').attr({
                                type: 'hidden',
                                name: 'deleted_variant_ids[]', // Tạo input name dạng mảng
                                value: variantId
                            }).appendTo('form'); // Append input vào form
                        }
                    }

                    // Xóa hàng tương ứng khỏi bảng
                    $(this).closest('tr').remove();
                });
            });
        });
    </script>

    {{-- TEXT EDITOR --}}
    <script>
        $(document).ready(function() {
            $('#editor').summernote({
                height: 300
            });
        });
    </script>

    {{-- PREVIEW IMAGE --}}
    @php
        $subImages = $product->images
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'url' => Storage::url($item->image),
                ];
            })
            ->toArray();
    @endphp

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // URL của ảnh chính
            const mainImageURL = "{{ Storage::url($product->img_thumbnail) }}";
            // Mảng chứa các URL và ID của ảnh phụ
            const subImagesURLs = @json($subImages);

            // Các container để hiển thị ảnh
            const mainImageContainer = document.getElementById('main-image-container');
            const subImagesContainer = document.getElementById('sub-images-container');

            const deletedImages = []; // Mảng lưu các ID của ảnh phụ bị xóa
            const deletedImagesInput = document.getElementById('deleted-images');
            // Hàm hiển thị ảnh chính từ DB
            function loadMainImageFromDB(url, container) {
                if (url) {
                    container.innerHTML = ''; // Xóa nội dung cũ nếu có
                    const imgElement = document.createElement('img');
                    imgElement.src = url;
                    imgElement.style.maxWidth = '200px'; // Kích thước ảnh chính
                    container.appendChild(imgElement);
                }
            }

            // Hàm hiển thị nhiều ảnh phụ từ DB
            function loadSubImagesFromDB(images, container) {
                container.innerHTML = ''; // Xóa ảnh cũ trong container nếu có
                images.forEach(image => {
                    const imgWrapper = document.createElement('div');
                    imgWrapper.classList.add('img-wrapper');

                    const imgElement = document.createElement('img');
                    imgElement.src = image.url; // URL của ảnh
                    imgElement.style.maxWidth = '100px'; // Kích thước ảnh phụ

                    // Nút xóa
                    const deleteBtn = document.createElement('button');
                    deleteBtn.classList.add('delete-btn');
                    deleteBtn.textContent = 'x';
                    deleteBtn.addEventListener('click', function() {
                        imgWrapper.remove(); // Xóa ảnh khỏi giao diện
                        deletedImages.push(image.id); // Thêm ID của ảnh vào mảng deletedImages
                        deletedImagesInput.value = JSON.stringify(deletedImages);
                    });

                    imgWrapper.appendChild(imgElement);
                    imgWrapper.appendChild(deleteBtn);
                    container.appendChild(imgWrapper);
                });
            }

            // Hiển thị ảnh từ DB khi trang load
            loadMainImageFromDB(mainImageURL, mainImageContainer);
            loadSubImagesFromDB(subImagesURLs, subImagesContainer);

            // Xử lý khi tải ảnh chính từ input
            const mainImageInput = document.getElementById('main-image-input');
            mainImageInput.addEventListener('change', function() {
                displayImage(this, mainImageContainer);

            });

            // Hàm hiển thị ảnh chính khi chọn từ input
            function displayImage(input, container) {
                container.innerHTML = ''; // Xóa nội dung cũ nếu có
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.style.maxWidth = '200px'; // Kích thước ảnh chính
                        container.appendChild(imgElement);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Hiển thị nhiều ảnh phụ mà không làm mất ảnh trước đó
            const subImagesInput = document.getElementById('sub-images-input');
            const subImageList = []; // Danh sách lưu các ảnh phụ đã chọn
            subImagesInput.addEventListener('change', function() {
                displayMultipleImages(this, subImagesContainer, subImageList);
            });

            });

            // Hàm hiển thị nhiều ảnh phụ khi chọn từ input
            function displayMultipleImages(input, container, imageList) {
                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgWrapper = document.createElement('div');
                        imgWrapper.classList.add('img-wrapper');

                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.style.maxWidth = '100px'; // Kích thước ảnh phụ

                        // Nút xóa
                        const deleteBtn = document.createElement('button');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.textContent = 'x';
                        deleteBtn.addEventListener('click', function() {
                            imgWrapper.remove(); // Xóa ảnh khi nhấn nút xóa
                        });

                        imgWrapper.appendChild(imgElement);
                        imgWrapper.appendChild(deleteBtn);
                        container.appendChild(imgWrapper);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    </script>

    {{-- validate variant --}}
    <script src="{{ asset('admin/js/ui/validations/product-edit.js') }}"></script>

@endsection

