<?php
if (!isset($_GET["PostID"]) && !isset($_GET["ForumID"]) && !isset($_GET["ForumGroupID"])) {
    #
}
# using w_ prefix to avoid variable clashing in other files
$w_forumGroupId = isset($_GET["ForumGroupID"]) ? $_GET["ForumGroupID"] : NULL;
$w_forumId = isset($_GET["ForumID"]) ? $_GET["ForumID"] : NULL;
$w_postId = isset($_GET["PostID"]) ? $_GET["PostID"] : NULL;

if (isset($w_forumId)) {
    $w_forumGroupId = Forums::getGroupByForum($w_forumId);
}

if (isset($w_postId)) {
    $post = new Thread($w_postId);
    $w_forumId = $post->getForumId();
    $w_forumGroupId = Forums::getGroupByForum($w_forumId);
}
?>

<span id="ctl00_cphRoblox_PostView1_ctl00_Whereami1" name="Whereami1">
    <table cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            <tr>
                <td valign="top" align="left" width="1px">
                    <nobr></nobr>
                </td>
                <td id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_ForumGroupMenu" class="popupMenuSink" valign="top" align="left" width="1px">
                    <nobr>
                        <a id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_LinkForumGroup" class="linkMenuSink" href="/Forum/ShowForumGroup.aspx?ForumGroupID=1">ROBLOX</a>
                    </nobr>
                </td>
                <td id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_ForumMenu" class="popupMenuSink" valign="top" align="left" width="1px">
                    <nobr>
                        <span id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_ForumSeparator" class="normalTextSmallBold">&nbsp;&gt;</span>
                        <a id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_LinkForum" class="linkMenuSink" href="/Forum/ShowForum.aspx?ForumID=13">General Discussion</a>
                    </nobr>
                </td>
                <td id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_PostMenu" class="popupMenuSink" valign="top" align="left" width="1px">
                    <nobr>
                        <span id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_PostSeparator" class="normalTextSmallBold">&nbsp;&gt;</span>
                        <a id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_LinkPost" class="linkMenuSink" href="/Forum/ShowPost.aspx?PostID=1964006">Err...</a>
                    </nobr>
                </td>
                <td valign="top" align="left" width="*">&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <span id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_MenuScript"></span>
</span>