<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['session_id', 'sender_id', 'message','is_read'];

    public function chatSession()
    {
        return $this->belongsTo(ChatSession::class, );
    }
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function session()
    {
        return $this->belongsTo(ChatSession::class, 'chat_session_id');
    }
}
