@extends('layouts.home')

@section('content')

    <div class="weui-cells__title bar">请填写报修信息</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">手机号</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="tel" placeholder="请输入机器SN">
            </div>
            <div class="weui-cell__ft">
                <a href="javascript:;" class="weui-vcode-btn">扫</a>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd"><label for="" class="weui-label">日期</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="date" value=""/>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd"><label for="" class="weui-label">时间</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="datetime-local" value="" placeholder=""/>
            </div>
        </div>
        
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd"><label class="weui-label">验证码</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="number" placeholder="请输入验证码"/>
            </div>
            <div class="weui-cell__ft">
                <img class="weui-vcode-img" src="./images/vcode.jpg" />
            </div>
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
        <a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">确定</a>
    </div>

@endsection

@section('script')
{{-- <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script type="text/javascript">
wx.config({{ $js_config }});
wx.ready(function(){

}); --}}
</script>
@endsection
