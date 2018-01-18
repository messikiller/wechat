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
    <a href="{{ route('member.profile') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-person primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            个人资料
        </p>
    </a>
    <a href="{{ route('feedback.ofMe') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-chatbubble-working primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            我的反馈
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
</div>

<div class="bar back-gray">功能</div>
<div class="weui-grids">

    <a href={{ route('feedback.add') }} class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-chatbox-working primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
        提交反馈
        </p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-archive primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            下载专区
        </p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-earth primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            联系我们
        </p>
    </a>
</div>
@endsection
