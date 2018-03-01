@extends('layouts.admin')

@section('style')
@endsection

@section('breadcrumb')
<Breadcrumb>
    <Breadcrumb-item>文章管理</Breadcrumb-item>
    <Breadcrumb-item>添加文章</Breadcrumb-item>
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
                        <Form-item label="标题" prop="title" required>
                            <i-input type="text" v-model="formCustom.title" name="title"></i-input>
                        </Form-item>
                    </i-col>
                </Row>
                <Row>
                    <i-col span="12">
                        <Form-item label="栏目" prop="album" required>
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
                        <Form-item label="封面" prop="cover" required>
                            <div v-show="showCoverUploader">
                                <Upload
                                    action="{{ route('admin.article.uploadCover') }}"
                                    name="coverFile"
                                    ref="coverUploader"
                                    :headers="{'X-CSRF-TOKEN': '{{ csrf_token() }}' }"
                                    :format="['jpg','jpeg','png']"
                                    :max-size="2048"
                                    :on-format-error="handleCoverFormatError"
                                    :on-exceeded-size="handleCoverMaxSize"
                                    :on-error="handleCoverError"
                                    :on-success="handleCoverSuccess"
                                >
                                    <i-button type="ghost" icon="camera">上传图片</i-button>
                                    (最大不超过2M，允许格式：jpg, jpeg, png)
                                </Upload>
                            </div>
                            <div>
                                <img :src="formCustom.cover" v-show="!showCoverUploader" height="150">
                            </div>
                            <i-button type="error" icon="ios-trash-outline" v-show="!showCoverUploader" @click="handleRemoveUploadedCover">删除</i-button>
                            <input type="hidden" name="cover" v-model="formCustom.cover">
                        </Form-item>
                    </i-col>
                </Row>
                <Row>
                    <i-col span="12">
                        <Form-item label="状态" prop="status" required>
                                <i-select v-model="formCustom.status">
                                    @foreach (config('define.article.status') as $status)
                                        <i-option value="{{ $status['value'] }}">{{ $status['desc'] }}</i-option>
                                    @endforeach
                                </i-select>
                            <input type="hidden" name="status" v-model="formCustom.status">
                        </Form-item>
                    </i-col>
                </Row>
                <Row>
                    <i-col span="12">
                        <Form-item label="摘要" prop="abstract" required>
                            <i-input type="textarea" :rows="3" name="abstract" v-model="formCustom.abstract"></i-input>
                        </Form-item>
                    </i-col>
                </Row>
                <Form-item label="内容" prop="content" required>
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
            showCoverUploader: true,
            formCustom: {
                title: '',
                album: '',
                cover: '',
                status: '{{ config('define.article.status.normal.value') }}',
                abstract: '',
                content: ''
            },
            ruleCustom: {
                title: [
                    {validator: validateGeneral, trigger: 'blur'}
                ],
                album: [
                    {validator: validateGeneral, trigger: 'blur'}
                ],
                status: [
                    {validator: validateGeneral, trigger: 'blur'}
                ],
                abstract: [
                    {validator: validateGeneral, trigger: 'blur'}
                ]
            }
        }
    },
    mounted: function () {
        EDITOR.ready(function() {
            EDITOR.execCommand('serverparam', '_token', '{{ csrf_token() }}');
        });
    },
    methods: {
        handleCoverFormatError: function () {
            this.$Modal.warning({
                title: '错误',
                content: '图片格式错误！'
            });
        },
        handleCoverMaxSize: function () {
            this.$Modal.warning({
                title: '错误',
                content: '图片大小超出限制！'
            });
        },
        handleCoverError: function () {
            this.$Modal.error({
                title: '失败',
                content: '图片上传失败！'
            });
        },
        handleCoverSuccess: function (res, file) {
            this.showCoverUploader = false;
            this.formCustom.cover = res.cover_src;
        },
        handleRemoveUploadedCover: function () {
            this.$refs.coverUploader.clearFiles();
            this.formCustom.cover  = '';
            this.showCoverUploader = true;
        },
        handleSubmit: function () {
            this.$refs.dataForm.validate((valid) => {
                if (valid && EDITOR.hasContents() && this.formCustom.cover != '') {
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
