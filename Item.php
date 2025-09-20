<?php
#made: 04/21/2025 @marsoc
#last edit: 04/21/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$itemId = $_GET["ID"];
if (isset($_GET["Refer"])) {
    if ($_GET["Refer"] === "Uri") {
        echo '
        <script>
        window.location = "boomblox:";
        setTimeout(function() {
                window.location.href = "/Item.aspx?ID='.urlencode($itemId).'";
            }, 1000);
        </script>
        ';
    }
}

$item = new ItemManager($itemId, $theme);

$scripts = Server::isIE7() ? "PlaceLauncher" : ["PlaceLauncher", "server"];
$page = new PageBuilder($item->getTitle(), $theme, "/templates/authheader.php", null, $scripts, true);
$page->buildHeader();

$item->load();

$page->buildFooter();
?>