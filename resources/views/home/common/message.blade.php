@extends('layouts.home')

@section('content')
    <div class="weui-msg">
        <div class="weui-msg__icon-area"><i class="weui-icon-{{ empty($msg_type) ? 'success' : $msg_type }} weui-icon_msg"></i></div>
        <div class="weui-msg__text-area">
            <h2 class="weui-msg__title">{{ $title }}</h2>
            <p class="weui-msg__desc">{{ empty($detail) ? '' : $detail }}</p>
        </div>
        <div class="weui-msg__opr-area">
            <p class="weui-btn-area">
                <a href="{{ empty($primary_btn_url) ? '' : $primary_btn_url }}" class="weui-btn weui-btn_primary">{{ empty($primary_btn_desc) ? '' : $primary_btn_desc }}</a>
                <a href="{{ empty($extra_btn_url) ? '' : $extra_btn_url }}" class="weui-btn weui-btn_default">{{ empty($extra_btn_desc) ? '' : $extra_btn_desc }}</a>
            </p>
        </div>
    </div>
@endsection
