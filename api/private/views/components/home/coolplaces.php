<?php
global $db, $theme;
$stmt = "SELECT * FROM items WHERE itemType='game' AND access=1 ORDER BY rand() LIMIT 5";
$result = $db->execute($stmt);
?>

<div id="UserPlacesPane">
    <div id="UserPlaces_Content">
        <table id="ctl00_cphRoblox_CoolPlacesDataList" cellspacing="0" border="0" width="100%">
            <tr>
                <?php if ($result->rowCount() > 0):
                    $places = $result->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($places as $place):
                        $asset = new Asset($place["itemId"]);
                        $render = $asset->GetThumbnail(420, 230, "PNG"); ?>
                        <td class="UserPlace">
                            <a id="ctl00_cphRoblox_CoolPlacesDataList_ctl00_rbxContentImage" title="<?=htmlspecialchars($place["itemName"])?>" href="/Item.aspx?ID=<?=(int)$place["itemId"]?>" style="display:inline-block;cursor:pointer;"><img style="width:120px;height:70px;" src="<?=$render?>" border="0" alt="<?=htmlspecialchars($place["itemName"])?>" blankurl="http://t2.xoblog.dev:80/blank-120x70.gif"/></a>
                        </td>
                <?php endforeach;
                endif; ?>
            </tr>
        </table>
    </div>
    <div id="UserPlaces_Header">
        <h3>Cool Places</h3>
        <p>Check out some of our favorite <?=Site::getThemeProperty("alias", $theme)?> places!</p>
    </div>
    <div id="ctl00_cphRoblox_ie6_peekaboo" style="clear: both"></div>
</div>
';