<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && header("Location: /");

$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." | Missing Item", $theme, "/templates/dryheader.php");
$page->buildHeader();


?>

<div id="Body">			
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <h2 style="text-align: center">The item you requested does not exist</h2>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>

<script type="text/javascript"> 
    window.window.setTimeout("window.location = /Default.aspx", 30000);
</script>

<?php
$page->buildFooter();
?>