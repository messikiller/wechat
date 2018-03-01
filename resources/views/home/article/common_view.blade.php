@extends('layouts.home')

@section('content')
    <article class="weui-article">
        <section>
            <h1><b>{{ $article->title }}</b></h1>
        </section>
        {!! $article->content !!}
    </article>
@endsection

@section('script')
<script type="text/javascript">
new Vue({
    el: '#app',
    created: function () {
        wx.config({!! $wx_config !!});

        wx.onMenuShareTimeline({
            title: '{{ $article->title }}',
            link: '{{ url()->current() }}',
            imgUrl: '{{ asset($article->cover) }}',
            success: function () {},
            cancel: function () {}
        });

        wx.onMenuShareAppMessage({
            title: '{{ $article->title }}',
            desc: '{{ $article->abstract }}',
            link: '{{ url()->current() }}',
            imgUrl: '{{ asset($article->cover) }}',
            type: 'link',
            data: '',
            success: function () {},
            cancel: function () {}
        });
    },
    data: {

    },
    methods: {

    }
});
</script>
@endsection
