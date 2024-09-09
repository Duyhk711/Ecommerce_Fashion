@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Thêm mới danh mục</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.catalogues.index') }}" style="color: inherit;">Danh mục</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm mới danh mục</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="content">
    <div class="block block-rounded">
        <div class="block-content">
    <form action="{{ route('admin.catalogues.store') }}" method="POST">
        @csrf
        <h2 class="content-heading pt-0">Thêm mới danh mục</h2>
        <div class="mb-3">
            <label for="parent_id" class="form-label">Danh Mục Cha</label>
            <select name="parent_id" id="parent_id" class="form-select">
                <option value="">Chọn Danh Mục Cha</option>
                @foreach($parentCatalogues as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{old('name')}}"> 
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" readonly value="{{old('slug')}}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
        </div>

        {{-- <div class="mb-3">
            <label for="is_active" class="form-label">Kích Hoạt</label>
            <input type="checkbox" name="is_active" id="is_active" value="1" checked>
        </div> --}}

        <div class="block-options mb-5">
            <button type="submit" class="btn btn-outline-primary me-2">Tạo mới</button>
            <a href="{{route('admin.catalogues.index')}}"  class="btn btn-alt-secondary" >
              <i class="fa fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </form>
</div>
</div>
</div>
    <script>
        document.getElementById('name').addEventListener('input', function() {
            const name = this.value;
            const slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
            document.getElementById('slug').value = slug;
        });
    </script>
@endsection
