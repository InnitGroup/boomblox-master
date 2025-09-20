<?php
#made: 03/15/2025 @marsoc
#last edit: 03/15/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." Error", $theme, "/templates/dryheader.php");
$page->buildHeader();

if (isset($_GET["aspxerrorpath"])) {
    $errorPath = "/".$_GET["aspxerrorpath"];
} else {
    $errorPath = "";
}

?>

<div id="Body">			
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <h2 style="text-align: center">An Error occured! We're sorry.</h2>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>

<script type="text/javascript"> 
    window.window.setTimeout("window.location = '<?=Site::$domain.htmlspecialchars($errorPath)?>'", 30000);
</script>

<?php
$page->buildFooter();
?>