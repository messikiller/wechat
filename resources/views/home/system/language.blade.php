@extends('layouts.home')

@section('content')

<form action="{{ url()->current() }}" method="post" ref="dataForm">
    {{ csrf_field() }}

    <div class="weui-cells__title bar">
        @lang('language.notice_before')
    </div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    @lang('language.select_language')
                </label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="language" v-model="formCustom.language">
                    <option value="zh">简体中文</option>
                    <option value="en">English</option>
                    <option value="ru">русский</option>
                    <option value="es">Español</option>
                </select>
            </div>
        </div>
    </div>

    <div class="weui-btn-area">
        <a href="javascript:;" class="weui-btn btn-primary" @click="clickSubmitBtn">Submit</a>
        <a href="{{ route('home.index') }}" class="weui-btn weui-btn_default">Home</a>
    </div>

</form>

@endsection

@section('script')
<script type="text/javascript">
var vm = new Vue({
    el: '#app',
    data: {
        formCustom: {
            language: '{{ $language }}'
        }
    },
    methods: {
        clickSubmitBtn: function () {
            this.$refs.dataForm.submit();
        }
    }
});
</script>
@endsection
