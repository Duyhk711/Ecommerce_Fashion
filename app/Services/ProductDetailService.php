<?php 
namespace App\Services;

use App\Models\Product;

class ProductDetailService{

    public function getProductDetail(string $id){
        $product = Product::with("catalogue", "variants.variantAttributes.attributeValue", "images")
        ->findOrFail($id);
        $totalStock = $product->variants->sum('stock');

        // Tạo collection để lưu các giá trị thuộc tính duy nhất
        $uniqueAttributes = collect(); // Để lưu các thuộc tính đã tồn tại (color, size, ...)

        // Duyệt qua các biến thể
        // Lọc các biến thể theo ID sản phẩm
        foreach ($product->variants as $variant) {
            // Kiểm tra ID sản phẩm của biến thể
            if ($variant->product_id === $product->id) {
                foreach ($variant->variantAttributes as $attribute) {
                    $attributeValue = $attribute->attributeValue;
                    $attributeName = $attribute->attribute->name;
                    
                    // Kiểm tra xem giá trị thuộc tính đã tồn tại hay chưa
                    $existingAttribute = $uniqueAttributes->first(function ($item) use ($attribute, $attributeValue) {
                        return $item['attributeName'] === $attribute->attribute->name 
                            && $item['value'] === $attributeValue->value 
                            && $item['colorCode'] === ($attributeValue->color_code ?? null);
                    });

                    // Nếu chưa tồn tại, thì thêm vào collection
                    if (!$existingAttribute) {
                        $uniqueAttributes->push([
                            'attributeName' => $attributeName, // Tên thuộc tính (color, size, material, ...)
                            'value' => $attributeValue->value, // Giá trị thuộc tính (đỏ, S, M, L, ...)
                            'colorCode' => $attributeValue->color_code ?? null // Nếu là màu sắc, lưu thêm mã màu
                        ]);
                    }
                }
            }
        }



        $relatedProducts = Product::where('catalogue_id', $product->catalogue_id)
        ->when($id, function ($query) use ($id) {
            return $query->where('id', '!=', $id);
        })
        ->get();

        return [
            'product' => $product,
            'totalStock' => $totalStock,
            'uniqueAttributes' => $uniqueAttributes,
            'relatedProducts' => $relatedProducts
        ];
    }

}


?>