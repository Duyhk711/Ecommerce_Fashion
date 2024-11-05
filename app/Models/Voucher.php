<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'minimum_order_value',
        'quantity',
        'description',
        'is_active',
        'start_date',
        'end_date',
        'quantity',
        'used_quantity',
    ];

    public function userVouchers()
    {
        return $this->hasMany(UserVoucher::class);
    }
}
