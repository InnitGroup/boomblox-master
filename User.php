<?php
#made: 02/27/2025 @marsoc
#last edit: 03/12/2025 @marsoc: items
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user, $db;
!$auth->isAuthed() && Server::_404();;

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
			if (!$viewedUser->viewedBy($user->getUserId())) {
				$viewedUser->addProfileView($user->getUserId());
			}
		}
	}
}

$page = new PageBuilder($userm->loadTitle(), $theme, "/templates/authheader.php", null, "PlaceLauncher");
$page->buildHeader();

?>
<div id="Body">
	<div id="UserContainer">
		<div id="LeftBank">
			<?=$userm->loadProfilePane()?>
			<?=$userm->loadBadgesPane()?>
			<?=$userm->loadStatsPane()?>
		</div>
		<div id="RightBank">
			<div id="UserPlacesPane">
				<div id="UserPlaces">
					<h4>Showcase</h4>
					<div>
						<input type="hidden" name="ShowcasePlacesAccordion_AccordionExtender_ClientState" value="0" />
						<?=$userm->loadPlaces()?>
					</div>
				</div>
			</div>
			<?=$userm->loadFriendsPane()?>
			<div id="FavoritesPane">
				<?=$userm->loadFavoritesPane()?>
			</div>
		</div>
        <div style="height:5px;clear:both;"></div>
		<?=$userm->loadFriendRequests()?>
		<div id="UserAssetsPane">
			<?=$userm->loadInventoryPane()?>
		</div>
	</div>
</div>

<?php
$page->buildFooter();
?>