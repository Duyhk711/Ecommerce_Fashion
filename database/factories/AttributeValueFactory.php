<?php

namespace Database\Factories;

use App\Models\AttributeValue;
use App\Models\Attribute; 
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttributeValue>
 */
class AttributeValueFactory extends Factory
{
    protected $model = AttributeValue::class;

    public function definition()
    {
        return [
            'attribute_id' => Attribute::inRandomOrder()->first()->id ?? Attribute::factory()->create()->id, // Lấy một thuộc tính ngẫu nhiên hoặc tạo mới
            'value' => $this->faker->word, // Tạo giá trị ngẫu nhiên
            'color_code' => $this->faker->hexColor(), // Tạo mã màu ngẫu nhiên, nên gọi như một phương thức
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
