@extends('layouts.home')

@section('content')
<div class="page__hd" style="padding: 40px;background-image: url('/img/sonoscape.png');background-size: 100% 100%;">
    <img src="{{ optional($wechat)->getAvatar()  }}" alt="avatar" class="avatar">
    <div class="userinfo">
        {{ empty($wechat) ? 'unknown' : optional($wechat)->getNickname() }}
        @if (! $user->is_completed)
            <span class="weui-badge">unfinished</span>
        @endif
    </div>
</div>

<div class="bar back-gray">
    @lang('index.member_center')
</div>
<div class="weui-grids">
    <a href="{{ route('home.member.profile') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-person primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label grid-title">
            @lang('index.profile')
        </p>
    </a>
    <a href="{{ route('home.feedback.ofMe') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-android-chat primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label grid-title">
            @lang('index.my_repair')
        </p>
    </a>
    <a href="{{ route('home.system.language') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-earth primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label grid-title">
            @lang('index.set_language')
        </p>
    </a>
    <a href="{{ route('home.feedback.add') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-chatbox-working primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label grid-title">
            @lang('index.repair')
        </p>
    </a>
    <a href="{{ route('home.member.machine') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-android-laptop primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label grid-title">
            @lang('index.my_machine')
        </p>
    </a>
</div>

<div class="bar back-gray">
    @lang('index.care_center')
</div>
<div class="weui-grids">
    <a href="{{ route('home.care.ultraDoctor') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-volume-high primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label grid-title">
            @lang('index.ultrasound_doctor')
        </p>
    </a>
    <a href="{{ route('home.care.endoDoctor') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-social-instagram primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label grid-title">
            @lang('index.endoscope_doctor')
        </p>
    </a>
    <a href="{{ route('home.care.providerCenter') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-android-contacts primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label grid-title">
            @lang('index.distributor_center')
        </p>
    </a>
</div>

<div class="bar back-gray">
    @lang('index.technical_support')
</div>
<div class="weui-grids">
    <a href="{{ route('home.support.news') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-ios-paper primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label grid-title">
            @lang('index.news')
        </p>
    </a>
    <a href="{{ route('home.support.ultrasound') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-android-volume-up primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label grid-title">
            @lang('index.ultrasound_center')
        </p>
    </a>
    <a href="{{ route('home.support.endoscope') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-social-instagram-outline primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label grid-title">
            @lang('index.endoscope_center')
        </p>
    </a>
    <a href="{{ route('home.support.endoMaintain') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-medkit primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label grid-title">
            @lang('index.endoscope_maintain')
        </p>
    </a>
</div>

<div class="bar back-gray">
    @lang('index.about_sonoscape')
</div>
<div class="weui-grids">
    <a href="{{ route('home.about.us') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-ribbon-b primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label grid-title">
            @lang('index.about_us')
        </p>
    </a>
    <a href="{{ route('home.about.globe') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-android-globe primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label grid-title">
            @lang('index.global_branch')
        </p>
    </a>
    <a href="{{ route('home.about.contact') }}" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="icon ion-social-whatsapp primary-color" style="font-size: 24px;"></i>
        </div>
        <p class="weui-grid__label grid-title">
            @lang('index.contact_us')
        </p>
    </a>
</div>

@endsection
