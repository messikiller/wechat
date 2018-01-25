@extends('layouts.home')

@section('content')

<form action="{{ url()->current() }}" method="post">
    {{ csrf_field() }}

    <div class="weui-cells__title bar">请完善您持有的机器信息</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label for="" class="weui-label">机器类型</label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="machine_type"  v-model="formCustom.machine_type">
                    @foreach (config('define.member.machine_type') as $key => $type)
                        @if ($key == 'default')
                            <option value="{{ $type['value'] }}"></option>
                        @else
                            <option value="{{ $type['value'] }}">{{ $type['desc'] }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">SN</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请扫描机器上的二维码信息" ref="snInput" readonly="true" name="machine_sn" value="{{ empty($member->machine_data) ? '' : json_decode($member->machine_data)->H->S }}">
                <input type="hidden" name="machine_data" ref="machineDataInput" value="{{ $member->machine_data }}">
            </div>
            <div class="weui-cell__ft">
                <a href="javascript:;" class="weui-vcode-btn" @click="clickScanBtn"><i class="icon ion-qr-scanner"></i></a>
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
    created: function () {
        wx.config({!! $wx_config !!});
    },
    data: {
        formCustom: {
            machine_type: '{{ $member->machine_type }}'
        }
    },
    methods: {
        clickScanBtn: function () {
            var _snInput = this.$refs.snInput;
            var _machineDataInput = this.$refs.machineDataInput;
            wx.scanQRCode({
                desc: 'Scan SonoScape SN QRCode',
                needResult: 1,
                scanType: ["qrCode"],
                success: function (res) {
                    try {
                        var obj = JSON.parse(res.resultStr);
                        if (typeof obj == 'object' && obj.hasOwnProperty('H')) {
                            _machineDataInput.value = res.resultStr;
                            _snInput.value = obj.H.S;
                        } else {
                            throw 'failed';
                        }
                    } catch (e) {
                        alert('Please Scan SonoScape Machine QR Code !')
                    }
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
