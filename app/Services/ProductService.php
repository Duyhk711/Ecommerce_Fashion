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

    public function listProducts($searchTerm, $catalogueId = null, $minPrice = null, $maxPrice = null, $stockStatus = null)
    {
        $query = Product::with([
            'catalogue',
            'mainImage',
            'variants.variantAttributes.attribute',
            'variants.variantAttributes.attributeValue',
            'images'
        ]);

        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('sku', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('catalogue', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', '%' . $searchTerm . '%');
                });
        }

        if ($catalogueId) {
            $query->where('catalogue_id', $catalogueId);
        }

        if ($minPrice !== null && $maxPrice !== null) {
            $query->whereBetween('price_regular', [$minPrice, $maxPrice]);
        } elseif ($minPrice !== null) {
            $query->where('price_regular', '>=', $minPrice);
        } elseif ($maxPrice !== null) {
            $query->where('price_regular', '<=', $maxPrice);
        }

        if ($stockStatus) {
            $query->whereHas('variants', function ($query) use ($stockStatus) {
                $query->select(DB::raw('sum(stock) as total_stock'))
                    ->groupBy('product_id');

                if ($stockStatus == 'low') {
                    $query->havingRaw('sum(stock) < 10');
                } elseif ($stockStatus == 'in_stock') {
                    $query->havingRaw('sum(stock) >= 10');
                } elseif ($stockStatus == 'out_of_stock') {
                    $query->havingRaw('sum(stock) = 0');
                }
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
                'meta_title' => $validatedData['meta_title'],
                'meta_description' => $validatedData['meta_description'],
                'meta_keywords' => $validatedData['meta_keywords'],
                'content' => $validatedData['content'],
                'material' => $validatedData['material'],
                'is_active' => $validatedData['is_active'],
                'is_new' => $validatedData['is_new'],
                'is_hot_deal' => $validatedData['is_hot_deal'],
                'is_show_home' => $validatedData['is_show_home'],
                'img_thumbnail' => $this->uploadImage($request->file('img_thumbnail')),
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $this->uploadImage($image),
                        'is_main' => 0,
                    ]);
                }
            }

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
    public function getProductForEdit($id)
    {
        $product = Product::with('variants.attributeValues.attribute')->findOrFail($id);

        $catalogues = Catalogue::all();
        $attributes = Attribute::with('values')->get();

        // Xử lý các thuộc tính đã sử dụng
        $usedAttributes = $this->processUsedAttributes($product);

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
            $size = $variant->attributeValues->firstWhere('attribute.name', 'Size');
            $color = $variant->attributeValues->firstWhere('attribute.name', 'Color');

            $variant->size = $size ? $size->value : 'N/A';
            $variant->color = $color ? $color->value : 'N/A';

            $variantAttributes = [];
            foreach ($variant->attributeValues as $attributeValue) {
                $variantAttributes[] = [
                    'attribute_id' => $attributeValue->attribute->id,
                    'attribute_value_id' => $attributeValue->id,
                ];
            }

            $variant->variantAttributes = $variantAttributes;
        }
    }

    // UPDATE
    public function updateProduct($id, $validatedData, $request)
    {
        // dd($request->all());
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_new' => $request->has('is_new') ? 1 : 0,
            'is_hot_deal' => $request->has('is_hot_deal') ? 1 : 0,
            'is_show_home' => $request->has('is_show_home') ? 1 : 0,
        ]);

        DB::beginTransaction();

        try {
            $product = Product::findOrFail($id);

            if ($request->hasFile('img_thumbnail')) {
                if ($product->img_thumbnail) {
                    Storage::delete($product->img_thumbnail);
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
                'meta_title' => $validatedData['meta_title'],
                'meta_description' => $validatedData['meta_description'],
                'meta_keywords' => $validatedData['meta_keywords'],
                'content' => $validatedData['content'],
                'material' => $validatedData['material'],
                'is_active' => $validatedData['is_active'],
                'is_new' => $validatedData['is_new'],
                'is_hot_deal' => $validatedData['is_hot_deal'],
                'is_show_home' => $validatedData['is_show_home'],
            ]);

            $deletedImages = json_decode($request->input('deleted_images', '[]'));
            if (!empty($deletedImages)) {
                $productImages = ProductImage::whereIn('id', $deletedImages)->get();

                foreach ($productImages as $productImage) {
                    Storage::delete($productImage->image);

                    $productImage->delete();
                }
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $this->uploadImage($image),
                        'is_main' => 0,
                    ]);
                }
            }

            // Xóa các biến thể bị xóa
            $deletedVariantIds = $request->input('deleted_variant_ids', []);
            if (!empty($deletedVariantIds)) {
                VariantAttribute::whereIn('product_variant_id', $deletedVariantIds)->delete();
                ProductVariant::whereIn('id', $deletedVariantIds)->delete();
            }

            // Cập nhật các biến thểhiện có
            $this->updateExistingVariants($request, $product);

            // Thêm các biến th mới
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

    // ADD NEW VALUES
    private function addNewVariants($request, $product)
    {
        $newVariantPrices = $request->input('new_variant_prices', []);
        $newVariantSalePrices = $request->input('new_variant_sale_prices', []);
        $newVariantStocks = $request->input('new_variant_stocks', []);
        $newVariantSkus = $request->input('new_variant_skus', []);
        $newVariantImages = $request->file('new_variant_images', []);
        $newValues = $request->input('new_values', []);

        foreach ($newVariantPrices as $index => $price) {
            $newVariant = ProductVariant::create([
                'product_id' => $product->id,
                'price_regular' => $price,
                'price_sale' => $newVariantSalePrices[$index],
                'stock' => $newVariantStocks[$index],
                'sku' => $newVariantSkus[$index],
                'image' => isset($newVariantImages[$index]) ? $this->uploadImageVariant($newVariantImages[$index]) : null,
            ]);

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

    // DELETE
    public function softDeleteProduct($id)
{
    // Lấy sản phẩm theo ID
    $product = Product::findOrFail($id);

    // Kiểm tra sản phẩm có tồn tại trong các đơn hàng qua các biến thể
    foreach ($product->variants as $variant) {
        $variantInOrders = DB::table('order_items')->where('product_variant_id', $variant->id)->exists();

        if ($variantInOrders) {
            return false; // Không thể xóa nếu có biến thể trong đơn hàng
        }
    }

    // Nếu không có biến thể nào của sản phẩm trong đơn hàng, thực hiện xóa

    // Xóa các ảnh và các biến thể của sản phẩm
    foreach ($product->variants as $variant) {
        foreach ($variant->images as $image) {
            $image->delete();
        }
        $variant->delete();
    }

    foreach ($product->images as $image) {
        $image->delete();
    }

    // Đánh dấu sản phẩm là không hoạt động thay vì xóa
    $product->is_active = 0;
    $product->save();

    // Xóa sản phẩm
    $product->delete();

    return true;
}



    // RESTORE
    public function restoreProduct($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        $product->restore();

        foreach ($product->variants()->withTrashed()->get() as $variant) {
            foreach ($variant->images()->withTrashed()->get() as $image) {
                $image->restore();
            }
            $variant->restore();
        }

        foreach ($product->images()->withTrashed()->get() as $image) {
            $image->restore();
        }

        $product->is_active = 1;
        $product->save();

        return true;
    }
}
