<div class="modalPopup" id="error<?=$errno?>" style="z-index: 5; position: fixed; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 27em; display: block">
    <div>
        <div style="margin: 1.5em;">
            <h3>PHP ERRROR</h3>
            <p>REPORT IN #BUGS</p>
            <p><?="$errfile [$errline]: $errstr"?>.</p>
            <p><input type="submit" name="ctl00$cphRoblox$ProceedWithTicketsPurchaseButton" value="Continue" onclick="document.getElementById('error<?=$errno?>').style.display = 'none'; return false;"  class="MediumButton" style="width:100%;"></p>
        </div>
    </div>
</div>