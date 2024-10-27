<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeValueRequest extends FormRequest
{
    public function rules()
    {
        return [
            'attribute_id' => 'required|array',  // Đảm bảo nó là mảng
            'attribute_id.*' => 'exists:attributes,id',
            'value' => 'required|array', // Đảm bảo value cũng là mảng
            'value.*' => 'string|max:255', // Kiểm tra từng phần tử trong value
            'color_code' => 'nullable|array', // Trường color_code là tùy chọn, có thể là mảng
            'color_code.*' => 'nullable|string|max:7', // Kiểm tra từng phần tử trong color_code
        ];
    }

    public function messages()
    {
        return [
            'attribute_id.required' => 'Trường thuộc tính không được để trống.',
            'attribute_id.array' => 'Trường thuộc tính phải là một mảng.',
            'attribute_id.*.exists' => 'Thuộc tính không tồn tại.',
            'value.required' => 'Trường giá trị không được để trống.',
            'value.array' => 'Trường giá trị phải là một mảng.',
            'value.*.string' => 'Giá trị phải là một chuỗi.',
            'value.*.max' => 'Giá trị không được vượt quá 255 ký tự.',
            'color_code.array' => 'Mã màu phải là một mảng.',
            'color_code.*.nullable' => 'Mã màu có thể để trống.',
            'color_code.*.string' => 'Mã màu phải là một chuỗi.',
            'color_code.*.max' => 'Mã màu không được vượt quá 7 ký tự.',
        ];
    }

    public function authorize()
    {
        return true;
    }
}

