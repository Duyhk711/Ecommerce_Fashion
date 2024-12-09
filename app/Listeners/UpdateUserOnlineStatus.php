<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class UpdateUserOnlineStatus
{
    public function handle(Login $event)
    {
        \Log::info('User logged in:', ['user_id' => $event->user->id]);
    $event->user->update(['is_online' => true]);
    }
}
