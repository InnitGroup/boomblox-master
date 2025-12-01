<?php
#made: 01/04/2025 @marsoc
#last edit: 01/04/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
$auth->isAuthed() && header("Location: /Default.aspx") && exit;
$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." is SAFE for kids! ROBLOX is a FREE casual virtual world with fully constructible/desctructible environments and immersive physics. Build, battle, chat, or just hang out.", $theme, "/templates/dryheader.php");

if (Server::isPost()) {
    $login = new Login;
    if ($login->validateLogin($_POST["Username"],$_POST["Password"])) {
        $login->login($_POST["Username"]);
        header("Location: /Default.aspx");
    }
}

!isset($_GET["Baby"]) && Server::_404();
$_GET["Baby"] !== "DontHurtMe" && Server::_404();

$page->buildHeader();
?>

<div id="Body">
	<script type="text/javascript">
		function signUp() {
			window.location = "/Login/New.aspx";
		}
	</script>
	<div id="FrameLogin" style="margin: 150px auto 150px auto; width: 500px; border: black thin solid; padding: 22px;">
		<div id="PaneNewUser" style="position:relative;bottom:13px;">
			<h3>New User?</h3>
			<p>You need an account to play Boomblox.</p>
			<p>If you aren't a Boomblox member then <a id="ctl00_cphRoblox_HyperLink1" href="New.aspx">register</a>. It's easy and we do <em>not</em> share your personal information with anybody. </p>
		</div>
		<div id="PaneLogin">
			<h3>Log In</h3>
			<form class="AspNet-Login" method="POST">
				<div class="AspNet-Login-UserPanel">
					<label for="ctl00_cphRoblox_lRobloxLogin_UserName" class="TextboxLabel">
						<em>U</em>ser Name: </label>
					<input type="text" id="ctl00_cphRoblox_lRobloxLogin_UserName" name="Username" value="" />&nbsp;
				</div>
				<div class="AspNet-Login-PasswordPanel">
					<label for="ctl00_cphRoblox_lRobloxLogin_Password" class="TextboxLabel">
						<em>P</em>assword: </label>
					<input type="password" id="ctl00_cphRoblox_lRobloxLogin_Password" name="Password" value="" />
				</div>
				<div class="AspNet-Login-SubmitPanel">
					<input type="submit" value="Log In" id="ctl00_cphRoblox_lRobloxLogin_LoginButton" name="type" />
				</div>
				<div class="AspNet-Login-PasswordRecoveryPanel">
					<a href="ResetPasswordRequest.aspx" title="Password recovery">Forgot your password?</a>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
$page->buildFooter();
?>