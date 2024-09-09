<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(), // Tạo liên kết đến product ngẫu nhiên
            'sku' => $this->faker->unique()->word, // SKU ngẫu nhiên và duy nhất
            'price_regular' => $this->faker->randomFloat(2, 10, 500), // Giá thường
            'price_sale' => $this->faker->optional()->randomFloat(2, 5, 400), // Giá giảm (có thể null)
            'stock' => $this->faker->numberBetween(0, 100), // Số lượng hàng tồn kho
            'image' => $this->faker->imageUrl(), // Đường dẫn hình ảnh ngẫu nhiên
            
        ];
    }
}
