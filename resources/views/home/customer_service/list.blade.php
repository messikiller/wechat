@extends('layouts.home')

@section('content')

    <div class="weui-flex">
        @foreach ($serviceList['kf_list'] as $service)
            <div class="weui-flex__item"><a href="{{ route('customerService.open', ['kf_wechat_id' => $service['kf_account']]) }}">{{ $service['kf_nick'] }}</a></div>
        @endforeach
    </div>

@endsection
