@extends('layouts.backend')

@section('content')
    <style>
        .form-control,
        select {
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .form-control:focus,
        select:focus {
            border-color: #5b9bd5;
            box-shadow: 0 0 5px rgba(91, 155, 213, 0.5);
        }

        .btn-primary {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #41729f;
            transform: scale(1.05);
        }

        .btn-primary:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }

        .alert {
            margin-bottom: 20px;
        }
    </style>

    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Sửa Voucher</h3>
                <div class="block-options">
                    <div class="block-options-item">
                        <a href="{{ route('admin.vouchers.index') }}" class="btn btn-sm btn-alt-secondary"
                            title="Quay lại danh sách">
                            <i class="fa fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
            </div>
            <div class="block-content d-flex justify-content-center">
                <form action="{{ route('admin.vouchers.update', $voucher->id) }}" method="POST" class="w-75"
                    id="voucherForm">
                    @csrf
                    @method('PUT') <!-- Thêm phương thức PUT cho sửa -->
                    <div class="form-group mb-3">
                        <label for="code">Mã Voucher <span class="text-danger">*</span></label>
                        <input type="text" name="code" class="form-control" id="code" placeholder="Mã voucher"
                            value="{{ old('code', $voucher->code) }}" readonly required>
                        @if ($errors->has('code'))
                            <span class="text-danger">{{ $errors->first('code') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="discount_type">Kiểu giảm giá <span class="text-danger">*</span></label>
                        <select name="discount_type" class="form-control" id="discount_type" required>
                            <option value="" disabled>Chọn kiểu giảm giá</option>
                            <option value="percentage"
                                {{ old('discount_type', $voucher->discount_type) == 'percentage' ? 'selected' : '' }}>Giảm theo phần trăm</option>
                            <option value="fixed"
                                {{ old('discount_type', $voucher->discount_type) == 'fixed' ? 'selected' : '' }}>Số tiền cố định</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="minimum_order_value">Giá trị đơn hàng tối thiểu <span class="text-danger">*</span></label>
                        <span class="form-text text-muted ms-3">(Giá trị nhập sẽ nhân với 1,000 đ)</span>
                        <input type="number" name="minimum_order_value" class="form-control" id="minimum_order_value"
                            placeholder="Nhập giá trị tối thiểu"
                            value="{{ old('minimum_order_value', $voucher->minimum_order_value) }}" min="0" required>
                        @if ($errors->has('minimum_order_value'))
                            <span class="text-danger">{{ $errors->first('minimum_order_value') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="discount_value">Giá trị giảm <span class="text-danger">*</span></label>
                        <span class="form-text text-muted ms-3">(Giá trị nhập sẽ nhân với 1,000 đ)</span>
                        <input type="number" name="discount_value" class="form-control" id="discount_value"
                            placeholder="Nhập giá trị giảm" value="{{ old('discount_value', $voucher->discount_value) }}" min="1" required>
                        <span id="discount_value_error" class="text-danger"></span> <!-- Hiển thị lỗi -->
                    </div>


                    <div class="form-group mb-3">
                        <label for="quantity">Số lượng <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Nhập số lượng"
                            value="{{ old('quantity', $voucher->quantity) }}" min="0" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="usage_limit">Giới hạn số lượng dùng cho 1 khách hàng <span class="text-danger">*</span></label>
                        <input type="number" name="usage_limit" class="form-control" id="usage_limit" placeholder="Nhập giới hạn số lượng dùng"
                            value="{{ old('usage_limit', $voucher->usage_limit) }}" min="1" required>
                        @if ($errors->has('usage_limit'))
                            <span class="text-danger">{{ $errors->first('usage_limit') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Mô tả</label>
                        <textarea name="description" class="form-control" id="description" rows="4" placeholder="Nhập mô tả">{{ old('description', $voucher->description) }}</textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">Ngày bắt đầu <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="start_date" class="form-control" id="start_date"
                                    value="{{ old('start_date', $voucher->start_date ? \Carbon\Carbon::parse($voucher->start_date)->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">Ngày kết thúc <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="end_date" class="form-control" id="end_date"
                                    value="{{ old('end_date', $voucher->end_date ? \Carbon\Carbon::parse($voucher->end_date)->format('Y-m-d\TH:i') : '') }}"
                                    required>
                                @if ($errors->has('end_date'))
                                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary" id="submitButton">Lưu</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validateDiscountValue() {
            var discountValueField = document.getElementById('discount_value');
            var discountValue = parseFloat(discountValueField.value);
            var minimumOrderValue = parseFloat(document.getElementById('minimum_order_value').value);
            var discountType = document.getElementById('discount_type').value;
            var discountValueError = document.getElementById('discount_value_error');

            // Xóa thông báo lỗi cũ
            discountValueError.innerHTML = '';

            // Kiểm tra loại giảm giá là phần trăm và giá trị giảm lớn hơn 100%
            if (discountType === 'percentage' && discountValue > 100) {
                discountValueError.innerHTML = '<span style="color: red;">Giảm giá phần trăm tối đa là 100%.</span>';
                return; // Kết thúc hàm nếu có lỗi
            }

            // Kiểm tra nếu giá trị giảm lớn hơn giá trị đơn hàng tối thiểu
            if (minimumOrderValue > 0 && discountValue >= minimumOrderValue) {
                discountValueError.innerHTML =
                    '<span style="color: red;">Giá trị giảm không thể lớn hơn hoặc bằng giá trị đơn hàng tối thiểu.</span>';

                return; // Kết thúc hàm nếu có lỗi
            }
        }

        document.getElementById('minimum_order_value').addEventListener('input', function() {
            toggleDiscountValueField();
            validateDiscountValue();
        });

        document.getElementById('discount_type').addEventListener('change', function() {
            toggleDiscountValueField();
            validateDiscountValue();
        });

        document.getElementById('discount_value').addEventListener('input', function() {
            validateDiscountValue();
        });

        document.addEventListener('DOMContentLoaded', function() {
            toggleDiscountValueField();
            validateDiscountValue();
        });
    </script>
@endsection
