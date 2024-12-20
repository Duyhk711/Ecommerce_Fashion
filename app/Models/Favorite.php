<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        // 'product_variant_id',
    ];

    /**
     * Get the user that owns the favorite.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that is favorited.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
