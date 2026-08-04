<tr class="GridItem">
    <td>
        <a title="<?=$userObj->getUsername()?>" href="/User.aspx?ID=<?=$userObj->getUserId()?>" style="display:inline-block;cursor:pointer;">
            <img src="<?=$avatar->GetThumbnail(48,48,"JPG")?>" border="0" alt="<?=$userObj->getUsername()?>" style="width:48px;height:48px;"/>
        </a>
    </td>
    <td>
        <a href="User.aspx?ID=<?=$userObj->getUserId()?>"><?=$userObj->getUsername()?></a>
        <br/>
        <span style="word-break:break-all"><?=htmlspecialchars(Helper::debugString($userObj->getBlurb()))?></span>
    </td>
    <td>
        <span><?=$userObj->getOnline()?></span>
        <br/>
    </td>
    <td>
        <span><?=$userObj->getStatus()?></span>
    </td>
</tr>