<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
$toolbox = new ToolboxManager;
?>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<title> Toolbox </title>
		<link href="/CSS/Toolbox.css" type="text/css" rel="stylesheet">
		<script id="Functions" type="text/jscript">
			function insertContent(id) {
				isNetworkClient = window.external.ExecScript('return game:findFirstChild("NetworkClient")~=nil')[0];
                    if (!isNetworkClient) window.external.Insert("http://<?=domain?>/asset/?id="+id);
			}

			function dragRBX(id) {
				isNetworkClient = window.external.ExecScript('return game:findFirstChild("NetworkClient")~=nil')[0];
                    if (!isNetworkClient) window.external.Insert("http://<?=domain?>/asset/?id="+id);
            }
            
			function clickButton(e, buttonid) {
				var bt = document.getElementById(buttonid);
				if (typeof bt == 'object') {
					if (navigator.appName.indexOf("Netscape") > (-1)) {
						if (e.keyCode == 13) {
							bt.click();
							return false;
						}
					}
					if (navigator.appName.indexOf("Microsoft Internet Explorer") > (-1)) {
						if (event.keyCode == 13) {
							bt.click();
							return false;
						}
					}
				}
			}
		</script>
	</head>
	<body class="Page" bottommargin="0" leftmargin="0" rightmargin="0">
		<form name="fToolbox" method="post" action="ClientToolbox.aspx?Category=AllModels&amp;Query=color&amp;PageIndex=9" onkeypress="" id="fToolbox">
			<div>
				<input type="hidden" name="__LASTFOCUS" id="__LASTFOCUS" value="">
				<input type="hidden" name="ScriptManager1_HiddenField" id="ScriptManager1_HiddenField" value="">
				<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="">
				<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="">
				<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="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">
			</div>
			<script type="text/javascript">
				var theForm = document.forms['fToolbox'];
                if (!theForm) {
                    theForm = document.fToolbox;
                }

                function __doPostBack(eventTarget, eventArgument) {
                    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
                        theForm.__EVENTTARGET.value = eventTarget;
                        theForm.__EVENTARGUMENT.value = eventArgument;
                        theForm.submit();
                    }
                }
			</script>
			<div id="ToolboxContainer">
				<div id="ToolboxControls">
					<div id="ToolboxSelector">
						<?php
						$sort = $_POST["ddlToolboxes"] ?? "AllModels";
						?>
						<select name="ddlToolboxes" onchange="javascript:setTimeout('__doPostBack(\'ddlToolboxes\',\'\')', 0)" id="ddlToolboxes" class="Toolboxes">
							<option <?=$sort == "1" ? 'selected="selected"' : ""?> value="1">Bricks</option>
							<option <?=$sort == "2" ? 'selected="selected"' : ""?> value="2">Robots</option>
							<option <?=$sort == "3" ? 'selected="selected"' : ""?> value="3">Chassis</option>
							<option <?=$sort == "9" ? 'selected="selected"' : ""?> value="9">Tools</option>
							<option <?=$sort == "12" ? 'selected="selected"' : ""?> value="12">Furniture</option>
							<option <?=$sort == "13" ? 'selected="selected"' : ""?> value="13">Roads</option>
							<option <?=$sort == "14" ? 'selected="selected"' : ""?> value="14">Skyboxes</option>
							<option <?=$sort == "15" ? 'selected="selected"' : ""?> value="15">Billboards</option>
							<option <?=$sort == "16" ? 'selected="selected"' : ""?> value="16">Game Objects</option>
							<option <?=$sort == "MyModels" ? 'selected="selected"' : ""?> value="MyModels">My Models</option>
							<option <?=$sort == "AllModels" ? 'selected="selected"' : ""?> value="AllModels">All Models</option>
						</select>
					</div>
					<div id="pSearch">
						<div id="ToolboxSearch">
							<?php
							$search = $_POST["tbSearch"] ?? "";
							?>
							<input name="tbSearch" type="text" id="tbSearch" class="Search" value="<?=htmlspecialchars($search)?>">
							<a id="lbSearch" class="ButtonText" href="javascript:__doPostBack('lbSearch','')">
								<div id="Button">Search</div>
							</a>
						</div>
					</div>
				</div>
				<div id="ToolboxItems">
					<table id="dlToolboxItems" style="display:inline-block;width:100%;">
						<?=$toolbox->loadModels()?>
						<!-- 20 -->
					</table>
				</div>
				<div id="pNavigation">
					<div class="Navigation">
						<div id="Previous">
							<a href="ClientToolbox.aspx?Category=AllModels&amp;Query=color&amp;PageIndex=8" id="PreviousPage">
								<span class="NavigationIndicators">&lt;&lt;</span> Prev </a>
						</div>
						<div id="Next">
							<a href="ClientToolbox.aspx?Category=AllModels&amp;Query=color&amp;PageIndex=10" id="NextPage">Next <span class="NavigationIndicators">&gt;&gt;</span>
							</a>
						</div>
						<div id="Location">
							<?=$toolbox->loadPagerLocation()?>
						</div>
					</div>
				</div>
			</div>
			<div>
				<input type="hidden" name="__VIEWSTATEENCRYPTED" id="__VIEWSTATEENCRYPTED" value="">
				<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="hPxEfVbAI0oLQh6AEAnU1DKBdRHz4QYWlqIY+klMs+cNqBQFBTjxBiZ3GeDn40M5Ba7bXPT2Dgnp5Sy+8sFqke9jfonawyZRkP8CuNxZBu5ziZZ7JVoCUs9PuaFGJpTB6yvetyj+lwVTJTVTOBIsZA==">
			</div>
		</form>
	</body>
</html>