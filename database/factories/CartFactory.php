<?php

namespace Database\Factories;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->optional()->numberBetween(1, 100), // Giả sử có 100 người dùng
            'session_id' => $this->faker->uuid, // ID phiên ngẫu nhiên
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
