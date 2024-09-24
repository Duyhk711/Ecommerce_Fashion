<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'ward' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'type' => 'required|in:home,office',
        ];
    }
    public function messages()
    {
        return [
            'customer_name.required' => 'Tên khách hàng là bắt buộc.',
            'customer_phone.required' => 'Số điện thoại là bắt buộc.',
            'address_line1.required' => 'Địa chỉ chính là bắt buộc.',
            'ward.required' => 'Phường/Xã là bắt buộc.',
            'district.required' => 'Quận/Huyện là bắt buộc.',
            'city.required' => 'Tỉnh/Thành phố là bắt buộc.',
            'type.required' => 'Loại địa chỉ là bắt buộc.',
            'type.in' => 'Loại địa chỉ không hợp lệ.',
        ];
    }
}
