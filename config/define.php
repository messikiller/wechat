<?php
return [
    'user_session_key' => 'user',
    'menu' => [
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
    ],

    'member' => [
        'type' => [
            'doctor'   => ['value' => 0, 'desc' => '代理商'],
            'provider' => ['value' => 1, 'desc' => '医生'],
        ],
    ],
];
