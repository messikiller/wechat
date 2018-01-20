<?php
namespace App\Services;

class Admin
{
    const config_admin_session_key = 'admin.user_session_key';

    public static function user()
    {
        return session(config(self::config_admin_session_key));
    }

    public static function login($user)
    {
        session()->put(config(self::config_admin_session_key), $user);
    }

    public static function logout()
    {
        session()->forget(config(self::config_admin_session_key));
    }

    public static function has()
    {
        return ! empty(self::user());
    }
}
