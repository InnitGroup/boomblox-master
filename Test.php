<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
!$auth->isAuthed() && Server::_404();


?>

<script>
    function a() {
        var app = window.external.GetApp();
        var ticket = "asdsadasd";
        //app.CreateGame(1);
        //app.RobloxAuthenticate("http://xoblog.dev/Login/Negotiate.ashx?suggest=a", ticket);
        alert(app.ID);
    }
</script>

<button onclick="a()">a</button>
