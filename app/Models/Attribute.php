<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function variantAttributes()
    {
        return $this->hasMany(VariantAttribute::class);
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'variant_attributes')
                    ->withPivot('attribute_value_id');
    }
}
