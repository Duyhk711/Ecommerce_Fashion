<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addresses')->insert([
            [
                'user_id' => 1,
                'customer_name' => 'John Doe',
                'customer_phone' => '123456789',
                'address_line1' => '123 Main St',
                'address_line2' => 'Apartment 4B',
                'is_default' => '1',
                'city' => 'Ho Chi Minh City',
                'district' => 'District 1',
                'ward' => 'Ward 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
