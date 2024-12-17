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
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách nhân viên</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Người dùng</li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách nhân viên</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    <!-- Page Content -->
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Danh sách nhân viên</h3>
                <div class="block-options">
                    @role('admin')
                        <div class="block-options-item">
                            <a href="{{ route('admin.users.staffs.create') }}" class="btn btn-sm btn-alt-secondary"
                                data-bs-toggle="tooltip" title="Add">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    @endrole
                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- Table with data -->
                <table id="productTable" class="table align-middle js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">
                                <i class="far fa-user"></i>
                            </th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Vai trò</th>
                            {{-- <th>Trang thái</th> --}}
                            @role('admin')
                                <th class="text-center">Hành động</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">
                                    <img class="img-avatar img-avatar48"
                                        src="{{ $user->avatar != '' ? asset('storage/' . $user->avatar) : asset('admin/media/avatars/avatar3.jpg') }}"
                                        alt="">
                                </td>
                                <td class="fw-semibold">
                                    <a href="be_pages_generic_profile.html">{{ $user->name }}</a>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->roles->first()?->name ?? 'Không có vai trò' }}</td>
                                {{-- <td>
                                    @if ($user->is_active == 1)
                                        <span class="badge bg-success">Kích hoạt</span>
                                    @else
                                        <span class="badge bg-danger">Ngừng kích hoạt</span>
                                    @endif
                                </td> --}}
                                @role('admin')
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-alt-secondary me-1" data-bs-toggle="tooltip" title="Sửa"
                                                href="{{ route('admin.users.staffs.edit', $user) }}">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </a>
                                            {{-- <form action="{{ route('admin.users.active', $user) }}" method="POST"
                                                style="display:inline;" class="form-activate me-1">
                                                @csrf

                                                <button type="submit" class="btn btn-sm btn-alt-secondary"
                                                    data-bs-toggle="tooltip"
                                                    title="{{ $user->is_active == 1 ? 'Deactivate' : 'Activate' }}">
                                                    <i class="fa-solid fa-power-off"></i>
                                                </button>
                                            </form> --}}
                                            <button class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal"
                                                data-bs-target="#updateRole" data-id="{{ $user->id }}"
                                                data-role="{{ $user->roles->first()?->name ?? '' }}"
                                                title="Quickly edit roles">

                                                <i class="fa fa-fw fa-gear"></i>

                                            </button>
                                            {{-- <a class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip"
                                            title="Quickly edit roles"
                                            href="{{ route('admin.users.staffs.edit', $user) }}">
                                        </a> --}}

                                        </div>
                                    </td>
                                @endrole
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- END Page Content -->
@endsection
@section('modal')
    <div class="modal fade" id="updateRole" tabindex="-1" aria-labelledby="updateRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateRoleModalLabel">Cập Nhật Vai Trò</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateRoleForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="userId" name="id">
                        <div class="mb-3">
                            <label for="roleSelect" class="form-label">Chọn vai trò mới</label>
                            <select id="roleSelect" class="form-select" name="role">
                                {{-- <option value="">Chọn vai trò</option> --}}
                                @foreach ($roles as $r)
                                    <option value="{{ $r->name }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var updateRole = document.getElementById('updateRole');
            var roleSelect = document.getElementById('roleSelect');
            var submitBtn = document.querySelector('.modal-footer .btn-primary');
            var updateRoleForm = document.getElementById('updateRoleForm');

            updateRole.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var userId = button.getAttribute('data-id');
                var userRole = button.getAttribute('data-role');


                var userIdInput = document.getElementById('userId');
                userIdInput.value = userId;
                roleSelect.value = userRole;
                updateRoleForm.action = `{{ route('admin.users.staffs.quickly', ':id') }}`.replace(':id',
                    userId);

                // Disable the "Cập Nhật" button if the status is already the current one
                submitBtn.disabled = true;
            });

            // Enable the "Cập Nhật" button only if a new status is selected
            roleSelect.addEventListener('change', function() {
                var currentStatus = document.getElementById('userId').getAttribute('data-status');

                if (roleSelect.value != currentStatus) {
                    submitBtn.disabled = false;
                } else {
                    submitBtn.disabled = true;
                }
            });
        });
    </script>

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
