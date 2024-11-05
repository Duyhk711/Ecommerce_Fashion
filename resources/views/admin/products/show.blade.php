@extends('layouts.backend')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center ">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách biến thể</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}" style="color: inherit;">Sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Biến thể</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content ">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Danh sách biến thể</h3>
            </div>

            <div class="block-content block-content-full">
                @if ($product->variants->count() > 0)
                    <table id="example" class="table table-hover align-middle js-dataTable-full">
                        <thead>
                            <tr>
                                <th>SKU biến thể</th>
                                <th>Giá biến thể</th>
                                <th>Giá khuyến mãi</th>
                                <th>Kho</th>
                                <th>Hình ảnh</th>
                                <th>Thuộc tính</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->variants as $variant)
                                <tr>
                                    <td class="fs-sm">{{ $variant->sku }}</td>
                                    <td class="fs-sm">{{ number_format($variant->price_regular) }}₫</td>
                                    <td class="fs-sm">{{ $variant->price_sale ? number_format($variant->price_sale) . '₫' : 'Không có' }}</td>
                                    <td class="fs-sm">{{ $variant->stock }}</td>
                                    <td class="fs-sm">
                                        <img src="{{ asset('storage/' . $variant->image) }}" alt="Hình ảnh biến thể" class="img-thumbnail" style="width: 120px; height: auto;">
                                    </td>
                                    <td class="fs-sm">
                                        @foreach ($variant->variantAttributes as $attribute)
                                            <strong>{{ $attribute->attribute->name }}:</strong> {{ $attribute->attributeValue->value }}<br>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary editVariantBtn" data-id="{{ $variant->id }}" data-bs-toggle="tooltip" title="Sửa">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>

                                             {{-- DELETE --}}
                                            <form action="{{ route('admin.variants.destroy', $variant->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa biến thể này?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-alt-secondary deleteVariantBtn" data-bs-toggle="tooltip" title="Xóa">
                                                    <i class="fa fa-fw fa-times text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Không có biến thể nào cho sản phẩm này.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal for Editing Product Variant -->
    <div class="modal fade" id="editVariantModal" tabindex="-1" aria-labelledby="editVariantModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVariantModalLabel">Chỉnh sửa biến thể</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editVariantForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="variantSku">SKU</label>
                            <input type="text" class="form-control" id="variantSku" name="sku" required>
                        </div>
                        <div class="form-group">
                            <label for="variantPriceRegular">Giá thường</label>
                            <input type="number" class="form-control" id="variantPriceRegular" name="price_regular" required>
                        </div>
                        <div class="form-group">
                            <label for="variantPriceSale">Giá khuyến mãi</label>
                            <input type="number" class="form-control" id="variantPriceSale" name="price_sale">
                        </div>
                        <div class="form-group">
                            <label for="variantStock">Kho</label>
                            <input type="number" class="form-control" id="variantStock" name="stock" required>
                        </div>
                        <div class="form-group">
                            <label for="variantImage">Hình ảnh</label>
                            <input type="file" class="form-control" id="variantImage" name="image">
                            <img id="variantCurrentImage" src="" class="img-thumbnail mt-2" style="width: 100px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Include jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#example').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                lengthMenu: [10, 25, 50, 100],
                pageLength: 10
            });

            // Event listener for edit buttons
            $('.editVariantBtn').on('click', function() {
                let variantId = $(this).data('id');
                let url = `/admin/variants/${variantId}/edit`;

                // Send AJAX request to get variant data
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        // Populate modal with variant data
                        $('#variantSku').val(data.sku);
                        $('#variantPriceRegular').val(data.price_regular);
                        $('#variantPriceSale').val(data.price_sale);
                        $('#variantStock').val(data.stock);
                        $('#variantCurrentImage').attr('src', `/storage/${data.image}`);

                        // Update form action
                        $('#editVariantForm').attr('action', `/admin/variants/${variantId}`);

                        // Show the modal
                        $('#editVariantModal').modal('show');
                    },
                    error: function() {
                        alert('Đã xảy ra lỗi khi tải dữ liệu biến thể.');
                    }
                });
            });
        });

        $('.deleteVariantBtn').on('click', function(e) {
        e.preventDefault(); // Ngăn hành động mặc định của form

        if (confirm('Bạn có chắc chắn muốn xóa biến thể này?')) {
            let form = $(this).closest('form'); // Lấy form gần nhất
            let actionUrl = form.attr('action');

            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: $('input[name="_token"]').val() // CSRF token
                },
                success: function(response) {
                    // Reload trang sau khi xóa thành công
                    window.location.reload();
                },
                error: function() {
                    alert('Đã xảy ra lỗi khi xóa biến thể.');
                }
            });
        }
    });

    </script>
    <script src="{{ asset('admin/js/dashmix.app.min.js') }}"></script> 
@endsection
