@extends('layouts.backend')

@section('css')
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection

@section('content')
<!--  Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách Banners</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.attributes.index') }}" style="color: inherit;">Banners</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách Banners</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Danh sách banner chính</h3>
            <div class="block-options">
                <div class="block-options-item">
                    <a href="{{ route('admin.banners.create') }}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>

        <div class="block-content">
            {{-- Main Banners --}}
            <table class="table table-hover align-middle table-striped  js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th class="d-none d-sm-table-cell">Mô tả</th>
                        <th class="d-none d-sm-table-cell">Hình ảnh</th>
                        <th class="d-none d-sm-table-cell">Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners->where('type', 'main') as $banner)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="d-none d-sm-table-cell">{{ $banner->description }}</td>
                        <td>
                            @foreach ($banner->images as $image)
                                <img src="{{ asset('storage/' . $image->image) }}" alt="Banner Image" width="100">
                            @endforeach
                        </td>
                        <td>
                            @if ($banner->is_active)
                                <span class="badge bg-success">Hoạt động</span>
                            @else
                                <span class="badge bg-danger">Không hoạt động</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <div class="btn-group">
                                <!-- ACTIVATE -->
                                @if (!$banner->is_active)
                                <form action="{{ route('admin.banners.activate', $banner->id) }}" method="POST" style="display:inline;" class="form-activate">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-alt-success" data-bs-toggle="tooltip" title="Activate">
                                        <i class="fa fa-fw fa-check"></i>
                                    </button>
                                </form>
                                @endif

                                <!-- EDIT -->
                                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" style="display:inline;" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
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
    <hr>
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Danh sách banner phụ</h3>
            <div class="block-options">
                <div class="block-options-item">
                    <a href="{{ route('admin.banners.create') }}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>

        <div class="block-content">
            <table class="table table-hover align-middle table-striped js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Mô tả</th>
                        <th>Vị trí</th>
                        <th>Hình ảnh</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners->where('type', 'sub') as  $banner)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="d-none d-sm-table-cell">{{ $banner->description }}</td>
                        <td class="d-none d-sm-table-cell">{{ $banner->position }}</td>
                        <td>
                            @foreach ($banner->images as $image)
                                <img src="{{ asset('storage/' . $image->image) }}" alt="Banner Image" width="100">
                            @endforeach
                        </td>
                        <td>
                            @if ($banner->is_active)
                                <span class="badge bg-success">Hoạt động</span>
                            @else
                                <span class="badge bg-danger">Không hoạt động</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <!-- ACTIVATE -->
                                @if (!$banner->is_active)
                                <form action="{{ route('admin.banners.activate', $banner->id) }}" method="POST" style="display:inline;" class="form-activate">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-alt-success" data-bs-toggle="tooltip" title="Activate">
                                        <i class="fa fa-fw fa-check"></i>
                                    </button>
                                </form>
                                @endif

                                <!-- EDIT -->
                                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" style="display:inline;" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
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
