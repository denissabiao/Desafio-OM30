<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class UserService extends User
{
    public static function getCookie($token)
    {
        return Cookie::make('token', $token, 60, null, null, false, true, false, 'lax');
    }
}
