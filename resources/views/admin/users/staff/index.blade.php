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
                    <div class="block-options-item">
                        <a href="{{ route('admin.users.staffs.create') }}" class="btn btn-sm btn-alt-secondary"
                            data-bs-toggle="tooltip" title="Add">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
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
                                <td>
                                    @if ($user->is_active == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Deactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-alt-secondary me-1" data-bs-toggle="tooltip" title="Sửa"
                                            href="{{ route('admin.users.staffs.edit', $user) }}">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </a>
                                        {{-- <form action="{{ route('admin.users.active', $user) }}" method="POST"
                                            style="display:inline;" class="form-activate">
                                            @csrf

                                            <button type="submit" class="btn btn-sm btn-alt-secondary"
                                                data-bs-toggle="tooltip"
                                                title="{{ $user->is_active == 1 ? 'Deactivate' : 'Activate' }}">
                                                <i class="fa-solid fa-power-off"></i>
                                            </button>
                                        </form> --}}
                                        {{-- <a class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip"
                                            title="Quickly edit roles"
                                            href="{{ route('admin.users.staffs.edit', $user) }}">
                                            <i class="fa fa-fw fa-gear"></i>
                                        </a> --}}

                                    </div>
                                </td>
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
    <div class="modal fade" id="updateRole" tabindex="-1" aria-labelledby="updateRoleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateRoleModalLabel">Cập Nhật Trạng Thái</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateRoleForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="orderId" name="id">
                        <div class="mb-3">
                            <label for="statusSelect" class="form-label">Chọn trạng thái mới</label>
                            <select id="statusSelect" class="form-select" name="status">
                                <option value="1">Chờ xác nhận</option>
                                <option value="2">Chờ vận chuyển</option>
                                <option value="3">Đang vận chuyển</option>
                                <option value="4">Hoàn thành</option>
                                <option value="huy_don_hang">Hủy bỏ</option>
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
    <!-- Nhúng jQuery từ CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    {{-- <script src="{{ asset('admin/js/dashmix.app.min.js') }}"></script>  --}}
    <script>
        $(document).ready(function() {
            $('#productTable').DataTable();
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
