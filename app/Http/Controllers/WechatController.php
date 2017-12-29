<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat;

class WechatController extends Controller
{
    public function serve()
    {
        $app = EasyWeChat::officialAccount();

        $menu = config('define.menu');
        $app->menu->create($menu);

        $app->server->push(function ($message) {
            if ($message['MsgType'] == 'text' && $message['Content'] == '借钱') {
                return route('home.index');
            }
        });

        $response = $app->server->serve();

        return $response;
    }
}
