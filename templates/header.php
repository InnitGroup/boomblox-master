<?php
#made: 01/04/2025 @marsoc
#last edit: 03/08/2025 @marsoc: wiki + blog
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
?>
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
									<img src="/images/<?=Site::getThemeProperty("logo",$theme);?>" border="0" alt="<?=Site::getThemeProperty("name",$theme);?>" style="<?=Site::getThemeProperty("logoDimensions",$theme);?>">
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
            	<div class="Navigation">
            		<span>
            		    <a class="MenuItem" href="/User.aspx">My <?=Site::getThemeProperty("alias")?></a>
            		</span>
            		<span class="Separator">&nbsp;|&nbsp;</span>
            		<span>
            		    <a class="MenuItem" href="/Games.aspx">Games</a>
            		</span>
            		<span class="Separator">&nbsp;|&nbsp;</span>
            		<span>
            		    <a class="MenuItem" href="/Catalog.aspx">Catalog</a>
            		</span>
            		<span class="Separator">&nbsp;|&nbsp;</span>
            		<span>
            		    <a class="MenuItem" href="/Browse.aspx">People</a>
            		</span>
            		<span class="Separator">&nbsp;|&nbsp;</span>
                    <span>
                        <a class="MenuItem" href="/Upgrades/BuildersClub.aspx"><?=Site::getThemeProperty("membership",$theme);?></a>
                    </span>
            		<span class="Separator">&nbsp;|&nbsp;</span>
            		<span>
            		    <a class="MenuItem" href="/Forum/Default.aspx">Forum</a>
            		</span>
            		<span class="Separator">&nbsp;|&nbsp;</span>
            		<span>
            		    <a class="MenuItem" href="https://boombloxjournal.tumblr.com/" target="_blank">News</a>&nbsp;<a id="ctl00_hlNewsFeed" href="https://boombloxjournal.tumblr.com/"><img src="/images/feed-icons/feed-icon-14x14.png" alt="RSS" border="0"></a>
            		</span>
            		<span class="Separator">&nbsp;|&nbsp;</span>
            		<span>
            		    <a class="MenuItem" href="/Parents.aspx">Parents</a>
            		</span>
            		<span class="Separator">&nbsp;|&nbsp;</span>
            		<span>
            		    <a class="MenuItem" href="https://uboomblox.miraheze.org/wiki/Main_Page" target="_blank">Help</a>
            		</span>
             	</div>
            </div>
