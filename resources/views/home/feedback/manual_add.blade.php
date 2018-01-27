@extends('layouts.home')

@section('content')

<form action="{{ url()->current() }}" method="post" ref="dataForm">
    {{ csrf_field() }}
    <div class="weui-cells__title bar">请填写报修信息</div>

    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd"><label class="weui-label"><span class="required">*&nbsp;</span>故障类型</label></div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="type" v-model="formData.type">
                    @foreach (config('define.feedback.type') as $type)
                        <option value="{{ $type['value'] }}">{{ $type['desc'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="weui-cells__title">处理器信息</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd"><label for="" class="weui-label">型号</label></div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="hmodel" v-model="formData.hmodel">
                    @foreach ($hcdkeys as $cdkey)
                        <option value="{{ $cdkey->title }}">{{ $cdkey->model }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label"><span class="required">*&nbsp;</span>SN</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入处理器SN号" name="hsn" v-model="formData.hsn">
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">软件版本</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入处理器软件版本" name="hversion" v-model="formData.hversion">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">镜体信息</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd"><label class="weui-label">型号</label></div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="emodel" v-model="formData.emodel">
                    @foreach ($ecdkeys as $cdkey)
                        <option value="{{ $cdkey->title }}">{{ $cdkey->model }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">SN</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入镜体SN号" name="esn" v-model="formData.esn">
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">软件版本</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入镜体软件版本" name="eversion" v-model="formData.eversion">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">光源信息</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd"><label for="" class="weui-label">型号</label></div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="lmodel" v-model="formData.lmodel">
                    @foreach ($lcdkeys as $cdkey)
                        <option value="{{ $cdkey->title }}">{{ $cdkey->model }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">SN</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入光源SN号" name="lsn" v-model="formData.lsn">
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">软件版本</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入光源软件版本" name="lversion" v-model="formData.lversion">
            </div>
        </div>
    </div>

    <div class="weui-cells__title"><span class="required">*&nbsp;</span>故障描述</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <textarea class="weui-textarea" placeholder="请输入文本" rows="3" name="description" v-model="formData.description"></textarea>
            </div>
        </div>
    </div>

    <div class="weui-btn-area">
        <a href="javascript:;" @click="clickSubmitBtn" class="weui-btn weui-btn_primary">Submit</a>
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
    data: {
        showDialog: false,
        dialog: {
            title: '',
            info: ''
        },
        formData: {
            hsn: '',
            hmodel: '',
            hversion: '',
            esn: '',
            emodel: '',
            eversion: '',
            type: '{{ config('define.feedback.type.unknown.value') }}',
            description: ''
        }
    },
    methods: {
        checkFormInput: function () {
            var _res = true;
            var _obj = this.formData;
            if (_obj.hsn == '' || _obj.description == '') {
                _res = false;
            }
            return _res;
        },
        clickSubmitBtn: function () {
            if (this.checkFormInput()) {
                this.$refs.dataForm.submit();
            } else {
                this.dialog = {
                    title: 'Notice',
                    info: 'Make sure the form is complete'
                };
                this.showDialog = true;
            }
        }
    }
});
</script>
@endsection
