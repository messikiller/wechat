@extends('layouts.home')

@section('content')
<div class="page__hd" style="padding: 40px;">
    {{-- <div class="icon ion-person avatar noavatar"></div> --}}
    <img src="{{ optional($user)->getAvatar()  }}" alt="avatar" class="avatar">
    <div class="userinfo">
        {{ optional($user)->getNickname() }}
    </div>
</div>

<div class="bar back-gray">功能</div>
<div class="weui-grids">
    <a href="{{ route('member.profile') }}" class="weui-grid">
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
@endsection
