@extends('layouts.backend')

@section('content')
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Thêm mới Voucher</h3>
                <div class="block-options">
                    <div class="block-options-item">
                        <a href="{{ route('admin.vouchers.index') }}" class="btn btn-sm btn-alt-secondary"
                            data-bs-toggle="tooltip" title="Quay lại danh sách">
                            <i class="fa fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
            </div>
            <div class="block-content">

                <form action="{{ route('admin.vouchers.store') }}" method="POST">
    @csrf
    <div class="form-group mb-3">
        <label for="code">Mã Voucher</label>
        <input type="text" name="code" class="form-control" id="code"
            placeholder="Nhập mã voucher" value="{{ old('code') }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="discount_type">Kiểu giảm giá</label>
        <select name="discount_type" class="form-control" id="discount_type" required>
            <option value="" disabled selected>Chọn kiểu giảm giá</option>
            <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Phần trăm</option>
            <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Số tiền cố định</option>
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="discount_value">Giá trị giảm</label>
        <input type="number" name="discount_value" class="form-control" id="discount_value"
            placeholder="Nhập giá trị giảm" value="{{ old('discount_value') }}" min="1" required>
    </div>

    <div class="form-group mb-3">
        <label for="start_date">Ngày bắt đầu</label>
        <input type="datetime-local" name="start_date" class="form-control" id="start_date"
            value="{{ old('start_date') ? old('start_date') : now()->format('Y-m-d\TH:i') }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="end_date">Ngày kết thúc</label>
        <input type="datetime-local" name="end_date" class="form-control" id="end_date"
            value="{{ old('end_date') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Lưu</button>
</form>

            </div>
        </div>
    </div>
@endsection
