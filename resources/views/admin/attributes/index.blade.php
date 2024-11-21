<!-- resources/views/attributes/index.blade.php -->
@extends('layouts.backend')
@section('title')
Danh sách thuộc tính
@endsection
@section('content')
<!--  Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách thuộc tính</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.attributes.index') }}" style="color: inherit;">Thuộc tính</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách thuộc tính</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Danh sách thuộc tính</h3>
            <div class="block-options">
                <div class="block-options-item">
                    <a href="{{ route('admin.attributes.create') }}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="block-content">
            <table class="table table-hover   align-middle" id="attributesTable">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Thuộc tính</th>
                        <th class="d-none d-sm-table-cell">Slug</th>
                        <th class="text-center" style="width: 100px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attributes as $attribute)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="fw-semibold"><a href="{{route('admin.attributes.edit', $attribute->id)}}">{{ $attribute->name }}</a></td>
                            <td class="d-none d-sm-table-cell">{{ $attribute->slug }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.attributes.edit', $attribute) }}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    {{-- DELETE  --}}
                                    <form action="{{ route('admin.attributes.destroy', $attribute) }}" method="POST" style="display:inline;" class="form-delete">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete" >
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
{{-- <script src="{{ asset('admin/js/dashmix.app.min.js') }}"></script>  --}}
@endsection
