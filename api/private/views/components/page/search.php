<?php
global $query;
if (!isset($query)) {
    $query = "";
}
?>

<div id="SearchBar" class="SearchBar">
	<span class="SearchBox"><input name="SearchTextBox" type="text" maxlength="100" class="TextBox" value="<?=$query?>"/></span>
	<span class="SearchButton"><input type="submit" name="SearchButton" value="Search"/></span>
    <span class="SearchLinks"><sup><a id="ctl00_cphRoblox_rbx_ResetSearchButton" href="javascript:__doPostBack('ctl00$cphRoblox$rbx$ResetSearchButton','')">Reset</a>&nbsp;|&nbsp;</sup><a href="#"><sup>Tips</sup>
    <span>Exact Phrase: "red brick"<br>
            Find ALL Terms: red and brick =OR=  red + brick<br>
            Find ANY Term: red or brick =OR= red | brick<br>
            Wildcard Suffix: tel* (Finds teleport, telamon, telephone, etc.)<br>
            Terms Near each other: red near brick =OR= red ~ brick<br>
            Excluding Terms: red and not brick =OR= red - brick<br>
            Grouping operations: brick and (red or blue) =OR= brick + (red | blue)<br>
            Combinations: "red brick" and not (tele* or tower) =OR= "red brick" - (tele* | tower)
            Wildcard Prefix is NOT supported: *port will not find teleport, airport, etc.
    </span>
    </a>
</span>	
</div>