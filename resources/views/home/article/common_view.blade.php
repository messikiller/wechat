@extends('layouts.home')

@section('content')
    <article class="weui-article">
        <section>
            <h1><b>{{ $article->title }}</b></h1>
        </section>
        {!! $article->content !!}
    </article>
@endsection
