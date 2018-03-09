@extends('layouts.home')

@section('content')
    <div class="weui-panel weui-panel_access">
        <div class="weui-panel__hd">{{ $detail }}</div>
        <div class="weui-panel__bd">

            @foreach($articles as $article)
                <a href="
                    @if ($article->type == config('define.article.type.link.value'))
                        {{ $article->content }}
                    @else
                        {{ route('home.index.article', $article->id) }}
                    @endif
                " class="weui-media-box weui-media-box_appmsg">
                    <div class="weui-media-box__hd">
                        <img class="weui-media-box__thumb" src="{{ $article->cover }}" width="100%" height="100%">
                    </div>
                    <div class="weui-media-box__bd">
                        <h4 class="weui-media-box__title">{{ $article->title }}</h4>
                        <p class="weui-media-box__desc">{{ $article->abstract }}</p>
                        <ul class="weui-media-box__info">
                            <li class="weui-media-box__info__meta">{{ date('Y-m-d', $article->created_at) }}</li>
                        </ul>
                    </div>
                </a>
            @endforeach

        </div>
    </div>

    <div class="weui-btn-area">
        <a href="{{ route('home.index') }}" class="weui-btn btn-primary">Home</a>
    </div>
@endsection
