<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVoucher extends Model
{

    use HasFactory;

    protected $table = 'user_voucher';
    protected $fillable = ['user_id', 'voucher_id','saved_at', 'is_used', 'limit'];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

}
