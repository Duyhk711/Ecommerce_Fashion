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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeFilterByCategory($query, $categories)
    {
        if (!empty($categories) && is_array($categories)) {
            return $query->whereIn('catalogue_id ', $categories);
        }
        return $query; // Nếu không có danh mục, trả về query gốc
    }

    public function scopeFilterByPrice($query, $priceRange)
    {
        if (!empty($priceRange) && strpos($priceRange, '-') !== false) {
            $range = explode('-', $priceRange);
            $min = (float) $range[0];
            $max = (float) $range[1];

            return $query->whereBetween('price_regular', [$min, $max]);
        }
        return $query; // Nếu không có khoảng giá, trả về query gốc
    }
    public function scopeFilterByColors($query, $colors)
    {
        if (!empty($colors) && is_array($colors) && count($colors) > 0) {
            return $query->whereHas('variants.variantAttributes', function ($q) use ($colors) {
                $q->whereIn('attribute_value_id', $colors);
            });
        }
        return $query; // Nếu không có màu, trả về query gốc
    }

    public function scopeFilterBySize($query, $sizes)
    {
        if (!empty($sizes) && is_array($sizes) && count($sizes) > 0) {
            return $query->whereHas('variants.variantAttributes', function ($q) use ($sizes) {
                $q->whereIn('attribute_value_id', $sizes);
            });
        }
        return $query; // Nếu không có kích thước, trả về query gốc
    }
}
