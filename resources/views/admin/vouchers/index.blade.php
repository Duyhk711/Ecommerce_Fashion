@extends('layouts.backend')

@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
    <style>
        /* Tùy chỉnh CSS cho bảng */
        .table {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table th {
            background-color: #f8f9fa;
            /* Màu nền cho header */
            color: #495057;
            /* Màu chữ cho header */
            font-weight: bold;
        }

        .btn-group .btn {
            margin: 0 2px;
            /* Căn giữa các nút */
        }

        .text-success {
            color: #28a745 !important;
            /* Màu xanh cho trạng thái hoạt động */
        }

        .text-danger {
            color: #dc3545 !important;
            /* Màu đỏ cho trạng thái không hoạt động */
        }
    </style>
@endsection

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách Voucher</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Voucher</li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách danh mục</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Danh sách voucher</h3>
                <div class="block-options">

                    @can('Thêm mới khuyến mại')
                        <div class="block-options-item">
                            <a href="{{ route('admin.vouchers.create') }}" class="btn btn-sm btn-alt-secondary"
                                data-bs-toggle="tooltip" title="Add">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
            <div class="block-content">
                <table class="table table-hover align-middle table-striped js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">Mã</th>
                            <th class="text-center">Giá trị</th>
                            <th class="text-center">Giá trị tối thiểu</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Mô tả</th>
                            <th class="text-center">Trạng thái</th>
                            @if (Auth::user()->can('Kích hoạt khuyến mại') ||
                                    Auth::user()->can('Xóa khuyến mại') ||
                                    Auth::user()->can('Chỉnh sửa khuyến mại'))
                                <th class="text-center">Hành động</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vouchers as $voucher)
                            <tr>
                                <td class="fs-sm text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $voucher->code }}</td>
                                <td class="text-center">
                                    @if ($voucher->discount_type == 'fixed')
                                        {{ number_format($voucher->discount_value * 1000, 0, '.', '.') }} ₫
                                    @else
                                        {{ $voucher->discount_value }} %
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ number_format($voucher->minimum_order_value * 1000, 0, '.', '.') }} ₫</td>
                                <td class="text-center">{{ $voucher->quantity }}</td>
                                <td class="text-center">{{ $voucher->description }}</td>
                                <td class="text-center">
                                    @if ($voucher->is_active)
                                        <span class="text-success">
                                            <i class="fa fa-check-circle" data-bs-toggle="tooltip" title="Hoạt động"></i>
                                        </span>
                                    @else
                                        <span class="text-danger">
                                            <i class="fa fa-ban" data-bs-toggle="tooltip" title="Không hoạt động"></i>
                                        </span>
                                    @endif
                                </td>
                                @if (Auth::user()->can('Kích hoạt khuyến mại') ||
                                        Auth::user()->can('Xóa khuyến mại') ||
                                        Auth::user()->can('Chỉnh sửa khuyến mại'))
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @can('Kích hoạt khuyến mại')
                                                @if (!$voucher->is_active)
                                                    <form action="{{ route('admin.vouchers.activate', $voucher->id) }}"
                                                        method="POST" style="display:inline;" class="form-activate">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-alt-success"
                                                            data-bs-toggle="tooltip" title="Kích hoạt">
                                                            <i class="fa fa-fw fa-check"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.vouchers.deactivate', $voucher->id) }}"
                                                        method="POST" style="display:inline;" class="form-deactivate">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-alt-danger"
                                                            data-bs-toggle="tooltip" title="Huỷ kích hoạt">
                                                            <i class="fa-solid fa-power-off"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endcan
                                            @can('Chỉnh sửa khuyến mại')
                                                <a href="{{ route('admin.vouchers.edit', $voucher->id) }}"
                                                    class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip"
                                                    title="Sửa">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                            @endcan
                                            @can('Xóa khuyến mại')
                                                <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}"
                                                    method="POST" style="display:inline;" class="form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-alt-secondary"
                                                        data-bs-toggle="tooltip" title="Xóa">
                                                        <i class="fa fa-fw fa-times text-danger"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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

    <!-- Page JS Code -->
    @vite(['resources/js/pages/datatables.js'])
@endsection
