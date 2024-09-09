<?php

namespace Database\Seeders;

use App\Models\OrderStatusChange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusChangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderStatusChange::factory()->count(5)->create();
    }
}
