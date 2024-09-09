<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Chạy các seeder khác ở đây
        $this->call([
            ProductSeeder::class, // Thêm seeder của bạn tại đây
        ]);
    }
}
