<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>SonoScape</title>
<link rel="stylesheet" href="{{ mix('css/home.css') }}">
<style media="screen">
html, body, #app {
    height: 100%;
}

body {
    background-color: #ffffff;
    font-family: -apple-system-font,Helvetica Neue,Helvetica,sans-serif;
}

.text-center {
    text-align: center;
}

.avatar {
    display: inline-block;
    background-color: #efefef;
    width: 56px;
    height: 56px;
    border-radius: 28px;
    border: 1px solid #d2d2d2;
    float: left;
}
.noavatar {
    text-align: center;
    font-size: 28px;
    line-height: 56px;
    color: #d0d0d0;
}
.userinfo {
    padding-left: 70px;
    height: 56px;
    line-height: 56px;
}

.footer {
    padding-top: 20px;
    padding-bottom: 20px;
}

.wechat-color {
    color: #1aad19;
}

.primary-color {
    color: #03a099;
}

.btn-primary {
    background-color: #03a099;
    color: #ffffff;
}

.btn-primary:hover {
    background-color: #027772;
}

.back-white {
    background-color: #ffffff;
}

.back-gray {
    background-color: #f8f8f8;
}

.bar {
    padding:15px 20px;
    font-size: 12px;
    color: #999999;
}

.required {
    color: red;
}

.tab-container {
    border-bottom: 1px solid #ccc;
}

.tab {
    line-height: 25px;
    text-align: center;
    margin: 0 20px;
    padding: 25px 0 10px 0;
    font-size: 14px;
}

.tab-active {
    margin-bottom: -3px;
    border-bottom: 3px solid #03a099;
    color: #03a099;
}
</style>
</head>
<body>
    <div id="app">

        @yield('content')

        <div class="weui-footer footer">
            <p class="weui-footer__text">Copyright &copy; 2002-2018 SonoScape co. Ltd</p>
        </div>
    </div>

<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
@yield('script')

</body>
</html>
