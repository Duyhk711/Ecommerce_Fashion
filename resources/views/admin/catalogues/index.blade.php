@extends('layouts.backend')

@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection

@section('content')
    <!--  Hero -->
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách Danh Mục</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.catalogues.index') }}" style="color: inherit;">Danh Mục</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách Danh Mục</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Danh sách danh mục chính</h3>
                <div class="block-options">
                    @can('Thêm mới danh mục')
                        <div class="block-options-item">
                            <a href="{{ route('admin.catalogues.create') }}" class="btn btn-sm btn-alt-secondary"
                                data-bs-toggle="tooltip" title="Add">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    @endcan
                </div>
            </div>

            <div class="block-content">
                {{-- Main Catalogues --}}
                <table class="table table-hover align-middle  js-catalogue-table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">STT</th>
                            <th>Tên Danh Mục</th>
                            <th>Slug</th>
                            <th>Mô tả</th>
                            <th>Ảnh</th>
                            <th class="d-none d-sm-table-cell">Trạng thái</th>
                            @if (Auth::user()->can('Kích hoạt danh mục') || Auth::user()->can('Chỉnh sửa danh mục'))
                                <th class="text-center">Hành động</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($catalogues->where('parent_id', null) as $catalogue)
                            <tr>
                                <td class="text-center">
                                    <a href="javascript:void(0);" class="toggle-children" data-id="{{ $catalogue->id }}">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $catalogue->name }}</td>
                                <td>{{ $catalogue->slug }}</td>
                                <td>{{ $catalogue->description }}</td>
                                <td>
                                    @if ($catalogue->cover)
                                        <img src="{{ asset('storage/' . $catalogue->cover) }}" alt="{{ $catalogue->name }}"
                                            style="width: 100px; height: auto;">
                                    @else
                                        <span>—</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($catalogue->is_active)
                                        <span class="badge bg-success">Hoạt động</span>
                                    @else
                                        <span class="badge bg-danger">Không hoạt động</span>
                                    @endif
                                </td>
                                @if (Auth::user()->can('Kích hoạt danh mục') || Auth::user()->can('Chỉnh sửa danh mục'))
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @can('Kích hoạt danh mục')
                                                @if ($catalogue->is_active)
                                                    <form action="{{ route('admin.catalogues.deactivate', $catalogue->id) }}"
                                                        method="POST" style="display:inline;" class="form-activate">
                                                        @csrf

                                                        <button type="submit" class="btn  btn-sm btn-alt-danger"
                                                            style="height: 30px" data-bs-toggle="tooltip" title="Activate">
                                                            <i class="fa-solid fa-power-off"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.catalogues.activate', $catalogue) }}"
                                                        method="POST" style="display:inline;" class="form-activate">
                                                        @csrf

                                                        <button type="submit" class="btn btn-sm btn-alt-success"
                                                            style="height: 30px" data-bs-toggle="tooltip" title="Activate">
                                                            <i class="fa fa-fw fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endcan
                                            @can('Chỉnh sửa danh mục')
                                                <a href="{{ route('admin.catalogues.edit', $catalogue->id) }}"class="btn mx-1 rounded-1 me-1 btn-sm btn-alt-secondary"
                                                    style="height: 30px" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil-alt mt-1"></i>
                                                </a>
                                            @endcan



                                            {{-- <form action="{{ route('admin.catalogues.destroy', $catalogue->id) }}"
                                            method="POST" style="display:inline;" class="form-delete"
                                            onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-alt-secondary" style="height: 30px"
                                                data-bs-toggle="tooltip" title="Delete">
                                                <i class="fa fa-fw fa-times text-danger rounded-1"></i>
                                            </button>
                                        </form> --}}
                                        </div>
                                    </td>
                                @endif
                            </tr>

                            @if ($catalogue->children->count())
                                @foreach ($catalogue->children as $child)
                                    <tr class="child-row child-of-{{ $catalogue->id }}" style="display:none;">
                                        <td class="text-center"></td>
                                        <td>— {{ $child->name }}</td>
                                        <td>{{ $child->slug }}</td>
                                        <td>{{ $child->description }}</td>
                                        <td>
                                            @if ($child->cover)
                                                <img src="{{ asset('storage/' . $child->cover) }}"
                                                    alt="{{ $child->name }}" style="width: 100px; height: auto;">
                                            @else
                                                <span>—</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($child->is_active)
                                                <span class="badge bg-success">Hoạt động</span>
                                            @else
                                                <span class="badge bg-danger">Không hoạt động</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                @if ($child->is_active)
                                                    <form action="{{ route('admin.catalogues.deactivate', $child->id) }}"
                                                        method="POST" style="display:inline;" class="form-activate">
                                                        @csrf

                                                        <button type="submit" class="btn btn-sm btn-alt-danger"
                                                            data-bs-toggle="tooltip" title="Deactivate">
                                                            <i class="fa-solid fa-power-off"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.catalogues.activate', $child->id) }}"
                                                        method="POST" style="display:inline;" class="form-activate">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-alt-success"
                                                            data-bs-toggle="tooltip" title="Activate">
                                                            <i class="fa fa-fw fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                <a href="{{ route('admin.catalogues.edit', $child) }}"
                                                    class="btn btn-sm btn-alt-secondary mx-1 " style="height: 30px">
                                                    <i class="fa fa-pencil-alt mt-1"></i>
                                                </a>

                                                {{-- <form action="{{ route('admin.catalogues.destroy', $child->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-alt-secondary">
                                                        <i class="fa fa-fw fa-times text-danger"></i>
                                                    </button>
                                                </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggles = document.querySelectorAll('.toggle-children');

        toggles.forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                const catalogueId = this.getAttribute('data-id');
                const childRows = document.querySelectorAll(`.child-of-${catalogueId}`);

                // Hiển thị/Ẩn danh mục con
                childRows.forEach(function(row) {
                    row.style.display = (row.style.display === 'none' || row.style
                        .display === '') ? 'table-row' : 'none';
                });

                // Thay đổi icon từ + sang - khi mở
                const icon = this.querySelector('i');
                if (icon.classList.contains('fa-plus')) {
                    icon.classList.remove('fa-plus');
                    icon.classList.add('fa-minus');
                } else {
                    icon.classList.remove('fa-minus');
                    icon.classList.add('fa-plus');
                }
            });
        });
    });
</script>
@section('js')
    <!-- Page JS Plugins -->
    <script src="{{ asset('admin/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
    {{-- <script src="{{ asset('admin/js/dashmix.app.min.js') }}"></script>  --}}
    @vite(['resources/js/pages/datatables.js'])
@endsection
