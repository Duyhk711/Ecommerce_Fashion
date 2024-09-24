<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Seed Attributes
        $attributes = [
            ['name' => 'Color', 'slug' => 'color'],
            ['name' => 'Size', 'slug' => 'size']
        ];

        foreach ($attributes as $attribute) {
            DB::table('attributes')->insert([
                'name' => $attribute['name'],
                'slug' => $attribute['slug'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Seed Attribute Values
        $colors = ['Red', 'Blue', 'Green']; // Chỉ chọn 3 màu
        $sizes = ['S', 'M', 'L']; // Chỉ chọn 3 size

        foreach ($colors as $color) {
            DB::table('attribute_values')->insert([
                'attribute_id' => 1, // ID for Color
                'value' => $color,
                'color_code' => $faker->hexColor,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        foreach ($sizes as $size) {
            DB::table('attribute_values')->insert([
                'attribute_id' => 2, // ID for Size
                'value' => $size,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Seed Products
        for ($i = 1; $i <= 5; $i++) {
            DB::table('products')->insert([
                'catalogue_id' => 1, // Ensure this ID is valid in `catalogues` table
                'name' => 'Product ' . $i,
                'slug' => Str::slug('Product ' . $i),
                'sku' => 'SKU-' . $i,
                'price_regular' => $faker->randomFloat(2, 10, 100),
                'price_sale' => $faker->randomFloat(2, 5, 90),
                'description' => $faker->text,
                'content' => $faker->paragraph,
                'material' => $faker->word,
                'user_manual' => $faker->text,
                'view' => $faker->numberBetween(0, 1000),
                'is_active' => $faker->boolean,
                'is_hot_deal' => $faker->boolean,
                'is_new' => $faker->boolean,
                'is_show_home' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Seed Product Variants (3 colors x 3 sizes = 9 variants for each product)
        $products = DB::table('products')->pluck('id')->toArray();
        $colorValues = DB::table('attribute_values')->where('attribute_id', 1)->pluck('id')->toArray();
        $sizeValues = DB::table('attribute_values')->where('attribute_id', 2)->pluck('id')->toArray();

        foreach ($products as $product_id) {
            foreach ($colorValues as $color_id) {
                foreach ($sizeValues as $size_id) {
                    // Tạo một biến thể cho mỗi cặp màu-size
                    DB::table('product_variants')->insert([
                        'product_id' => $product_id,
                        'sku' => 'PV-' . $product_id . '-' . $color_id . '-' . $size_id,
                        'price_regular' => $faker->randomFloat(2, 10, 100),
                        'price_sale' => $faker->randomFloat(2, 5, 90),
                        'stock' => $faker->numberBetween(0, 100),
                        'image' => $faker->imageUrl(390, 520, 'fashion'),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    $variant_id = DB::getPdo()->lastInsertId();

                    // Gán thuộc tính color
                    DB::table('variant_attributes')->insert([
                        'product_variant_id' => $variant_id,
                        'attribute_id' => 1, // Color
                        'attribute_value_id' => $color_id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    // Gán thuộc tính size
                    DB::table('variant_attributes')->insert([
                        'product_variant_id' => $variant_id,
                        'attribute_id' => 2, // Size
                        'attribute_value_id' => $size_id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        // Seed Product Images
        foreach ($products as $product_id) {
            for ($k = 1; $k <= 6; $k++) {
                DB::table('product_images')->insert([
                    'product_id' => $product_id,
                    'image' => $faker->imageUrl(390, 520, 'fashion'),
                    'is_main' => $k == 1 ? 1 : 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
