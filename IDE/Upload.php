<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
if (Server::isPost()) {
	if (isset($_POST["__EVENTTARGET"])) {
		$target = $_POST["__EVENTTARGET"];
		if (str_contains($_POST["__EVENTTARGET"],"CreationsRepeater\$ctl")) {
			$relativePlace = substr($target, 21, 1);
			if (is_numeric(substr($target,22,1))) {
				$relativePlace = substr($target, 21, 2);
			}
		}
	}
	PageBuilder::addComponent("ide", "select");
} else {
	PageBuilder::addComponent("ide","upload");
}
?>