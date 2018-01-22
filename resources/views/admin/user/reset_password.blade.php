@extends('layouts.admin')

@section('breadcrumb')
<Breadcrumb>
    <Breadcrumb-item>用户管理</Breadcrumb-item>
    <Breadcrumb-item>重置密码</Breadcrumb-item>
</Breadcrumb>
@endsection

@section('main-content')

    <Row>
        <i-col span="6">
            @include('layouts.errors')
            <i-form :model="formCustom" :rules="ruleCustom" :label-width="100" method="post" action="{{ url()->current() }}" ref="dataForm">
                {{ csrf_field() }}
                <Form-item label="账号" prop="username">
                    {{ $user->username }}
                </Form-item>
                <Form-item label="密码" prop="password">
                    <i-input type="text" v-model="formCustom.password" name="password"></i-input>
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
                password: ''
            },
            ruleCustom: {
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
