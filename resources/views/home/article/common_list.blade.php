@extends('layouts.home')

@section('content')
    <div class="weui-cells__title bar">{{ $detail }}</div>

    @if ($articles->count() == 0)
        <article class="weui-article">
            <p>Maintaining ...</p>
        </article>
    @endif

    <div class="weui-cells">
        @foreach ($articles as $article)
            <a class="weui-cell weui-cell_access" href="{{ route('home.index.article', $article->id) }}">
                <div class="weui-cell__hd"><i class="icon ion-ios-paper primary-color"></i>&ensp;</div>
                <div class="weui-cell__bd">
                    <p>{{ str_limit($article->title, 20) }}</p>
                </div>
                <div class="weui-cell__ft">{{ date('Y-m-d', $article->created_at) }}</div>
            </a>
        @endforeach
    </div>
@endsection
