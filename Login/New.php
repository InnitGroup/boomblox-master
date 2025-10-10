<?php
#made: 01/05/2025 @marsoc
#last edit: 01/09/2025 @marsoc: page works completely
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
$auth->isAuthed() && header("Location: /Default.aspx") && exit;

$page = new PageBuilder(Site::getThemeProperty("alias",$theme).": A FREE Virtual World-Building Game with Avatar Chat, 3D Environments, and Physics", 0, "/templates/dryheader.php", [], ["register"]);
$page->buildHeader();

if (Server::isPost()) {
	$register = new Registration;
	$result = $register->handle();
	if ($result) { #x: registry passed
		header("Location: /Default.aspx"); #eat pie first you noob! seariously! go get me some pie!
	} else {
		$error = json_decode($result)->focus;
	}
}

#!isset($_GET["Come"]) && 
Server::_404();
#$_GET["Come"] !== "AsYouAre" && Server::_404();

?>
<div id="Body">
	<form name="Registration" method="POST">
		<div id="Registration">
			<div id="ctl00_cphRoblox_upAccountRegistration">
				<h2>Sign Up and Play</h2>
				<h3>Step 1 of 2: Create Account</h3>
				<div id="EnterAgeGroup">
					<fieldset title="Provide your age-group">
						<legend>Provide your age-group</legend>
						<div class="Suggestion">
							This will help us to customize your experience.  Users under 13 years will only be shown pre-approved images.
						</div>
						<div class="AgeGroupRow">
							<span id="ctl00_cphRoblox_rblAgeGroup">
								<input id="ctl00_cphRoblox_rblAgeGroup_0" type="radio" name="AgeGroup" value="1" checked="checked" tabindex="5">
								<label for="ctl00_cphRoblox_rblAgeGroup_0">Under 13 years</label>
								<br>
								<input id="ctl00_cphRoblox_rblAgeGroup_1" type="radio" name="AgeGroup" value="2" tabindex="5">
								<label for="ctl00_cphRoblox_rblAgeGroup_1">13 years or older</label>
							</span>
						</div>
					</fieldset>
				</div>
				<div id="EnterUsername">
					<fieldset title="Choose a name for your <?=Site::getThemeProperty("alias",$theme);?> character">
						<legend>Choose a name for your <?=Site::getThemeProperty("alias",$theme);?> character</legend>
						<div class="Suggestion">
							Use 3-20 alphanumeric characters: A-Z, a-z, 0-9, no spaces
						</div>
						<div class="Validators">
							<div class="Attention"><?=isset($error) && $error == "EnterUsername" && $register->error(json_decode($result),"EnterUsername");?></div>
							<div><a style="padding:5px;" href="javascript:toggleUsernameSuggestions()">Suggestions</a></div>
							<div id="UsernameSuggestions" style="display: none">
								<div>a,&nbsp;a,&nbsp;a</div>
								<div><a href="#">Learn about username suggestions</a></div>
							</div>
						</div>
						<div class="UsernameRow">
							<label for="ctl00_cphRoblox_UserName" id="ctl00_cphRoblox_UserNameLabel" class="Label">Character Name:</label>&nbsp;<input name="Username" onfocusout="validate()" type="text" id="ctl00_cphRoblox_UserName" tabindex="1" class="TextBox"><br>
						</div>
					</fieldset>
				</div>
				<div id="EnterPassword">
					<fieldset title="Choose your <?=Site::getThemeProperty("alias",$theme);?> password">
						<legend>Choose your <?=Site::getThemeProperty("alias",$theme);?> password</legend>
						<div class="Suggestion">
							4-10 characters, no spaces
						</div>
						<div class="Validators">
							<div class="Attention"><?=isset($error) && $error == "EnterPassword" && $register->error(json_decode($result),"EnterPassword");?></div>
							<div></div>
							<div></div>
							<div></div>
						</div>
						<div class="PasswordRow">
							<label for="ctl00_cphRoblox_Password" id="ctl00_cphRoblox_LabelPassword" class="Label">Password:</label>&nbsp;<input name="Password" type="password" id="ctl00_cphRoblox_Password" tabindex="2" class="TextBox">
						</div>
						<div class="ConfirmPasswordRow">
							<label for="ctl00_cphRoblox_TextBoxPasswordConfirm" id="ctl00_cphRoblox_LabelPasswordConfirm" class="Label">Confirm Password:</label>&nbsp;<input name="PasswordConfirm" type="password" id="ctl00_cphRoblox_TextBoxPasswordConfirm" tabindex="3" class="TextBox">
						</div>
					</fieldset>
				</div>
				<div id="EnterChatMode">
					<fieldset title="Choose your chat mode">
						<legend>Choose your chat mode</legend>
						<div class="Suggestion">
							All in-game chat is subject to profanity filtering and moderation.  For enhanced chat safety, choose SuperSafe Chat; only chat from pre-approved menus will be shown to you.
						</div>
						<div class="ChatModeRow">
							<span id="ctl00_cphRoblox_rblChatMode">
								<input id="ctl00_cphRoblox_rblChatMode_0" type="radio" name="Chatmode" value="false" checked="checked" tabindex="6">
								<label for="ctl00_cphRoblox_rblChatMode_0">Safe Chat</label>
								<br>
								<input id="ctl00_cphRoblox_rblChatMode_1" type="radio" name="Chatmode" value="true" tabindex="6">
								<label for="ctl00_cphRoblox_rblChatMode_1">SuperSafe Chat</label>
							</span>	
						</div>
					</fieldset>
				</div>
				<div id="EnterEmail">
					<fieldset title="Provide your parent's email address">		
						<legend>Provide your Boomblox key</legend>
						<div class="Suggestion">
							This will allow you to create a Boobmlox account
						</div>
						<div class="Validators">
							<div class="Attention"><?=isset($error) && $error == "EnterKey" && $register->error(json_decode($result),"EnterKey");?></div>
							<div></div>
							<div></div>
						</div>
						<div class="EmailRow">
							<label for="ctl00_cphRoblox_TextBoxEMail" id="ctl00_cphRoblox_LabelEmail" class="Label">Your Boomblox Key:</label>&nbsp;<input name="Key" type="text" id="ctl00_cphRoblox_TextBoxEMail" tabindex="4" class="TextBox">
						</div>
					</fieldset>
				</div>
				<div class="Confirm">
					<input type="submit" name="ctl00$cphRoblox$ButtonCreateAccount" value="Register" id="ctl00_cphRoblox_ButtonCreateAccount" tabindex="5" class="BigButton">
				</div>			
			</div>
		</div>
		<div id="Sidebars">
			<div id="AlreadyRegistered">
				<h3>Already Registered?</h3>
				<p>If you just need to login, go to the <a id="ctl00_cphRoblox_HyperLinkLogin" href="Default.aspx?ReturnUrl=%2f">Login</a> page.</p>
				<p>If you have already registered but you still need to download the game installer, go directly to <a id="ctl00_cphRoblox_HyperLinkDownload" href="/Install/Default.aspx?ReturnUrl=%2f">download</a>.</p>
			</div>
			<div id="TermsAndConditions">
				<h3>Terms &amp; Conditions</h3>
				<p>Registration does not provide any guarantees of service. See our <a id="ctl00_cphRoblox_HyperLinkToS" href="/Info/TermsOfService.aspx?layout=null" target="_blank">Terms of Service</a> and <a id="ctl00_cphRoblox_HyperLinkEULA" href="/Info/EULA.htm" target="_blank">Licensing Agreement</a> for details.</p>
				<p><?=Site::getThemeProperty("alias",$theme);?> will not share your email address with 3rd parties. See our <a id="ctl00_cphRoblox_HyperLinkPrivacy" href="/Info/Privacy.aspx?layout=null" target="_blank">Privacy Policy</a> for details.</p>
			</div>
		</div>
		<div id="ctl00_cphRoblox_ie6_peekaboo" style="clear: both"></div>
	</form>
	<script>
	</script>
</div>
<?php
$page->buildFooter();
?>