<?php
PageBuilder::addComponent("forum", "header");
PageBuilder::addComponent("forum", "navmenu");
?>

<table cellPadding="0" width="100%">
  <tr>
    <td align="left" colSpan="2"><?=PageBuilder::addComponent("forum", "whereami")?></td>
  </tr>
  <tr>
    <td align="left" colSpan="2">&nbsp;
    </td>
  </tr>
  <tr>
    <td colSpan="2">
      <span class="menuTitle">Threads you are tracking:</span>
      <AspNetForums:ThreadList id="ThreadTracking" class="tableBorder" CellSpacing="1" CellPadding="0" Width="100%">
      </AspNetForums:ThreadList>
      <br>
      <label visible="false" id="NoTrackedThreads" class="normalTextSmallBold">You are not tracking any threads.</label>
    </td>
  </tr>
  <tr>
    <td align="left" colSpan="2">&nbsp;
    </td>
  </tr>
  <tr>
    <td colSpan="2">
      <span class="menuTitle">Last 25 active threads you have participated in:</span>
      <AspNetForums:ThreadList id="ParticipatedThreads" class="tableBorder" CellSpacing="1" CellPadding="0" Width="100%">
      </AspNetForums:ThreadList>
      <br>
      <label visible="false" id="NoParticipatedThreads" class="normalTextSmallBold">You are not tracking any threads.</label>
    </td>
  </tr>
  <tr>
    <td align="right" colSpan="2">
      <a id="ctl00_cphRoblox_Myforums1_ctl00_FindMorePosts" class="linkSmallBold" href="javascript:void(0)">View more posts you have participated in</a>
    </td>
  </tr>
</table>

<?=PageBuilder::addComponent("forum", "footer")?>