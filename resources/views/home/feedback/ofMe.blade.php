@extends('layouts.home')

@section('content')
    <div class="weui-flex tab-container">
        <div class="weui-flex__item">
            <div class="tab" :class="selectedTabIndex==1?'tab-active':''" @click="clickTab(1)">
                @lang('my_repair.all_feedback')
            </div>
        </div>
        <div class="weui-flex__item">
            <div class="tab" :class="selectedTabIndex==2?'tab-active':''" @click="clickTab(2)">
                @lang('my_repair.processing_feedback')
            </div>
        </div>
        <div class="weui-flex__item">
            <div class="tab" :class="selectedTabIndex==3?'tab-active':''" @click="clickTab(3)">
                @lang('my_repair.processed_feedback')
            </div>
        </div>
    </div>
    <div v-show="selectedTabIndex==1">
        <div class="weui-cells">
            @foreach ($feedbacks as $feedback)
                <a class="weui-cell weui-cell_access" href="{{ route('home.feedback.view', ['id' => $feedback->id]) }}">
                    <div class="weui-cell__hd"><i class="icon ion-chatbox-working primary-color"></i>&nbsp;</div>
                    <div class="weui-cell__bd">
                        <p>SN: {{ $feedback->hsn }}</p>
                    </div>
                    <div class="weui-cell__ft">{{ date('Y-m-d', $feedback->created_at) }}</div>
                </a>
            @endforeach
        </div>
    </div>
    <div v-show="selectedTabIndex==2">
        <div class="weui-cells">
            @foreach ($feedbacks->where('status', '=', config('define.feedback.status.processing.value')) as $feedback)
                <a class="weui-cell weui-cell_access" href="{{ route('home.feedback.view', ['id' => $feedback->id]) }}">
                    <div class="weui-cell__hd"><i class="icon ion-chatbox-working primary-color"></i>&nbsp;</div>
                    <div class="weui-cell__bd">
                        <p>SN: {{ $feedback->hsn }}</p>
                    </div>
                    <div class="weui-cell__ft">{{ date('Y-m-d', $feedback->created_at) }}</div>
                </a>
            @endforeach
        </div>
    </div>
    <div v-show="selectedTabIndex==3">
        <div class="weui-cells">
            @foreach ($feedbacks->where('status', '=', config('define.feedback.status.finished.value')) as $feedback)
                <a class="weui-cell weui-cell_access" href="{{ route('home.feedback.view', ['id' => $feedback->id]) }}">
                    <div class="weui-cell__hd"><i class="icon ion-chatbox-working primary-color"></i>&nbsp;</div>
                    <div class="weui-cell__bd">
                        <p>SN: {{ $feedback->hsn }}</p>
                    </div>
                    <div class="weui-cell__ft">{{ date('Y-m-d', $feedback->created_at) }}</div>
                </a>
            @endforeach
        </div>
    </div>

    <div class="weui-btn-area">
        <a href="{{ route('home.index') }}" class="weui-btn btn-primary">Home</a>
    </div>
@endsection

@section('script')
<script type="text/javascript">
new Vue({
    el: '#app',
    data: {
        selectedTabIndex: 1
    },
    methods: {
        clickTab: function (index) {
            this.selectedTabIndex = index;
        }
    }
});
</script>
@endsection
