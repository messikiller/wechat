@extends('layouts.admin')

@section('breadcrumb')
    <Breadcrumb>
        <Breadcrumb-item>文章管理</Breadcrumb-item>
        <Breadcrumb-item>文章列表</Breadcrumb-item>
    </Breadcrumb>
@endsection

@section('main-content')

    <Card dis-hover>
        <Row>
            <i-col span="4">
                <i-form :label-width="100">
                    <Form-item label="标题" prop="title">
                        <i-input size="small" v-model="filterCustom.title"></i-input>
                    </Form-item>
                </i-form>
            </i-col>

            <i-col span="4">
                <i-form :label-width="100">
                    <Form-item label="栏目" prop="album">
                        <i-select size="small" v-model="filterCustom.album">
                            @foreach (config('define.article.album') as $album)
                                <i-option value="{{ $album['value'] }}">{{ $album['desc'] }}</i-option>
                            @endforeach
                        </i-select>
                    </Form-item>
                </i-form>
            </i-col>

            <i-col span="4">
                <i-form :label-width="100">
                    <Form-item label="状态" prop="status">
                        <i-select size="small" v-model="filterCustom.status">
                            @foreach (config('define.article.status') as $status)
                                <i-option value="{{ $status['value'] }}">{{ $status['desc'] }}</i-option>
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
            title: '{{ isset($filter['filter_title']) ? $filter['filter_title'] : '' }}',
            album: '{{ isset($filter['filter_album']) ? $filter['filter_album'] : '' }}',
            status: '{{ isset($filter['filter_status']) ? $filter['filter_status'] : '' }}'
        },
        header: [
            {title: '#',       key: 'index', width: '100'},
            {title: '标题', key: 'title'},
            {title: '栏目',    key: 'album_title'},
            {title: '状态',    key: 'status_desc'},
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
            @foreach ($list as $article)
            {
                'index': '{{ $list->perPage() * ($list->currentPage() - 1) + $loop->iteration }}',
                'title': '{{ $article->title }}',
                @foreach (config('define.article.album') as $album)
                    @if ($album['value'] == $article->album)
                        'album_title': '{{ $album['desc'] }}',
                        @break
                    @endif
                @endforeach
                @foreach (config('define.article.status') as $status)
                    @if ($status['value'] == $article->status)
                        'status_desc': '{{ $status['desc'] }}',
                        @break
                    @endif
                @endforeach
                'created_at': '{{ date('Y-m-d H:i:s', $article->created_at) }}',
                'edit_url': '{{ route('admin.article.edit', $article->id) }}'
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
                album: '',
                status: ''
            };
            this.handleSubmitFilter();
        }
    }
});
</script>
@endsection
