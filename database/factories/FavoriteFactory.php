<?php

namespace Database\Factories;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Favorite>
 */
class FavoriteFactory extends Factory
{
    protected $model = Favorite::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id, // Lấy một người dùng ngẫu nhiên hoặc tạo mới
            'product_id' => Product::inRandomOrder()->first()->id ?? Product::factory()->create()->id, // Lấy một sản phẩm ngẫu nhiên hoặc tạo mới
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
