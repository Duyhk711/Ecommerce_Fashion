<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        $productVariant = ProductVariant::inRandomOrder()->first(); // Lấy một biến thể sản phẩm ngẫu nhiên
        $order = Order::inRandomOrder()->first(); // Lấy một đơn hàng ngẫu nhiên

        return [
            'order_id' => $order ? $order->id : Order::factory(), // Sử dụng ID đơn hàng, hoặc tạo mới nếu không có
            'product_variant_id' => $productVariant->id, // ID của biến thể sản phẩm
            'quantity' => $this->faker->numberBetween(1, 10), // Số lượng
            'price' => $productVariant->price_regular, // Giá sản phẩm
            'product_name' => $this->faker->words(2, true), // Tên sản phẩm
            'product_sku' => $productVariant->sku, // SKU sản phẩm
            'variant_sku' => $productVariant->sku, // SKU biến thể
            'variant_price_regular' => $productVariant->price_regular, // Giá thường biến thể
            'variant_price_sale' => $productVariant->price_sale, // Giá giảm biến thể (có thể null)
            'variant_image' => $productVariant->image, // Hình ảnh biến thể
            'customer_name' => $this->faker->name, // Tên khách hàng
            'customer_email' => $this->faker->unique()->safeEmail, // Email khách hàng
            'customer_phone' => $this->faker->phoneNumber, // Số điện thoại khách hàng
            'address_line1' => $this->faker->streetAddress, // Địa chỉ 1
            'address_line2' => $this->faker->optional()->streetAddress, // Địa chỉ 2 (có thể null)
            'city' => $this->faker->city, // Thành phố
            'state' => $this->faker->state, // Bang/Tỉnh
            'postal_code' => $this->faker->postcode, // Mã bưu điện
            'country' => $this->faker->country, // Quốc gia
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
