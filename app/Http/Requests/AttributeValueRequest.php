<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeValueRequest extends FormRequest
{
    public function rules()
    {
        return [
            'attribute_id' => 'required|',
            'attribute_id.*' => 'exists:attributes,id',
            'value' => 'required|',
            // 'value.*' => 'string|max:255',
            // 'additional_value' => 'array',
            // 'additional_value.*.*' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'attribute_id.required' => 'Trường thuộc tính không được để trống.',
            // 'attribute_id.array' => 'Trường thuộc tính phải là một mảng.',
            'attribute_id.*.exists' => 'Thuộc tính không tồn tại.',
            'value.required' => 'Trường giá trị không được để trống.',
            // 'value.array' => 'Trường giá trị phải là một mảng.',
            'value.*.string' => 'Giá trị phải là một chuỗi.',
            // 'value.*.max' => 'Giá trị không được vượt quá 255 ký tự.',
            // 'additional_value.array' => 'Trường giá trị bổ sung phải là một mảng.',
            // 'additional_value.*.*.nullable' => 'Giá trị bổ sung có thể để trống.',
            // 'additional_value.*.*.string' => 'Giá trị bổ sung phải là một chuỗi.',
            // 'additional_value.*.*.max' => 'Giá trị bổ sung không được vượt quá 255 ký tự.',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
