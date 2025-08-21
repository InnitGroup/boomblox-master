<tr align="center" style="background-color: #FFD0D0;">
    <td>
        <a><?=$shout["user"]?></a>
    </td>
    <td><?=htmlspecialchars($shout["text"])?></td>
    <td><?=Helper::timeFormat($shout["time"])?></td>
</tr>