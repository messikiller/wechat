@extends('layouts.home')

@section('content')
<form action="{{ url()->current() }}" method="post">
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
                <select class="weui-select" name="type">
                    @foreach (config('define.member.type') as $type)
                        <option value="{{ $type['value'] }}" {{ $member->type == $type['value']  ? 'selected="selected"' : '' }}>{{ __($type['trans']) }}</option>
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
                <input class="weui-input" type="text" value="{{ $member->nickname }}" name="nickname"/>
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
                <select class="weui-select" name="sex">
                    @foreach (config('define.member.sex') as $sex)
                        <option value="{{ $sex['value'] }}" {{ $member->sex == $sex['value'] ? 'selected="selected"' : '' }}>{{ __($sex['trans']) }}</option>
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
                <input class="weui-input" type="text" name="mail" value="{{ $member->mail }}"/>
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
                <input class="weui-input" type="tel" name="mobile" value="{{ $member->mobile }}"/>
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
                <select class="weui-select" name="region_id">
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}" {{ $region->id == $member->region_id ? 'selected="selected"' : '' }}>{{ $region->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    @lang('profile.company')
                </label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="company" value="{{ $member->company }}"/>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">
                    @lang('profile.hospital')
                </label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="hospital" value="{{ $member->hospital }}"/>
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
                <input class="weui-input" type="text" name="address" value="{{ $member->address }}"/>
            </div>
        </div>

    </div>
    <div class="weui-cells__tips">
        @lang('profile.notice_after')
    </div>

    <div class="weui-btn-area">
        <button type="submit" class="weui-btn btn-primary">Submit</button>
        <a class="weui-btn weui-btn_default" href="{{ route('home.index') }}">Home</a>
    </div>
</form>
@endsection
