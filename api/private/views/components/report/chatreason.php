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
            <p>Please pick a reason for your report.</p>
            <div style="text-align:center;padding:5px;">
                <input type="submit" style="width:70%;margin-top:5px;" name="ctl00$cphRoblox$ReportReason" value="Bad Words"><br>
                <input type="submit" style="width:70%;margin-top:5px;" name="ctl00$cphRoblox$ReportReason" value="Bad Username"><br>
                <input type="submit" style="width:70%;margin-top:5px;" name="ctl00$cphRoblox$ReportReason" value="Rude or Mean Behavior"><br>
                <input type="submit" style="width:70%;margin-top:5px;" name="ctl00$cphRoblox$ReportReason" value="Team/Spawn Killing"><br>
                <input type="submit" style="width:70%;margin-top:5px;" name="ctl00$cphRoblox$ReportReason" value="False Reporting Me">
            </div>
            <input type="hidden" name="ctl00$robloxCph$reportedUser" value="<?=$_POST['ctl00$robloxCph$reportedUser']?>">
        </div>
    </form>
</body>