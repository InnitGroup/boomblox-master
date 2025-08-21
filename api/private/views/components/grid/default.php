<?php
global $theme;
?>

<div id="MainPanel">
    <h1>Welcome to the Grid!</h1>
    <p>Here you can manage all server aspects of <?=Site::getThemeProperty("alias", $theme)?>!</p>
    <p>You can find a complete directory of all things to do in the Grid section on the link tree on the left panel, or look below.</p>
    <hr>
    <ul>
        <li><a href="/Admi/Grid/Deploy.aspx">Deploy</a> - deploy & push new clients</li>
        <li><a href="/Admi/Grid/Games.aspx">Games</a> - overseer gameservers controlled by the grid service</li>
        <li><a href="/Admi/Grid/Default.aspx">Home</a> - YOU ARE HERE</li>
    </ul>
    <hr>
    <h1>About the Grid Service:</h1>
    <p>The Grid Service (RBX<u>GS</u>) handles all grid actions, such as gameservers and thumbnails.</p>
    <p>Although our Grid Service does not natively host the gameservers, you can still overseer the gameservers from this panel.</p>
    <p>We primarily use the Grid Service for rendering, and because there is no archived RBXGS for 0.7.6.0, we cannot run gameservers on it <u>natively</u>.</p>
</div>