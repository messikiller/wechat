@extends('layouts.home')

@section('content')
<div class="page__hd" style="padding: 40px;background-image: url('/img/sonoscape.png');background-size: 100% 100%;">
    <img src="{{ optional($wechat)->getAvatar()  }}" alt="avatar" class="avatar">
    <div class="userinfo">
        {{ empty($wechat) ? 'unknown' : optional($wechat)->getNickname() }}
        @if (! $user->is_completed)
            <span class="weui-badge">未完善</span>
        @endif
    </div>
</div>

<div class="bar back-gray">会员中心</div>
<div class="weui-grids">
    <a href="{{ route('home.member.profile') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-person primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            个人资料
        </p>
    </a>
    <a href="{{ route('home.feedback.ofMe') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-chatbubble-working primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            我的报修
        </p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-android-settings primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            系统设置
        </p>
    </a>
    <a href="{{ route('home.feedback.add') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-chatbox-working primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            设备报修
        </p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-android-desktop primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            我的机器
        </p>
    </a>
</div>

<div class="bar back-gray">维修中心</div>
<div class="weui-grids">
    <a href="{{ route('home.care.endoDoctor') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-settings primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            医生中心（ES）
        </p>
    </a>
    <a href="{{ route('home.care.ultraDoctor') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-hammer primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            医生中心（US）
        </p>
    </a>
    <a href="{{ route('home.care.providerCenter') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-person-stalker primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            经销商中心
        </p>
    </a>
</div>

<div class="bar back-gray">技术支持</div>
<div class="weui-grids">
    <a href="{{ route('home.support.news') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-ios-paper primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            新闻
        </p>
    </a>
    <a href="{{ route('home.support.ultrasound') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-android-volume-up primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            超声中心
        </p>
    </a>
    <a href="{{ route('home.support.endoscope') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-social-instagram-outline primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            内窥镜中心
        </p>
    </a>
    <a href="{{ route('home.support.endoMaintain') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-medkit primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            内窥镜保养
        </p>
    </a>
</div>

<div class="bar back-gray">关于开立</div>
<div class="weui-grids">
    <a href="{{ route('home.about.us') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-ios-people primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            关于我们
        </p>
    </a>
    <a href="{{ route('home.about.globe') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-earth primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            全球分支
        </p>
    </a>
    <a href="{{ route('home.about.contact') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-social-whatsapp primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            联系我们
        </p>
    </a>
</div>

@endsection
