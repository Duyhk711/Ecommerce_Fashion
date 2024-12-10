<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;

class UpdateUserOfflineStatus
{
    public function handle(Logout $event)
    {
        $user = $event->user;
        if ($user) {
            $user->update(['is_online' => false]);
        }
    }
}
