<?php

namespace App\Services;

use App\Models\Product;

class ProductDetailService
{
    public function getProductDetail(string $id)
    {
        // Tìm sản phẩm với các quan hệ cần thiết
        $product = Product::with("variants.variantAttributes.attributeValue", "images")
            ->findOrFail($id);

        // Lấy thông tin chi tiết của từng biến thể, bao gồm tồn kho
        $variantDetails = $product->variants->map(function ($variant) {
            return [
                'id' => $variant->id,
                'stock' => $variant->stock,
                'attributes' => $variant->variantAttributes->map(function ($attribute) {
                    return [
                        'attributeName' => $attribute->attribute->name,
                        'value' => $attribute->attributeValue->value,
                        'colorCode' => $attribute->attributeValue->color_code ?? null
                    ];
                })
            ];
        });

        // Tính tổng tồn kho
        $totalStock = $product->variants->sum('stock');

        // Lấy các thuộc tính độc nhất từ biến thể sản phẩm
        $uniqueAttributes = $product->variants->flatMap(function ($variant) {
            return $variant->variantAttributes->map(function ($attribute) {
                return [
                    'attributeName' => $attribute->attribute->name,
                    'value' => $attribute->attributeValue->value,
                    'colorCode' => $attribute->attributeValue->color_code ?? null
                ];
            });
        })->unique(function ($item) {
            return $item['attributeName'] . $item['value'] . $item['colorCode'];
        });

        // Tìm sản phẩm liên quan
        $relatedProducts = Product::where('catalogue_id', $product->catalogue_id)
            ->where('id', '!=', $id)
            ->get();
        // dd($variantDetails);
        return [
            'product' => $product,
            'totalStock' => $totalStock,
            'variantDetails' => $variantDetails,
            'uniqueAttributes' => $uniqueAttributes,
            'relatedProducts' => $relatedProducts
        ];
    }
    
}
