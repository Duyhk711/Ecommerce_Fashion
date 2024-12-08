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

        #discount_value_container {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: max-height 0.5s ease, opacity 0.5s ease;
        }

        #discount_value_container.show {
            max-height: 150px;
            opacity: 1;
        }

        .required-label::after {
            content: " *";
            color: red;
        }
    </style>

    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Thêm mới Voucher</h3>
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
                <form action="{{ route('admin.vouchers.store') }}" method="POST" class="w-75" id="voucherForm">
                    @csrf
                    @if ($errors->has('general'))
                        <div class="alert alert-danger">
                            {{ $errors->first('general') }}
                        </div>
                    @endif
                    <input type="hidden" name="is_active" value="0">
                    <div class="form-group mb-3">
                        <label for="code" class="required-label">Mã Voucher</label>
                        <input type="text" name="code" class="form-control" id="code"
                            placeholder="Nhập mã voucher" value="{{ old('code') }}" required>
                        @if ($errors->has('code'))
                            <span class="text-danger">{{ $errors->first('code') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="discount_type" class="required-label">Kiểu giảm giá</label>
                        <select name="discount_type" class="form-control" id="discount_type" required>
                            <option value="" disabled selected>Chọn kiểu giảm giá</option>
                            <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Giảm
                                theo phần trăm</option>
                            <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Số tiền cố định
                            </option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="minimum_order_value" class="required-label">Giá trị đơn hàng tối thiểu</label>
                        <input type="number" name="minimum_order_value" class="form-control" id="minimum_order_value"
                            placeholder="Nhập giá trị tối thiểu" value="{{ old('minimum_order_value') }}" min="0">
                        <span id="minimum_order_value_error" class="error-message"></span>
                    </div>

                    <div id="discount_value_container" class="form-group mb-3">
                        <label for="discount_value" class="required-label">Giá trị giảm</label>
                        <input type="number" name="discount_value" class="form-control" id="discount_value"
                            placeholder="Nhập giá trị giảm" value="{{ old('discount_value') }}" min="1">
                        <span id="discount_value_error" class="error-message"></span>
                    </div>

                    <div class="form-group mb-3">
                        <label for="quantity" class="required-label">Số lượng</label>
                        <input type="number" name="quantity" class="form-control" id="quantity"
                            placeholder="Nhập số lượng" value="{{ old('quantity') }}" min="0" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="usage_limit" class="required-label">Giới hạn số lượng dùng cho 1 khách hàng:</label>
                        <input type="number" name="usage_limit" class="form-control" id="usage_limit"
                            placeholder="Nhập giới hạn số lượng dùng" value="{{ old('usage_limit') }}" min="1">
                        @if ($errors->has('usage_limit'))
                            <span class="text-danger">{{ $errors->first('usage_limit') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Mô tả</label>
                        <textarea name="description" class="form-control" id="description" rows="4" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date" class="required-label">Ngày bắt đầu</label>
                                <input type="datetime-local" name="start_date" class="form-control" id="start_date"
                                    value="{{ old('start_date') ? old('start_date') : now()->format('Y-m-d\TH:i') }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date" class="required-label">Ngày kết thúc</label>
                                <input type="datetime-local" name="end_date" class="form-control" id="end_date"
                                    value="{{ old('end_date') }}" required>
                                @if ($errors->has('end_date'))
                                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mb-3" id="submitButton"
                        data-original-text="Lưu">Lưu</button>

                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleDiscountValueField() {
            var discountValueContainer = document.getElementById('discount_value_container');
            var discountValueField = document.getElementById('discount_value');
            var minimumOrderValueField = document.getElementById('minimum_order_value');
            var discountType = document.getElementById('discount_type').value;
            var discountValueError = document.getElementById('discount_value_error');

            // Xóa thông báo lỗi cũ
            discountValueError.innerHTML = '';

            // Hiển thị trường discount_value nếu giá trị minimum_order_value lớn hơn 0
            if (minimumOrderValueField.value > 0) {
                discountValueContainer.classList.add('show');
            } else {
                discountValueContainer.classList.remove('show');
            }
        }

        function validateDiscountValue() {
            var discountValueField = document.getElementById('discount_value');
            var discountValue = parseFloat(discountValueField.value);
            var minimumOrderValue = parseFloat(document.getElementById('minimum_order_value').value);
            var discountType = document.getElementById('discount_type').value;
            var discountValueError = document.getElementById('discount_value_error');

            // Xóa thông báo lỗi cũ
            discountValueError.innerHTML = '';

            // Kiểm tra nếu giá trị giảm lớn hơn giá trị đơn hàng tối thiểu
            if (minimumOrderValue > 0 && discountValue > minimumOrderValue) {
                discountValueError.innerHTML =
                    '<span style="color: red;">Giá trị giảm không thể lớn hơn giá trị đơn hàng tối thiểu.</span>';
            }

            // Kiểm tra loại giảm giá là phần trăm và giá trị giảm lớn hơn 100%
            if (discountType === 'percentage' && discountValue > 100) {
                discountValueError.innerHTML = '<span style="color: red;">Giảm giá phần trăm tối đa là 100%.</span>';
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
