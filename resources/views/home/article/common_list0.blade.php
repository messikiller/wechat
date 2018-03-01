@extends('layouts.home')

@section('content')
    <div class="weui-panel weui-panel_access">
        <div class="weui-panel__hd">{{ $title }}</div>
        <div class="weui-panel__bd">

            @foreach($list as $article)
                <a href="{{ $article->url }}" class="weui-media-box weui-media-box_appmsg">
                    <div class="weui-media-box__hd">
                        <img class="weui-media-box__thumb" src="{{ $article->thumbnail }}">
                    </div>
                    <div class="weui-media-box__bd">
                        <h4 class="weui-media-box__title">{{ $article->title }}</h4>
                        <p class="weui-media-box__desc">{{ $article->abstract }}</p>
                    </div>
                </a>
            @endforeach

        </div>
    </div>

    <div class="weui-btn-area">
        <a href="{{ route('home.index') }}" @click="clickSubmitBtn" class="weui-btn btn-primary">Home</a>
    </div>
@endsection
