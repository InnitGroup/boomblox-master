<script>
    function a() {
        var app = window.external.GetApp();
        var workspace = app.CreateGame(1);
        window.external.ExecScript('print(1)');
    }
</script>
<button onclick="javascript:a()">test</button>