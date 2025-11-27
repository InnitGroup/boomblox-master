<?php
global $db, $thread;

PageBuilder::addComponent("forum", "header");
PageBuilder::addComponent("forum", "navmenu");
?>

<?=PageBuilder::addComponent("forum", "footer")?>