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
                            placeholder="( Lưu ý: Giá trị nhập sẽ được tự động nhân *1000 Đơn vị: VND. )" value="{{ old('minimum_order_value') }}" min="0">
                        @if ($errors->has('minimum_order_value'))
                            <span class="text-danger">{{ $errors->first('minimum_order_value') }}</span>
                        @endif

                    </div>


                    <div id="discount_value_container" class="form-group mb-3">
                        <label for="discount_value" class="required-label">Giá trị giảm</label>
                        <input type="number" name="discount_value" class="form-control" id="discount_value"
                            placeholder="Nhập giá trị giảm" value="{{ old('discount_value') }}" min="1">
                        @if ($errors->has('discount_value'))
                            <span class="text-danger">{{ $errors->first('discount_value') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="quantity" class="required-label">Số lượng</label>
                        <input type="number" name="quantity" class="form-control" id="quantity"
                            placeholder="Nhập số lượng" value="{{ old('quantity') }}" min="0" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="usage_limit" class="required-label">Giới hạn số lượng dùng</label>
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

                    <button type="submit" class="btn btn-primary mb-3" id="submitButton" data-original-text="Lưu">Lưu</button>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('voucherForm').addEventListener('submit', function(event) {
        var submitButton = document.getElementById('submitButton');
        submitButton.disabled = true;
        submitButton.setAttribute('data-original-text', submitButton.innerHTML);
        submitButton.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Đang xử lý...';
         });
        function toggleDiscountValueField() {
            var discountValueContainer = document.getElementById('discount_value_container');
            var discountValueField = document.getElementById('discount_value');
            var discountValue = parseFloat(discountValueField.value);
            var minimumOrderValue = parseFloat(document.getElementById('minimum_order_value').value);

            if (minimumOrderValue > 0 && discountValue > minimumOrderValue) {
                discountValueField.setCustomValidity('Giá trị giảm không thể lớn hơn giá trị đơn hàng tối thiểu.');
                discountValueField.reportValidity();
            } else {
                discountValueField.setCustomValidity('');
            }


            var discountType = document.getElementById('discount_type').value;
            if (discountType === 'percentage' && discountValue > 20) {
                discountValueField.setCustomValidity('Giảm giá phần trăm tối đa là 20%.');
                discountValueField.reportValidity();
            } else {
                discountValueField.setCustomValidity('');
            }
            if (minimumOrderValue > 0) {
                discountValueContainer.classList.add('show');
            } else {
                discountValueContainer.classList.remove('show');
            }
        }


        document.getElementById('minimum_order_value').addEventListener('input', function() {
            toggleDiscountValueField();
        });
        document.getElementById('discount_value').addEventListener('input', function() {
            toggleDiscountValueField();
        });
        document.addEventListener('DOMContentLoaded', function() {
            toggleDiscountValueField();
        });

        document.getElementById('voucherForm').addEventListener('submit', function(event) {
            var submitButton = document.getElementById('submitButton');
            submitButton.disabled = true;
        });
    </script>
@endsection
