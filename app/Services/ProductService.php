<?php

namespace App\Services;

use App\Models\Catalogue;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Attribute;
use App\Models\VariantAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    public function getCreateData()
    {
        $catalogues = Catalogue::all();
        $attributes = Attribute::with('values')->get();
        $sku = 'PRD-' . Str::upper(Str::random(8));

        return compact('catalogues', 'attributes', 'sku');
    }

    public function storeProduct($validatedData)
    {
        DB::beginTransaction();
        try {
            // Lưu sản phẩm vào bảng `products`
            $product = new Product();
            $product->catalogue_id = $validatedData['catalogue-select'];
            $product->name = $validatedData['name'];
            $product->slug = Str::slug($validatedData['name']);
            $product->sku = $validatedData['sku'];
            $product->price_regular = $validatedData['price_regular'] ?? 0;
            $product->price_sale = $validatedData['price_sale'] ?? null;
            $product->description = $validatedData['description'];
            $product->content = $validatedData['content'];
            $product->material = $validatedData['material'];
            $product->is_active = $validatedData['is_active'] === 'on' ? 1 : 0;
            $product->is_new = $validatedData['is_new'] === 'on' ? 1 : 0;
            $product->save();

            // Xử lý lưu ảnh chính (main image)
            if (isset($validatedData['main_image'])) {
                $mainImage = $validatedData['main_image'];
                $mainImagePath = $mainImage->store('products', 'public'); // Lưu ảnh vào thư mục "products"

                // Lưu thông tin ảnh chính vào bảng `product_images`
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = $mainImagePath;
                $productImage->is_main = 1; // Đánh dấu là ảnh chính
                $productImage->save();
            }

            // Xử lý lưu các ảnh phụ (sub images)
            if (isset($validatedData['sub_images'])) {
                foreach ($validatedData['sub_images'] as $subImage) {
                    $subImagePath = $subImage->store('products', 'public'); // Lưu ảnh phụ vào thư mục "products"

                    // Lưu thông tin ảnh phụ vào bảng `product_images`
                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image = $subImagePath;
                    $productImage->is_main = 0; // Đánh dấu là ảnh phụ
                    $productImage->save();
                }
            }

            // Xử lý biến thể sản phẩm (product variants)
            foreach ($validatedData['product_data'] as $variant) {
                $productVariant = new ProductVariant();
                $productVariant->product_id = $product->id;
                $productVariant->sku = $variant['sku'];
                $productVariant->price_regular = $variant['price_regular'] ?? 0;
                $productVariant->price_sale = $variant['price_sale'] ?? null;
                $productVariant->stock = $variant['stock'];

                // Giải mã chuỗi JSON cho `attribute_ids` và `value_ids`
                $attributeIds = json_decode($variant['attribute_ids'], true);
                $valueIds = json_decode($variant['value_ids'], true);

                // Xử lý ảnh base64 từ chuỗi JSON (nếu có)
                if (!empty($variant['image'])) {
                    preg_match("/^data:image\/(\w+);base64,/", $variant['image'], $matches);
                    $imageType = $matches[1] ?? 'png'; // Lấy phần loại file (png, jpeg, etc.)

                    // Giải mã base64
                    $image = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $variant['image']));

                    // Đặt tên file và đường dẫn
                    $imageName = uniqid() . '.' . $imageType;
                    $imagePath = "product-variants/{$imageName}";

                    // Lưu ảnh vào thư mục public/storage/products/variants
                    Storage::disk('public')->put($imagePath, $image);

                    // Gán đường dẫn ảnh vào biến thể
                    $productVariant->image = $imagePath;
                } else {
                    $productVariant->image = null;
                }

                $productVariant->save();

                // Lưu các thuộc tính biến thể vào `variant_attributes`
                foreach ($attributeIds as $key => $attributeId) {
                    $variantAttribute = new VariantAttribute();
                    $variantAttribute->product_variant_id = $productVariant->id;
                    $variantAttribute->attribute_id = $attributeId;
                    $variantAttribute->attribute_value_id = $valueIds[$key];
                    $variantAttribute->save();
                }
            }

            // Commit transaction
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception('Failed to save product: ' . $e->getMessage());
        }
    }
}
