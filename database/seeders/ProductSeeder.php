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
        // Clear tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('variant_attributes')->truncate();
        DB::table('product_variants')->truncate();
        DB::table('product_images')->truncate();
        DB::table('products')->truncate();
        DB::table('catalogues')->truncate();
        DB::table('attribute_values')->truncate();
        DB::table('attributes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Seed attributes
        $colorAttributeId = DB::table('attributes')->insertGetId([
            'name' => 'Color',
            'slug' => Str::slug('Color'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $sizeAttributeId = DB::table('attributes')->insertGetId([
            'name' => 'Size',
            'slug' => Str::slug('Size'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Seed attribute values
        $colorValues = [
            ['attribute_id' => $colorAttributeId, 'value' => 'Red', 'color_code' => '#FF0000'],
            ['attribute_id' => $colorAttributeId, 'value' => 'Blue', 'color_code' => '#0000FF'],
            ['attribute_id' => $colorAttributeId, 'value' => 'Green', 'color_code' => '#00FF00'],
        ];

        $sizeValues = [
            ['attribute_id' => $sizeAttributeId, 'value' => 'S'],
            ['attribute_id' => $sizeAttributeId, 'value' => 'M'],
            ['attribute_id' => $sizeAttributeId, 'value' => 'L'],
        ];

        foreach ($colorValues as $color) {
            DB::table('attribute_values')->insert($color);
        }

        foreach ($sizeValues as $size) {
            DB::table('attribute_values')->insert($size);
        }

        // 3. Seed catalogues
        $catalogueId1 = DB::table('catalogues')->insertGetId([
            'name' => 'Men Clothes',
            'slug' => Str::slug('Men Clothes'),
            'description' => 'Catalogue for men clothes',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. Seed products using a for loop
        $numberOfProducts = 20;  // You can change this number to add more or fewer products

        for ($i = 1; $i <= $numberOfProducts; $i++) {
            $productId = DB::table('products')->insertGetId([
                'catalogue_id' => $catalogueId1,
                'name' => 'Product ' . $i,
                'slug' => Str::slug('Product ' . $i),
                'sku' => 'PROD' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'img_thumbnail' => 'https://canifa.com/img/1517/2000/resize/6/t/6ts24w004-sw001-thumb.webp',
                'price_regular' => rand(10, 100),  // Random price for example
                'price_sale' => rand(5, 50),  // Random sale price
                'is_show_home' => rand(0,1),
                'description' => 'Description for Product ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Seed product images
            DB::table('product_images')->insert([
                ['product_id' => $productId, 'image' => 'product-' . $i . '-main.jpg', 'is_main' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['product_id' => $productId, 'image' => 'product-' . $i . '-side.jpg', 'is_main' => 0, 'created_at' => now(), 'updated_at' => now()],
            ]);

            // Seed product variants
            for ($j = 1; $j <= 3; $j++) {  // Each product will have 3 variants
                $variantId = DB::table('product_variants')->insertGetId([
                    'product_id' => $productId,
                    'sku' => 'PROD' . str_pad($i, 3, '0', STR_PAD_LEFT) . '-VAR' . $j,
                    'price_regular' => rand(10, 100),
                    'stock' => rand(0, 20),
                    'image' => 'product-' . $i . '-variant-' . $j . '.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Seed variant attributes
                $colorId = DB::table('attribute_values')->where('value', $colorValues[array_rand($colorValues)]['value'])->first()->id;
                $sizeId = DB::table('attribute_values')->where('value', $sizeValues[array_rand($sizeValues)]['value'])->first()->id;

                DB::table('variant_attributes')->insert([
                    'product_variant_id' => $variantId,
                    'attribute_id' => $colorAttributeId,
                    'attribute_value_id' => $colorId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('variant_attributes')->insert([
                    'product_variant_id' => $variantId,
                    'attribute_id' => $sizeAttributeId,
                    'attribute_value_id' => $sizeId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}