<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && header("Location: /Welcome.php");

$assetId = 0;
if (isset($_GET["id"])) {
    $assetId = $_GET["id"];
} elseif (isset($_POST["assetId"])) {
    $assetId = $_POST["assetId"];
}

$page = new APageBuilder($theme);
$page->buildHeader();

if ($assetId > 0) {
    ob_start();
    $contents = new AssetRedirect($assetId);
    $contents = ob_get_clean();
} else {
    $contents = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/cdn/t2/unavail-250x250.png");
}
?>

<div id="MainPanel">
    <img src="data:image/png;base64,<?=base64_encode($contents)?>">
    <div style="margin-top:10px;"></div>
    <label>Asset ID:</label>
    <input name="assetId" type="number" value="<?=$assetId?>"><br>
    <input type="submit" value="View">
</div>

<?php
$page->buildFooter();
?>