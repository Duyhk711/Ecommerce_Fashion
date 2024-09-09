<?php

namespace Database\Seeders;

use App\Models\Catalogue;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CatalogueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create(); // Khởi tạo Faker

        // Tạo 10 danh mục giả
        $catalogues = Catalogue::factory()->count(10)->create();

        // Cập nhật parent_id cho một số danh mục để tạo mối quan hệ
        foreach ($catalogues as $catalogue) {
            // Lấy danh sách các id đã tạo
            $existingIds = $catalogues->pluck('id')->toArray();

            // Chỉ cập nhật parent_id nếu có id cha hợp lệ
            if ($faker->boolean(50) && count($existingIds) > 1) { // 50% xác suất để có parent_id
                // Chọn một parent_id ngẫu nhiên từ danh sách id đã tồn tại, tránh chọn chính nó
                $parentId = $faker->randomElement(array_diff($existingIds, [$catalogue->id]));
                $catalogue->update(['parent_id' => $parentId]);
            }
        }
    }
}
