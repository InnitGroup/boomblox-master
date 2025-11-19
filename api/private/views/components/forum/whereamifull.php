<?php
global $theme;

if (!isset($_GET["PostID"]) && !isset($_GET["ForumID"]) && !isset($_GET["ForumGroupID"])) {
    #
}
# using w_ prefix to avoid variable clashing in other files
$w_forumGroupId = isset($_GET["ForumGroupID"]) ? (int)$_GET["ForumGroupID"] : NULL;
$w_forumId = isset($_GET["ForumID"]) ? (int)$_GET["ForumID"] : NULL;
$w_postId = isset($_GET["PostID"]) ? (int)$_GET["PostID"] : NULL;

if (isset($w_forumId)) {
    $w_forumGroupId = Forum::getGroupByForum($w_forumId);
    $w_forumGroup = new ForumGroup($w_forumGroupId);
    $w_forum = new Forum($w_forumId);
}

if (isset($w_postId)) {
    $w_post = new Thread($w_postId);
    $w_forumId = $w_post->getForumId();
    $w_forum = new Forum($w_forumId);
    $w_forumGroupId = Forum::getGroupByForum($w_forumId);
    $w_forumGroup = new ForumGroup($w_forumGroupId);
}
?>

<span id="ctl00_cphRoblox_PostView1_ctl00_Whereami1" name="Whereami1">
    <table cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            <tr>
                <td valign="top" align="left" width="1px">
                    <nobr>
                        <a id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_LinkHome" class="linkMenuSink" href="/Forum/Default.aspx"><?=Site::getThemeProperty("alias", $theme)?> Forum</a>
                    </nobr>
                </td>
                <?php if (isset($w_forumGroupId)): ?>
                <td id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_ForumGroupMenu" class="popupMenuSink" valign="top" align="left" width="1px">
                    <nobr>
                        <span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_ForumGroupSeparator" class="normalTextSmallBold">&nbsp;&gt;</span>
                        <a id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_LinkForumGroup" class="linkMenuSink" href="/Forum/ShowForumGroup.aspx?ForumGroupID=<?=$w_forumGroupId?>"><?=$w_forumGroup->getName()?></a>
                    </nobr>
                </td>
                <?php endif; if (isset($w_forumId)): ?>
                <td id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_ForumMenu" class="popupMenuSink" valign="top" align="left" width="1px">
                    <nobr>
                        <span id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_ForumSeparator" class="normalTextSmallBold">&nbsp;&gt;</span>
                        <a id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_LinkForum" class="linkMenuSink" href="/Forum/ShowForum.aspx?ForumID=<?=$w_forumId?>"><?=$w_forum->getTopic()?></a>
                    </nobr>
                </td>
                <?php endif; if (isset($w_postId)): ?>
                <td id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_PostMenu" class="popupMenuSink" valign="top" align="left" width="1px">
                    <nobr>
                        <span id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_PostSeparator" class="normalTextSmallBold">&nbsp;&gt;</span>
                        <a id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_LinkPost" class="linkMenuSink" href="/Forum/ShowPost.aspx?PostID=<?=$w_postId?>"><?=$w_post->getTitle()?></a>
                    </nobr>
                </td>
                <?php endif; ?>
                <td valign="top" align="left" width="*">&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <span id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_MenuScript"></span>
</span>