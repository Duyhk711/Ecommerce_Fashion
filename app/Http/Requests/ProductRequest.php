<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // 'name' => 'required|string|max:255',
            // 'sku' => 'required|string|max:255|unique:products,sku',
            // 'price_regular' => 'required|numeric|min:0',
            // 'price_sale' => 'nullable|numeric|min:0|lt:price_regular',
            // 'description' => 'nullable|string|max:200',
            // 'content' => 'nullable|string',
            // 'material' => 'nullable|string|max:255',
            // 'catalogue-select' => 'required|exists:catalogues,id',
            // 'main_image' => 'nullable|image',
            // 'sub_images.*' => 'nullable|image',
            // 'product_data' => 'required|array',
            // 'product_data.*.sku' => 'required|string|max:255',
            // 'product_data.*.price_regular' => 'required|numeric|min:0',
            // 'product_data.*.price_sale' => 'nullable|numeric|min:0|lt:product_data.*.price_regular',
            // 'product_data.*.stock' => 'required|integer|min:0',
            // 'product_data.*.attribute_ids' => 'required|string',
            // 'product_data.*.value_ids' => 'required|string',
        ];
    }
}
