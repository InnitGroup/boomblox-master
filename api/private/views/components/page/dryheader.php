<?php
global $theme, $auth, $user;
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?=$title?></title>
        <link rel="icon" href="/images/<?=Site::getThemeProperty("favicon", $theme)?>?v=<?=time()?>">
        <link rel="stylesheet" href="/CSS/AllCSS.ashx?v=<?=$theme?>&t=<?=time()?>">
        <link rel="stylesheet" href="/CSS/Ajax.css?t=<?=time()?>">
		<meta name="robots" content="noindex">
        <?php if (Server::isIE7()): ?>
            <script src="/ScriptResource.axd?v=<?=time()?>&d=ZGF0YTI="></script>
        <?php else: ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script src="/ScriptResource.axd?v=<?=time()?>"></script>
        <?php endif; ?>

        <?php if (isset($jsList)): foreach ($jsList as $js): ?>
            <script src="/ScriptResource.axd?d=<?=base64_encode($js)?>"></script>
        <?php endforeach; endif; ?>
    </head>
    <body>
	<form name="aspnetForm" method="post" id="aspnetForm">
		<input type="hidden" name="__EVENTARGUMENT">
		<input type="hidden" name="__EVENTTARGET">
		<input type="hidden" name="__VIEWSTATE" value="<?=Viewstate::generateViewState()?>">
        <div id="MasterContainer"><div id="Container">
            <div id="Header">
            	<div id="Banner">
            	    <div id="Options">
            	    	<div id="Authentication">
            				<span>
            				    <a id="ctl00_lsLoginStatus" href="#"></a>
            				</span>
            			</div>
            			<div id="Settings">
            			    <span id="ctl00_lSettings"></span>
            			</div>
            		</div>
					<div id="Logo">
						<a id="ctl00_rbxImage_Logo" title="<?=Site::getThemeProperty("name",$theme);?>" href="/" style="display:inline-block;cursor:pointer;position:relative;top:4px">
							<img src="/images/<?=Site::getThemeProperty("logo", $theme)?>?t=<?=time()?>" border="0" alt="<?=Site::getThemeProperty("name",$theme);?>" blankurl="http://t2.<?=domain?>/blank-267x70.gif" style="">
						</a>
					</div>
					<div id="Alerts" style="position:relative;bottom:1px;">
						<table style="width:100%;height:100%">
							<tr>
								<td valign="middle">
								</td>
							</tr>
						</table>
					</div>
            	</div>
        </div>
