<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<title>SonoScape</title>
<link rel="stylesheet" href="{{ mix('css/home.css') }}">
<style media="screen">
html, body {
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
    margin-top: 20px;
}

.wechat-color {
    color: #1aad19;
}

.primary-color {
    color: #00B5AD;
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
</style>
</head>
<body>

@yield('content')

<div class="weui-footer footer">
    <p class="weui-footer__text">Copyright &copy; 2002-2018 SonoScape co. Ltd</p>
</div>

@yield('script')

</body>
</html>
