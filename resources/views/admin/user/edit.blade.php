@extends('layouts.admin')

@section('breadcrumb')
<Breadcrumb>
    <Breadcrumb-item>用户管理</Breadcrumb-item>
    <Breadcrumb-item>更新用户</Breadcrumb-item>
</Breadcrumb>
@endsection

@section('main-content')

    <Row>
        <i-col span="6">
            @include('layouts.errors')
            <i-form :model="formCustom" :rules="ruleCustom" :label-width="100" method="post" action="{{ url()->current() }}" ref="dataForm">
                {{ csrf_field() }}
                <Form-item label="账号" prop="username">
                    <i-input type="text" v-model="formCustom.username" name="username"></i-input>
                </Form-item>
                <Form-item label="姓名" prop="nickname">
                    <i-input type="text" v-model="formCustom.nickname" name="nickname"></i-input>
                </Form-item>
                <Form-item>
                    <i-button type="primary" @click="handleSubmit">提交</i-button>
                </Form-item>
            </i-form>
        </i-col>
    </Row>

@endsection

@section('script')
<script type="text/javascript">
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
                username: '{{ $user->username }}',
                nickname: '{{ $user->nickname }}'
            },
            ruleCustom: {
                username: [
                    {validator: validateGeneral, trigger: 'blur'}
                ],
                nickname: [
                    {validator: validateGeneral, trigger: 'blur'}
                ],
                password: [
                    {validator: validateGeneral, trigger: 'blur'}
                ]
            }
        }
    },
    methods: {
        handleSubmit: function () {
            this.$refs.dataForm.validate((valid) => {
                if (valid) {
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
