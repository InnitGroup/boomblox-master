<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && header("Location: /Welcome.php");

$page = new APageBuilder;

exit;

$stmt = "SELECT * FROM items WHERE itemType='game'";
$result = $db->execute($stmt);
$fetched = $result->fetchAll(PDO::FETCH_ASSOC);

foreach ($fetched as $place) {
    if ($place["itemId"] == 794) {
        continue;
    }
    
    $compressed = gzencode(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/content/".$place["itemId"]));
    file_put_contents($_SERVER["DOCUMENT_ROOT"]."/content/".$place["itemId"], $compressed);
    echo "compressed place ID ".$place["itemId"]."<br>";
}
?>