<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttributeValueRequest extends FormRequest
{
    public function rules()
    {
        return [
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required|string|max:255',
            'color_code' => 'nullable|string|size:7', // Mã màu phải có dạng hex (bao gồm #)
        ];
    }

    public function messages()
    {
        return [
            'attribute_id.required' => 'Thuộc tính là bắt buộc.',
            'attribute_id.exists' => 'Thuộc tính không tồn tại.',
            'value.required' => 'Giá trị là bắt buộc.',
            'value.string' => 'Giá trị phải là một chuỗi.',
            'value.max' => 'Giá trị không được vượt quá 255 ký tự.',
            'color_code.size' => 'Mã màu phải có định dạng hex hợp lệ.',
        ];
    }
    
    public function authorize()
    {
        return true;
    }
}

