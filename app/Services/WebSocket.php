<?php

namespace App\Services;

use App\Models\User;

class WebSocket
{
    public static function user()
    {
        return User::find(auth()->id());
    }
}
