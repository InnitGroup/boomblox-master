<?php
$length = $punishment["actionLength"];

$plural = $length > 1 ? "s" : "";
$title = $length . " day" . $plural;
$datetime = new DateTime($punishment["actionDate"]);
$expirationtime = $datetime->modify("+$length day");
$expiration = $expirationtime->format("n/j/Y g:i:s A");

?>

<div id="ctl00_cphRoblox_Panel3">
    <p> Your account has been disabled for <?=$title?>. You may re-activate it after <span id="ctl00_cphRoblox_Label6"><?=$expiration?></span> <br></p>
</div>