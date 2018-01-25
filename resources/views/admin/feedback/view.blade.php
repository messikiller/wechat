@extends('layouts.admin')

@section('breadcrumb')
<Breadcrumb>
    <Breadcrumb-item>反馈管理</Breadcrumb-item>
    <Breadcrumb-item>查看反馈详情</Breadcrumb-item>
</Breadcrumb>
@endsection

@section('main-content')

    <Row>
        <i-col span="12">
            <table class="ui selectable celled definition structured table">
                <tr>
                    <td width="100" class="right aligned">会员</td>
                    <td>{{ $feedback->member->nickname }}</td>
                </tr>
                <tr>
                    <td width="100" class="right aligned">反馈时间</td>
                    <td>{{ date('Y-m-d', $feedback->created_at) }}</td>
                </tr>
                <tr>
                    <td class="right aligned">反馈状态</td>
                    <td>
                        @foreach (config('define.feedback.status') as $status)
                            @if ($status['value'] == $feedback->status)
                                {{ $status['desc'] }}
                                @break
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="right aligned">故障类型</td>
                    <td>
                        @foreach (config('define.feedback.type') as $type)
                            @if ($type['value'] == $feedback->type)
                                {{ $type['desc'] }}
                                @break
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="right aligned">机器信息</td>
                    <td>
                        <table class="ui selectable celled structured table">
                            <thead>
                                <tr>
                                    <th style="background-color:#f9fafb;"></th>
                                    <th>SN</th>
                                    <th>型号</th>
                                    <th>软件版本</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>处理器</td>
                                    <td>{{ $machine_data['hsn'] }}</td>
                                    <td>{{ $machine_data['hmodel'] }}</td>
                                    <td>{{ $machine_data['hversion'] }}</td>
                                </tr>
                                <tr>
                                    <td>晶体</td>
                                    <td>{{ $machine_data['esn'] }}</td>
                                    <td>{{ $machine_data['emodel'] }}</td>
                                    <td>{{ $machine_data['eversion'] }}</td>
                                </tr>
                                <tr>
                                    <td>光源</td>
                                    <td>{{ $machine_data['lsn'] }}</td>
                                    <td>{{ $machine_data['lmodel'] }}</td>
                                    <td>{{ $machine_data['lversion'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="right aligned">故障描述</td>
                    <td>
                        {{ $feedback->description }}
                    </td>
                </tr>
            </table>
        </i-col>
    </Row>

@endsection

@section('script')
<script type="text/javascript">
new Vue({
    el: '#app',
    data () {
        return {

        }
    },
    methods: {

    }
});
</script>
@endsection
