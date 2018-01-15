@extends('layouts.home')

@section('content')
<div class="page__hd" style="padding: 40px;">
    <img src="{{ optional($user)->getAvatar()  }}" alt="avatar" class="avatar">
    <div class="userinfo">
        {{ empty($user) ? 'unknown' : optional($user)->getNickname() }}
    </div>
</div>

<div class="bar back-gray">{{ __('home.index.member') }}</div>
<div class="weui-grids">
    <a href="{{ route('member.profile') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-person primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            {{ __('home.index.profile') }}
        </p>
    </a>
    <a href="{{ route('feedback.ofMe') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-chatbubble-working primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            Advice
        </p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-android-settings primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            Setting
        </p>
    </a>
</div>

<div class="bar back-gray">{{ __('home.index.functions') }}</div>
<div class="weui-grids">

    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-chatbox-working primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            Advise
        </p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-archive primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label">
            Download
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
@endsection
