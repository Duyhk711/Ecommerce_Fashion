<?php

namespace Database\Factories;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voucher>
 */
class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Voucher::class;
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->word, // Mã voucher ngẫu nhiên và duy nhất
            'discount_type' => $this->faker->randomElement(['percentage', 'fixed']), // Loại giảm giá
            'discount_value' => $this->faker->randomFloat(2, 1, 100), // Giá trị giảm giá
            'start_date' => $this->faker->date(), // Ngày bắt đầu
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year'), // Ngày kết thúc trong 1 năm tới
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
