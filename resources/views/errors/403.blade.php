<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Acess Denied</title>
</head>
<body>

<div id="app">
</div>

<script src="{{ mix('js/admin.js') }}"></script>
<script>
new Vue({
    el: '#app',
    mounted: function () {
        this.$Modal.warning({
            title: "拒绝访问",
            content: "您没有权限访问该页面，如需获得相应权限，请与管理员联系！",
            onOk: () => {
                window.location.href = '{{ route('admin.index.welcome') }}';
            }
        })
    }
});
</script>
</body>
</html>
