<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'title',
        'comment',
        'rating'
    ];
    
    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($comment) {
            $comment->updated_at = null; // Đặt giá trị null cho updated_at khi tạo mới
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);   
    }

    public function product()
    {
        return $this->belongsTo(Product::class);   
    }

}
