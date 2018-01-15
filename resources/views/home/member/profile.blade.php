@extends('layouts.home')

@section('content')
<form action="{{ url()->current() }}" method="post">
    {{ csrf_field() }}

    <div class="weui-cells__title bar">请完善您的个人资料</div>
    <div class="weui-cells weui-cells_form">

        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label for="" class="weui-label">角色</label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="type" value="{{ $member->type }}">
                    <option></option>
                    @foreach (config('define.member.type') as $type)
                        <option value="{{ $type['value'] }}">{{ $type['desc'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入姓名" value="{{ $member->nickname }}" name="nickname"/>
            </div>
        </div>

        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label for="" class="weui-label">性别</label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="sex" value="{{ $member->sex }}">
                    <option></option>
                    <option value="1">男</option>
                    <option value="2">女</option>
                </select>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">邮箱</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入合法的电子邮箱" name="mail" value="{{ $member->mail }}"/>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">手机号</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="tel" placeholder="请输入" name="mobile" value="{{ $member->mobile }}"/>
            </div>
        </div>

        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label for="" class="weui-label">国家/地区</label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="region_id" value="{{ $member->region_id }}">
                    <option></option>
                    <option value="1">中国</option>
                    <option value="2">美国</option>
                    <option value="3">英国</option>
                </select>
            </div>
        </div>

        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label class="weui-label">公司</label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="company_id" value="{{ $member->company_id }}">
                    <option></option>
                    <option value="1">中国</option>
                    <option value="2">美国</option>
                    <option value="3">英国</option>
                </select>
            </div>
        </div>

        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label for="" class="weui-label">医院</label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="hospital_id" value="{{ $member->hospital_id }}">
                    <option></option>
                    <option value="1">中国</option>
                    <option value="2">美国</option>
                    <option value="3">英国</option>
                </select>
            </div>
        </div>

    </div>
    <div class="weui-cells__tips">注意：医生不需要选择公司，代理商不需要选择医院</div>

    <div class="weui-btn-area">
        <button type="submit" class="weui-btn weui-btn_primary">Submit</button>
        <a class="weui-btn weui-btn_default" href="{{ route('home.index') }}">Home</a>
    </div>
</form>
@endsection
