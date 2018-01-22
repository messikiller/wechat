@extends('layouts.admin')

@section('breadcrumb')
    <Breadcrumb>
        <Breadcrumb-item>权限管理</Breadcrumb-item>
        <Breadcrumb-item>权限组列表</Breadcrumb-item>
    </Breadcrumb>
@endsection

@section('main-content')
    <Row>
        <i-col span="24">
            <i-button type="primary" icon="plus" onClick="window.location.href='{{ route('admin.privilegeGroup.add') }}'">添加权限组</i-button>
        </i-col>
    </Row>
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
        header: [
            {title: '#',       key: 'index', width: '100'},
            {title: '权限组名称', key: 'title'},
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
            @foreach ($list as $group)
            {
                'index': '{{ $list->perPage() * ($list->currentPage() - 1) + $loop->iteration }}',
                'title': '{{ $group->title }}',
                'created_at': '{{ date('Y-m-d', $group->created_at) }}',
                'edit_url': '{{ route('admin.privilegeGroup.edit', $group->id) }}'
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
        }
    }
});
</script>
@endsection
