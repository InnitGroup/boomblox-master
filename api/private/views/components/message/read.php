<?php
global $user;

$messageData = $message["messageData"];

$dateSent = new DateTime($messageData["date"]);
$dateSent = $dateSent->format("n/j/Y h:i:s A");

$subject = $messageData["subject"] ?? "";
$content = $messageData["content"] ?? "";

$username = $messageData["senderUn"];
$userId = $messageData["senderId"];
$recipientId = $messageData["recipientId"];

$avatar = new Avatar($userId);
$thumbnail = $avatar->GetThumbnail(500, 500, "PNG")
?>
<div id="Body">
    <div id="InvitationContainer">
            <div id="MessageContainer">
                <div id="AdsPane">
                <?=Ad::generateAd("160x600")?>
                </div>
            </div>
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
</div>
<div style="clear:both"></div>