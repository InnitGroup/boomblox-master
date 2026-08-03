<?php
#made: 02/27/2025 @marsoc
#last edit: 03/12/2025 @marsoc: items
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user, $db;
!$auth->isAuthed() && Server::_404();;

if (isset($_GET["username"]) || isset($_GET["Username"])) {
	$username = isset($_GET["username"]) ? $_GET["username"] : $_GET["Username"];
	if ($db->usernameTaken($username)) {
		$id = $db->getIdByUser($username);
		exit(header("Location: /User.aspx?ID=$id"));
	}
}

$userId = $_GET["ID"] ?? $_GET["id"] ?? 0;
$publicView = $_GET["ForcePublicView"] ?? true;
$target = $_POST["__EVENTTARGET"] ?? null;
$argument = $_POST["__EVENTARGUMENT"] ?? null;
$category = $_POST["AssetCategory"] ?? null;

$userm = new UserManager($userId, $publicView, $theme, [$target, $argument, $category]);

if ($publicView) {
	if ($userId !== $user->getUserId() && $userId !== 0) {
		if ($db->userExists($userId)) {
			$viewedUser = new User($userId);
			if ($viewedUser->isPunished()) {
				Server::_404();
			}
			if (!$viewedUser->viewedBy($user->getUserId())) {
				$viewedUser->addProfileView($user->getUserId());
			}
		}
	}
}

$page = new PageBuilder($userm->loadTitle(), $theme, "/templates/authheader.php", null, "PlaceLauncher");
$page->buildHeader();
?>

<div class="MyRobloxContainer">
	<div style="width:900px;height:30px;font-family:Verdana, Helvetica, Sans-Serif; clear:both; display:block;">
		<span id="ctl00_cphRoblox_rbxHeaderPane_nameRegion" style="font-size:20px; font-weight:bold;"><?=$userId !== 0 ? $db->getUserById($userId) : "<a href='/My/CustomSettings.aspx' style='color:inherit'>Hi</a>, " . $user->getUsername()?></span>
	</div>
	<br clear="all">
	<div class="Column1d">
		<?=$userm->loadProfilePane()?>
		<?=$userm->loadBadgesPane()?>
		<?php if (false): ?>
		<?=$userm->loadUserBadgesPane()?>
		<?php endif; ?>
		<?=$userm->loadStatsPane()?>
		<?=$userm->loadGroupsPane()?>
	</div>
	<div class="Column2d">
		<div class="StandardBoxHeader">Showcase </div>
			<div id="UserPlacesPane" style="clear:both; background-color: White;">
				<div id="UserPlaces" style="overflow:visible">
					<input type="hidden" name="ShowcasePlacesAccordion_AccordionExtender_ClientState" value="0" />
					<?=$userm->loadPlaces()?>
				</div>
			</div>
			<?=$userm->loadFriendsPane()?>
			<?=$userm->loadFavoritesPane()?>
		</div>
	</div>
	<br clear="all">
	<div style="height:5px;clear:both;"></div>
	<?=$userm->loadFriendRequests()?>
	<div id="UserContainer"><div id="UserAssetsPane">
		<?=$userm->loadInventoryPane()?>
	</div>
</div>

<?php
$page->buildFooter();
?>