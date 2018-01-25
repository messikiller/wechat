@extends('layouts.admin')

@section('breadcrumb')
<Breadcrumb>
    <Breadcrumb-item>反馈管理</Breadcrumb-item>
    <Breadcrumb-item>更新反馈信息</Breadcrumb-item>
</Breadcrumb>
@endsection

@section('main-content')

    <Row>
        <i-col span="6">
            @include('layouts.errors')
            <i-form :model="formCustom" :rules="ruleCustom" :label-width="100" method="post" action="{{ url()->current() }}" ref="dataForm">
                {{ csrf_field() }}
                <Form-item label="状态" prop="status">
                    <i-select v-model="formCustom.status" name="status">
                        @foreach (config('define.feedback.status') as $status)
                            <i-option value="{{ $status['value'] }}">{{ $status['desc'] }}</i-option>
                        @endforeach
                    </i-select>
                </Form-item>
                <Form-item label="故障类型" prop="type">
                    @foreach (config('define.feedback.type') as $type)
                        @if ($type['value'] == $feedback->type)
                            {{ $type['desc'] }}
                            @break
                        @endif
                    @endforeach
                </Form-item>
                <Form-item label="处理器SN" prop="hsn">
                    {{ $feedback->hsn }}
                </Form-item>
                <Form-item label="故障描述" prop="description">
                    {{ $feedback->description }}
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
                status: '{{ $feedback->status }}'
            },
            ruleCustom: {
                status: [
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
