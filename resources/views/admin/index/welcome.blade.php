@extends('layouts.admin')

@section('style')
<style>
.badge-success {
    background-color: #00cc66 !important;
}
.badge-error {
    background-color: #ff3300 !important;
}
</style>
@endsection

@section('breadcrumb')
<Breadcrumb>
    <Breadcrumb-item>首页</Breadcrumb-item>
    <Breadcrumb-item>欢迎</Breadcrumb-item>
</Breadcrumb>
@endsection

@section('main-content')

<Row>
    <i-col span="24">
        <h2 style="display: inline-block;">{{ config('admin.app.title') }}</h2>
        <Badge count="Beta"></Badge>
    </i-col>
</Row>

<div style="height: 20px;"></div>

<Row>
    <i-col span="12">
        <Card dis-hover :bordered="false">
            <Alert type="info" show-icon>
                当前用户
                <Icon type="person" slot="icon" size="36"></Icon>
                <template slot="desc">{{ $user->nickname }}</template>
            </Alert>
        </Card>
    </i-col>

    <i-col span="12">
        <Card dis-hover :bordered="false">
            <Alert type="warning" show-icon>
                登录 IP
                <Icon type="information-circled" slot="icon" size="36"></Icon>
                <template slot="desc">{{ $_SERVER['REMOTE_ADDR'] }}</template>
            </Alert>
        </Card>
    </i-col>

    <i-col span="24">
        <Card dis-hover :bordered="false">
            <Alert type="success" show-icon>
                权限列表
                <Icon type="gear-b" slot="icon" size="36"></Icon>
                <template slot="desc" style="color: red !important;">
                    @if (count($privData) == 0)
                        <b>无</b>
                    @else
                        <ul style="list-style: disc;">
                            @foreach ($privData as $group => $privileges)
                                <li style="margin: 5px 10px;">
                                    {{ $group }} :
                                    @foreach ($privileges as $privilege)
                                        <Tag type="border" color="green"><Icon type="checkmark-circled" size="14"></Icon> {{ $privilege }}</Tag>
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </template>
            </Alert>
        </Card>
    </i-col>
</Row>

<div style="height: 20px;"></div>

@endsection

@section('script')
<script>
new Vue({
    el: '#app'
});
</script>
@endsection
