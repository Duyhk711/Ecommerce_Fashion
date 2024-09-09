<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'avatar' => 'https://media.vogue.fr/photos/637e27bf20134248cd8c2278/master/w_1600%2Cc_limit/2106_0130_v0477.1241.jpg',
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(), // Hoặc null nếu bạn muốn
            'password' => bcrypt('password'), // Mật khẩu đã mã hóa
            'remember_token' => Str::random(10), // Tạo token ngẫu nhiên

        ];
    }
}
