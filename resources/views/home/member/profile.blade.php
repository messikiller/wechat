@extends('layouts.home')

@section('content')
<form action="{{ url()->current() }}" method="post" ref="dataForm">
    {{ csrf_field() }}

    <div class="weui-cells__title bar">
        @lang('profile.notice_before')
    </div>
    <div class="weui-cells weui-cells_form">

        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    <span class="required">*&nbsp;</span>
                    @lang('profile.role')
                </label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" v-model="formData.type" name="type">
                    @foreach (config('define.member.type') as $type)
                        <option value="{{ $type['value'] }}">{{ __($type['trans']) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    <span class="required">*&nbsp;</span>
                    @lang('profile.name')
                </label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" v-model="formData.nickname" name="nickname"/>
            </div>
        </div>

        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    <span class="required">*&nbsp;</span>
                    @lang('profile.gender')
                </label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" v-model="formData.sex" name="sex">
                    @foreach (config('define.member.sex') as $sex)
                        <option value="{{ $sex['value'] }}">{{ __($sex['trans']) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    <span class="required">*&nbsp;</span>
                    @lang('profile.mail')
                </label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" v-model="formData.mail" name="mail"/>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    <span class="required">*&nbsp;</span>
                    @lang('profile.mobile')
                </label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="tel" v-model="formData.mobile" name="mobile"/>
            </div>
        </div>

        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    <span class="required">*&nbsp;</span>
                    @lang('profile.region')
                </label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" v-model="formData.region_id" name="region_id">
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    <span class="required" v-show="formData.type==types.provider">*&nbsp;</span>
                    @lang('profile.company')
                </label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" v-model="formData.company" name="company"/>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    <span class="required" v-show="formData.type==types.doctor">*&nbsp;</span>
                    @lang('profile.hospital')
                </label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" v-model="formData.hospital" name="hospital"/>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    <span class="required">*&nbsp;</span>
                    @lang('profile.address')
                </label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" v-model="formData.address" name="address"/>
            </div>
        </div>

    </div>
    <div class="weui-cells__tips">
        @lang('profile.notice_after')
    </div>

    <div class="weui-btn-area">
        <a href="javascript:;" class="weui-btn btn-primary" @click="clickSubmitBtn">Submit</a>
        <a class="weui-btn weui-btn_default" href="{{ route('home.index') }}">Home</a>
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
    data: {
        showDialog: false,
        dialog: {
            title: '',
            info: ''
        },
        types: {
            doctor: '{{ config('define.member.type.doctor.value') }}',
            provider: '{{ config('define.member.type.provider.value') }}'
        },
        formData: {
            type:      '{{ $member->type }}',
            nickname:  '{{ $member->nickname }}',
            sex:       '{{ $member->sex }}',
            mail:      '{{ $member->mail }}',
            mobile:    '{{ $member->mobile }}',
            region_id: '{{ $member->region_id }}',
            company:   '{{ $member->company }}',
            hospital:  '{{ $member->hospital }}',
            address:   '{{ $member->address }}'
        }
    },
    methods: {
        checkFormInput: function () {
            var _res   = true;
            var _obj   = this.formData;
            var _types = this.types;

            for (var k in _obj)
            {
                if (_obj.hasOwnProperty(k))
                {
                    if (k == 'company') {
                        if (_type == _types.provider && _obj[k] == '') {
                            _res = false;
                            break;
                        }
                    } else if (k == 'hospital') {
                        if (_type == _types.doctor && _obj[k] == '') {
                            _res = false;
                            break;
                        }
                    } else if (_obj[k] == '') {
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
