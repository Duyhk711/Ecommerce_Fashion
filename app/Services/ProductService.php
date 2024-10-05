<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\VariantAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductService
{
    public function storeProduct($productData, $request)
    {
        DB::beginTransaction();

        try {
            // Tạo slug từ tên sản phẩm
            $slug = Str::slug($productData['name']);

            // Lưu sản phẩm vào bảng `products`
            $product = Product::create([
                'catalogue_id' => $productData['catalogue'],
                'name' => $productData['name'],
                'slug' => $slug,
                'sku' => $productData['sku'],
                'price_regular' => $productData['price_regular'],
                'price_sale' => $productData['price_sale'],
                'description' => $productData['description'],
                'content' => $productData['content'],
                'is_active' => $productData['is_active'],
                'is_hot_deal' => $productData['is_hot_deal'],
                'is_new' => $productData['is_new'],
                'is_show_home' => $productData['is_show_home'],
            ]);

            // Lưu hình ảnh chính
            if ($request->hasFile('main_image')) {
                $mainImage = $request->file('main_image')->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $mainImage,
                    'is_main' => 1, // Đánh dấu là ảnh chính
                ]);
            }

            // Lưu các ảnh phụ
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $image) {
                    $galleryImage = $image->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $galleryImage,
                        'is_main' => 0, // Đánh dấu là ảnh phụ
                    ]);
                }
            }

            // Lưu các biến thể
            foreach ($productData['variants'] as $index => $variant) {
                $this->storeProductVariant($product, $variant, $request, $index);
            }

            DB::commit();
            return ['message' => 'Sản phẩm đã được lưu thành công', 'status' => 200];

        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => $e->getMessage(), 'status' => 500];
        }
    }

    private function storeProductVariant($product, $variant, $request, $index)
    {
        // Xử lý ảnh biến thể
        $variantImagePath = null;
        if ($request->hasFile("variant_images.{$index}")) {
            $variantImage = $request->file("variant_images.{$index}");
            $variantImagePath = $variantImage->store('variants', 'public');
        }

        // Lưu biến thể
        $productVariant = ProductVariant::create([
            'product_id' => $product->id,
            'sku' => $variant['sku'],
            'price_regular' => $variant['price_regular'],
            'price_sale' => $variant['price_sale'],
            'stock' => $variant['stock'],
            'image' => $variantImagePath, // Lưu ảnh biến thể
        ]);

        // Lưu các thuộc tính của biến thể
        foreach ($variant['attribute_ids'] as $attributeIndex => $attributeId) {
            VariantAttribute::create([
                'product_variant_id' => $productVariant->id,
                'attribute_id' => $attributeId,
                'attribute_value_id' => $variant['value_ids'][$attributeIndex],
            ]);
        }
    }
}
