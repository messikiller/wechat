<?php
namespace App\Services;
use App\Models\Member;

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
        return ! empty(session(config('define.user_session_key')));
    }

    public static function set($user)
    {
        session()->put(config('define.user_session_key'), $user);
    }

    public static function reload()
    {
        $user = self::user();
        $wechat_id = $user->wechat_id;

        $member = Member::where('wechat_id', '=', $wechat_id)->first();
        $member->setAttribute('wechat', $user);

        self::set($member);
    }
}
