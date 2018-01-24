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
        'is_completed' => [
            'false' => ['value' => 0, 'desc' => '否'],
            'true'  => ['value' => 1, 'desc' => '是'],
        ],
        'type' => [
            'provider' => ['value' => 0, 'desc' => '医生'],
            'doctor'   => ['value' => 1, 'desc' => '代理商'],
        ],
        'machine_type' => [
            'default'    => ['value' => 0, 'desc' => '未填写'],
            'endoscope'  => ['value' => 1, 'desc' => '内窥镜'],
            'ultrasound' => ['value' => 2, 'desc' => '超声'],
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
            'doctor_center_es'   => ['value' => 1, 'desc' => '内窥镜医生中心（维修）'],
            'doctor_center_us'   => ['value' => 2, 'desc' => '超声医生中心（维修）'],
            'distributor_center' => ['value' => 3, 'desc' => '代理商中心（维修）'],
            'news'               => ['value' => 4, 'desc' => '新闻'],
            'ultrasound_center'  => ['value' => 5, 'desc' => '超声中心（技术支持）'],
            'endoscopy_center'   => ['value' => 6, 'desc' => '内窥镜中心（技术支持）'],
            'endoscopy_maintain' => ['value' => 7, 'desc' => '内窥镜维修（技术支持）'],
        ],
        'status' => [
            'normal' => ['value' => 0, 'desc' => '正常'],
            'hidden' => ['value' => 1, 'desc' => '隐藏']
        ]
    ],
];
