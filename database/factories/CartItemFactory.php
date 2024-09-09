<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    public function definition()
    {
        $cart = Cart::inRandomOrder()->first(); // Lấy một giỏ hàng ngẫu nhiên
        $productVariant = ProductVariant::inRandomOrder()->first(); // Lấy một biến thể sản phẩm ngẫu nhiên

        return [
            'cart_id' => $cart ? $cart->id : Cart::factory(), // Sử dụng ID giỏ hàng, hoặc tạo mới nếu không có
            'product_variant_id' => $productVariant ? $productVariant->id : ProductVariant::factory(), // ID của biến thể sản phẩm
            'quantity' => $this->faker->numberBetween(1, 5), // Số lượng
            'price' => $productVariant ? $productVariant->price_regular : $this->faker->randomFloat(2, 10, 500), // Giá sản phẩm
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
