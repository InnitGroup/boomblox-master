<?php
#made: 04/20/2025 @marsoc
#last edit: 04/20/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user, $db;
!$auth->isAuthed() && header("Location: /Welcome.php");

$abuseId = $_GET["AbuseID"];
$stmt = "SELECT * FROM reports WHERE id=:abuseId";
$result = $db->execute($stmt, [":abuseId" => $abuseId]);
if ($result->rowCount() == 1) {
    $abuse = $result->fetch(PDO::FETCH_ASSOC);
}

if (!isset($abuse)) {
    Server::_404();
}

$page = new APageBuilder($theme);
$page->buildHeader();

PageBuilder::addComponent("admin", "abuseviewer", compact("abuse"));

$page->buildFooter();
?>