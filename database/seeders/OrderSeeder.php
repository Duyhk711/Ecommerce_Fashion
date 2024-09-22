<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed dữ liệu cho bảng orders
        $orderId = DB::table('orders')->insertGetId([
            'user_id' => 1,
            'voucher_id' => null,
            'address_id' => 3, // Thay thế bằng ID của địa chỉ có sẵn
            'sku' => 'ORDER001',
            'session_id' => null,
            'customer_name' => 'John Doe',
            'customer_email' => 'johndoe@example.com',
            'customer_phone' => '123456789',
            'total_price' => 200.00,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed dữ liệu cho bảng order_items
        DB::table('order_items')->insert([
            'order_id' => $orderId,
            'product_variant_id' => 7, // ID của product_variant
            'quantity' => 1,
            'price' => 200.00,
            'product_name' => 'Sample Product',
            'product_sku' => 'PROD001',
            'variant_sku' => 'VAR001',
            'variant_price_regular' => 200.00,
            'variant_price_sale' => null,
            'variant_image' => 'image.jpg',
            'customer_name' => 'John Doe',
            'customer_email' => 'johndoe@example.com',
            'customer_phone' => '123456789',
            'address_line1' => '123 Street',
            'address_line2' => '',
            'city' => 'New York',
            'state' => 'NY',
            'postal_code' => '10001',
            'country' => 'USA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
