<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequest extends FormRequest
{

    public function authorize()
    {
        return true; // Đặt thành false nếu bạn muốn kiểm tra quyền truy cập
    }

    public function rules()
{
    return [
        'code' => 'required|string|unique:vouchers,code',
        'discount_type' => 'required|string|in:percentage,fixed',
        'discount_value' => 'required|numeric|min:1',
        'minimum_order_value' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'description' => 'required|string',
        'is_active' => 'nullable|boolean',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ];
}


    // Hàm để cung cấp các thông báo lỗi tùy chỉnh
    public function messages()
    {
        return [
            'code.required' => 'Vui lòng nhập mã voucher.',
            'code.string' => 'Mã voucher phải là chuỗi ký tự.',
            'code.max' => 'Mã voucher không được vượt quá :max ký tự.',

            'discount_type.required' => 'Vui lòng chọn kiểu giảm giá.',
            'discount_type.in' => 'Kiểu giảm giá không hợp lệ, chỉ chấp nhận "percentage" hoặc "amount".',

            'discount_value.required' => 'Vui lòng nhập giá trị giảm.',
            'discount_value.numeric' => 'Giá trị giảm phải là một số.',

            'start_date.required' => 'Vui lòng nhập ngày bắt đầu.',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',

            'end_date.required' => 'Vui lòng nhập ngày kết thúc.',
            'end_date.date' => 'Ngày kết thúc không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
        ];
    }
}
