<?php
global $user, $theme;
?>

<div id="Body">
    <div id="EditProfileContainer">
        <h2>Edit Profile</h2>
        <?php if (isset($_POST['__EVENTARGUMENT'])): if ($_POST['__EVENTARGUMENT'] == 'Roblox$Submit'): ?>
        <div id="EditItemContainer">
            <div id="Confirmation" class="Suggestion" style="font-size: 12px;">Your changes to the item have been saved. (<?=date("h:i:s A")?>)</div>
        </div>
        <?php Server::_self(3); endif; endif; ?>
        <div id="AgeGroup">
            <fieldset title="Update your age-group">
                <legend>Update your age-group</legend>
                <div class="Suggestion"> This is used to customize your <?=Site::getThemeProperty("alias", $theme)?> experience. Users under 13 years are only shown pre-approved images. </div>
                <div class="AgeGroupRow">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="radio" name="AgeGroup" value="1" tabindex="1">
                                    <label>Under 13 years</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" name="AgeGroup" value="2" checked="checked" tabindex="1">
                                    <label>13 years or older</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
        <div id="ChatMode">
            <fieldset title="Update your chat mode">
                <legend>Update your chat mode</legend>
                <div class="Suggestion"> All in-game chat is subject to profanity filtering and moderation. For enhanced chat safety, choose SuperSafe Chat; only chat from pre-approved menus will be shown to you. </div>
                <div class="ChatModeRow">
                    <table border="0">
                        <tbody>
                            <tr>
                                <td>
                                    <input type="radio" name="ChatMode" value="False" checked="checked" tabindex="2">
                                    <label>Safe Chat</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" name="ChatMode" value="True" tabindex="2">
                                    <label>SuperSafe Chat</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
        <div id="ResetPassword">
            <fieldset title="Reset your password">
                <legend>Change your password</legend>
                <div class="Suggestion">Click the button below to change your password.</div>
                <div class="ResetPasswordRow"> &nbsp; <a href="javascript:__doPostBack('','Roblox$ChangePassword')">Change Password</a></div>
            </fieldset>
        </div>
        <div id="EnterEmail">
            <?php
            $inputType = "Discord Account";
            if ($theme == 1) $inputType = "Email";
            ?>
            <fieldset title="Update <?=$inputType?>">
                <legend>Update <?=$inputType?></legend>
                <div class="EmailRow">
                <?php if ($user->isVerified()): if ($theme == 1): ?>
                    <label class="Label">Email:</label>&nbsp; <input readonly name="TextBoxEMail" type="text" value="<?=$emails[(int)$user->getData("user", "email")[0]]?>" tabindex="4" class="TextBox">
                <?php else: ?>
                    <label class="Label">Discord ID:</label>&nbsp; <input readonly name="TextBoxEMail" type="text" value="<?=htmlspecialchars($user->getData("user", "email"))?>" tabindex="4" class="TextBox">
                <?php endif; elseif ($theme == 1): ?>
                    <label class="Label">Email:</label>&nbsp; <input readonly name="TextBoxEMail" type="text" tabindex="4" class="TextBox">
                <?php else: ?>
                    <label class="Label">Discord ID:</label>&nbsp; <input readonly name="TextBoxEMail" type="text" tabindex="4" class="TextBox">
                <?php endif; ?>
            </div>
            <?php if (!$user->isVerified()): ?>
            <div style="text-align:center;">
                <a title="Verify <?=$inputType?>" href="javascript:__doPostBack('<?=$user->getData("user","email")?>','Roblox$VerifyEmail')">Verify <?=$inputType?></a>
                <div class="Suggestion">and get a free hat!</div>
            </div>
            <?php endif; ?>
        </fieldset>

        </div>
        <div id="Blurb">
            <fieldset title="Update your personal blurb">
                <legend>Update your personal blurb</legend>
                <div class="Suggestion">Describe yourself here (max. 1000 characters). Make sure not to provide any details that can be used to identify you outside <?=Site::getThemeProperty("alias", $theme)?>. </div>
                <div class="BlurbRow">
                    <textarea name="Blurb" rows="2" cols="20" tabindex="3" class="MultilineTextBox"><?=$user->getBlurb()?></textarea>
                </div>
            </fieldset>
        </div>
        <div class="Buttons">
            <a tabindex="4" class="Button" href="javascript:__doPostBack('','Roblox$Submit')">Update</a>
            &nbsp; 
            <a tabindex="5" class="Button" href="javascript:__doPostBack('','Roblox$Cancel')">Cancel</a>
        </div>
    </div>
</div>