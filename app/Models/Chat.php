<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id', 'receiver_id', 'message', 'seen'];

    // Liên kết với model User (cả người gửi và người nhận đều là user)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public static function unreadCount($userId)
    {
        return self::where('receiver_id', $userId)
                   ->where('seen', false)
                   ->count();
    }
}
