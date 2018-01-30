@extends('layouts.home')

@section('content')
    <div class="weui-cells__title bar">查看反馈详情：</div>
    <div class="weui-form-preview">
        <div class="weui-form-preview__hd">
            <label class="weui-form-preview__label">处理状态</label>
                <em class="weui-form-preview__value">
                    @foreach (config('define.feedback.status') as $status)
                        @if ($status['value'] == $feedback->status)
                            {{ $status['desc'] }}
                            @break
                        @endif
                    @endforeach
                </em>
        </div>
        <div class="weui-form-preview__bd">
            <p>
                <label class="weui-form-preview__label">故障类型</label>
                <span class="weui-form-preview__value">
                    @foreach (config('define.feedback.type') as $type)
                        @if ($type['value'] == $feedback->type)
                            {{ $type['desc'] }}
                            @break
                        @endif
                    @endforeach
                </span>
            </p>
            <p>
                <label class="weui-form-preview__label">反馈人</label>
                <span class="weui-form-preview__value">{{ empty($feedback->member) ? '-' : $feedback->member->nickname }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">反馈时间</label>
                <span class="weui-form-preview__value">{{ date('Y-m-d', $feedback->created_at) }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">处理器SN</label>
                <span class="weui-form-preview__value">{{ empty($feedback->hsn) ? '-' : $feedback->hsn }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">处理器型号</label>
                <span class="weui-form-preview__value">{{ empty($cdkeyIdx[$machineData['H']['M']]) ? '-' : $cdkeyIdx[$machineData['H']['M']]['model'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">处理器软件版本</label>
                <span class="weui-form-preview__value">{{ empty($machineData['H']['V']) ? '-' : $machineData['H']['V'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">镜体SN</label>
                <span class="weui-form-preview__value">{{ empty($machineData['E']['S']) ? '-' : $machineData['E']['S'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">镜体型号</label>
                <span class="weui-form-preview__value">{{ empty($cdkeyIdx[$machineData['E']['M']]) ? '-' : $cdkeyIdx[$machineData['E']['M']]['model'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">镜体软件版本</label>
                <span class="weui-form-preview__value">{{ empty($machineData['E']['V']) ? '-' : $machineData['E']['V'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">光源SN</label>
                <span class="weui-form-preview__value">{{ empty($machineData['L']['S']) ? '-' : $machineData['L']['S'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">光源型号</label>
                <span class="weui-form-preview__value">{{ empty($cdkeyIdx[$machineData['L']['M']]) ? '-' : $cdkeyIdx[$machineData['L']['M']]['model'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">光源软件版本</label>
                <span class="weui-form-preview__value">{{ empty($machineData['L']['V']) ? '-' : $machineData['L']['V'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">故障描述</label>
                <span class="weui-form-preview__value">{{ empty($feedback->description) ? '-' : $feedback->description }}</span>
            </p>
        </div>
        <div class="weui-form-preview__ft">
            <a class="weui-form-preview__btn weui-form-preview__btn_primary" href="{{ route('home.feedback.ofMe') }}">返回反馈列表</a>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
new Vue({
    el: '#app',
    data: {

    },
    methods: {

    }
});
</script>
@endsection
