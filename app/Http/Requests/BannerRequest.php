<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => 'required|in:main,sub',
            'position' => 'nullable',
            'description' => 'nullable',
            'images.*' => 'nullable|image',
            'is_active' => 'sometimes|boolean',
            'remove_images' => 'array',
            'remove_images.*' => 'exists:banner_images,id',
        ];
    }
}
