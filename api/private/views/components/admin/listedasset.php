<tr>
    <td><?=htmlspecialchars($item["itemName"])?></td>
    <td><?=$item["itemId"]?></td>
    <td><?=isset($item["fileName"]) ? htmlspecialchars($item["fileName"]) : "Not found"?></td>
</tr>