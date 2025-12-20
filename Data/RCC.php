<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user, $auth;

!$auth->isAuthed() && Server::_404();

$page = new PageBuilder("User RCC Manager", $theme, "/templates/authheader.php", null, [], true);
$page->buildHeader();
?>

<div id="Body">
    <h1>RCC Manager</h1>
    <p>Overseer and manage the grid as a regular user</p>
    <hr>
    <p><?=Gameservers::gridOnline() ? "Running" : "Offline"?></p>
    <?php if (!Gameservers::gridOnline()): ?>
    <a href="javascript:__doPostBack('ctl$robloxCph$Start','')">Start</a>
    <?php endif; ?>
    <br><br>
    <?php
    if (Server::isPost() && !Gameservers::gridOnline()) {
        if (isset($_POST["__EVENTTARGET"])) {
            if ($_POST["__EVENTTARGET"] == 'ctl$robloxCph$Start') {
                Gameservers::startGrid();
                echo '<script>window.location = "/Data/RCC.aspx"</script>';
            } 
        }
    }
    ?>
</div>

<?=$page->buildFooter()?>