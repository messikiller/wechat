@extends('layouts.home')

@section('content')

<form action="{{ url()->current() }}" method="post">
    {{ csrf_field() }}

    <div class="weui-cells__title bar">请选择您期望的系统语言</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label for="" class="weui-label">语言</label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="language" v-model="formCustom.language">
                    <option value="chinese">汉语</option>>
                    <option value="english">English</option>>
                    <option value="spanish">Español</option>>
                </select>
            </div>
        </div>
    </div>

    <div class="weui-btn-area">
        <button type="submit" class="weui-btn weui-btn_primary">Submit</button>
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
            language: ''
        }
    },
    methods: {
    }
});
</script>
@endsection
