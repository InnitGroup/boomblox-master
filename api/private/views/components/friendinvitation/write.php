<?php
global $db;

$userId = ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]);
$recipientId = (int)$_GET["RecipientID"];

$user = new User($userId);

$from = $db->getUserById($userId);
$to = $db->getUserById($recipientId);

if ($user->friendsWith($to)):
    PageBuilder::addComponent("friendinvitation", "alreadyfriends", compact("userId", "to"));
else: 
?>
<div id="Body">
    <div id="ctl00_cphRoblox_pPrivateMessageEditor">
        <h3>Your Friend Request</h3>
        <div id="MessageEditorContainer">
            <div class="MessageEditor">
                <table width="100%">
                    <tbody>
                        <tr valign="top">
                            <td style="width:12em">
                                <div id="From">
                                    <span class="Label">
                                        <span id="ctl00_cphRoblox_rbxMessageEditor_lblFrom">From:</span>
                                    </span>
                                    <span class="Field">
                                        <span id="ctl00_cphRoblox_rbxMessageEditor_lblAuthor"><?=$from?></span>
                                    </span>
                                </div>
                                <div id="To">
                                    <span class="Label">
                                        <span id="ctl00_cphRoblox_rbxMessageEditor_lblTo">Send To:</span>
                                    </span>
                                    <span class="Field">
                                        <span id="ctl00_cphRoblox_rbxMessageEditor_lblRecipient"><?=$to?></span>
                                    </span>
                                </div>
                            </td>
                            <td style="padding:0 24px 6px 12px">
                                <div id="Subject">
                                    <div class="Label">
                                        <label for="ctl00_cphRoblox_rbxMessageEditor_txtSubject" id="ctl00_cphRoblox_rbxMessageEditor_lblSubject">Subject:</label>
                                    </div>
                                    <div class="Field">
                                        <input name="ctl00$cphRoblox$rbxMessageEditor$txtSubject" type="text" value="Friend Request" id="ctl00_cphRoblox_rbxMessageEditor_txtSubject" class="TextBox" style="width:100%;">
                                    </div>
                                </div>
                                <div class="Body">
                                    <div class="Label">
                                        <label for="ctl00_cphRoblox_rbxMessageEditor_txtBody" id="ctl00_cphRoblox_rbxMessageEditor_lblBody">Message:</label>
                                    </div>
                                    <textarea name="ctl00$cphRoblox$rbxMessageEditor$txtBody" rows="2" cols="20" id="ctl00_cphRoblox_rbxMessageEditor_txtBody" class="MultilineTextBox" style="width:100%;"></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="Buttons" style="margin-top:5px;">
            <a id="ctl00_cphRoblox_lbSend" class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$lbSend','')" style="position:relative;left:576px;">Send</a>
        </div>
    </div>
</div>
<?php endif; ?>