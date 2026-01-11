<?php
global $user;
PageBuilder::addComponent("forum", "header");

if (Server::isPost()) {
    if (isset($_POST["Timezone"])) {
        $timezone = $user->getTimezone();
        $timezones = [-10, -9, -8, -7, -6, -5, -4, -3, 0, 1, 2, 3, 4, 5, 8, 9, 10, 11, 12];
        $newTimezone = $_POST["Timezone"];
        if (!in_array($newTimezone, $timezones)) {
            Server::_404();
        }

        if ($timezone !== $newTimezone) {
            $user->setTimezone($newTimezone);
        }
    }

    if (isset($_POST["Occupation"])) {
        $occupation = $user->getOccupation();
        $newOccupation = $_POST["Occupation"];
        
        if ($occupation !== $newOccupation) {
            $user->setOccupation($newOccupation);
        }
    }

    if (isset($_POST["Interests"])) {
        $interests = $user->getInterests();
        $newInterests = $_POST["Interests"];
        
        if ($interests !== $newInterests) {
            $user->setInterests($newInterests);
        }
    }

    if (isset($_POST["AolIm"])) {
        $aim = $user->getAIM();
        $newAim = $_POST["AolIm"];
        
        if ($aim !== $newAim) {
            $user->setAIM($newAim);
        }
    }

    if (isset($_POST["Icq"])) {
        $icq = $user->getICQ();
        $newIcq = $_POST["Icq"];
        
        if ($icq !== $newIcq) {
            $user->setICQ($newIcq);
        }
    }

    if (isset($_POST["Location"])) {
        $location = $user->getLocation();
        $newLocation = $_POST["Location"];
        
        if ($location !== $newLocation) {
            $user->setLocation($newLocation);
        }
    }

    if (isset($_POST["MsnIm"])) {
        $msn = $user->getMSN();
        $newMsn = $_POST["MsnIm"];
        
        if ($msn !== $newMsn) {
            $user->setMSN($newMsn);
        }
    }

    if (isset($_POST["YahooIM"])) {
        $yahoo = $user->getYahoo();
        $newYahoo = $_POST["YahooIM"];
        
        if ($yahoo !== $newYahoo) {
            $user->setYahoo($newYahoo);
        }
    }

    if (isset($_POST["Website"])) {
        $website = $user->getWebsite();
        $newWebsite = $_POST["Website"];
        
        if ($website !== $newWebsite) {
            $user->setWebsite($newWebsite);
        }
    }

    if (isset($_POST["FakeEmail"])) {
        $pemail = $user->getPemail();
        $newPemail = $_POST["FakeEmail"];
        
        if ($pemail !== $newPemail) {
            $user->setPemail($newPemail);
        }
    }

    Server::_self();
}
?>

