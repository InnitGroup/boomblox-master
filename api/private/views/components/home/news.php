<?php
global $theme;
?>

<h4 style="text-align: center; height: 16px; margin: 0px 0px 2px 0px;"><a id="ctl00_cphRoblox_NewsFeed_RobloxNewsHyperLink" href="https://boombloxjournal.tumblr.com/"><font color="graytext"><?=Site::getThemeProperty("alias", $theme)?> News</font></a></h4>
<table id="ctl00_cphRoblox_NewsFeed_dlNews" cellspacing="0" cellpadding="1" border="0" width="158" style="position:relative;left:17px">
    <tbody>
        <tr>
            <td align="left">
            <li style="margin-left: 1px;">
                <a id="ctl00_cphRoblox_NewsFeed_dlNews_ctl00_NewsItemHyperLink" href="<?=Tumblr::getRelativePostLink(0)?>"><?=Tumblr::getRelativePostTitle(0)?></a>
            </li>
            </td>
        </tr>
        <tr>
            <td align="left">
            <li style="margin-left: 1px;">
                <a id="ctl00_cphRoblox_NewsFeed_dlNews_ctl00_NewsItemHyperLink" href="<?=Tumblr::getRelativePostLink(1)?>"><?=Tumblr::getRelativePostTitle(1)?></a>
            </li>
            </td>
        </tr>
        <tr>
            <td align="left">
            <li style="margin-left: 1px;">
                <a id="ctl00_cphRoblox_NewsFeed_dlNews_ctl00_NewsItemHyperLink" href="<?=Tumblr::getRelativePostLink(2)?>"><?=Tumblr::getRelativePostTitle(2)?></a>
            </li>
            </td>
        </tr>
    </tbody>
</table>