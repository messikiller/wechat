@extends('layouts.admin')

@section('breadcrumb')
<Breadcrumb>
    <Breadcrumb-item>会员管理</Breadcrumb-item>
    <Breadcrumb-item>查看会员详情</Breadcrumb-item>
</Breadcrumb>
@endsection

@section('main-content')

    <Row>
        <i-col span="12">
            <table class="ui selectable celled definition structured table">
                <tr>
                    <td width="100" class="right aligned">姓名</td>
                    <td>{{ $member->nickname }}</td>
                </tr>

                <tr>
                    <td width="100" class="right aligned">邮箱</td>
                    <td>{{ $member->mail }}</td>
                </tr>

                <tr>
                    <td width="100" class="right aligned">手机号</td>
                    <td>{{ $member->mobile }}</td>
                </tr>

                <tr>
                    <td width="100" class="right aligned">地区</td>
                    <td>{{ empty($member->region_id) ? '' : $member->region->title }}</td>
                </tr>

                <tr>
                    <td width="100" class="right aligned">医院</td>
                    <td>{{ $member->hospital }}</td>
                </tr>

                <tr>
                    <td width="100" class="right aligned">公司</td>
                    <td>{{ $member->company }}</td>
                </tr>

                <tr>
                    <td width="100" class="right aligned">地址</td>
                    <td>{{ $member->address }}</td>
                </tr>

                <tr>
                    <td width="100" class="right aligned">机器类型</td>
                    <td>
                        @foreach (config('define.member.machine_type') as $machine_type)
                            @if ($machine_type['value'] == $member->machine_type)
                                {{ $machine_type['desc'] }}
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
                                    <th>识别码</th>
                                    <th>机型</th>
                                    <th>软件版本</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (empty($machine_data))
                                    <tr>
                                        <td colspan="5" class="center aligned">-</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>处理器</td>
                                        <td>{{ $machine_data['hsn'] }}</td>
                                        <td>{{ $machine_data['hcdkey'] }}</td>
                                        <td>{{ $machine_data['hmodel'] }}</td>
                                        <td>{{ $machine_data['hversion'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>镜体</td>
                                        <td>{{ $machine_data['esn'] }}</td>
                                        <td>{{ $machine_data['ecdkey'] }}</td>
                                        <td>{{ $machine_data['emodel'] }}</td>
                                        <td>{{ $machine_data['eversion'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>光源</td>
                                        <td>{{ $machine_data['lsn'] }}</td>
                                        <td>{{ $machine_data['lcdkey'] }}</td>
                                        <td>{{ $machine_data['lmodel'] }}</td>
                                        <td>{{ $machine_data['lversion'] }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
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
