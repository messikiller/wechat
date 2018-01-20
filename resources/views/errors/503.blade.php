<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>系统维护中</title>
<link rel="stylesheet" href="{{ mix('css/page.css') }}">
<style>
html, body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0px;
}

.container {
    height: 100%;
    display: flex;
    align-items: center;
    text-align: center;
    justify-content: center;
}
</style>
</head>
<body id="app">

    <div class="container">
        <i class="huge setting loading icon"></i>
        <h2>
            管理员正在维护系统，请稍候 ......
        </h2>
    </div>

<script src="{{ mix('js/app.js') }}"></script>
<script type="text/javascript">
new Vue({
    el: '#app'
});
</script>
</body>
</html>
