<?php
PageBuilder::addComponent("forum", "header");
PageBuilder::addComponent("forum", "navmenu");
?>

<table cellPadding="0" width="100%">
  <tr>
    <td align="left" colSpan="2"><ASPNETFORUMS:WHEREAMI id="Whereami1" runat="server" NAME="Whereami1"></ASPNETFORUMS:WHEREAMI></td>
  </tr>
  <tr>
    <td align="left" colSpan="2">&nbsp;
    </td>
  </tr>
  <tr>
    <td colSpan="2">
      <span class="menuTitle">Threads you are tracking:</span>
      <AspNetForums:ThreadList id="ThreadTracking" CssClass="tableBorder" runat="server" CellSpacing="1" CellPadding="0" Width="100%">
      </AspNetForums:ThreadList>
      <br>
      <asp:Label visible="false" id="NoTrackedThreads" runat="server" CssClass="normalTextSmallBold">You are not tracking any threads.</asp:Label>
    </td>
  </tr>
  <tr>
    <td align="left" colSpan="2">&nbsp;
    </td>
  </tr>
  <tr>
    <td colSpan="2">
      <span class="menuTitle">Last 25 active threads you have participated in:</span>
      <AspNetForums:ThreadList id="ParticipatedThreads" CssClass="tableBorder" runat="server" CellSpacing="1" CellPadding="0" Width="100%">
      </AspNetForums:ThreadList>
      <br>
      <asp:Label visible="false" id="NoParticipatedThreads" runat="server" CssClass="normalTextSmallBold">You are not tracking any threads.</asp:Label>
    </td>
  </tr>
  <tr>
    <td align="right" colSpan="2">
      <a id="ctl00_cphRoblox_Myforums1_ctl00_FindMorePosts" class="linkSmallBold" href="javascript:void(0)">View more posts you have participated in</a>
    </td>
  </tr>
</table>

<?php
PageBuilder::addComponent("forum", "footer");
?>