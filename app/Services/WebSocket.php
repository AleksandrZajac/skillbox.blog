<?php

namespace App\Services;

use App\Models\Subscribe;
use App\Models\User;

class WebSocket
{
    public static function subscribe()
    {
        return Subscribe::where('name', '=', 'web-socket')->first();
    }

    public static function user()
    {
        return User::find(auth()->id());
    }
}
