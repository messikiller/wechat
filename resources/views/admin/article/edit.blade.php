@extends('layouts.admin')

@section('style')
@endsection

@section('breadcrumb')
<Breadcrumb>
    <Breadcrumb-item>文章管理</Breadcrumb-item>
    <Breadcrumb-item>文章编辑</Breadcrumb-item>
</Breadcrumb>
@endsection

@section('main-content')
    <Row>
        <i-col span="24">
            @include('layouts.errors')
            <i-form :model="formCustom" :rules="ruleCustom" :label-width="100" method="post" action="{{ url()->current() }}" ref="dataForm">
                {{ csrf_field() }}
                <Row>
                    <i-col span="12">
                        <Form-item label="标题" prop="title">
                            <i-input type="text" v-model="formCustom.title" name="title"></i-input>
                        </Form-item>
                    </i-col>
                </Row>
                <Row>
                    <i-col span="12">
                        <Form-item label="栏目" prop="album">
                                <i-select v-model="formCustom.album">
                                    @foreach (config('define.article.album') as $album)
                                        <i-option value="{{ $album['value'] }}">{{ $album['desc'] }}</i-option>
                                    @endforeach
                                </i-select>
                            <input type="hidden" name="album" v-model="formCustom.album">
                        </Form-item>
                    </i-col>
                </Row>
                <Row>
                    <i-col span="12">
                        <Form-item label="状态" prop="status">
                                <i-select v-model="formCustom.status">
                                    @foreach (config('define.article.status') as $status)
                                        <i-option value="{{ $status['value'] }}">{{ $status['desc'] }}</i-option>
                                    @endforeach
                                </i-select>
                            <input type="hidden" name="status" v-model="formCustom.status">
                        </Form-item>
                    </i-col>
                </Row>
                <Form-item label="内容" prop="content">
                    <script id="container" name="content" type="text/plain"></script>
                </Form-item>
                <Form-item>
                    <i-button type="primary" @click="handleSubmit">提交</i-button>
                </Form-item>
            </i-form>
        </i-col>
    </Row>

@endsection

@section('script')

    @include('vendor.ueditor.assets')

<script type="text/javascript">
window.EDITOR = UE.getEditor('container', {
    zIndex: 1
});
new Vue({
    el: '#app',
    data () {
        const validateGeneral = (rule, value, callback) => {
            if (! value) {
                return callback(new Error('该字段不能为空'));
            } else {
                callback();
            }
        };

        return {
            formCustom: {
                title: '{{ $article->title }}',
                album: '{{ $article->album }}',
                status: '{{ $article->status }}',
                content: '{{ $article->content }}'
            },
            ruleCustom: {
                title: [
                    {validator: validateGeneral, trigger: 'blur'}
                ],
                status: [
                    {validator: validateGeneral, trigger: 'blur'}
                ],
                album: [
                    {validator: validateGeneral, trigger: 'blur'}
                ]
            }
        }
    },
    mounted: function () {
        EDITOR.ready(function() {
            EDITOR.execCommand('serverparam', '_token', '{{ csrf_token() }}');
            EDITOR.setContent('{!! $article->content !!}');
        });
    },
    methods: {
        handleSubmit: function () {
            this.$refs.dataForm.validate((valid) => {
                if (valid && EDITOR.hasContents()) {
                    this.$refs.dataForm.$el.submit();
                } else {
                    this.$Notice.warning({
                        title: '表单验证失败!',
                        desc: '请填写完整后提交表单'
                    });
                }
            });
        }
    }
});
</script>
@endsection
