<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Đảm bảo rằng request này được ủy quyền
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên thuộc tính là bắt buộc.',
            'name.string'   => 'Tên thuộc tính phải là chuỗi.',
            'name.max'      => 'Tên thuộc tính không được vượt quá 255 ký tự.',
        ];
    }
}
