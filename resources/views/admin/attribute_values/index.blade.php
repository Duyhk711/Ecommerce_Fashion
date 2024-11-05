@extends('layouts.backend')

@section('title')
    Danh sách giá trị
@endsection

@section('css')
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
  <!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách giá trị</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.attribute_values.index') }}" style="color: inherit;">Giá trị thuộc tính</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách giá trị</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="content">
    
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Danh sách giá trị</h3>
            <div class="block-options">
                <div class="block-options-item">
                    <a href="{{ route('admin.attribute_values.create') }}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class -->
            <table id="example" class="table table-hover align-middle table-striped  js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Thuộc tính</th>
                        <th class="d-none d-sm-table-cell">Giá trị</th>
                        <th class="text-center" style="width: 100px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attributeValues as $attributeValue)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="d-none d-sm-table-cell">{{ $attributeValue->attribute->name }}</td>
                            <td class="d-none d-sm-table-cell">{{ $attributeValue->value }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <!-- EDIT -->
                                    <a href="{{ route('admin.attribute_values.edit', $attributeValue) }}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Sửa">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    <!-- DELETE -->
                                    <form action="{{ route('admin.attribute_values.destroy', $attributeValue) }}" method="POST" style="display:inline;" class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Xóa" >
                                            <i class="fa fa-fw fa-times text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>


@endsection

@section('js')

  <!-- Page JS Plugins -->
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<script>$(document).ready(function() {
    $('#example').DataTable(); 
});</script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteBtns = document.querySelectorAll('.form-delete');

        for (const btn of deleteBtns) {
            btn.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: "Xác nhận xóa?",
                    text: "Nếu xóa bạn sẽ không thể khôi phục!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        }
    });
</script>
<script src="{{ asset('admin/js/dashmix.app.min.js') }}"></script> 
@endsection
