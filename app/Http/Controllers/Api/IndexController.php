<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class IndexController extends ApiController
{
    public function index()
    {
        $ret = [
            'banner' => 'http://wechat.sonoscape.net/img/sonoscape.png',
            'entries' => [
                [
                    'title' => '会员中心',
                    'subs'  => [
                        ['title' => '我的资料', 'icon' => 'person', 'url' => 'pages/profile/profile'],
                        ['title' => '我的报修', 'icon' => 'android-chat', 'url' => 'pages/personal_feedback/personal_feedback'],
                        ['title' => '故障报修', 'icon' => 'chatbox-working', 'url' => 'pages/feedback/feedback'],
                    ]
                ],
            ],
        ];

        return response_json_view(HTTP_STATUS_OK, $ret);
    }
}
