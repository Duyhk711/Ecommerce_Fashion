<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */  protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Tạo liên kết đến user ngẫu nhiên
            'voucher_id' => Voucher::factory()->create()->id, // Nếu bạn có model Voucher
            'address_id' => Address::factory(), // Tạo liên kết đến address ngẫu nhiên
            'sku' => $this->faker->unique()->word, // SKU ngẫu nhiên
            'session_id' => $this->faker->uuid, // ID phiên ngẫu nhiên
            'customer_name' => $this->faker->name,
            'customer_email' => $this->faker->safeEmail,
            'customer_phone' => $this->faker->phoneNumber,
            'total_price' => $this->faker->randomFloat(2, 10, 500), // Giá ngẫu nhiên
            'status' => 'pending', // Trạng thái đơn hàng
            'payment_status' => 'unpaid', // Trạng thái thanh toán

        ];
    }
}
