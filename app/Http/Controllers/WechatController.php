<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat;

class WechatController extends Controller
{
    public function serve()
    {
        $app = EasyWeChat::officialAccount();

        //$menu = config('define.menu');
        //$app->menu->create($menu);

        $response = $app->server->serve();

        return $response;
    }

    public function oauthCallback(Request $request)
    {
        $app   = EasyWeChat::officialAccount();
        $oauth = $app->oauth;
        $user  = $oauth->user();

        session()->put(config('define.wechat_user_session_key'), $user);

        $target = session('redirect_url', route('home.index'));

        return redirect($target);
    }
}
