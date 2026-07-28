<?php
#made: 02/12/2025 @marsoc
#last edit: 02/15/2025 @marsoc: pagination, searching
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$m = $_GET["m"] ?? "TopFavorites";
$c = $_GET["c"] ?? 8; // yea
$t = $_GET["t"] ?? "PastWeek";
$d = $_GET["d"] ?? "All";
$p = $_GET["p"] ?? 1;
$q = $_POST["SearchTextBox"] ?? $_GET["q"] ?? "";
$catalog = new CatalogManager($m, $c, $t, $d, $p, $q, $theme);
$items = $catalog->getItems($catalog->getSQLSort($m));
$paginator = new Paginator("Catalog",$items,$p,20,$catalog->getSort());
Server::pageRestrictorB($items, 20, $p);

$page = new PageBuilder(Site::getThemeProperty("name",$theme)." - Catalog", $theme, "/templates/authheader.php");
$page->buildHeader();
?>

<div id="Body">
	<div id="CatalogContainer">
		<?=PageBuilder::addComponent("page", "search", compact("q"))?>
		<?=$catalog->loadSorts()?>
		<div class="Assets">
			<span class="AssetsDisplaySet"><?=$catalog->getDisplaySetLabel($m,$c,$t)?></span>
			<div style="height:70px">
				<?=$paginator->load()?>
			</div>
			<table cellspacing="0" align="Center" border="0" width="610">
				<?=$catalog->loadItems($items);
				isset($GLOBALS["pageEx"]) && print($GLOBALS["pageEx"]);
				?>
			</table>
			<div style="height:70px">
				<?=$paginator->load()?>
			</div>
		</div>
		<div style="clear: both;"/>
	</div>
</div>

<?php
$page->buildFooter();
?>