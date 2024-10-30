@extends('layouts.backend')

@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
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
                    <div class="block-options-item">
                        <a href="{{ route('admin.vouchers.create') }}" class="btn btn-sm btn-alt-secondary"
                            data-bs-toggle="tooltip" title="Add">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="block-content">
                <table class="table table-hover align-middle table-striped js-dataTable-full">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã</th>
                            {{-- <th>Kiểu</th> --}}
                            <th>Giá trị</th>
                            <th>Giá trị đơn hàng tối thiểu</th>
                            <th>Số lượng</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            {{-- <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th> --}}
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vouchers as $voucher)
                            <tr>
                                <td class="fs-sm">{{ $loop->iteration }}</td>
                                <td>{{ $voucher->code }}</td>
                                {{-- <td>{{ $voucher->discount_type }}</td> --}}
                                <td>
                                    @if($voucher->discount_type == 'fixed')
                                        {{ number_format($voucher->discount_value, 3, '.') }} ₫
                                    @else
                                        {{ $voucher->discount_value }} %
                                    @endif
                                </td>
                                <td>{{ number_format($voucher->minimum_order_value * 1000, 0, '.', ',') }} ₫</td>
                                <td>{{ $voucher->quantity }}</td>
                                <td>{{ $voucher->description }}</td>
                                <td>
                                    @if ($voucher->is_active)
                                    <span class="text-success">
                                        <i class="fa fa-check-circle text-success" data-bs-toggle="tooltip" title="Hoạt động"></i>
                                    </span>
                                    @else
                                    <span class="text-danger">
                                        <i class="fa fa-ban text-danger"data-bs-toggle="tooltip" title="Không hoạt động"></i>
                                    </span>
                                    @endif
                                </td>

                                <!-- Sử dụng Carbon format để hiển thị datetime -->
                                {{-- <td>{{ \Carbon\Carbon::parse($voucher->start_date)->format('d/m/Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y H:i') }}</td> --}}

                                <td class="text-center">
                                    <div class="btn-group">
                                        <!-- ACTIVATE -->
                                        @if (!$voucher->is_active)
                                            <form action="{{ route('admin.vouchers.activate', $voucher->id) }}" method="POST"
                                                style="display:inline;" class="form-activate">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-alt-success"
                                                    data-bs-toggle="tooltip" title="Kích hoạt">
                                                    <i class="fa fa-fw fa-check"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{route('admin.vouchers.deactivate',$voucher->id)}}" method="POST"
                                                style="display:inline;" class="form-deactivate">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-alt-danger"
                                                    data-bs-toggle="tooltip" title="Huỷ kích hoạt">
                                                    <i class="fa-solid fa-power-off"></i>
                                                </button>
                                            </form>
                                        @endif

                                        <!-- EDIT -->
                                        <a href="{{ route('admin.vouchers.edit', $voucher->id) }}"
                                            class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Sửa">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <!-- DELETE -->
                                        <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST"
                                            style="display:inline;" class="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-alt-secondary"
                                                data-bs-toggle="tooltip" title="Xóa">
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
