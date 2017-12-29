<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat;

class WechatController extends Controller
{
    public function serve()
    {
        $app = EasyWeChat::officialAccount();

        $buttons = [
            [
                "type" => "click",
                "name" => "今日歌曲",
                "key"  => "V1001_TODAY_MUSIC"
            ],
            [
                "name"       => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];
        $app->menu->create($buttons);

        $app->server->push(function ($message) {
            if ($message['MsgType'] == 'text' && $message['content'] == '借钱') {
                return '想借钱，找林工！';
            }
        });

        $response = $app->server->serve();

        return $response;
    }
}
