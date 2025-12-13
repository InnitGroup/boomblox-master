<?php
global $theme, $user;
$username = $user->getUsername();
?>

<div id="Body" style="margin-left:100px;">
    <div id="ctl00_cphRoblox_pPrivateMessageEditor">
        <h3>Share <?=Site::getThemeProperty("alias", $theme)?> with a Friend</h3>
        <p>Fill out the form below to share <?=Site::getThemeProperty("alias", $theme)?> with a friend who's not already a member of the site.</p>
        <div id="MessageEditorContainer">
            <div class="MessageEditor">
                <table width="100%">
                    <tbody>
                        <tr valign="top">
                            <td style="padding:0 24px 6px 12px">
                                <div style="float:left;margin-right:20px;">
                                    <p class="Label">Your Name:</p><br>
                                    <p class="Label">Email To:</p><br>
                                    <p class="Label">Message:</p><br>
                                </div>
                                <div style="margin-bottom:15px;">
                                    <input name="ctl00$cphRoblox$rbxMessageEditor$txtSubject" type="text" value="Your friend <?=$username?> at ROBLOX.com" id="ctl00_cphRoblox_rbxMessageEditor_txtSubject" class="TextBox" style="width:80%;">
                                </div>
                                <div style="margin-bottom:15px;">
                                    <input name="ctl00$cphRoblox$rbxMessageEditor$txtSubject" type="text" id="ctl00_cphRoblox_rbxMessageEditor_txtSubject" class="TextBox" style="width:80%;">
                                </div>
                                <div>
                                    <textarea name="ctl00$cphRoblox$rbxMessageEditor$txtBody" rows="10" cols="20" id="ctl00_cphRoblox_rbxMessageEditor_txtBody" class="MultilineTextBox" style="width:80%;">Check out <?=Site::getThemeProperty("alias", $theme)?>, this awesome free game I found on teh internets!</textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="Buttons" style="margin-top:5px;">
            <a id="ctl00_cphRoblox_lbSend" class="Button" href="javascript:alert('Currently a filler page.')" style="position:relative;left:544px;">Send Invite</a>
            <a href="/api/public/Gift.php?Key=<?="SUPERCALIFRAGILISTICEXPIALODOCIOUS" . pi() * $user->getUserId()?>" style="position:relative; left:500px; bottom: 15px; height:32px;"><img style="position: relative; height:32px; bottom: -15px; z-index: -1" src="https://t2.xoblog.dev/41066f10efc6268bea31a30684530522?v=1"></a>
    </div>
</div>