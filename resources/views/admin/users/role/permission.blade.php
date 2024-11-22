@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách các quyền</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.users.index') }}" style="color: inherit;">người dùng</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách các quyền</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
                <form action="{{ route('admin.users.roles.permission.update', $role) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <h2 class="content-heading pt-0">Vai trò: {{ $role->name }}</h2>
                    <div class="mb-3 row m-3">
                        @foreach ($permission as $per)
                            <div class="form-check form-check-inline col-3">
                                <input class="form-check-input" type="checkbox"
                                    @foreach ($permissionsOfRole as $get)
                                      @if ($get->id == $per->id)
                                        checked
                                      @endif @endforeach
                                    value="{{ $per->name }}" id="{{ $per->id }}" name="permission[]">
                                <label class="form-check-label" for="{{ $per->id }}">{{ $per->name }}</label>
                            </div>
                        @endforeach

                    </div>

                    <!-- Nút tạo mới và quay lại -->
                    <div class="block-options mb-5 text-center mt-5">
                        <button type="submit" class="btn btn-outline-primary me-2">Lưu</button>
                        <a href="{{ route('admin.users.roles') }}" class="btn btn-alt-secondary">
                            <i class="fa fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var fileImg = document.getElementById('avatar');
        var img = document.getElementById('img');
        fileImg.addEventListener('change', function(e) {
            e.preventDefault();
            img.src = URL.createObjectURL(this.files[0]);
        })
    </script>
    {{-- <script src="{{ asset('admin/js/dashmix.app.min.js') }}"></script>  --}}
@endsection
