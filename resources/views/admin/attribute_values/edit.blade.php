@extends('layouts.backend')

@section('title')
Cập nhật giá trị
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Giá trị thuộc tính</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.attributes.index') }}" style="color: inherit;">Giá trị thuộc tính</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Cập nhật giá trị</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    <div class="block block-rounded">
        <div class="block-content">
            <form action="{{ route('admin.attribute_values.update', $attributeValue) }}" method="POST">
                @csrf
                @method('PUT')
                <h2 class="content-heading pt-0">Cập nhật giá trị</h2>

                <div class="row">
                    <div class="col-lg-12 col-xl-8 offset-xl-2">

                        <!-- Thuộc Tính -->
                        <div class="mb-4">
                            <label class="form-label" for="attribute_id">Thuộc Tính</label>
                            <select id="attribute_id" name="attribute_id" class="form-select @error('attribute_id') is-invalid @enderror" required>
                                @foreach($attributes as $attribute)
                                    <option value="{{ $attribute->id }}" {{ $attribute->id == $attributeValue->attribute_id ? 'selected' : '' }}>
                                        {{ $attribute->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('attribute_id')
                                <div class="text-danger mt-2" id="attribute_id-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Giá Trị -->
                        <div class="mb-4">
                            <label class="form-label" for="value">Giá Trị</label>
                            <input type="text" id="value" name="value" class="form-control @error('value') is-invalid @enderror" value="{{ old('value', $attributeValue->value) }}" placeholder="Nhập giá trị" required>
                            @error('value')
                                <div class="text-danger mt-2" id="value-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nút Cập Nhật -->
                        <div class="block-options mb-5">
                            <button type="submit" class="btn btn-outline-primary me-2">Cập Nhật</button>
                            <a href="{{route('admin.attribute_values.index')}}"  class="btn btn-alt-secondary" >
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
