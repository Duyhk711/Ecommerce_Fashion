<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderStatusChange;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderStatusChange>
 */
class OrderStatusChangeFactory extends Factory
{
    protected $model = OrderStatusChange::class;

    public function definition()
    {
        return [
            'order_id' => Order::factory(), // Tạo liên kết đến order ngẫu nhiên
            'user_id' => User::factory(), // Tạo liên kết đến user ngẫu nhiên
            'old_status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'canceled']),
            'new_status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'canceled']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
