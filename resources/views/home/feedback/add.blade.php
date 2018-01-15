@extends('layouts.home')

@section('content')

@endsection

@section('script')
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script type="text/javascript">
wx.config({{ $js_config }});
wx.ready(function(){
    
});
</script>
@endsection
