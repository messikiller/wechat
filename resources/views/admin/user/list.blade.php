@extends('layouts.admin')

@section('breadcrumb')
    <Breadcrumb>
        <Breadcrumb-item>用户管理</Breadcrumb-item>
        <Breadcrumb-item>用户列表</Breadcrumb-item>
    </Breadcrumb>
@endsection

@section('main-content')
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
            {title: '账户名称', key: 'username'},
            {title: '姓名',    key: 'nickname'},
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
                    }, '编辑'),
                    h('Button', {
                        props: {
                            type: 'warning',
                            size: 'small'
                        },
                        style: {
                            marginRight: '5px'
                        },
                        on: {
                            click: () => {
                                window.location.href = params.row.reset_password_url;
                            }
                        }
                    }, '重置密码')
                ]);
            }}
        ],
        data: [
            @foreach ($list as $user)
            {
                'index': '{{ $list->perPage() * ($list->currentPage() - 1) + $loop->iteration }}',
                'username': '{{ $user->username }}',
                'nickname': '{{ $user->nickname }}',
                'created_at': '{{ date("Y-m-d", $user->created_at) }}',
                'edit_url': '{{ route('admin.user.edit', $user->id) }}',
                'reset_password_url': '{{ route('admin.user.resetPassword', $user->id) }}'
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
