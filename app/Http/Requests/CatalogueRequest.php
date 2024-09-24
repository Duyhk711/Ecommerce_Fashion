<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatalogueRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Nếu có trường ảnh bìa
            'parent_id' => 'nullable|exists:catalogues,id', // Nếu có trường parent_id
        ];
    }



    public function messages()
    {
        return [
            'parent_id.exists' => 'Danh mục cha không tồn tại.',
            'name.required' => 'Tên danh mục không được để trống.',
            // 'name.unique' => 'Tên danh mục đã tồn tại.',
            'name.string' => 'Tên danh mục phải là một chuỗi.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'description.string' => 'Mô tả phải là một chuỗi.',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
