<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(VoucherSeeder::class);
        $this->call(OrderStatusChangeSeeder::class);
        $this->call(CatalogueSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductVariantSeeder::class);
        $this->call(OrderItemSeeder::class);
        $this->call(CartSeeder::class);
        $this->call(CartItemSeeder::class);
        $this->call(AttributeSeeder::class);
        $this->call(VariantAttributeSeeder::class);
        $this->call(FavoriteSeeder::class);
    }
}
