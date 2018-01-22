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

];
