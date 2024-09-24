<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Xóa sạch dữ liệu trong các bảng trước khi seed
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('variant_attributes')->truncate();
        DB::table('product_variants')->truncate();
        DB::table('product_images')->truncate();
        DB::table('products')->truncate();
        DB::table('catalogues')->truncate();
        DB::table('attribute_values')->truncate();
        DB::table('attributes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Bước 1: Tạo thuộc tính và giá trị thuộc tính
        $attributes = [
            'Color' => [
                'Red' => '#FF0000',
                'Blue' => '#0000FF',
                'Green' => '#008000'
            ],
            'Size' => ['S', 'M', 'L']
        ];

        $attributeIds = [];
        $attributeValues = [];

        foreach ($attributes as $attributeName => $values) {
            // Lưu thuộc tính vào bảng `attributes`
            $attributeId = DB::table('attributes')->insertGetId([
                'name' => ucfirst($attributeName),
                'slug' => Str::slug($attributeName),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $attributeIds[$attributeName] = $attributeId;

            // Lưu các giá trị thuộc tính vào bảng `attribute_values`
            foreach ($values as $value => $codeOrSize) {
                if ($attributeName === 'Color') {
                    // Lưu giá trị màu sắc kèm mã màu
                    $valueId = DB::table('attribute_values')->insertGetId([
                        'attribute_id' => $attributeId,
                        'value' => $value,
                        'color_code' => $codeOrSize,  // Mã màu
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $attributeValues[$attributeName][$value] = $valueId; // Lưu lại giá trị màu sắc
                } else {
                    // Lưu kích thước (không có mã màu)
                    $valueId = DB::table('attribute_values')->insertGetId([
                        'attribute_id' => $attributeId,
                        'value' => $codeOrSize,  // Kích thước
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $attributeValues[$attributeName][$codeOrSize] = $valueId; // Lưu lại giá trị kích thước theo `Size`
                }
            }
        }

        // Bước 2: Tạo danh mục cha
        $parentCatalogues = ['Men', 'Women', 'Kids', 'Accessories'];
        $catalogueIds = [];

        foreach ($parentCatalogues as $parentCatalogue) {
            // Lưu danh mục cha vào bảng `catalogues`
            $catalogueId = DB::table('catalogues')->insertGetId([
                'name' => $parentCatalogue,
                'slug' => Str::slug($parentCatalogue),
                'description' => 'Description for ' . $parentCatalogue,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $catalogueIds[$parentCatalogue] = $catalogueId;
        }

        // Bước 3: Tạo danh mục con
        $subCatalogues = [
            'Men' => ['T-Shirts', 'Shoes', 'Jackets'],
            'Women' => ['Dresses', 'Shoes', 'Handbags'],
            'Kids' => ['Toys', 'Clothing', 'Accessories'],
            'Accessories' => ['Belts', 'Hats', 'Sunglasses']
        ];

        foreach ($subCatalogues as $parentCatalogue => $children) {
            foreach ($children as $childCatalogue) {
                // Tạo slug duy nhất
                $slug = Str::slug($childCatalogue);
                $baseSlug = $slug;
                $counter = 1;

                while (DB::table('catalogues')->where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                // Lưu danh mục con vào bảng `catalogues`
                DB::table('catalogues')->insert([
                    'name' => $childCatalogue,
                    'slug' => $slug,
                    'description' => 'Description for ' . $childCatalogue,
                    'is_active' => 1,
                    'parent_id' => $catalogueIds[$parentCatalogue],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Bước 4: Tạo sản phẩm và biến thể
        for ($i = 1; $i <= 20; $i++) {
            $productName = 'Product ' . $i;
            $slug = Str::slug($productName, '-');
            $sku = 'SKU' . $i;
            $image = 'https://canifa.com/img/1517/2000/resize/6/t/6ts24s021-sw001-1-ag.webp';

            // Lưu sản phẩm vào bảng `products`
            $productId = DB::table('products')->insertGetId([
                'catalogue_id' => rand(1, 4),
                'name' => $productName,
                'slug' => $slug,
                'sku' => $sku,
                'img_thumbnail' => $image,
                'price_regular' => rand(100, 500),
                'price_sale' => rand(50, 400),
                'description' => 'Description for ' . $productName,
                'content' => 'Content for ' . $productName,
                'material' => 'Cotton',
                'user_manual' => 'Care instructions for ' . $productName,
                'view' => rand(0, 1000),
                'is_active' => 1,
                'is_show_home' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Tạo biến thể sản phẩm
            foreach ($attributes['Color'] as $color => $colorCode) {
                foreach ($attributes['Size'] as $size) {
                    // Tạo SKU cho biến thể
                    $variantSku = $sku . '-' . Str::slug($color . '-' . $size, '-');

                    // Lưu biến thể vào bảng `product_variants`
                    $variantId = DB::table('product_variants')->insertGetId([
                        'product_id' => $productId,
                        'sku' => $variantSku,
                        'price_regular' => rand(100, 500),
                        'price_sale' => rand(50, 400),
                        'stock' => rand(10, 50),
                        'image' => $image,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Liên kết với thuộc tính màu sắc
                    DB::table('variant_attributes')->insert([
                        'product_variant_id' => $variantId,
                        'attribute_id' => $attributeIds['Color'],
                        'attribute_value_id' => $attributeValues['Color'][$color],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Liên kết với thuộc tính kích thước
                    DB::table('variant_attributes')->insert([
                        'product_variant_id' => $variantId,
                        'attribute_id' => $attributeIds['Size'],
                        'attribute_value_id' => $attributeValues['Size'][$size],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
