<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'catalogue_id' => 'required|exists:catalogues,id',
            // 'sku' => 'required|string|max:255|unique:products,sku',
            'price_regular' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0|lt:price_regular',
            'img_thumbnail' => 'nullable|image',
            'images.*' => 'nullable|image',
            'variant_prices.*' => 'required|numeric|min:0',
            'variant_sale_prices.*' => 'nullable|numeric|min:0|lt:variant_prices.*',
            'variant_stocks.*' => 'required|integer|min:0',
            'variant_skus.*' => 'required|string|max:255',
            'variant_images.*' => 'nullable|image',
            'description' => 'nullable|string|max:200',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'material' => 'nullable|string|max:255',
            'is_active' => 'nullable',
            'is_new' => 'nullable',
            'is_hot_deal' => 'nullable',
            'is_show_home' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'catalogue_id.required' => 'Vui lòng chọn danh mục sản phẩm.',
            // 'sku.required' => 'Vui lòng nhập SKU.',
            'sku.unique' => 'SKU đã tồn tại, vui lòng chọn SKU khác.',
            'price_regular.required' => 'Giá gốc là bắt buộc.',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'img_thumbnail.required' => 'Ảnh chính là bắt buộc.',
            'img_thumbnail.image' => 'Ảnh chính phải là tệp hình ảnh hợp lệ.',
            'variant_prices.*.required' => 'Giá biến thể là bắt buộc.',
            'variant_stocks.*.required' => 'Số lượng biến thể là bắt buộc.',
        ];
    }

}

