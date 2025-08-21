<tr class="GridItem">
    <td>
        <a title="<?=$user["username"]?>" href="/User.aspx?ID=<?=$user["id"]?>" style="display:inline-block;cursor:pointer;">
            <img src="<?=$avatar->GetThumbnail(48,48,"JPG")?>" border="0" alt="<?=$user["username"]?>" style="width:48px;height:48px;"/>
        </a>
    </td>
    <td>
        <a href="User.aspx?ID=<?=$user["id"]?>"><?=$user["username"]?></a>
        <br/>
        <span><?=($user["blurb"])?></span>
    </td>
    <td>
        <span><?=$userObj->getOnline()?></span>
        <br/>
    </td>
    <td>
        <span><?=$userObj->getStatus()?></span>
    </td>
</tr>