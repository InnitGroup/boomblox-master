<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
#!$auth->isAuthed() && Server::_root();
?>

<div style="margin:12px">
    <div id="ErrorReporting" class="ErrorReporting" style="display: block">
        <p> ROBLOX crashed on your computer recently! We would like to find out why so that we can make ROBLOX better. </p>
        <p> Help us fix bugs by cclicking Send Error Report</p>
        <div class="YesNoButtons">
            <input name="ctl00$ContentPlaceHolder1$ErrorReporting1$ButtonYes" type="button" id="ctl00_ContentPlaceHolder1_ErrorReporting1_ButtonYes" class="YesButton" value="Send Error Report" onclick="sendRobloxErrorFiles(); return false" />
            <input id="ButtonNo" class="NoButton" type="button" value="Don't Send" onclick="dontSendRobloxErrorFiles(); return false" />
        </div>
    </div>
    <div id="ErrorReportingThanks" class="ErrorReporting" style="display: none">
        <p> Your ROBLOX crashed recently. An error report is being sent to ROBLOX. </p>
        <p> This operation will take a few minutes, but you may continue doing other things. </p>
        <div class="YesNoButtons">
            <input id="Button2" class="NoButton" type="button" value="Cancel" onclick="dontSendRobloxErrorFiles(); return false" />
        </div>
    </div>
    <script type="text/javascript">
        var robloxAppReport;

        function dontSendRobloxErrorFiles() {
            robloxAppReport.DeleteErrorFiles();
            window.close();
        }

        function sendRobloxErrorFiles() {
            robloxAppReport.SendErrorFiles("http://<?=url?>/Error/Dmp.ashx");
            window.close();
        }

        function updateRobloxError() {
            var er = robloxAppReport.ErrorReporting;
            if (er == 0) {
                // Skip error reporting
                return false;
            }
            if (robloxAppReport.HasErrorFiles) {
                if (er == 1) document.getElementById("ErrorReporting").style.display = "block";
                else if (er == 2) sendRobloxErrorFiles();
            } else {
                document.getElementById("ErrorReporting").style.display = "none";
            }
            //document.getElementById("ErrorReportingThanks").style.display = robloxAppReport.IsUploadingErrorFiles ? "block" : "none";
            return true;
        }

        function updateRobloxErrorTimer() {
            if (updateRobloxError()) window.setTimeout("updateRobloxErrorTimer()", 1000);
        }
        try {
            robloxAppReport = new ActiveXObject("Roblox.App");
            robloxAppReport.IsUploadingErrorFiles; // Quick check that the API exists
            window.setTimeout("updateRobloxErrorTimer()", 100);
        } catch (e) {}
    </script>
<div>