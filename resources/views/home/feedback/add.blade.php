@extends('layouts.home')

@section('content')

    <div class="weui-cells__title bar">请填写报修信息</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">SN</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="tel" placeholder="请输入机器SN">
            </div>
            <div class="weui-cell__ft">
                <a href="javascript:;" class="weui-vcode-btn" @click="clickScanBtn">扫一扫</a>
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
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script type="text/javascript">
var vm = new Vue({
    el: '#app',
    mounted: function () {
        wx.config({!! $wx_config !!});
    },
    data: {

    },
    methods: {
        clickScanBtn: function () {
            console.log('1111');
            wx.scanQRCode({
                desc: 'scanQRCode desc',
                needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                success: function (res) {
                   // 回调
                },
                error: function(res){
                      if(res.errMsg.indexOf('function_not_exist') > 0){
                           alert('版本过低请升级')
                        }
                 }
            });
        }
    }
});


</script>
@endsection
