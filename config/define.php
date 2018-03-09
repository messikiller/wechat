<?php
return [
    'user_session_key' => 'user',
    'user_locale_session' => 'locale',
    'engineer_keypass' => 'sonoscape',

    'member' => [
        'is_completed' => [
            'false' => ['value' => 0, 'desc' => '否', 'trans' => 'config.false'],
            'true'  => ['value' => 1, 'desc' => '是', 'trans' => 'config.true'],
        ],
        'sex' => [
            'male'   => ['value' => 0, 'desc' => '男', 'trans' => 'config.male'],
            'female' => ['value' => 1, 'desc' => '女', 'trans' => 'config.female'],
        ],
        'type' => [
            'provider' => ['value' => 0, 'desc' => '代理商', 'trans' => 'config.distributor'],
            'doctor'   => ['value' => 1, 'desc' => '医生', 'trans' => 'config.doctor'],
        ],
        'machine_type' => [
            'default'    => ['value' => 0, 'desc' => '未知', 'trans' => 'config.unknown'],
            'endoscope'  => ['value' => 1, 'desc' => '内窥镜', 'trans' => 'config.endoscope'],
            'ultrasound' => ['value' => 2, 'desc' => '超声', 'trans' => 'config.ultrasound'],
        ],
    ],

    'feedback' => [
        'type' => [
            'unknown' => ['value' => 0, 'desc' => '未知', 'trans' => 'config.unknown'],
            'soft'    => ['value' => 1, 'desc' => '软件故障', 'trans' => 'config.soft_faulty'],
            'hard'    => ['value' => 2, 'desc' => '硬件故障', 'trans' => 'config.hard_faulty'],
        ],
        'status' => [
            'processing' => ['value' => 0, 'desc' => '处理中', 'trans' => 'config.processing'],
            'finished'   => ['value' => 1, 'desc' => '已处理', 'trans' => 'config.finished'],
        ]
    ],

    'user' => [
        'is_admin' => [
            'false' => ['value' => 0, 'desc' => '否', 'trans' => 'config.false'],
            'true'  => ['value' => 1, 'desc' => '是', 'trans' => 'config.true'],
        ],
    ],

    'cdkey' => [
        'type' => [
            'lens'      => ['value' => 0, 'desc' => '镜体', 'trans' => 'config.endoscope'],
            'processor' => ['value' => 1, 'desc' => '处理器', 'trans' => 'config.processor'],
            'light'     => ['value' => 2, 'desc' => '光源', 'trans' => 'config.light_source'],
        ],
    ],

    'article' => [
        'type' => [
            'normal' => ['value' => 0, 'desc' => '普通文章'],
            'link'   => ['value' => 1, 'desc' => '跳转链接'],
        ],
        'album' => [
            'doctor_center_es'   => ['value' => 1, 'desc' => '医生中心（内窥镜）'],
            'doctor_center_us'   => ['value' => 2, 'desc' => '医生中心（超声）'],
            'distributor_center' => ['value' => 3, 'desc' => '代理商中心'],
            'news'               => ['value' => 4, 'desc' => '新闻'],
            'ultrasound_center'  => ['value' => 5, 'desc' => '超声中心'],
            'endoscopy_center'   => ['value' => 6, 'desc' => '内窥镜中心'],
            'endoscopy_maintain' => ['value' => 7, 'desc' => '内窥镜保养'],
            'engineer'           => ['value' => 8, 'desc' => '工程师专区（隐藏）'],
        ],
        'status' => [
            'normal' => ['value' => 0, 'desc' => '正常'],
            'hidden' => ['value' => 1, 'desc' => '隐藏']
        ]
    ],
];
