@extends('layouts.admin')

@section('breadcrumb')
    <Breadcrumb>
        <Breadcrumb-item>识别码管理</Breadcrumb-item>
        <Breadcrumb-item>识别码列表</Breadcrumb-item>
    </Breadcrumb>
@endsection

@section('main-content')
    <Row>
        <i-col span="24">
            <i-button type="primary" icon="plus" onClick="window.location.href='{{ route('admin.cdkey.add') }}'">添加识别码</i-button>
        </i-col>
    </Row>
    <div style="height: 15px;"></div>

    <Card dis-hover>
        <Row>
            <i-col span="4">
                <i-form :label-width="100">
                    <Form-item label="名称" prop="title">
                        <i-input size="small" v-model="filterCustom.title"></i-input>
                    </Form-item>
                </i-form>
            </i-col>

            <i-col span="4">
                <i-form :label-width="100">
                    <Form-item label="机型" prop="model">
                        <i-input size="small" v-model="filterCustom.model"></i-input>
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
            title: '{{ isset($filter['filter_title']) ? $filter['filter_title'] : '' }}',
            model: '{{ isset($filter['filter_model']) ? $filter['filter_model'] : '' }}'
        },
        header: [
            {title: '#',       key: 'index', width: '100'},
            {title: '识别码名称', key: 'title'},
            {title: '类型', key: 'type_desc'},
            {title: '机型', key: 'model'},
            {title: '创建时间', key: 'created_at'},
            {title: '操作', key: 'action', width: '400', render: (h, params) => {
                return h('div', [
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
            @foreach ($list as $cdkey)
            {
                'index': '{{ $list->perPage() * ($list->currentPage() - 1) + $loop->iteration }}',
                'title': '{{ $cdkey->title }}',
                @foreach (config('define.cdkey.type') as $type)
                    @if ($type['value'] == $cdkey->type)
                        'type_desc': '{{ $type['desc'] }}',
                        @break
                    @endif
                @endforeach
                'model': '{{ $cdkey->model }}',
                'created_at': '{{ date('Y-m-d', $cdkey->created_at) }}',
                'edit_url': '{{ route('admin.cdkey.edit', $cdkey->id) }}'
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
                title: '',
                model: ''
            };
            this.handleSubmitFilter();
        }
    }
});
</script>
@endsection
