<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', config('admin.app.title'))</title>
<link rel="stylesheet" href="{{ mix('css/admin.css') }}">
@yield('style')
</head>
<body>
<div id="app" class="layout">

    <Row>
        <i-col span="24">
            <div class="layout-breadcrumb">
                @yield('breadcrumb')
            </div>
        </i-col>
    </Row>

    <Row>
        <i-col span="24">
            <div class="layout-content" id="main-content">
                <div class="layout-content-main">
                    @yield('main-content')
                </div>
            </div>
            <div class="layout-copy">
                2002-2017 &copy; sonoscape&ensp;联系我们：<a href="mailto:heqm@sonoscape.mail">何奇明（heqm@sonoscape.mail）<a>
            </div>
        </i-col>
    </Row>

</div>

<script src="{{ mix('js/admin.js') }}"></script>
<script type="text/javascript">
    document.getElementById('main-content').style.minHeight = document.body.clientHeight - 115 + 'px';
</script>
@yield('script')
</body>
</html>
