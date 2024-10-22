<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedVoucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'voucher_id',
    ];

    // Quan hệ với bảng vouchers
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    // Quan hệ với bảng users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
