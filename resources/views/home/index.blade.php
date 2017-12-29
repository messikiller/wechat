<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<title>WeUI</title>
<!-- 引入 WeUI -->
<link rel="stylesheet" href="{{ mix('css/home.css') }}">
<style media="screen">
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

    <div class="page__hd" style="padding: 40px;">
        <div class="icon ion-person avatar noavatar"></div>
        <div class="userinfo">
            username
        </div>
    </div>

    <div class="bar back-gray">功能</div>
    <div class="weui-grids">
        <a href="javascript:;" class="weui-grid">
            <div class="weui-grid__icon text-center">
                <i class="icon ion-person primary-color" style="font-size: 24px;"></i>
            </div>
            <p class="weui-grid__label">
                Profile
            </p>
        </a>
        <a href="javascript:;" class="weui-grid">
            <div class="weui-grid__icon text-center">
                <i class="icon ion-chatbox-working primary-color" style="font-size: 24px;"></i>
            </div>
            <p class="weui-grid__label">
                Advice
            </p>
        </a>
        <a href="javascript:;" class="weui-grid">
            <div class="weui-grid__icon text-center">
                <i class="icon ion-ios-help primary-color" style="font-size: 24px;"></i>
            </div>
            <p class="weui-grid__label">
                Help
            </p>
        </a>
        <a href="javascript:;" class="weui-grid">
            <div class="weui-grid__icon text-center">
                <i class="icon ion-earth primary-color" style="font-size: 24px;"></i>
            </div>
            <p class="weui-grid__label">
                About
            </p>
        </a>
    </div>

    <div class="bar back-gray">功能</div>
    <div class="weui-grids">
        <a href="javascript:;" class="weui-grid">
            <div class="weui-grid__icon text-center">
                <i class="icon ion-home primary-color" style="font-size: 24px;"></i>
            </div>
            <p class="weui-grid__label">
                Button
            </p>
        </a>
        <a href="javascript:;" class="weui-grid">
            <div class="weui-grid__icon text-center">
                <i class="icon ion-home primary-color" style="font-size: 24px;"></i>
            </div>
            <p class="weui-grid__label">
                Button
            </p>
        </a>
        <a href="javascript:;" class="weui-grid">
            <div class="weui-grid__icon text-center">
                <i class="icon ion-home primary-color" style="font-size: 24px;"></i>
            </div>
            <p class="weui-grid__label">
                Button
            </p>
        </a>
        <a href="javascript:;" class="weui-grid">
            <div class="weui-grid__icon text-center">
                <i class="icon ion-home primary-color" style="font-size: 24px;"></i>
            </div>
            <p class="weui-grid__label">
                Button
            </p>
        </a>
    </div>

</body>
</html>
