<?php
#made: 01/07/2025 @marsoc
#last edit: 01/07/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
?>
	<form name="aspnetForm" method="post" id="aspnetForm">
		<input type="hidden" name="__EVENTARGUMENT">
		<input type="hidden" name="__EVENTTARGET">
		<input type="hidden" name="__VIEWSTATE" value="<?php echo Viewstate::generateViewState(); ?>">
        <div id="Container">
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
								<div id="Logo" style="height:0px">
								<a id="ctl00_rbxImage_Logo" title="<?=Site::getThemeProperty("name",$theme);?>" href="/Default.aspx" style="display:inline-block;cursor:pointer;">
									<img src="/images/<?=Site::getThemeProperty("logo",$theme);?>" border="0" alt="<?=Site::getThemeProperty("name",$theme);?>" style="position:relative;<?=Site::getThemeProperty("logoDimensions",$theme);?>">
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
