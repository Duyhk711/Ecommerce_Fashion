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

    public function listProducts($searchTerm)
    {
        // Tạo query lấy sản phẩm
        $query = Product::with([
            'catalogue',
            'mainImage',
            'variants.variantAttributes.attribute',
            'variants.variantAttributes.attributeValue',
            'images'
        ]);

        // Nếu có từ khóa tìm kiếm thì áp dụng điều kiện tìm kiếm
        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('sku', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('catalogue', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', '%' . $searchTerm . '%');
                });
        }

        // Sắp xếp và phân trang
        return $query->orderBy('created_at', 'desc')->paginate(10);
    }



    public function getCreateData()
    {
        $catalogues = Catalogue::all();
        $attributes = Attribute::with('values')->get();
        $sku = 'PRD-' . Str::upper(Str::random(8));

        return compact('catalogues', 'attributes', 'sku');
    }

    public function storeProduct($validatedData, $request)
    {
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_new' => $request->has('is_new') ? 1 : 0,
            'is_hot_deal' => $request->has('is_hot_deal') ? 1 : 0,
            'is_show_home' => $request->has('is_show_home') ? 1 : 0,
        ]);
        DB::beginTransaction();
        try {
            // Lưu thông tin chung của sản phẩm
            $product = Product::create([
                'name' => $validatedData['name'],
                'catalogue_id' => $validatedData['catalogue_id'],
                'sku' => $validatedData['sku'],
                'slug' => Str::slug($validatedData['name']),
                'price_regular' => $validatedData['price_regular'],
                'price_sale' => $validatedData['price_sale'],
                'description' => $validatedData['description'],
                'content' => $validatedData['content'],
                'material' => $validatedData['material'],
                'is_active' => $validatedData['is_active'],
                'is_new' => $validatedData['is_new'],
                'is_hot_deal' => $validatedData['is_hot_deal'],
                'is_show_home' => $validatedData['is_show_home'],
                'img_thumbnail' => $this->uploadImage($request->file('img_thumbnail')),
            ]);

            // Lưu các ảnh phụ
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $this->uploadImage($image),
                        'is_main' => 0,
                    ]);
                }
            }

            // Xử lý và lưu các biến thể
            $this->storeVariants($product, $validatedData, $request);

            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function storeVariants($product, $validatedData, $request)
    {
        $variantPrices = $validatedData['variant_prices'];
        $variantSalePrices = $validatedData['variant_sale_prices'];
        $variantStocks = $validatedData['variant_stocks'];
        $variantSkus = $validatedData['variant_skus'];
        $variantImages = $request->file('variant_images');
        $variantValues = $request->input('values');

        foreach ($variantPrices as $index => $price) {
            $variant = ProductVariant::create([
                'product_id' => $product->id,
                'sku' => $variantSkus[$index],
                'price_regular' => $price,
                'price_sale' => $variantSalePrices[$index],
                'stock' => $variantStocks[$index],
                'image' => $variantImages[$index] ? $this->uploadImageVariant($variantImages[$index]) : null,
            ]);

            if (isset($variantValues[$index])) {
                foreach ($variantValues[$index] as $value) {
                    VariantAttribute::create([
                        'product_variant_id' => $variant->id,
                        'attribute_id' => $value['attribute_id'],
                        'attribute_value_id' => $value['attribute_value_id'],
                    ]);
                }
            }
        }
    }

    private function uploadImage($image)
    {
        if ($image) {
            return $image->store('products', 'public');
        }
        return null;
    }
    private function uploadImageVariant($image)
    {
        if ($image) {
            return $image->store('products_variants', 'public');
        }
        return null;
    }

    // EDIT
    // Lấy thông tin chi tiết sản phẩm để hiển thị trong trang edit
    public function getProductForEdit($id)
    {
        // Lấy sản phẩm cùng với các biến thể và giá trị thuộc tính của chúng
        $product = Product::with('variants.attributeValues.attribute')->findOrFail($id);

        // Lấy tất cả danh mục và thuộc tính
        $catalogues = Catalogue::all();
        $attributes = Attribute::with('values')->get();

        // Xử lý các thuộc tính đã sử dụng
        $usedAttributes = $this->processUsedAttributes($product);

        // Xử lý các biến thể để tạo dữ liệu chuẩn cho view
        $this->processVariants($product);

        return compact('product', 'catalogues', 'attributes', 'usedAttributes');
    }

    // Xử lý thuộc tính đã được sử dụng
    private function processUsedAttributes($product)
    {
        $usedAttributes = [];

        foreach ($product->variants as $variant) {
            foreach ($variant->attributeValues as $attributeValue) {
                $attributeId = $attributeValue->attribute->id;
                $valueId = $attributeValue->id;

                if (!isset($usedAttributes[$attributeId])) {
                    $usedAttributes[$attributeId] = [];
                }

                if (!in_array($valueId, $usedAttributes[$attributeId])) {
                    $usedAttributes[$attributeId][] = $valueId;
                }
            }
        }

        return $usedAttributes;
    }

    // Xử lý thông tin biến thể
    private function processVariants($product)
    {
        foreach ($product->variants as $variant) {
            // Lấy giá trị của thuộc tính 'Size' và 'Color'
            $size = $variant->attributeValues->firstWhere('attribute.name', 'Size');
            $color = $variant->attributeValues->firstWhere('attribute.name', 'Color');

            // Gán giá trị kích cỡ và màu sắc vào biến thể
            $variant->size = $size ? $size->value : 'N/A';
            $variant->color = $color ? $color->value : 'N/A';

            // Tạo mảng chuẩn cho các thuộc tính của biến thể
            $variantAttributes = [];
            foreach ($variant->attributeValues as $attributeValue) {
                $variantAttributes[] = [
                    'attribute_id' => $attributeValue->attribute->id,
                    'attribute_value_id' => $attributeValue->id,
                ];
            }

            // Gán thuộc tính đã được xử lý vào biến thể để sử dụng trong view
            $variant->variantAttributes = $variantAttributes;
        }
    }

    // UPDATE
    public function updateProduct($id, $validatedData, $request)
    {
        // dd($request->all());
        // Cập nhật các trường boolean
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_new' => $request->has('is_new') ? 1 : 0,
            'is_hot_deal' => $request->has('is_hot_deal') ? 1 : 0,
            'is_show_home' => $request->has('is_show_home') ? 1 : 0,
        ]);

        DB::beginTransaction();

        try {
            // Lấy sản phẩm hiện tại
            $product = Product::findOrFail($id);

            // Kiểm tra và giữ ảnh cũ nếu không upload ảnh mới
            if ($request->hasFile('img_thumbnail')) {
                // Nếu có ảnh mới thì upload và xóa ảnh cũ nếu cần
                if ($product->img_thumbnail) {
                    Storage::delete($product->img_thumbnail);  // Xóa ảnh cũ nếu cần
                }
                $product->img_thumbnail = $this->uploadImage($request->file('img_thumbnail'));
            }

            // Cập nhật các thông tin khác của sản phẩm
            $product->update([
                'name' => $validatedData['name'],
                'catalogue_id' => $validatedData['catalogue_id'],
                'slug' => Str::slug($validatedData['name']),
                'price_regular' => $validatedData['price_regular'],
                'price_sale' => $validatedData['price_sale'],
                'description' => $validatedData['description'],
                'content' => $validatedData['content'],
                'material' => $validatedData['material'],
                'is_active' => $validatedData['is_active'],
                'is_new' => $validatedData['is_new'],
                'is_hot_deal' => $validatedData['is_hot_deal'],
                'is_show_home' => $validatedData['is_show_home'],
                // Không cần cập nhật img_thumbnail nếu không có file mới
            ]);
            //      // Xử lý ảnh phụ bị xóa
            // if ($request->has('deleted_images')) {
            //     $deletedImages = json_decode($request->input('deleted_images'), true);
            //     foreach ($deletedImages as $imageId) {
            //         $imageRecord = ProductImage::find($imageId);
            //         if ($imageRecord) {
            //             // Xóa ảnh khỏi hệ thống lưu trữ
            //             Storage::delete($imageRecord->image);
            //             // Xóa bản ghi trong database
            //             $imageRecord->delete();
            //         }
            //     }
            // }
            // Thêm các ảnh phụ (gallery) mới
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    // Lưu từng ảnh phụ vào cơ sở dữ liệu
                    ProductImage::create([
                        'product_id' => $product->id,           // Liên kết ảnh với sản phẩm
                        'image' => $this->uploadImage($image),  // Upload và lấy đường dẫn ảnh
                        'is_main' => 0,                         // Đánh dấu đây là ảnh phụ, không phải ảnh chính
                    ]);
                }
            }

            // Xóa các biến thể bị xóa
            $deletedVariantIds = $request->input('deleted_variant_ids', []);
            if (!empty($deletedVariantIds)) {
                // Xóa các thuộc tính của biến thể và biến thể
                VariantAttribute::whereIn('product_variant_id', $deletedVariantIds)->delete();
                ProductVariant::whereIn('id', $deletedVariantIds)->delete();
            }

            // Cập nhật các biến thể hiện có
            $this->updateExistingVariants($request, $product);

            // Thêm các biến thể mới
            $this->addNewVariants($request, $product);

            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    private function updateExistingVariants($request, $product)
    {
        $variantIds = $request->input('variant_ids', []);
        $variantPrices = $request->input('variant_prices', []);
        $variantSalePrices = $request->input('variant_sale_prices', []);
        $variantStocks = $request->input('variant_stocks', []);
        $variantSkus = $request->input('variant_skus', []);
        $variantImages = $request->file('variant_images', []);

        foreach ($variantIds as $index => $variantId) {
            $variant = ProductVariant::find($variantId);
            if ($variant) {
                // Cập nhật thông tin biến thể
                $variant->update([
                    'price_regular' => $variantPrices[$index],
                    'price_sale' => $variantSalePrices[$index],
                    'stock' => $variantStocks[$index],
                    'sku' => $variantSkus[$index],
                    'image' => isset($variantImages[$index]) ? $this->uploadImageVariant($variantImages[$index]) : $variant->image,
                ]);
            }
        }
    }

    private function addNewVariants($request, $product)
    {
        $newVariantPrices = $request->input('new_variant_prices', []);
        $newVariantSalePrices = $request->input('new_variant_sale_prices', []);
        $newVariantStocks = $request->input('new_variant_stocks', []);
        $newVariantSkus = $request->input('new_variant_skus', []);
        $newVariantImages = $request->file('new_variant_images', []);
        $newValues = $request->input('new_values', []); // Thuộc tính cho biến thể mới

        foreach ($newVariantPrices as $index => $price) {
            // Tạo biến thể mới
            $newVariant = ProductVariant::create([
                'product_id' => $product->id,
                'price_regular' => $price,
                'price_sale' => $newVariantSalePrices[$index],
                'stock' => $newVariantStocks[$index],
                'sku' => $newVariantSkus[$index],
                'image' => isset($newVariantImages[$index]) ? $this->uploadImage($newVariantImages[$index]) : null,
            ]);

            // Lưu các giá trị thuộc tính của biến thể mới
            if (isset($newValues[$index])) {
                foreach ($newValues[$index] as $value) {
                    VariantAttribute::create([
                        'product_variant_id' => $newVariant->id,
                        'attribute_id' => $value['attribute_id'],
                        'attribute_value_id' => $value['attribute_value_id'],
                    ]);
                }
            }
        }
    }
}
