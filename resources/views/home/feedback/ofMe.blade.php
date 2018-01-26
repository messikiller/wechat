@extends('layouts.home')

@section('content')

<div class="weui-tab">
    <div class="weui-navbar">
        <div class="weui-navbar__item" @click="clickTab('tab1')" :class="selectedTab=='tab1'?'weui-bar__item_on':''">
            全部反馈
        </div>
        <div class="weui-navbar__item" @click="clickTab('tab2')" :class="selectedTab=='tab2'?'weui-bar__item_on':''">
            已处理
        </div>
    </div>
    <div class="weui-tab__panel">
        <div v-show="selectedTab=='tab1'">
            <div class="weui-cells">
                @foreach ($feedbacks as $feedback)
                    <a class="weui-cell weui-cell_access" href="javascript:;">
                        <div class="weui-cell__bd">
                            <p>{{ $feedback->hsn }}</p>
                        </div>
                        <div class="weui-cell__ft">{{ date('Y-m-d', $feedback->created_at) }}</div>
                    </a>
                @endforeach
            </div>
        </div>
        <div v-show="selectedTab=='tab2'">
            @foreach ($feedbacks->where('status', '=', config('define.feedback.status.finished.value')) as $feedback)
                <a class="weui-cell weui-cell_access" href="javascript:;">
                    <div class="weui-cell__bd">
                        <p>{{ $feedback->hsn }}</p>
                    </div>
                    <div class="weui-cell__ft">{{ date('Y-m-d', $feedback->created_at) }}</div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
new Vue({
    el: '#app',
    data: {
        selectedTab: 'tab1'
    },
    methods: {
        clickTab: function (tab) {
            this.selectedTab = tab;
        }
    }
});
</script>
@endsection
