<?php
#made: 03/30/2025 @marsoc
#last edit: 03/30/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$ap = $_GET["ap"] ?? 0;
$payment = new PaymentManager($ap, $theme);

$page = new PageBuilder($payment->getTitle(), $theme, "/templates/authheader.php");
$page->buildHeader();

$payment->loadPayment();

$page->buildFooter();
?>