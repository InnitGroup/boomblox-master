<?php
global $user, $auth;
?>

<span id="ctl00_cphRoblox_Navigationmenu1">
    <table width="100%" cellspacing="1" cellpadding="0">
        <tbody>
            <tr>
                <?php if ($auth->isAuthed()): ?>
                <td align="right" valign="middle">
                    <a id="ctl00_cphRoblox_Navigationmenu1_ctl00_HomeMenu" class="menuTextLink" href="/Forum/Default.aspx">
                        <img src="/Forum/skins/default/images/icon_mini_home.gif" border="0">Home &nbsp; </a>
                    <a id="ctl00_cphRoblox_Navigationmenu1_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx">
                        <img src="/Forum/skins/default/images/icon_mini_search.gif" border="0">Search &nbsp; </a>
                    <a id="ctl00_cphRoblox_Navigationmenu1_ctl00_ProfileMenu" class="menuTextLink" href="/Forum/User/EditUserProfile.aspx?UserName=<?=$user->getUsername()?>">
                        <img src="/Forum/skins/default/images/icon_mini_profile.gif" border="0">Profile &nbsp; </a>
                        <a id="ctl00_cphRoblox_Navigationmenu1_ctl00_RegisterMenu" class="menuTextLink" href="/Forum/User/MyForums.aspx">
                        <img src="/Forum/skins/default/images/icon_mini_myforums.gif" border="0">MyForums &nbsp; </a>
                </td>
                <?php else: ?>
                <td align="right" valign="middle">
                    <a id="ctl00_cphRoblox_Navigationmenu1_ctl00_HomeMenu" class="menuTextLink" href="/Forum/Default.aspx">
                        <img src="/Forum/skins/default/images/icon_mini_home.gif" border="0">Home &nbsp; </a>
                    <a id="ctl00_cphRoblox_Navigationmenu1_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx">
                        <img src="/Forum/skins/default/images/icon_mini_search.gif" border="0">Search &nbsp; </a>
                    <a id="ctl00_cphRoblox_Navigationmenu1_ctl00_RegisterMenu" class="menuTextLink" href="/Forum/User/CreateUser.aspx">
                        <img src="/Forum/skins/default/images/icon_mini_register.gif" border="0">Register &nbsp; </a>
                </td>
                <?php endif; ?>
            </tr>
        </tbody>
    </table>
</span>