@extends('layouts.home')

@section('content')
<form action="{{ url()->current() }}" method="post">
    {{ csrf_field() }}

    <div class="weui-cells__title bar">请完善您的个人资料</div>
    <div class="weui-cells weui-cells_form">

        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label class="weui-label">角色</label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="type">
                    @foreach (config('define.member.type') as $type)
                        <option value="{{ $type['value'] }}" {{ $member->type == $type['value']  ? 'selected="selected"' : '' }}>{{ $type['desc'] }}</option>
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
                <select class="weui-select" name="sex">
                    <option value="1" {{ $member->sex == 1 ? 'selected="selected"' : '' }}>Male</option>
                    <option value="2" {{ $member->sex == 2 ? 'selected="selected"' : '' }}>Female</option>
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
                <select class="weui-select" name="region_id">
                    <option></option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}" {{ $region->id == $member->region_id ? 'selected="selected"' : '' }}>{{ $region->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label class="weui-label">公司</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入公司名称" name="company" value="{{ $member->company }}"/>
            </div>
        </div>

        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label for="" class="weui-label">医院</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入医院名称" name="hospital" value="{{ $member->hospital }}"/>
            </div>
        </div>

        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label for="" class="weui-label">地址</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入详细地址" name="address" value="{{ $member->address }}"/>
            </div>
        </div>

    </div>
    <div class="weui-cells__tips">注意：医生不需要填写公司，代理商不需要填写医院</div>

    <div class="weui-btn-area">
        <button type="submit" class="weui-btn weui-btn_primary">Submit</button>
        <a class="weui-btn weui-btn_default" href="{{ route('home.index') }}">Home</a>
    </div>
</form>
@endsection
