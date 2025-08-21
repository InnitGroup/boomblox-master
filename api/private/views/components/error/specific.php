<?php
$errors = [
    0 => "Nil error",
    1 => "Render error"
];
?>

<div id="Body">			
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <h2 style="text-align: center">An Error occured! We're sorry.</h2>
    <p style="text-align: center"><?=$errors[$errorId]?>, <a href="https://discord.com/channels/1252269246486937692/1257007864258760774">report?</a></p>
    <p style="text-align: center"><a href="/Default.aspx">Home</a></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>

<script type="text/javascript"> 
    window.window.setTimeout("window.location = /Default.aspx'", 30000);
</script>