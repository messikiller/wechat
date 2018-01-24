<?php
return [
    [
        'icon'  => 'person-stalker',
        'title' => '用户管理',
        'sub'   => [
            '用户列表' => 'admin.user.list',
            '添加用户' => 'admin.user.add',
        ]
    ],
    [
        'icon'  => 'alert-circled',
        'title' => '权限管理',
        'sub'   => [
            '权限组管理' => 'admin.privilegeGroup.list',
            '权限管理'   => 'admin.privilege.list',
            '用户权限管理' => 'admin.privilege.manage',
        ]
    ],
    [
        'icon'  => 'ios-paper-outline',
        'title' => '文章管理',
        'sub'   => [
            '文章列表'   => 'admin.article.list',
            '发布新文章' => 'admin.article.add',
        ]
    ],
    [
        'icon'  => 'key',
        'title' => '识别码管理',
        'sub'   => [
            '识别码列表' => 'admin.cdkey.list',
            '添加识别码' => 'admin.cdkey.add',
        ]
    ],

];
