<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', config('admin.app.title'))</title>
<link rel="stylesheet" href="{{ mix('css/admin_layout.css') }}">
</head>
<body>
<div id="app">

    @php
        $tree = config('navtree');
        $user = \App\Services\Admin::user();
    @endphp

    @inject('ACL', 'App\Services\Acl')

    <div class="layout" style="height:100%;">
        <Row type="flex" style="height:100%;">
            <i-col span="3" v-show="showLeft" class="layout-menu-left">
                <i-menu active-name="1" theme="dark" width="auto" accordion>
                    <div class="layout-logo-left" style="text-align:center;">
                        <Icon type="ios-gear" size="22"></Icon>&ensp;{{ config('admin.app_title') }}
                    </div>

                    @foreach ($tree as $menu)
                        @if ($user->is_admin || $ACL->canAccessOne($user->id, array_values($menu['sub'])))
                            <Submenu name="{{ $loop->iteration }}">
                                <template slot="title">
                                    <Icon type="{{ $menu['icon'] }}" size="20"></Icon>
                                    {{ $menu['title'] }}
                                </template>
                                    @foreach ($menu['sub'] as $subtitle => $subpath)
                                        @if ($user->is_admin || $ACL->canAccess($user->id, $subpath))
                                            <a href="{{ route($subpath) }}" target="sonoscape">
                                                <Menu-item name="{{ $loop->parent->iteration }}-{{ $loop->iteration }}">{{ $subtitle }}</Menu-item>
                                            </a>
                                        @endif
                                    @endforeach
                            </Submenu>
                        @endif
                    @endforeach

                </i-menu>
            </i-col>
            <i-col :span="spanRight">
                <div class="layout-header" id="nav_header">
                    <i-menu mode="horizontal">
                        <Row>
                            <i-col span="4">
                                <i-button type="text" @click="toggleLeft" v-show="showLeft">
                                    <Tooltip content="隐藏侧边栏" placement="right">
                                        <Icon type="navicon" size="32"></Icon>
                                    </Tooltip>
                                </i-button>
                                <i-button type="text" @click="toggleLeft" v-show="!showLeft">
                                    <Tooltip content="展开侧边栏" placement="right">
                                        <Icon type="navicon" size="32" class="rotate"></Icon>
                                    </Tooltip>
                                </i-button>
                            </i-col>
                            <i-col span="6" offset="14">
                                <div class="layout-assistant">
                                    <Submenu name="1">
                                        <template slot="title">
                                            <Icon type="person" size="16"></Icon>欢迎登陆，{{ $user->nickname }}
                                        </template>
                                        <a href="#" target="sonoscape"><Menu-item name="1-1">个人中心</Menu-item></a>
                                        <a href="#" target="sonoscape"><Menu-item name="1-2">重置密码</Menu-item></a>
                                        <a href="#"><Menu-item name="1-3">退出系统</Menu-item></a>
                                    </Submenu>
                                </div>
                                <i-button
                                    type="info"
                                    shape="circle"
                                    size="small"
                                    icon="arrow-left-a"
                                    onClick="window.sonoscape.window.history.back()"
                                >
                                    后退
                                </i-button>
                            </i-col>
                        </Row>
                    </i-menu>
                </div>

                <iframe name="sonoscape"
                    src=""
                    width="100%"
                    frameborder="no"
                    border="0"
                    marginwidth="0"
                    marginheight="0"
                    scrolling="yes"
                    allowtransparency="yes"
                    :style="iframe_style">
                </iframe>

            </i-col>
        </Row>
    </div>

</div>

<script src="{{ mix('js/admin.js') }}"></script>
<script>
new Vue({
    el: '#app',
    data: () => {
        return {
            spanRight: 21,
            showLeft: true,
            iframe_style: {
                height: function () {
                    var _h_app = document.getElementById('app').clientHeight;
                    var _h_nav = document.getElementById('nav_header').clientHeight;
                    return _h_app - _h_nav + 'px';
                }()
            }
        }
    },
    methods: {
        toggleLeft () {
            if (this.showLeft) {
                this.showLeft  = false;
                this.spanRight = 24;
            } else {
                this.spanRight = 21;
                this.showLeft  = true;
            }
        }
    }
});
</script>
</body>
</html>
