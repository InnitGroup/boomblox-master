<?php
#made: 01/10/2025 @marsoc
#last edit: 01/18/2025 @marsoc: .php -> .aspx
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
$auth->isAuthed() && header("Location: /Default.aspx");
Server::isIE7() && header("Location: /Login/Default.aspx");

if (Server::isPost()) {
    $login = new Login;
    if ($login->validateLogin($_POST["Username"],$_POST["Password"])) {
        $login->login($_POST["Username"]);
        header("Location: /Default.aspx");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="favicon" href="images/favicon.ico">
        <title>Boomblox</title>
        <style>
                        * {
                color: white;
                font-family: Arial, Helvetica, sans-serif;
            }
            input {
                height:20px;
                background-color:#111111;
                border:2px solid #cc7bf4;
                border-radius: 5px;
                color:#cc7bf4;
            }
            a {
                color: #cc7bf4;
            }
            video {
                position: fixed;
                top: 50%;
                left: 50%;
                min-width: 120%;
                max-height: 120%;
                width: auto;
                height: auto;
                z-index: -1;
                transform: translate(-50%, -50%);
            }
            #Container {
                display:flex;
                flex-wrap:nowrap;
            }
            #LoginWrapper {
                position:fixed;
                background-color:#111111;
                border:2px solid #cc7bf4;
                border-radius:25px;
                height:60%;
                width:400px;
                height:auto;
                top:50%;
                left:50%;
                transform: translate(-50%, -50%);
                text-align:center;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                padding:12px;
            }
            #LoginWrapper .LoginForm {
                position:relative;
                background-color:#191919;
                border:2px solid #cc7bf4; 
                border-radius:25px;
                width:auto;
                height:auto;
                max-width:1;
                top:27%;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                padding:12px;
            }
        </style>
    </head>
    <body>
        <div style="overflow:hidden;">
            <video autoplay muted loop>
                <source src="/images/ppark.mp4" type="video/mp4">
            </video>
        </div>
        <div id="Container">
            <div id="LoginWrapper">
                <h1>Welcome to Boomblox!</h1>
                <p>Boomblox is an all around 2008-themed playground where you can have fun building and destroying things with your friends.</p>
                <form method="POST" name="AuthLogin" class="LoginForm">
                    <h2>Login</h2>
                    <p>If you do not yet have an account, you can get one by becoming a tester through our <a href="https://discord.gg/RgZNJvvRcN">discord</a> and then <a href="/Login/New.aspx">registering</a></p>
                    <label>Username</label><br>
                    <input type="text" name="Username"><br><br>
                    <label>Password</label><br>
                    <input type="password" name="Password"><br><br>
                    <input type="submit" value="Login" style="cursor:pointer;">
                </form>
                <p>The video in the background is infact footage taken from the Boomblox client, from the game "Boomblox Park".</p>
            </div>
        </div>
    </body>
</html>

