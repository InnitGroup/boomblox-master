<?php
#made: 03/14/2025 @marsoc
#last edit: 03/20/2025 @marsoc: pretty much complete
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && header("Location: /Welcome.php");

$char = new CharacterManager($_POST);

$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." - Change Character", $theme, "/templates/authheader.php", null, "character");
$page->buildHeader();
?>
<div id="Body">
    <script>
        
    </script>
	<div id="CustomizeCharacterContainer">
		<?=$char->attireChooser()?>
		<?=$char->characterViewer()?>
		<div class="Mannequin">
			<?=$char->colorChooserFrame()?>
		</div>
		<?=$char->accoutrements()?>
	</div>
    <div style="clear:both;"></div>
</div>
<?php
$page->buildFooter();
?>