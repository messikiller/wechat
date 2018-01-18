@extends('layouts.home')

@section('content')

    <div class="weui-flex">
        @foreach ($serviceList as $service)
            <div class="weui-flex__item"><a href="{{ route('customerService.open', ['open_id' => $service['kf_account'])] }}">{{ $service['kf_nick'] }}</a></div>
        @endforeach
    </div>

@endsection
