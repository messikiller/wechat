@extends('layouts.admin')

@section('breadcrumb')
    <Breadcrumb>
        <Breadcrumb-item>会员管理</Breadcrumb-item>
        <Breadcrumb-item>会员列表</Breadcrumb-item>
    </Breadcrumb>
@endsection

@section('main-content')
    <Card dis-hover>
        <Row>
            <i-col span="4">
                <i-form :label-width="100">
                    <Form-item label="会员类型" prop="type">
                        <i-select size="small" v-model="filterCustom.type">
                            @foreach (config('define.member.type') as $type)
                                <i-option value="{{ $type['value'] }}">{{ $type['desc'] }}</i-option>
                            @endforeach
                        </i-select>
                    </Form-item>
                </i-form>
            </i-col>

        </Row>
        <Row>
            <i-col span="24">
                <i-button type="info" size="small" style="margin-left: 100px;margin-right: 5px;" @click="handleSubmitFilter()">筛选</i-button>
                <i-button type="warning" size="small" style="margin-right: 5px;" @click="handleResetFilter()">重置</i-button>
            </i-col>
        </Row>
    </Card>

    <div style="height: 15px;"></div>
    <i-table border :columns="header" :data="data" size="small"></i-table>
    <div style="height: 15px;"></div>
    <Page :total="{{ $list->total() }}"
          :page-size="{{ $list->perPage() }}"
          :current="{{ $list->currentPage() }}"
          @on-change="handlePageChange"
          show-elevator>
     </Page>
@endsection

@section('script')
<script type="text/javascript">
var vm = new Vue({
    el: '#app',
    data: {
        filterCustom: {
            type: '{{ isset($filter['filter_type']) ? $filter['filter_type'] : '' }}'
        },
        header: [
            {title: '#',       key: 'index', width: '100'},
            {title: '类型', key: 'type_desc'},
            {title: '姓名', key: 'nickname'},
            {title: '邮箱', key: 'mail'},
            {title: '手机号', key: 'mobile'},
            {title: '地区', key: 'region_title'},
            {title: '医院', key: 'hospital_title'},
            {title: '公司', key: 'company_title'},
            {title: '机器类型', key: 'machine_type_desc'},
            {title: '是否完善资料', key: 'is_completed_desc'},
            {title: '操作', key: 'action', width: '200', render: (h, params) => {
                return h('div', [
                    h('Button', {
                        props: {
                            type: 'success',
                            size: 'small'
                        },
                        style: {
                            marginRight: '5px'
                        },
                        on: {
                            click: () => {
                                window.location.href = params.row.view_url
                            }
                        }
                    }, '查看')
                ]);
            }}
        ],
        data: [
            @foreach ($list as $member)
            {
                'index': '{{ $list->perPage() * ($list->currentPage() - 1) + $loop->iteration }}',
                @foreach (config('define.member.type') as $type)
                    @if ($type['value'] == $member->type)
                        'type_desc': '{{ $type['desc'] }}',
                        @break
                    @endif
                @endforeach
                'nickname': '{{ $member->nickname }}',
                'mail': '{{ $member->mail }}',
                'mobile': '{{ $member->mobile }}',
                'region_title': '{{ optional($member->region)->title }}',
                'hospital_title': '{{ optional($member->hospital)->title }}',
                'company_title': '{{ optional($member->company)->title }}',
                @foreach (config('define.member.machine_type') as $machine_type)
                    @if ($machine_type['value'] == $member->machine_type)
                        'machine_type_desc': '{{ $machine_type['desc'] }}',
                        @break
                    @endif
                @endforeach
                @foreach (config('define.member.is_completed') as $is_completed)
                    @if ($is_completed['value'] == $member->is_completed)
                        'is_completed_desc': '{{ $is_completed['desc'] }}',
                        @break
                    @endif
                @endforeach
                'created_at': '{{ date('Y-m-d', $member->created_at) }}',
                'view_url': '{{ route('admin.member.view', $member->id) }}'
            }
                @if (! $loop->last)
                ,
                @endif
            @endforeach
        ]
    },
    methods: {
        handlePageChange (page) {
            var url = "{!! $list->url(0) !!}";
            window.location.href = url.replace(/page=\d+/, 'page='+page);
        },
        handleSubmitFilter () {
            var url = '{{ url()->current() }}' + '?page=1';

            for (key in this.filterCustom) {
                if (! this.filterCustom[key]) {
                    continue;
                }
                url += '&filter_' + key + '=' + this.filterCustom[key];
            }

            window.location.href = url;
        },
        handleResetFilter () {
            this.filterCustom = {
                type: ''
            };
            this.handleSubmitFilter();
        }
    }
});
</script>
@endsection
