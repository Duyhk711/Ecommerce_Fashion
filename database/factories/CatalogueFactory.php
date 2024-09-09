<?php

namespace Database\Factories;

use App\Models\Catalogue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalogue>
 */
class CatalogueFactory extends Factory
{
    protected $model = Catalogue::class;

    public function definition()
    {
        return [
            'parent_id' => $this->faker->optional()->randomDigitNotNull, // Chọn parent_id ngẫu nhiên
            'name' => $this->faker->word, // Tên danh mục
            'slug' => $this->faker->slug, // Slug cho danh mục
            'description' => $this->faker->optional()->paragraph, // Mô tả ngẫu nhiên
            'is_active' => $this->faker->boolean, // Trạng thái hoạt động
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
