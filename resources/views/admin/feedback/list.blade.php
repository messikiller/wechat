@extends('layouts.admin')

@section('breadcrumb')
    <Breadcrumb>
        <Breadcrumb-item>反馈管理</Breadcrumb-item>
        <Breadcrumb-item>反馈列表</Breadcrumb-item>
    </Breadcrumb>
@endsection

@section('main-content')
    <Card dis-hover>
        <Row>
            <i-col span="4">
                <i-form :label-width="100">
                    <Form-item label="反馈状态" prop="status">
                        <i-select size="small" v-model="filterCustom.status">
                            @foreach (config('define.feedback.status') as $status)
                                <i-option value="{{ $status['value'] }}">{{ $status['desc'] }}</i-option>
                            @endforeach
                        </i-select>
                    </Form-item>
                </i-form>
            </i-col>

            <i-col span="4">
                <i-form :label-width="100">
                    <Form-item label="故障类型" prop="type">
                        <i-select size="small" v-model="filterCustom.type">
                            @foreach (config('define.feedback.type') as $type)
                                <i-option value="{{ $type['value'] }}">{{ $type['desc'] }}</i-option>
                            @endforeach
                        </i-select>
                    </Form-item>
                </i-form>
            </i-col>

            <i-col span="4">
                <i-form :label-width="100">
                    <Form-item label="处理器SN" prop="type">
                        <i-input size="small" v-model="filterCustom.hsn"></i-input>
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
            status: '{{ isset($filter['filter_status']) ? $filter['filter_status'] : '' }}',
            type: '{{ isset($filter['filter_type']) ? $filter['filter_type'] : '' }}',
            hsn: '{{ isset($filter['filter_hsn']) ? $filter['filter_hsn'] : '' }}'
        },
        header: [
            {title: '#',       key: 'index', width: '100'},
            {title: '会员', key: 'member_nickname'},
            {title: '故障类型', key: 'type_desc'},
            {title: '处理器SN', key: 'hsh'},
            {title: '报修状态', key: 'status_desc'},
            {title: '反馈时间', key: 'created_at'},
            {title: '操作', key: 'action', width: '400', render: (h, params) => {
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
                    }, '查看'),
                    h('Button', {
                        props: {
                            type: 'primary',
                            size: 'small'
                        },
                        style: {
                            marginRight: '5px'
                        },
                        on: {
                            click: () => {
                                window.location.href = params.row.edit_url
                            }
                        }
                    }, '编辑')
                ]);
            }}
        ],
        data: [
            @foreach ($list as $feedback)
            {
                'index': '{{ $list->perPage() * ($list->currentPage() - 1) + $loop->iteration }}',
                'member_nickname': '{{ $feedback->member->nickname }}',
                @foreach (config('define.feedback.type') as $type)
                    @if ($type['value'] == $feedback->type)
                        'type_desc': '{{ $type['desc'] }}',
                        @break
                    @endif
                @endforeach
                'hsh': '{{ $feedback->hsn }}',
                @foreach (config('define.feedback.status') as $status)
                    @if ($status['value'] == $feedback->status)
                        'status_desc': '{{ $status['desc'] }}',
                        @break
                    @endif
                @endforeach
                'created_at': '{{ date('Y-m-d', $feedback->created_at) }}',
                'view_url': '{{ route('admin.feedback.view', $feedback->id) }}',
                'edit_url': '{{ route('admin.feedback.edit', $feedback->id) }}'
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
                status: '',
                type: '',
                hsn: ''
            };
            this.handleSubmitFilter();
        }
    }
});
</script>
@endsection
