<?php
?>

<div id="PlaceReset">
    <div id="popup" class="popupControl" style="width:400px;">
        <div>
            <div align="right">
                <a class="PopUpOption" href="javascript:__doPostBack('ctl00$cphRoblox$lbClosePopUp','')">[ close window ]</a>
            </div>
            <div class="PopUpInstruction">To reset your place, click an image below:</div>
            <table cellspacing="0" cellpadding="10" align="Center" border="0" style="border-collapse:collapse;">
                <tbody>
                    <tr>
                        <td align="center" valign="middle" style="color:#003399;background-color:White;">
                            <a supportsalphachannel="false" title="Happy Home in Robloxia" onclick="javascript:__doPostBack('ctl00$cphRoblox$dlPlaceTemplates$ctl00$rbxPlaceTemplateThumbnail','')" style="display:inline-block;height:70px;width:120px;cursor:pointer;">
                                <img src="<?=fullDomain?>/cdn/t2/ec270e402fea4b1d1d7068679fb47c55" style="height:70px;width:120px;" border="0" id="img" alt="Happy Home in Robloxia">
                            </a>
                            <br>
                            <span>Happy Home in Robloxia</span>
                        </td>
                        <td align="center" valign="middle" style="color:#003399;background-color:White;">
                            <a supportsalphachannel="false" title="Starting BrickBattle Map" onclick="javascript:__doPostBack('ctl00$cphRoblox$dlPlaceTemplates$ctl02$rbxPlaceTemplateThumbnail','')" style="display:inline-block;height:70px;width:120px;cursor:pointer;">
                                <img src="<?=fullDomain?>/cdn/t2/b117674211d077146446e8b2216a7af0" style="height:70px;width:120px;" border="0" id="img" alt="Starting BrickBattle Map">
                            </a>
                            <br>
                            <span>Starting BrickBattle Map</span>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" style="color:#003399;background-color:White;">
                            <a supportsalphachannel="false" title="Empty Baseplate" onclick="javascript:__doPostBack('ctl00$cphRoblox$dlPlaceTemplates$ctl01$rbxPlaceTemplateThumbnail','')" style="display:inline-block;height:70px;width:120px;cursor:pointer;">
                                <img src="<?=fullDomain?>/cdn/t2/7364b9e2bf42b7acf1837cbbec1ffa2d" style="height:70px;width:120px;" border="0" id="img" alt="Empty Baseplate">
                            </a>
                            <br>
                            <span>Empty Baseplate</span>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <fieldset title="Reset Place">
        <legend>Reset Place</legend>
        <div class="Suggestion"> Only do this if you want to reset your place to one of our starting templates. This will cause you to lose any changes you have made and cannot be un-done. </div>
        <div class="ResetPlaceRow">
            <div class="Button" style="width:80px;" id="reset"> Reset Place </div>
        </div>
    </fieldset>
</div>