<?php
namespace App\Services;

class Auth
{
    public static function user()
    {
        return optional(session(config('define.user_session_key')));
    }

    public static function wechat()
    {
        return optional(session(config('define.user_session_key')))->wechat;
    }

    public static function has()
    {
        return ! empty(session( config('define.user_session_key')));
    }

    public static function set($user)
    {
        session()->put(config('define.user_session_key'), $user);
    }
}
