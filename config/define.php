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
            'provider' => ['value' => 0, 'desc' => '医生'],
            'doctor'   => ['value' => 1, 'desc' => '代理商'],
        ],
    ],

    'feedback' => [
        'type' => [
            'unknown' => ['value' => 0, 'desc' => '未知'],
            'soft'    => ['value' => 1, 'desc' => '软件故障'],
            'hard'    => ['value' => 2, 'desc' => '硬件故障'],
        ],
        'status' => [
            'processing' => ['value' => 0, 'desc' => '处理中'],
            'finished'   => ['value' => 1, 'desc' => '已完成'],
        ]
    ],

    'user' => [
        'is_admin' => [
            'true'  => ['value' => 1, 'desc' => '是'],
            'false' => ['value' => 0, 'desc' => '否'],
        ],
    ],
    
    'article' => [
        'album' => [
            'news'               => ['value' => 1, 'desc' => '新闻'],
            'distributor_center' => ['value' => 2, 'desc' => '代理商中心'],
            'ultrasound_center'  => ['value' => 3, 'desc' => '超声中心'],
            'endoscopy_center'   => ['value' => 4, 'desc' => '内窥镜中心'],
            'endoscopy_maintain' => ['value' => 5, 'desc' => '内窥镜维修']
        ],
        'status' => [
            'normal' => ['value' => 0, 'desc' => '正常'],
            'hidden' => ['value' => 1, 'desc' => '隐藏']
        ]
    ],
];
