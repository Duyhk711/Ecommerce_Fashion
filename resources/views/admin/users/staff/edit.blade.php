@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Chỉnh sửa người dùng</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.users.index') }}" style="color: inherit;">users</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa người dùng</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
                <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2 class="content-heading pt-0">Chỉnh sửa người dùng</h2>
                    <!-- Ảnh -->
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Ảnh đại diện</label>
                        <input type="file" name="avatar" id="avatar" class="form-control">
                        <img id="img" class="mt-2" src="{{ asset('storage/' . $user->avatar) }}" width="200px">
                    </div>
                    <!-- Tên Danh Mục -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên người dùng</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" id="phone"
                            class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Vai trò</label>
                        <select class="form-select" id="role" name="role">
                            <option selected="">Chọn vai trò</option>
                            @foreach ($roles as $r)
                                <option value="{{ $r->name }}" @if ($user_role && $user_role->name == $r->name) selected @endif>
                                    {{ $r->name }}</option>
                            @endforeach
                        </select>
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nút tạo mới và quay lại -->
                    <div class="block-options mb-5 text-center mt-5">
                        <button type="submit" class="btn btn-outline-primary me-2">Lưu</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-alt-secondary">
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
