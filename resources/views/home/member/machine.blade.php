@extends('layouts.home')

@section('content')

<form action="{{ url()->current() }}" method="post" ref="dataForm">
    {{ csrf_field() }}

    <div class="weui-cells__title bar">
        @lang('my_machine.notice_before')
    </div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    <span class="required">*&nbsp;</span>
                    @lang('my_machine.machine_type')
                </label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="machine_type"  v-model="formData.machine_type">
                    @foreach (config('define.member.machine_type') as $key => $type)
                        @if ($key == 'default')
                            <option value="{{ $type['value'] }}"></option>
                        @else
                            <option value="{{ $type['value'] }}">{{ __($type['trans']) }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    <span class="required">*&nbsp;</span>
                    SN
                </label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="{{ __('my_machine.scan_machine_qrcode') }}" readonly="true" name="machine_sn" v-model="formData.machine_sn"/>
                <input type="hidden" name="machine_data" v-model="formData.machine_data"/>
            </div>
            <div class="weui-cell__ft">
                <a href="javascript:;" class="weui-vcode-btn" @click="clickScanBtn"><i class="icon ion-qr-scanner"></i></a>
            </div>
        </div>
    </div>

    <div class="weui-btn-area">
        <a href="javascript:;" class="weui-btn btn-primary" @click="clickSubmitBtn">Submit</a>
        <a href="{{ route('home.index') }}" class="weui-btn weui-btn_default">Home</a>
    </div>

</form>

<div v-show="showDialog">
    <div class="weui-mask"></div>
    <div class="weui-dialog">
        <div class="weui-dialog__hd"><strong class="weui-dialog__title">@{{ dialog.title }}</strong></div>
        <div class="weui-dialog__bd">@{{ dialog.info }}</div>
        <div class="weui-dialog__ft">
            <a href="javascript:;" @click="showDialog=false" class="weui-dialog__btn weui-dialog__btn_primary primary-color">OK</a>
        </div>
    </div>
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
        showDialog: false,
        dialog: {
            title: '',
            info: ''
        },
        formData: {
            machine_type: '{{ $member->machine_type }}',
            machine_sn: '{{ empty($member->machine_data) ? '' : json_decode($member->machine_data)->H->S }}',
            machine_data: '{{ $member->machine_data }}'
        }
    },
    methods: {
        clickScanBtn: function () {
            var _formData = this.formData;
            wx.scanQRCode({
                desc: 'Scan SonoScape SN QRCode',
                needResult: 1,
                scanType: ["qrCode"],
                success: function (res) {
                    try {
                        var obj = JSON.parse(res.resultStr);
                        if (typeof obj == 'object' && obj.hasOwnProperty('H')) {
                            _formData.machine_data = res.resultStr;
                            _formData.machine_sn   = obj.H.S;
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
        },
        checkFormInput: function () {
            var _res   = true;
            var _obj   = this.formData;

            for (var k in _obj)
            {
                if (_obj.hasOwnProperty(k))
                {
                    if (_obj[k] == '') {
                        _res = false;
                        break;
                    }
                }
            }
            return _res;
        },
        clickSubmitBtn: function () {
            if (this.checkFormInput()) {
                this.$refs.dataForm.submit();
            } else {
                this.dialog = {
                    title: 'Notice',
                    info: 'Make sure the form is complete !'
                };
                this.showDialog = true;
            }
        }
    }
});
</script>
@endsection
