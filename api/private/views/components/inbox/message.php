<tr class="InboxRow">
    <td style="padding-top:4px;padding-bottom:4px;"><input name="ctl00$robloxCph$SelectMessage[]" class="messageCheckbox" value="<?=$message["messageId"]?>"  id="ctl00$robloxCph$SelectableMessage" type="checkbox"></td>
    <td><div style="text-align:left;width:355px;overflow:hidden;text-overflow:ellipsis;white-space:pre-line;"><a href="PrivateMessage.aspx?MessageID=<?=$message["messageId"]?>"><?=$message["unread"] == 1 ? "<b>" : ""?><?=!isset($message["subject"]) || empty(trim($message["subject"])) ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : htmlspecialchars($message["subject"])?><?=$message["unread"] == 1 ? "</b>" : ""?></a></div></td>
    <td><div style="text-align:left;width:185px;overflow:hidden;text-overflow:ellipsis;white-space:pre-line;"><a href="/User.aspx?ID=<?=$message["senderId"]?>"><?=$message["senderUn"]?></a></div></td>
    <td><div style="text-align:left;width:185px;overflow:hidden;text-overflow:ellipsis;white-space:pre-line;"><?php
    #2025-05-30 16:45:02
    $date = new DateTime($message["date"]);
    echo $date->format("Y-m-d H:i:s");
    ?></div></td>
</tr>