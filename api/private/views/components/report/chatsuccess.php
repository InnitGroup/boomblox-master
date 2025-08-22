<body style="background-color:#427FCC">
    <script>
        function __doPostBack(eventTarget, eventArgument) {
            document.aspnetForm.__EVENTTARGET.value = eventTarget;
            document.aspnetForm.__EVENTARGUMENT.value = eventArgument;
            document.aspnetForm.submit();
        }
    </script>
    <form name="aspnetForm" method="POST">
        <div style="padding-right:20px;padding-bottom:20px;">
            <?php
            $reported = new User($_POST['ctl00$robloxCph$reportedUser']);
            $username = $reported->getUsername();
            ?>

            <p style="text-align:center">Successfully reported <?=$username?>!</p>
            <br>
            <button style="text-align:center" onclick="window.close()">Continue</button>
        </div>
    </form>
</body>