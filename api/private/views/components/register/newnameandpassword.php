<?php global $theme, $db;?>
<div id="Body">
    <div class="Registration">
        <h2>Create a Free <?=Site::getThemeProperty("alias", $theme)?> Account</h2>
        <h3>Welcome to our really quick signup</h3>
        <div id="ctl00_cphRoblox_upAccountRegistration">
            <div id="EnterUsername">
                <fieldset title="Choose a name for your <?=Site::getThemeProperty("alias", $theme)?> character">
                    <legend class="Legend">Choose a name for your <?=Site::getThemeProperty("alias", $theme)?> character</legend>
                    <div class="Suggestion">
                        Use 3-20 alphanumeric characters: A-Z, a-z, 0-9, no spaces. Please do not use your name or any other information that identifies you in real life.
                    </div>
                    <div class="Validators">
                        <div class="Attention"><?=isset($error) && $error == "EnterUsername" && $register->error(json_decode($result), "EnterUsername")?></div>
                        <div><a style="padding:5px;" href="javascript:toggleUsernameSuggestions()">Suggestions</a></div>
                        <div id="UsernameSuggestions" style="display: none">
                            <div>
                            <?php if (!empty($register->presets)): foreach ($register->presets as $suggestion):?>
                                <?=!$db->usernameTaken($suggestion) ? $suggestion : ""?><br>
                            <?php endforeach; ?>
                            <?php else: ?>
                                There are no available presets at the moment.
                            <?php endif; ?>
                            </div>
                            <div><a href="javascript:alert('Pick a suggested username for 1 month of BC upon registry!')">Learn about username suggestions</a></div>
                        </div>
                    </div>
                    <div class="UsernameRow">
                        <label for="ctl00_cphRoblox_UserName" id="ctl00_cphRoblox_UserNameLabel" class="Label">Character Name:</label>&nbsp;<input name="Username" onfocusout="validate()" type="text" id="ctl00_cphRoblox_UserName" tabindex="1" class="TextBox"><br>
                    </div>
                </fieldset>
            </div>
            <div id="EnterPassword">
                <fieldset title="Choose your <?=Site::getThemeProperty("alias", $theme)?> password">
                    <legend class="Legend">Choose your <?=Site::getThemeProperty("alias", $theme)?> password</legend>
                    <div class="Suggestion">
                        6-20 characters, no spaces. At least 4 letters and 2 numbers. This is the KEY to your account. Don't pick something obvious like "password", "asdf", or "qwerty".
                    </div>
                    <div class="Validators">
                        <div class="Attention"><?=isset($error) && $error == "EnterPassword" && $register->error(json_decode($result), "EnterPassword")?></div>
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
            <div id="EnterEmail">
                <fieldset title="Provide your parent's email address">		
                    <legend class="Legend">Provide your <?=Site::getThemeProperty("alias", $theme)?> key</legend>
                    <div class="Suggestion">
                        This will allow you to create a <?=(rand(1, 20) == 17 && $theme !== 1) ? "Boobmlox" : Site::getThemeProperty("alias", $theme)?> account
                    </div>
                    <div class="Validators">
                        <div class="Attention"><?=isset($error) && $error == "EnterKey" && $register->error(json_decode($result), "EnterKey")?></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="EmailRow">
                        <label for="ctl00_cphRoblox_TextBoxEMail" id="ctl00_cphRoblox_LabelEmail" class="Label">Your <?=Site::getThemeProperty("alias", $theme)?> Key:</label>&nbsp;<input name="Key" type="text" id="ctl00_cphRoblox_TextBoxEMail" tabindex="4" class="TextBox">
                    </div>
                </fieldset>
            </div>
            <div class="Confirm">
                <input type="submit" name="ctl00$cphRoblox$ButtonCreateAccount" value="Sign Up!" id="ctl00_cphRoblox_ButtonCreateAccount" tabindex="5" class="BigButton">
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
            <p>
                <a id="ctl00_cphRoblox_hlTruste" href="https://www.truste.org/ivalidate.php?url=www.<?=domain?>&amp;sealid=105" style="display:inline-block;width:140px;">
                    <img src="/images/truste_seal_kids.gif" alt="" style="border-width:0px;">
                </a>
            </p>
        </div>
    </div>
    <div style="clear:both;margin-top:5px">&nbsp;</div>
</div>