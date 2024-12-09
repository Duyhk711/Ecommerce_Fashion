@extends('layouts.backend')

@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách vai trò</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Người dùng</li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách vai trò</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    <!-- Page Content -->
    <div class="content">
        <div class="d-flex justify-content-between ">
            <div class="block block-rounded" style="width: 35%; height: 250px">
                <div class="block-content">
                    <form action="{{ route('admin.users.roles.store') }}" method="POST">
                        @csrf
                        <h2 class="content-heading pt-0">Thêm vai trò</h2>
                        <!-- Tên Danh Mục -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên vai trò</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Nút tạo mới và quay lại -->
                        <div class="block-options text-center mt-4">
                            <button type="submit" class="btn btn-outline-primary me-2">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="block block-rounded" style="width: 60%">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Danh sách vai trò</h3>
                    {{-- <div class="block-options">
                    <div class="block-options-item">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-alt-secondary"
                            data-bs-toggle="tooltip" title="Add">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div> --}}
                </div>
                <div class="block-content block-content-full">
                    <!-- Table with data -->
                    <table id="productTable" class="table align-middle js-dataTable-full">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 100px;">
                                    #
                                </th>
                                <th>Têm</th>
                                <th class="text-center" style="width: 100px;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $r)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="fw-semibold">
                                        <a href="be_pages_generic_profile.html">{{ $r->name }}</a>
                                    </td>
                                    <td class="text-left">
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip"
                                                title="Sửa vai trò" href="{{ route('admin.users.roles.edit', $r) }}">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </a>
                                            <a class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip"
                                                title="Chỉ định quyền"
                                                href="{{ route('admin.users.roles.permission', $r) }}">
                                                <i class="fa fa-fw fa-gear"></i>
                                            </a>
                                            @if ($r->name != 'admin')
                                                <form action="{{ route('admin.users.roles.delete', $r) }}" method="POST"
                                                    class="form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-alt-secondary"
                                                        data-bs-toggle="tooltip" title="Xóa">
                                                        <i class="fa fa-fw fa-times text-danger"></i>
                                                    </button>
                                                </form>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    <!-- END Page Content -->
@endsection
@section('js')
    <!-- Page JS Plugins -->
    <script src="{{ asset('admin/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    {{-- <script src="{{ asset('admin/js/dashmix.app.min.js') }}"></script>  --}}

    <!-- Page JS Code -->
    @vite(['resources/js/pages/datatables.js'])

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
@endsection
