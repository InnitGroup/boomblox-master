
    <div id="MyRobloxContainer" style="margin-top:18px">
        <div class="CreateNewGroup">
            <div class="StandardBoxHeader">Create A Group</div>
            <div style="text-align:left;margin:12px;display:block;height:500px">
                <div style="float:left;">
                    <div>Name:</div>
                    <div><br><input name="ctl00$RobloxGroup$Name" type="text" style="width:370px" maxlength="50"></div>
                    <div><br>Description:</div>
                    <div><br><textarea name="ctl00$RobloxGroup$Description" rows="15" cols="65"></textarea></div>
                    <div><br>Emblem:</div>
                    <div><br><input name="ctl00$RobloxGroup$Emblem" type="file"></div>
                    <div><br>Creating a group costs <span class="CreateNewGroupError">100 ROBUX</span>. By clicking Purchase, your account will be charged <span class="CreateNewGroupError">100 ROBUX</span>.</div>
                    <div><br>Need more ROBUX? Buy some <a href="/Upgrades/Robux.aspx">here</a>.</div>
                    <div><br><input type="submit" name="ctl00$RobloxGroup$Purchase" value="Purchase">&nbsp;<input type="submit" name="ctl00$RobloxGroup$Cancel" value="Cancel"></div>
                </div>

                <div style="float:right;border:solid 2px black;padding:4px">
                    <h3>Settings:</h3>
                    
                    <div style="margin:2px">
                        <span>Group Entry:</span><br>
                        <span><input name="ctl00$RobloxGroup$Settings$GroupEntry" value="1" type="radio" checked> Anyone can join</span><br>
                        <span><input name="ctl00$RobloxGroup$Settings$GroupEntry" value="2" type="radio"> Manual Approval</span>
                    </div>

                    <div style="margin:2px">
                        <br><span>Public Wall View:</span><br>
                        <span><input name="ctl00$RobloxGroup$Settings$WallView" value="1" type="radio" checked> Anyone can see the wall</span><br>
                        <span><input name="ctl00$RobloxGroup$Settings$WallView" value="2" type="radio"> Only members can see the wall</span>
                    </div>

                    <div style="margin:2px">
                        <br><span>Posting:</span><br>
                        <span><input name="ctl00$RobloxGroup$Settings$Posting" value="1" type="radio" checked> Every group member can post</span><br>
                        <span><input name="ctl00$RobloxGroup$Settings$Posting" value="2" type="radio"> Only Group Admins can post</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>