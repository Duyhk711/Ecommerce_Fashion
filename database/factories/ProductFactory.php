<?php

namespace Database\Factories;

use App\Models\Catalogue;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'catalogue_id' => Catalogue::factory(), // Tạo liên kết đến catalogue ngẫu nhiên
            'name' => $this->faker->words(2, true), // Tạo tên sản phẩm bằng hai từ
            'slug' => $this->faker->slug, // Slug cho sản phẩm
            'sku' => $this->faker->unique()->word, // SKU ngẫu nhiên và duy nhất
            'img_thumbnail' => $this->faker->imageUrl(), // Đường dẫn hình ảnh ngẫu nhiên
            'price_regular' => $this->faker->randomFloat(2, 10, 500), // Giá thường
            'price_sale' => $this->faker->optional()->randomFloat(2, 5, 400), // Giá giảm (có thể null)
            'description' => $this->faker->paragraph, // Mô tả ngẫu nhiên
            'content' => $this->faker->text, // Nội dung ngẫu nhiên
            'material' => $this->faker->word, // Vật liệu ngẫu nhiên
            'user_manual' => $this->faker->text, // Hướng dẫn sử dụng ngẫu nhiên
            'view' => $this->faker->numberBetween(0, 1000), // Số lượt xem ngẫu nhiên
            'is_active' => $this->faker->boolean, // Trạng thái hoạt động
            'is_hot_deal' => $this->faker->boolean(30), // 30% xác suất là hot deal
            'is_new' => $this->faker->boolean(50), // 50% xác suất là sản phẩm mới
            'is_show_home' => $this->faker->boolean(50), // 50% xác suất là hiển thị trên trang chủ
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
