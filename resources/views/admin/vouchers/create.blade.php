@extends('layouts.backend')

@section('content')
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Thêm mới Voucher</h3>
                <div class="block-options">
                    <div class="block-options-item">
                        <a href="{{ route('admin.vouchers.index') }}" class="btn btn-sm btn-alt-secondary" title="Quay lại danh sách">
                            <i class="fa fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
            </div>
            <div class="block-content d-flex justify-content-center">
                <form action="{{ route('admin.vouchers.store') }}" method="POST" class="w-75">
                    @csrf
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ __('Vui lòng kiểm tra lại thông tin bên dưới') }}
                        </div>
                    @endif

                    <div class="form-group mb-3">
                        <label for="code">Mã Voucher</label>
                        <input type="text" name="code" class="form-control" id="code" placeholder="Nhập mã voucher" value="{{ old('code') }}" required>
                        @if($errors->has('code'))
                            <span class="text-danger">{{ $errors->first('code') }}</span>
                        @endif
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
                        <input type="number" name="discount_value" class="form-control" id="discount_value" placeholder="Nhập giá trị giảm" value="{{ old('discount_value') }}" min="1" required>
                        @if($errors->has('discount_value'))
                            <span class="text-danger">{{ $errors->first('discount_value') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="minimum_order_value">Giá trị đơn hàng tối thiểu</label>
                        <input type="number" name="minimum_order_value" class="form-control" id="minimum_order_value" placeholder="Nhập giá trị tối thiểu" value="{{ old('minimum_order_value') }}" min="0">
                        @if($errors->has('minimum_order_value'))
                            <span class="text-danger">{{ $errors->first('minimum_order_value') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="quantity">Số lượng</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Nhập số lượng" value="{{ old('quantity') }}" min="0" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Mô tả</label>
                        <textarea name="description" class="form-control" id="description" rows="4" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="start_date">Ngày bắt đầu</label>
                        <input type="datetime-local" name="start_date" class="form-control" id="start_date" value="{{ old('start_date') ? old('start_date') : now()->format('Y-m-d\TH:i') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="end_date">Ngày kết thúc</label>
                        <input type="datetime-local" name="end_date" class="form-control" id="end_date" value="{{ old('end_date') }}" required>
                        @if($errors->has('end_date'))
                            <span class="text-danger">{{ $errors->first('end_date') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
