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
		<div id="SearchBar" class="SearchBar">
			<span class="SearchBox"><input name="SearchTextBox" type="text" maxlength="100" class="TextBox" value="<?=htmlspecialchars($q)?>"/></span>
			<span class="SearchButton"><input type="submit" name="SearchButton" value="Search"/></span>
			<?php if ($theme !== 3): ?>
			<span class="SearchLinks"><sup><a id="ctl00_cphRoblox_rbxCatalog_ResetSearchButton" href="javascript:__doPostBack('ctl00$cphRoblox$rbxCatalog$ResetSearchButton','')">Reset</a>&nbsp;|&nbsp;</sup><a href="#"><sup>Tips</sup>
            <span>Exact Phrase: "red brick"<br>
                  Find ALL Terms: red and brick =OR=  red + brick<br>
                  Find ANY Term: red or brick =OR= red | brick<br>
                  Wildcard Suffix: tel* (Finds teleport, telamon, telephone, etc.)<br>
                  Terms Near each other: red near brick =OR= red ~ brick<br>
                  Excluding Terms: red and not brick =OR= red - brick<br>
                  Grouping operations: brick and (red or blue) =OR= brick + (red | blue)<br>
                  Combinations: "red brick" and not (tele* or tower) =OR= "red brick" - (tele* | tower)
                  Wildcard Prefix is NOT supported: *port will not find teleport, airport, etc.
            </span>
			<?php endif; ?>
        </a></span>
		</div>
		<?=$catalog->loadSorts()?>
		<div class="Assets">
			<span class="AssetsDisplaySet"><?=$catalog->getDisplaySetLabel($m,$c,$t)?></span>
			<?=$paginator->load()?>
			<table cellspacing="0" align="Center" border="0" width="610">
				<?=$catalog->loadItems($items);
				isset($GLOBALS["pageEx"]) && print($GLOBALS["pageEx"]);
				?>
			</table>
		<?=$paginator->load()?>
		</div>
		
		<div style="clear: both;"/>
	</div>
</div>

<?php
$page->buildFooter();
?>