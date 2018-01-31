<?php
return [
    'user_session_key' => 'user',
    'user_locale_session' => 'locale',

    'member' => [
        'is_completed' => [
            'false' => ['value' => 0, 'desc' => translate('config.false')],
            'true'  => ['value' => 1, 'desc' => translate('config.true')],
        ],
        'sex' => [
            ['value' => 0, 'desc' => translate('config.male')],
            ['value' => 1, 'desc' => translate('config.female')],
        ],
        'type' => [
            'provider' => ['value' => 0, 'desc' => translate('config.doctor')],
            'doctor'   => ['value' => 1, 'desc' => translate('config.distributor')],
        ],
        'machine_type' => [
            'default'    => ['value' => 0, 'desc' => translate('config.unknown')],
            'endoscope'  => ['value' => 1, 'desc' => translate('config.endoscope')],
            'ultrasound' => ['value' => 2, 'desc' => translate('config.ultrasound')],
        ],
    ],

    'feedback' => [
        'type' => [
            'unknown' => ['value' => 0, 'desc' => translate('config.unknown')],
            'soft'    => ['value' => 1, 'desc' => translate('config.soft_faulty')],
            'hard'    => ['value' => 2, 'desc' => translate('config.hard_faulty')],
        ],
        'status' => [
            'processing' => ['value' => 0, 'desc' => translate('config.processing')],
            'finished'   => ['value' => 1, 'desc' => translate('config.finished')],
        ]
    ],

    'user' => [
        'is_admin' => [
            'true'  => ['value' => 1, 'desc' => translate('config.true')],
            'false' => ['value' => 0, 'desc' => translate('config.false')],
        ],
    ],

    'cdkey' => [
        'type' => [
            'lens'      => ['value' => 0, 'desc' => translate('config.endoscope')],
            'processor' => ['value' => 1, 'desc' => translate('config.processor')],
            'light'     => ['value' => 2, 'desc' => translate('config.light_source')],
        ],
    ],

    'article' => [
        'album' => [
            'doctor_center_es'   => ['value' => 1, 'desc' => '医生中心（内窥镜）'],
            'doctor_center_us'   => ['value' => 2, 'desc' => '医生中心（超声）'],
            'distributor_center' => ['value' => 3, 'desc' => '代理商中心'],
            'news'               => ['value' => 4, 'desc' => '新闻'],
            'ultrasound_center'  => ['value' => 5, 'desc' => '超声中心'],
            'endoscopy_center'   => ['value' => 6, 'desc' => '内窥镜中心'],
            'endoscopy_maintain' => ['value' => 7, 'desc' => '内窥镜保养'],
        ],
        'status' => [
            'normal' => ['value' => 0, 'desc' => '正常'],
            'hidden' => ['value' => 1, 'desc' => '隐藏']
        ]
    ],
];
