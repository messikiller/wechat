@extends('layouts.home')

@section('content')

<form action="{{ url()->current() }}" method="post" ref="dataForm">
    {{ csrf_field() }}
    <div class="weui-cells__title bar">
        @lang('repair.notice_before')
        ，
        <a href="{{ route('home.feedback.manualAdd') }}">{{ __('repair.here_manual_feedback') }} <i class="icon ion-ios-lightbulb"></i></a>）</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    <span class="required">*&nbsp;</span>
                    @lang('repair.type')
                </label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="type" v-model="formData.type">
                    @foreach (config('define.feedback.type') as $type)
                        <option value="{{ $type['value'] }}">{{ __($type['trans']) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    <span class="required">*&nbsp;</span>
                    @lang('repair.hsn')
                </label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="{{ __('repair.scan_machine_qrcode') }}" readonly="true" name="hsn" v-model="formData.hsn">
                <input type="hidden" name="machine_data" v-model="formData.machine_data"/>
            </div>
            <div class="weui-cell__ft">
                <a href="javascript:;" class="weui-vcode-btn" @click="clickScanBtn"><i class="icon ion-qr-scanner"></i></a>
            </div>
        </div>

    </div>

    <div class="weui-cells weui-cells_form">
        <div class="weui-cells__title">
            <span class="required">*&nbsp;</span>
            @lang('repair.description')
        </div>
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <textarea class="weui-textarea" rows="3" name="description" v-model="formData.description"></textarea>
                </div>
            </div>
        </div>

    </div>

    <div class="weui-btn-area">
        <a href="javascript:;" @click="clickSubmitBtn" class="weui-btn btn-primary">Submit</a>
        <a href="{{ route('home.index') }}" class="weui-btn weui-btn_default">Home</a>
    </div>

</form>

<div v-show="showDialog">
    <div class="weui-mask"></div>
    <div class="weui-dialog">
        <div class="weui-dialog__hd"><strong class="weui-dialog__title">@{{ dialog.title }}</strong></div>
        <div class="weui-dialog__bd">@{{ dialog.info }}</div>
        <div class="weui-dialog__ft">
            <a href="javascript:;" @click="showDialog=false" class="weui-dialog__btn weui-dialog__btn_primary">OK</a>
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
            hsn: '',
            machine_data: '',
            type: '',
            description: ''
        }
    },
    methods: {
        clickScanBtn: function () {
            var _this = this;
            wx.scanQRCode({
                desc: 'Scan SonoScape SN QRCode',
                needResult: 1,
                scanType: ["qrCode"],
                success: function (res) {
                    try {
                        var obj = JSON.parse(res.resultStr);
                        if (typeof obj == 'object' && obj.hasOwnProperty('H')) {
                            _this.formData.machine_data = res.resultStr;
                            _this.formData.hsn = obj.H.S;
                        } else {
                            throw 'failed';
                        }
                    } catch (e) {
                        this.dialog = {
                            title: 'Error',
                            info: 'Please Scan SonoScape Machine QR Code !'
                        };
                        this.showDialog = true;
                    }
                },
                error: function (res) {
                    alert('Error');
                }
            });
        },
        checkFormInput: function () {
            var _res = true;
            var _obj = this.formData;
            for (var k in _obj) {
                if (_obj.hasOwnProperty(k) && _obj[k] == '') {
                    _res = false;
                    break;
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
