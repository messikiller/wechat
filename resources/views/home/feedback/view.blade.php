@extends('layouts.home')

@section('content')
    <div class="weui-cells__title bar">
        @lang('repair_view.notice_before')
    </div>
    <div class="weui-form-preview">
        <div class="weui-form-preview__hd">
            <label class="weui-form-preview__label">
                @lang('repair_view.status')
            </label>
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
                <label class="weui-form-preview__label">
                    @lang('repair_view.faulty_type')
                </label>
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
                <label class="weui-form-preview__label">
                    @lang('repair_view.member_nickname')
                </label>
                <span class="weui-form-preview__value">{{ empty($feedback->member) ? '-' : $feedback->member->nickname }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">
                    @lang('repair_view.created_at')
                </label>
                <span class="weui-form-preview__value">{{ date('Y-m-d', $feedback->created_at) }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">
                    @lang('repair_view.hsn')
                </label>
                <span class="weui-form-preview__value">{{ empty($feedback->hsn) ? '-' : $feedback->hsn }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">
                    @lang('repair_view.hmodel')
                </label>
                <span class="weui-form-preview__value">{{ empty($cdkeyIdx[$machineData['H']['M']]) ? '-' : $cdkeyIdx[$machineData['H']['M']]['model'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">
                    @lang('repair_view.hversion')
                </label>
                <span class="weui-form-preview__value">{{ empty($machineData['H']['V']) ? '-' : $machineData['H']['V'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">
                    @lang('repair_view.esn')
                </label>
                <span class="weui-form-preview__value">{{ empty($machineData['E']['S']) ? '-' : $machineData['E']['S'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">
                    @lang('repair_view.emodel')
                </label>
                <span class="weui-form-preview__value">{{ empty($cdkeyIdx[$machineData['E']['M']]) ? '-' : $cdkeyIdx[$machineData['E']['M']]['model'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">
                    @lang('repair_view.eversion')
                </label>
                <span class="weui-form-preview__value">{{ empty($machineData['E']['V']) ? '-' : $machineData['E']['V'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">
                    @lang('repair_view.lsn')
                </label>
                <span class="weui-form-preview__value">{{ empty($machineData['L']['S']) ? '-' : $machineData['L']['S'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">
                    @lang('repair_view.lmodel')
                </label>
                <span class="weui-form-preview__value">{{ empty($cdkeyIdx[$machineData['L']['M']]) ? '-' : $cdkeyIdx[$machineData['L']['M']]['model'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">
                    @lang('repair_view.lversion')
                </label>
                <span class="weui-form-preview__value">{{ empty($machineData['L']['V']) ? '-' : $machineData['L']['V'] }}</span>
            </p>
            <p>
                <label class="weui-form-preview__label">
                    @lang('repair_view.description')
                </label>
                <span class="weui-form-preview__value">{{ empty($feedback->description) ? '-' : $feedback->description }}</span>
            </p>
        </div>
        <div class="weui-form-preview__ft">
            <a class="weui-form-preview__btn weui-form-preview__btn_default" href="{{ route('home.index') }}">Home</a>
            <a type="submit" class="weui-form-preview__btn weui-form-preview__btn_primary" href="{{ route('home.feedback.ofMe') }}">Back</a>
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
