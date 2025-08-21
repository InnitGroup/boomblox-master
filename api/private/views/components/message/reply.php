<?php
global $user;

$messageData = $message["messageData"];

$dateSent = new DateTime($messageData["date"]);
$day = $dateSent->format("n/j/Y");
$time = $dateSent->format("h:i:s A");
$dateSent = $dateSent->format("n/j/Y h:i:s A");

$username = $messageData["senderUn"];
$userId = $messageData["senderId"];
$recipientId = $messageData["recipientId"];

$subject = $messageData["subject"] ?? "";
$content = $messageData["content"] ?? "";
$replyContent = PHP_EOL."------------------------------
On $day at $time $username wrote ".$messageData["content"] ?? "";

$avatar = new Avatar($userId);
$thumbnail = $avatar->GetThumbnail(500, 500, "PNG")
?>
<div id="Body">
    <div id="InvitationContainer">
            <div id="InvitationPane">
                <div id="ctl00_cphRoblox_pFriendInvitation">
                    <div id="ctl00_cphRoblox_pMessageReader">
                        <h3>Private Message</h3>
                            <div class="MessageReaderContainer">
                                <div id="Message">
                                    <table width="100%">
                                        <tbody>
                                            <tr valign="top">
                                                <td style="width: 10em">
                                                    <div id="DateSent"><?=$dateSent?></div>
                                                    <div id="Author">
                                                        <a id="ctl00_cphRoblox_rbxMessageReader_Avatar" disabled="disabled" title="<?=$username?>" onclick="return false" style="display:inline-block;height:64px;width:64px;">
                                                            <?php if ($username !== "ROBLOX [System Message]"): ?>
                                                            <img style="height:64px;width:64px;" src="<?=$thumbnail?>" border="0" id="img" alt="<?=$username?>">
                                                            <?php endif; ?>
                                                        </a>
                                                        <br>
                                                        <a id="ctl00_cphRoblox_rbxMessageReader_AuthorHyperLink" title="Visit <?=$username?>'s Home Page" href="../User.aspx?ID=<?=$userId?>"><?=$username?></a>
                                                    </div>
                                                    <div id="Subject"> <?=htmlspecialchars($subject)?> <br>
                                                        <br>
                                                        <?php if ($username !== "ROBLOX [System Message]"): ?>
                                                        <div id="ctl00_cphRoblox_rbxMessageReader_AbuseReportButton_AbuseReportPanel" class="ReportAbusePanel">
                                                            <span class="AbuseIcon">
                                                                <a id="ctl00_cphRoblox_rbxMessageReader_AbuseReportButton_ReportAbuseIconHyperLink" href="../AbuseReport/Message.aspx?ID=2274830&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fMy%2fFriendInvitation.aspx%3fInvitationID%3d494536">
                                                                    <img src="../images/abuse.PNG" alt="Report Abuse" style="border-width:0px;">
                                                                </a>
                                                            </span>
                                                            <span class="AbuseButton">
                                                                <a id="ctl00_cphRoblox_rbxMessageReader_AbuseReportButton_ReportAbuseTextHyperLink" href="../AbuseReport/Message.aspx?ID=2274830&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fMy%2fFriendInvitation.aspx%3fInvitationID%3d494536">Report Abuse</a>
                                                            </span>
                                                        </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td style="padding: 0 10px 0 10px">
                                                    <div class="Body">
                                                        <textarea disabled id="ctl00_cphRoblox_rbxMessageReader_pBody" class="MultilineTextBox" style="height:250px;width:400px;overflow-y:scroll;"><?=$content?></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
                <div id="ctl00_cphRoblox_pSubmit_ExistingMessage">
                    <div class="Buttons">
                        <a id="ctl00_cphRoblox_lbCancel" class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$lbCancel','')">Cancel</a>
                        <a id="ctl00_cphRoblox_lbDelete" class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$lbDelete','')">Delete</a>
                        <a id="ctl00_cphRoblox_lbReply" class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$lbReply','')">Reply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="clear:both"></div>
    <div id="InvitationContainer">
        <div id="InvitationPane">
            <div id="ctl00_cphRoblox_pPrivateMessageEditor">
                <h3>Your Message</h3>
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
                                                <span id="ctl00_cphRoblox_rbxMessageEditor_lblAuthor"><?=$user->getUsername()?></span>
                                            </span>
                                        </div>
                                        <div id="To">
                                            <span class="Label">
                                                <span id="ctl00_cphRoblox_rbxMessageEditor_lblTo">Send To:</span>
                                            </span>
                                            <span class="Field">
                                                <span id="ctl00_cphRoblox_rbxMessageEditor_lblRecipient"><?=$username?></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td style="padding:0 24px 6px 12px">
                                        <div id="Subject">
                                            <div class="Label">
                                                <label for="ctl00_cphRoblox_rbxMessageEditor_txtSubject" id="ctl00_cphRoblox_rbxMessageEditor_lblSubject">Subject:</label>
                                            </div>
                                            <div class="Field">
                                                <input name="ctl00$cphRoblox$rbxMessageEditor$txtSubject" type="text" id="ctl00_cphRoblox_rbxMessageEditor_txtSubject" class="TextBox" style="width:100%;" value="<?="RE: ".htmlspecialchars($subject)?>">
                                            </div>
                                        </div>
                                        <div class="Body">
                                            <div class="Label">
                                                <label for="ctl00_cphRoblox_rbxMessageEditor_txtBody" id="ctl00_cphRoblox_rbxMessageEditor_lblBody">Message:</label>
                                            </div>
                                            <textarea name="ctl00$cphRoblox$rbxMessageEditor$txtBody" rows="12" cols="20" id="ctl00_cphRoblox_rbxMessageEditor_txtBody" class="MultilineTextBox" style="width:100%;"><?=PHP_EOL.$replyContent?></textarea>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div style="clear:both"></div>
                </div>
                <div id="ctl00_cphRoblox_pSubmit_ExistingMessage">
                    <div class="Buttons" style="margin-top:-10px;">
                        <a id="ctl00_cphRoblox_lbSend" class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$lbSubmitReply','')">Send</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="clear:both"></div>