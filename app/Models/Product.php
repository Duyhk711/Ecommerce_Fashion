<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
