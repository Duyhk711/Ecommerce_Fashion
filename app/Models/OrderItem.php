<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
   use HasFactory; // thiếu và đã bổ sung 9/9
    protected $fillable = [
        'order_id',
        'product_variant_id',
        'quantity',
        'price',
        'product_name',
        'product_sku',
        'variant_sku',
        'variant_price_regular',
        'variant_price_sale',
        'variant_image',
        'customer_name',
        'customer_email',
        'customer_phone',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'country',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
