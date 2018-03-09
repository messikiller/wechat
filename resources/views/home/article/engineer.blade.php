@extends('layouts.home')

@section('style')
<style>
.cover {
    width: 100%;
    height: 100%;
    position: fixed;
    display: flex;
    top: 0;
    background-color: teal;
}

.cover .keypass-container {
    width: 60%;
    height: 150px;
    margin: auto;
}

.cover .keypass-container input {
    background-color: #ffffff;
}

.cover .keypass-container .cover-title {
    font-size: 24px;
    color: #ffffff;
    text-align: center
}
</style>
@endsection

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

    <div class="cover" v-show="showCover">
        <div class="keypass-container">
            <div class="cover-title">
                请输入口令
            </div>
            <div class="weui-cells">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="password" v-model="input" />
                    </div>
                    <div class="weui-cell__ft">
                        <a class="weui-vcode-btn btn-primary" href="javascript:;" @click="clickKeypassBtn">GO!</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
new Vue({
    el: '#app',
    data: {
        showCover: true,
        keypass: '{{ config('define.engineer_keypass') }}',
        input: ''
    },
    methods: {
        clickKeypassBtn: function () {
            if (this.keypass == this.input) {
                this.showCover = false;
            }
        }
    }
});
</script>
@endsection
