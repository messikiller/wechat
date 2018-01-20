<html lang="{{ config('app.locale') }}">
<html>
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>登录系统</title>
<style>
body {
    background-color: #f5f7f9 !important;
}
</style>
</head>
<body>

<div id="app">

    <i-menu mode="horizontal" active-name="1" theme="dark">
        <Row>
            <i-col span="4" offset="1">
                <h3 style="color: #d7dde4;"><i>SonoScape</i>&ensp;</h3>
            </i-col>
            <i-col span="4" offset="15">
                <Menu-item name="1">
                    <Icon type="log-in"></Icon>登录系统
                </Menu-item>
            </i-col>
        </Row>
    </i-menu>

    <div style="height: 40px;"></div>

    <Row type="flex" justify="center">
        <i-col span="8">
            <Card dis-hover>
                <p slot="title">欢迎登录</p>
                <i-form :model="formCustom" :rules="ruleCustom" :label-width="100" method="post" action="{{ url()->current() }}" ref="formLogin">

                    {{ csrf_field() }}

                    <Form-item label="用户名" prop="username">
                        <i-input type="text" v-model="formCustom.username" name="username" style="width: 90%;"></i-input>
                    </Form-item>
                    <Form-item label="密码" prop="password">
                        <i-input type="password" v-model="formCustom.password" name="password" style="width: 90%;"></i-input>
                    </Form-item>
                    <Form-item>
                        <i-button type="primary" @click="clickSubmitBtn">登录</i-button>
                    </Form-item>

                </i-form>
            </Card>
        </i-col>
    </Row>

</div>

<script src="{{ mix('js/admin.js') }}"></script>
<script type="text/javascript">
var vm = new Vue({
    el: '#app',
    data () {
        const validateUsername = (rule, value, callback) => {
            if (value === '') {
                callback(new Error('请输入用户名'));
            } else {
                callback();
            }
        };

        const validatePassword = (rule, value, callback) => {
            if (value === '') {
                callback(new Error('请输入密码'));
            } else {
                callback();
            }
        };

        return {
            formCustom: {
                username: '',
                password: ''
            },
            ruleCustom: {
                username: [
                    {validator: validateUsername, trigger: 'blur'}
                ],
                password: [
                    {validator: validatePassword, trigger: 'blur'}
                ]
            }
        }
    },
    methods: {
        clickSubmitBtn: function () {
            this.$refs.formLogin.validate((valid) => {
                if (valid) {
                    this.$refs.formLogin.$el.submit();
                }
            })
        }
    }
});
</script>
</body>
</html>
