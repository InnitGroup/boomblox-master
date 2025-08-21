<div class="Accoutrements">
    <h4>Currently Wearing</h4>
    <table>
        <tbody>
            <tr class="TileGroup">';
                if (!empty($items)) {
                    foreach ($items as $item) {
                        echo '
                        <td class="Asset" id="'.$item["itemId"].'">
                        <a class="RemoveItem" href="javascript:__doPostBack(\'Accoutrement\', \''.$item["catalogType"].'$'.$item["itemId"].'$Remove\')" onclick="wearItem(event)">&nbsp;[ remove ]&nbsp;</a>
                        <a href="/Item.aspx?ID='.$item["itemId"].'">
                        <img class="AssetThumbnail" src="/cdn/t2/unavail-100x100.png">
                        </a>
                        <div class="AssetName">
                            <a href="/Item.aspx?ID='.$item["itemId"].'">'.htmlspecialchars($item["itemName"]).'</a>
                        </div>
                        <div class="AssetDetails Label">
                            <span>Creator: <a href="/User.aspx?ID='.$item["creatorId"].'">'.$item["creatorName"].'</a></span>
                        </div>
                    </td>
                        ';
                    }
                } else {
                    #https://www.youtube.com/watch?v=p5d0ammvUoo
                    echo Site::noResults("You are not wearing any items from your wardrobe.");
                }
            echo '</tr>
        </tbody>
    </table>
    <div class="FooterPager">
        <span>
            <span style="color:#dcdcdc;">First</span>
            <span style="color:#dcdcdc;">Previous</span>
            '; 
            
            if (!empty($items)) {
                echo '<span>1</span>';
            }

            echo'
            <span style="color:#dcdcdc;">Next</span>
            <span style="color:#dcdcdc;">Last</span>
        </span>
    </div>
</div>