<table class="tableBorder" cellSpacing="1" cellPadding="0" width="100%">
    <tr>
        <th class="tableHeaderText" align="left" height="20">
            &nbsp; Edit User Information for:
            <span class="tableHeaderText" style="font-weight: bold"><?=$user->getUsername()?></span></th></tr>
    <tr>
        <td class="forumHeaderBackgroundAlternate" align="left" height="20"><span class="forumTitle">&nbsp;Required Information </span></td>
    </tr>
    <tr>
        <td class="forumRow">
            <table cellSpacing="0" cellPadding="2" border="0">
                <tr>
                    <td colSpan="4">&nbsp;</td>
                </tr>
                <!-- Email -->
                <tr>
                    <td class="forumRow" noWrap width="19">&nbsp; &nbsp;
                    </td>
                    <td noWrap align="right"><span class="normalTextSmallBold">Email: </span></td>
                    <td align="left"><input name="ctl00$cphRoblox$EmailTextBox$lbEmail" type="text" size="35" id="ctl00_cphRoblox_EmailTextBox_lbEmail" <?=$user->getEmail() !== NULL ? 'disabled value="' . $user->getEmail() . '"' : ''?>></td> <!-- \w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)* -->
                    <td align="left"><span id="ctl00_cphRoblox_Edituserprofile1_InfoForm_RequiredFieldValidator1" class="validationWarningSmall" style="color:Red;visibility:hidden;">You must supply a valid email address.</span></td>
                </tr>
                <tr>
                    <td colSpan="2"></td>
                    <td vAlign="top" height="20"><span class="normalTextSmaller">&nbsp;Your email 
            address is not publicly available.</span></td>
                    <td vAlign="top">
                        <span id="ctl00_cphRoblox_Edituserprofile1_InfoForm_RequiredFieldValidator1" class="validationWarningSmall" style="color:Red;visibility:hidden;">You must supply an email address.</span>
                    </td>
                </tr>
                <!-- Timezone -->
                <tr>
                    <td class="forumRow" noWrap width="19">&nbsp; &nbsp;
                    </td>
                    <td noWrap align="right"><span class="normalTextSmallBold">Timezone: </span></td>
                    <td align="left">
                        <select id="Timezone" name="Timezone">
                            <option <?=$user->getTimezone() == -10 ? "selected" : ""?> value="-10">Hawaii (GMT -10)</option>
                            <option <?=$user->getTimezone() == -9 ? "selected" : ""?> value="-9">Alaska (GMT -9)</option>
                            <option <?=$user->getTimezone() == -8 ? "selected" : ""?> value="-8">Pacific Time (GMT -8)</option>
                            <option <?=$user->getTimezone() == -7 ? "selected" : ""?> value="-7">Mountain Time (GMT -7)</option>
                            <option <?=$user->getTimezone() == -6 ? "selected" : ""?> value="-6">Central Time (GMT -6)</option>
                            <option <?=$user->getTimezone() == -5 ? "selected" : ""?> value="-5">Eastern Time (GMT -5)</option>
                            <option <?=$user->getTimezone() == -4 ? "selected" : ""?> value="-4">Atlantic Time (GMT -4)</option>
                            <option <?=$user->getTimezone() == -3 ? "selected" : ""?> value="-3">Brasilia Time (GMT -3)</option>
                            <option <?=$user->getTimezone() == 0 ? "selected" : ""?> value="0">Greenwich Mean Time (GMT +0)</option>
                            <option <?=$user->getTimezone() == 1 ? "selected" : ""?> value="1">Central Europe Time (GMT +1)</option>
                            <option <?=$user->getTimezone() == 2 ? "selected" : ""?> value="2">Eastern Europe Time (GMT +2)</option>
                            <option <?=$user->getTimezone() == 3 ? "selected" : ""?> value="3">Middle Eastern Time (GMT +3)</option>
                            <option <?=$user->getTimezone() == 4 ? "selected" : ""?> value="4">Abu Dhabi Time (GMT +4)</option>
                            <option <?=$user->getTimezone() == 5 ? "selected" : ""?> value="5">Indian Time (GMT +5)</option>
                            <option <?=$user->getTimezone() == 8 ? "selected" : ""?> value="8">Eastern China Time (GMT +8)</option>
                            <option <?=$user->getTimezone() == 9 ? "selected" : ""?> value="9">Japan Time (GMT +9)</option>
                            <option <?=$user->getTimezone() == 10 ? "selected" : ""?> value="10">Australian Time (GMT +10)</option>
                            <option <?=$user->getTimezone() == 11 ? "selected" : ""?> value="11">Pacific Rim Time (GMT +11)</option>
                            <option <?=$user->getTimezone() == 12 ? "selected" : ""?> value="12">New Zealand Time (GMT +12)</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colSpan="2"></td>
                    <td vAlign="top" height="20"><span class="normalTextSmaller">&nbsp;Date/Times will 
            be displayed for your timezone.</span></td>
                </tr>
                <!-- Date Format -->
                <tr>
                    <td class="forumRow" noWrap width="19">&nbsp; &nbsp;
                    </td>
                    <td noWrap align="right"><span class="normalTextSmallBold">Date Format: </span></td>
                    <td align="left"><select id="DateFormat">
                            <option Value="dd MMM yyyy">Day Month Year (1 May 2002)</option>
                            <option Value="MM-dd-yyyy">Month-Day-Year (5-1-2002)</option>
                            <option Value="dd-MM-yyyy">Day-Month-Year (1-5-2002)</option>
                            <option Value="MM/dd/yyyy">Month/Day/Year (5/1/2002)</option>
                            <option Value="dd/MM/yyyy">Day/Month/Year</option>
                        </select></td>
                <tr>
                    <td colSpan="2"></td>
                    <td vAlign="top" height="20"><span class="normalTextSmaller">&nbsp;Date/Times will 
            be displayed in this format.</span></td>
                </tr>
                <!-- Change Password-->
                <tr>
                    <td class="forumRow" noWrap width="19">&nbsp; &nbsp;
                    </td>
                    <td noWrap align="right"></td>
                    <td align="left"><a Class="linkSmallBold" href="/Forum/User/ChangePassword.aspx">Change 
                            Password</a></td>
                    <td align="left"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="forumHeaderBackgroundAlternate" align="left" height="20"><span class="forumTitle">&nbsp;About you (Optional) </span></td>
    </tr>
    <tr>
        <td class="forumRow">
            <table cellSpacing="0" cellPadding="3" width="100%" border="0">
                <tr>
                    <td><span class="normalTextSmaller">&nbsp;</span></td>
                </tr>
                <tr>
                    <td class="forumRow" noWrap width="19">&nbsp; &nbsp;
                    </td>
                    <!-- Occupation -->
                    <td align="right"><span class="normalTextSmallBold">Occupation: </span></td>
                    <td align="left"><input name="Occupation" type="text" size="35" id="Occupation" <?=$user->getOccupation() !== NULL && !empty($user->getOccupation()) ? 'value="' . htmlspecialchars($user->getOccupation()) . '"' : ""?>></td>
                    <td align="left"></td>
                    <!-- Location -->
                    <td noWrap align="right"><span class="normalTextSmallBold">Location: </span></td>
                    <td noWrap align="left"><input name="Location" type="text" size="35" id="Location" <?=$user->getLocation() !== NULL && !empty($user->getLocation()) ? 'value="' . htmlspecialchars($user->getLocation()) . '"' : ""?>></td>
                </tr>
                <tr>
                    <td class="forumRow" noWrap width="19">&nbsp; &nbsp;
                    </td>
                    <!-- Interests -->
                    <td align="right"><span class="normalTextSmallBold">Interests: </span></td>
                    <td align="left"><input name="Interests" type="text" size="35" id="Interests" <?=$user->getInterests() !== NULL && !empty($user->getInterests()) ? 'value="' . htmlspecialchars($user->getInterests()) . '"' : ""?>></td>
                    <td align="left"></td>
                    <!-- MSN IM -->
                    <td noWrap align="right"><span class="normalTextSmallBold">MSN IM: </span></td>
                    <td noWrap align="left"><input name="MsnIm" type="text" size="35" id="MsnIm" <?=$user->getMSN() !== NULL && !empty($user->getMSN()) ? 'value="' . htmlspecialchars($user->getMSN()) . '"' : ""?>></td>
                </tr>
                <tr>
                    <!-- AIM -->
                    <td class="forumRow" noWrap width="19">&nbsp; &nbsp;
                    </td>
                    <td align="right"><span class="normalTextSmallBold">AIM: </span></td>
                    <td align="left"><input name="AolIm" type="text" size="35" id="AolIm" <?=$user->getAIM() !== NULL && !empty($user->getAIM()) ? 'value="' . htmlspecialchars($user->getAIM()) . '"' : ""?>></td>
                    <td align="left"></td>
                    <!-- Yahhoo Im -->
                    <td noWrap align="right"><span class="normalTextSmallBold">Yahoo IM: </span></td>
                    <td noWrap align="left"><input name="YahooIM" type="text" size="35" id="YahooIM" <?=$user->getYahoo() !== NULL && !empty($user->getYahoo()) ? 'value="' . htmlspecialchars($user->getYahoo()) . '"' : ""?>></td>
                </tr>
                <tr>
                    <td class="forumRow" noWrap width="19">&nbsp; &nbsp;
                    </td>
                    <!-- ICQ -->
                    <td align="right"><span class="normalTextSmallBold">ICQ: </span></td>
                    <td align="left"><input name="Icq" type="text" size="35" id="Icq" <?=$user->getICQ() !== NULL && !empty($user->getICQ()) ? 'value="' . htmlspecialchars($user->getICQ()) . '"' : ""?>></td>
                    <td align="left"></td>
                    <!-- Web site -->
                    <td noWrap align="right"><span class="normalTextSmallBold">Website: </span></td>
                    <td noWrap align="left">
                        <input name="Website" type="text" pattern="https?://[A-Za-z]+\.[A-Za-z]+" size="35" id="Website" <?=$user->getWebsite() !== NULL && !empty($user->getWebsite()) ? 'value="' . htmlspecialchars($user->getWebsite()) . '"' : ""?>> <!-- http://([\w-]+\.)+[\w-]+(/[\w- ./?%&amp;=]*)? -->
                        <span id="ctl00_cphRoblox_Edituserprofile1_InfoForm_RequiredFieldValidator1" class="validationWarningSmall" style="color:Red;visibility:hidden;">Must be valid URL.</span>
                    </td>
                </tr>
                <tr>
                    <td colSpan="4">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <TR>
        <td class="forumHeaderBackgroundAlternate" align="left" height="20"><span class="forumTitle">&nbsp;Display Options </span></td>
    </TR>
    <tr>
        <td class="forumRow">
            <table cellSpacing="0" cellPadding="3" border="0">
                <tr>
                    <td><span class="normalTextSmaller">&nbsp;</span></td>
                </tr>
                <!-- Fake Email -->
                <tr>
                    <td class="forumRow" noWrap width="19">&nbsp; &nbsp;
                    </td>
                    <td noWrap align="right"><span class="normalTextSmallBold">Public Email: </span></td>
                    <td align="left"><input name="FakeEmail" pattern="[A-Za-z]+@[A-Za-z]+\.[A-Za-z]+" type="text" size="35" id="FakeEmail" <?=$user->getPemail() !== NULL && !empty($user->getPemail()) ? 'value="' . htmlspecialchars($user->getPemail()) . '"' : ""?>></td>
                    <td>
                        <span id="ctl00_cphRoblox_Edituserprofile1_InfoForm_RequiredFieldValidator1" class="validationWarningSmall" style="color:Red;visibility:hidden;">You must supply a valid email address.</span> <!-- \w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)* -->
                    </td>
                </tr>
                <tr>
                    <td colSpan="2"></td>
                    <td vAlign="top" height="20"><span class="normalTextSmaller">&nbsp;Email address published with your profile.</span></td>
                </tr>
                <!-- Signature -->
                <tr>
                    <td class="forumRow" noWrap width="19">&nbsp; &nbsp;
                    </td>
                    <td vAlign="top" align="right"><span class="normalTextSmallBold">Signature: </span></td>
                    <td align="left" colSpan="2">
                        <textarea name="Signature" rows="5" cols="50" id="Signature"><?=$user->getSignature() !== NULL && !empty($user->getSignature()) ? htmlspecialchars($user->getSignature()) : ""?></textarea>
                    </td>
                    <td align="left"></td>
                </tr>
                <tr>
                    <td colSpan="2"></td>
                    <td vAlign="top" height="20"><span class="normalTextSmaller">&nbsp;Message appended to your posts.</span></td>
                </tr>
    
    <!-- Administration options -->
    <span id="Administration">
        <TR style="display:none;">
            <td class="forumHeaderBackgroundAlternate" align="left" height="20"><span class="forumTitle">&nbsp;Administrator Options </span></td>
        </TR>
        <tr style="display:none;">
            <td class="forumRow">
                <table cellSpacing="0" cellPadding="3" border="0">
                    <tr>
                        <td><span class="normalTextSmaller">&nbsp;</span></td>
                    </tr>
                    <!-- User profile approved -->
                    <tr>
                        <td colSpan="2">
                        <td vAlign="top" align="left"><input type="checkbox" id="ProfileApproved"><label class="normalTextSmallBold"> User's profile is approved (profile details are public)</label></td>
                    </tr>
                    <!-- User banned-->
                    <tr>
                        <td colSpan="2">
                        <td vAlign="top" align="left"><input type="checkbox" id="Banned"><label class="normalTextSmallBold"> User is banned (cannot login)</label></td>
                    </tr>
                    <!-- User trusted -->
                    <tr>
                        <td colSpan="2">
                        <td vAlign="top" align="left"><input type="checkbox" id="UserTrusted"><label class="normalTextSmallBold"> User is trusted (does not require moderation)</label></td>
                    </tr>
                    <!-- Email user's password -->
                    <tr>
                        <td colSpan="2">
                        <td vAlign="top" align="left"><button ID="EmailUserPassword">Email the user his/her password</button></td>
                    </tr>
                    <tr>
                        <td colSpan="4">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </span>
</table><br><br>
<p>
    <table width="100%" border="0">
        <tr>
            <td valign="top" align="center">
                <span runat="server" id="PasswordRequired">
                    <span class="normalTextSmallBold">Password (required for update): </span>
                    <input id="Password" columns="35" type="Password">
                </span>
                <button id="Submit" type="submit">Update User Information</button>
            </td>
        </tr>
        <tr>
            <td align="middle" colSpan="2"><asp:requiredfieldvalidator id="ValidatePassword" runat="server" ErrorMessage="You must enter a password to make changes." Display="Dynamic" controltovalidate="Password" CssClass="validationWarningSmall"></asp:requiredfieldvalidator></td>
        </tr>
    </table>
</p>
<?=PageBuilder::addComponent("forum", "footer")?>