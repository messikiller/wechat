<?php
return [
    'user_session_key' => 'admin.user',
    'app' => [
        'title' => '公众号后台'
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
    ]
];
