@extends('layouts.home')

@section('content')

    <div class="weui-cells__title bar">请填写报修信息</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">SN</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="tel" placeholder="请输入机器SN" ref="snInput">
            </div>
            <div class="weui-cell__ft">
                <a href="javascript:;" class="weui-vcode-btn" @click="clickScanBtn"><i class="icon ion-qr-scanner"></i></a>
            </div>
        </div>
    </div>

    <div class="weui-cell weui-cell_select weui-cell_select-after">
        <div class="weui-cell__hd">
            <label for="" class="weui-label">故障类型</label>
        </div>
        <div class="weui-cell__bd">
            <select class="weui-select" name="type">
                @foreach (config('define.feedback.type') as $type)
                    <option value="{{ $type['value'] }}">{{ $type['desc'] }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="weui-cells__title">故障描述</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <textarea class="weui-textarea" placeholder="请输入文本" rows="3"></textarea>
            </div>
        </div>
    </div>

    <div class="weui-btn-area">
        <a class="weui-btn weui-btn_primary" href="javascript:">确定</a>
    </div>

@endsection

@section('script')
<script type="text/javascript">
var vm = new Vue({
    el: '#app',
    created: function () {
        wx.config({!! $wx_config !!});
    },
    data: {

    },
    methods: {
        clickScanBtn: function () {
            var _snInput = this.$refs.snInput;
            wx.scanQRCode({
                desc: 'Scan SonoScape SN QRCode',
                needResult: 1,
                scanType: ["qrCode"],
                success: function (res) {
                   _snInput.value = res.resultStr;
                },
                error: function (res) {
                    alert('Error');
                }
            });
        }
    }
});


</script>
@endsection
