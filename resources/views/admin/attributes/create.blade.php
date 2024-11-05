@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Thêm thuộc tính</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.attributes.index') }}" style="color: inherit;">Thuộc tính</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm thuộc tính</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="content">
    <div class="block block-rounded">
        <div class="block-content">
            <form action="{{ route('admin.attributes.store') }}" method="POST">
                @csrf
                <h2 class="content-heading pt-0">Thêm mới thuộc tính</h2>

                <div class="row">
                    <div class="col-lg-12 col-xl-8 offset-xl-2">

                        <!-- Tên Attribute -->
                        <div class="mb-4">
                            <label class="form-label" for="name">Tên Attribute</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <div class="text-danger mt-2" id="name-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nút Lưu và Quay lại -->
                        <div class="block-options mb-5">
                            <button type="submit" class="btn btn-outline-primary me-2">Thêm mới</button>
                            <a href="{{route('admin.attributes.index')}}"  class="btn btn-alt-secondary" >
                              <i class="fa fa-arrow-left"></i> Quay lại
                            </a>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@section('js')
<script src="{{ asset('admin/js/dashmix.app.min.js') }}"></script> 
@endsection
@endsection
