<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();

$page = new PageBuilder(Site::getThemeProperty("alias", $theme) . " | Install", $theme, "/templates/authheader.php");
$page->buildHeader();

if (Server::isPost()) {
    if (isset($_POST['ctl00$cphRoblox$ButtonDownload'])) {
        echo "
        <script>
        window.open('/Install/ActiveDownload.aspx', '_blank');
        </script>
        ";
    }
}
?>

<div id="Body">
    <div>
    </div>
    <p align="center" style="color: red">Currently, ROBLOX is only available on PCs running the Windows® operating system</p>
    <div style="margin-top: 12px; margin-bottom: 12px">
        <div id="AlreadyInstalled" style="display: none">
            <p>ROBLOX is already installed on this computer. If you want to try installing it again then follow the instructions below. Otherwise, you can just <a href="javascript:goBack()">continue</a>.</p>
        </div>
        <img id="ctl00_cphRoblox_Image3" class="Bullet" src="/images/BuildIcon.png" border="0">
        <div id="InstallStep1" style="padding-left: 60px">
            <h2>Download ROBLOX</h2>
            <p><input type="submit" name="ctl00$cphRoblox$ButtonDownload" value="Install ROBLOX" id="ctl00_cphRoblox_ButtonDownload" class="BigButton">&nbsp;(Total download about 8.5Mb)</p>
        </div>
        <img id="ctl00_cphRoblox_Image4" class="Bullet" src="/images/FriendsIcon.png" border="0">
        <div id="InstallStep2" style="padding-left: 60px">
            <h2>Run the Installer</h2>
            <p>A window will open asking what you want to do with a file called Setup.exe.</p>
            <p>Click 'Run'. You might see a confirmation message, asking if you're sure you want to run this software. Click 'Run' again.</p>
            <p><img id="ctl00_cphRoblox_Image1" src="/images/Install/DownloadPrompt.PNG" border="0"></p>
        </div>
        <img id="ctl00_cphRoblox_Image5" class="Bullet" src="/images/BattleIcon.png" border="0">
        <div id="InstallStep3" style="padding-left: 60px">
            <h2>Follow the Setup Wizard</h2>
            <p>When the download has finished, the ROBLOX Setup Wizard will appear and guide you through the rest of the installation.</p>
            <p><img id="ctl00_cphRoblox_Image2" src="/images/Install/Wizard.PNG" border="0"></p>
        </div>
    </div>

    <script type="text/javascript">
        function isInstalled()
        {
		    try
		    { 
			    var robloxClient = new ActiveXObject("RobloxInstall.Updater"); 
			    return true;
		    }
		    catch (e)
		    { 
		        return false;
		    } 
        }
        function goBack()
        {
 		    window.history.back();
        }
		function checkInstall() 
		{ 
			if (isInstalled())
			{ 
				// If we didn't fail, then we can move on
				document.getElementById("ctl00_cphRoblox_ButtonDownload").disabled = true;
				urchinTracker("InstallSuccess");
                Roblox.Install.Service.InstallSucceeded();
				goBack();
			}
			else
			{
				// Try again later 
				window.setTimeout("checkInstall()", 2000); 
			} 
		} 
    </script>
    <script type="text/javascript">
		if (isInstalled())
		{
		    AlreadyInstalled.style.display="block";
		}
		else
		{
		    window.setTimeout("checkInstall()", 1000);
		}
    </script>
</div>

<?php
$page->buildFooter();
?>