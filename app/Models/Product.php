<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // thiếu và đã bổ sung 9/9
    protected $fillable = [
        'catalogue_id',
        'name',
        'slug',
        'sku',
        'img_thumbnail',
        'price_regular',
        'price_sale',
        'description',
        'content',
        'material',
        'user_manual',
        'view',
        'is_active',
        'is_hot_deal',
        'is_new',
        'is_show_home',
    ];

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function scopeFilterByCategory($query, $categories)
    {
        // dd($categories);
        if (!empty($categories)) {
            // dd([(int) $categories]);
            return $query->where('catalogue_id', $categories);
        }
        // dd($categories);

        return $query; // Nếu không có danh mục, trả về query gốc
    }

    public function scopeFilterByPrice($query, $priceRange)
    {

        if (!empty($priceRange) && strpos($priceRange, '-') !== false) {
            // Loại bỏ ký tự "đ" và khoảng trắng, sau đó phân tách giá trị
            $priceRange = str_replace(['đ', ' ', ','], '', $priceRange);
            $range = explode('-', $priceRange);

            // Đảm bảo có đủ 2 giá trị (min và max)
            if (count($range) == 2) {
                $min = (float) $range[0];
                $max = (float) $range[1];

                // Trả về query có điều kiện lọc theo khoảng giá
                return $query->whereBetween('price_sale', [$min, $max]);
            }
        }
        return $query; // Nếu không có khoảng giá, trả về query gốc
    }
    public function scopeFilterByAttributes($query, $attributes)
    {
        if (!empty($attributes)) {
            return $query->whereHas('variants.variantAttributes', function ($query) use ($attributes) {
                $query->where('attribute_value_id', $attributes)->distinct();
            });
        }
        return $query; // Nếu không có màu, trả về query gốc
    }
}
