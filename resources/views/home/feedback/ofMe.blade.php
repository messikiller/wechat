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
                <a class="weui-cell weui-cell_access" href="javascript:;">
                    <div class="weui-cell__bd">
                        <p>SN:453434346778</p>
                    </div>
                    <div class="weui-cell__ft">2017-09-28</div>
                </a>
                <a class="weui-cell weui-cell_access" href="javascript:;">
                    <div class="weui-cell__bd">
                        <p>SN:453434346778</p>
                    </div>
                    <div class="weui-cell__ft">2017-09-28</div>
                </a>
                <a class="weui-cell weui-cell_access" href="javascript:;">
                    <div class="weui-cell__bd">
                        <p>SN:453434346778</p>
                    </div>
                    <div class="weui-cell__ft">2017-09-28</div>
                </a>
                <a class="weui-cell weui-cell_access" href="javascript:;">
                    <div class="weui-cell__bd">
                        <p>SN:453434346778</p>
                    </div>
                    <div class="weui-cell__ft">2017-09-28</div>
                </a>
                <a class="weui-cell weui-cell_access" href="javascript:;">
                    <div class="weui-cell__bd">
                        <p>SN:453434346778</p>
                    </div>
                    <div class="weui-cell__ft">2017-09-28</div>
                </a>
                <a class="weui-cell weui-cell_access" href="javascript:;">
                    <div class="weui-cell__bd">
                        <p>SN:453434346778</p>
                    </div>
                    <div class="weui-cell__ft">2017-09-28</div>
                </a>
            </div>
        </div>
        <div v-show="selectedTab=='tab2'">Page 2</div>
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
