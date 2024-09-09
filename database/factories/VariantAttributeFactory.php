<?php

namespace Database\Factories;

use App\Models\VariantAttribute;
use App\Models\ProductVariant; // Nhập model ProductVariant
use App\Models\Attribute; // Nhập model Attribute
use App\Models\AttributeValue; // Nhập model AttributeValue
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VariantAttribute>
 */
class VariantAttributeFactory extends Factory
{
    protected $model = VariantAttribute::class;

    public function definition()
    {
        return [
            'product_variant_id' => ProductVariant::inRandomOrder()->first()->id ?? ProductVariant::factory()->create()->id, // Lấy một biến thể sản phẩm ngẫu nhiên
            'attribute_id' => Attribute::inRandomOrder()->first()->id ?? Attribute::factory()->create()->id, // Lấy một thuộc tính ngẫu nhiên
            'attribute_value_id' => AttributeValue::inRandomOrder()->first()->id ?? AttributeValue::factory()->create()->id, // Lấy một giá trị thuộc tính ngẫu nhiên
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
