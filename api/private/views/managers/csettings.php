<?php
class CSettingsManager {
    private $theme;
    private $user;
    public function __construct($post, $theme) {
        $this->theme = $theme;
        $this->user = new User(ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]));
        if (!empty($post)) {
            $this->handle($post);
        }
    }
    public function handle($post) {
        if (isset($_POST["__EVENTARGUMENT"]) && !empty($_POST["__EVENTARGUMENT"])) {
            $argument = $_POST["__EVENTARGUMENT"];
            if (str_contains($argument, "$")) {
                global $db;
                $decryptedData = explode("$", $argument);
                $action = $decryptedData[1];
                switch ($action) {
                    case "DynamicIP":
                        $stmt = "SELECT dynamicIp FROM users WHERE id=:id";
                        $result = $db->execute($stmt, [":id" => ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])]);
                        $result = $result->fetch(PDO::FETCH_ASSOC);
                        $isDynamic = (bool)$result["dynamicIp"];

                        $stmt = "UPDATE users SET dynamicIp=:dynamicIp WHERE id=:id";
                        $result = $db->execute($stmt, [":dynamicIp" => (int)!$isDynamic, ":id" => ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])]);

                        $stmt = "UPDATE users SET lastIp=:lastIp WHERE id=:id";
                        $ip = IP::getDatabaseIp(IP::getIp(!$isDynamic), !$isDynamic);
                        $result = $db->execute($stmt, [":lastIp" => $ip, ":id" => ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])]);
                        break;
                    case "Submit":
                        $theme = (int)$post["Theme"];
                        $validThemes = [0, 1, 2, 3, 4];
                        if ($theme !== $this->user->getData("user", "theme") && in_array($theme, $validThemes)) {
                            $stmt = "UPDATE users SET theme=:theme WHERE id=:id";
                            $db->execute($stmt, [":theme" => $theme, ":id" => ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])]);
                        }
                        break;
                }
                header("Location: /My/CustomSettings.aspx");
            }
        }
    }
    public function isDynamic() {
        $isDynamic = (bool)$this->user->getData("user", "dynamicIp");
        if ($isDynamic) {
            return "Online";
        } else {
            return "Offline";
        }
    }
    public function isTheme($theme) {
        $isTheme = (bool)($theme == $this->user->getData("user", "theme"));
        if ($isTheme) {
            return 'checked="checked"';
        }
    }
    public function load() {
        echo '
        <div id="Body">
            <div id="EditProfileContainer">
                <h2>Custom Settings</h2>
                <div id="AgeGroup">
                    <fieldset title="Select a theme">
                        <legend>Select a theme</legend>
                        <div class="Suggestion"> Pick a theme you like to customize the site design.</div>
                        <div class="AgeGroupRow">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="radio" name="Theme" value="0" '.$this->isTheme(0).' tabindex="1">
                                            <label>Default Theme (Boomblox)</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" name="Theme" value="1" '.$this->isTheme(1).' tabindex="1">
                                            <label>ROBLOX Theme</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" name="Theme" value="3" '.$this->isTheme(3).' tabindex="1">
                                            <label>2007 ROBLOX Theme</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>RIP Protonium Theme</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>(March 2025 - September 29th, 2025)</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" name="Theme" value="4" '.$this->isTheme(4).' tabindex="1">
                                            <label>Dark Theme</label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="Suggestion"><a href="javascript:__viewModal(\'modal$Themes\')">Read more</a> to educate yourself about themes.</div>
                    </fieldset>
                </div>
                <div id="ChatMode">
                    <fieldset title="Update your chat mode">
                        <legend>Update your chat mode</legend>
                        <div class="Suggestion"> All in-game chat is subject to profanity filtering and moderation. For enhanced chat safety, choose SuperSafe Chat; only chat from pre-approved menus will be shown to you. </div>
                        <div class="ChatModeRow">
                            <table border="0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="radio" name="ChatMode" value="False" checked="checked" tabindex="2">
                                            <label>Safe Chat</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" name="ChatMode" value="True" tabindex="2">
                                            <label>SuperSafe Chat</label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </div>
                <div id="ResetPassword">
                    <fieldset title="Using a dynamic IP?">
                        <legend>Using a dynamic IP?</legend>
                        <div class="Suggestion">Click the hyperlink below to declare/undeclare your IP address as dynamic.</div>
                        <div class="ResetPasswordRow">
                            &nbsp; 
                            <a href="javascript:__doPostBack(\'\',\'Roblox$DynamicIP\')">Toggle dynamic IP</a>
                            <img src="/images/OnlineStatusIndicator_Is'.$this->isDynamic().'.gif">
                        </div>
                        <div class="Suggestion">Do not use this unless your IP is dynamic, <a href="javascript:__viewModal(\'modal$DynamicIP\')">read more.</a></div>
                    </fieldset>
                </div>
                <div class="modalPopup" id="modalPopup" style="display:none;width:300px;position:absolute;left:805px;bottom:440px;">
                    <div style="margin: 1.5em">
                        <div id="modal$DynamicIP" style="display: none">
                            <div id="Spinner" style="float:left;margin:0 1em 1em 0">
                                <img style="height:30px; "src="/images/CopyLocked.png" alt="Progress" border="0">
                            </div>
                            <h4>Dynamic IPs</h4>By toggling the dynamic IP assurance feature, you are informing the servers that your IP is dynamic so you won\'t be constantly alerted of new logins, and you won\'t get locked out of your account when the site is locked by user IP.<br><br>It is also important to note that if you declare your IP as being dynamic here and it isn\'t, you open your account to the possibility of people with similar IPs to you being able to pester your account.
                        </div>
                        <div id="modal$Themes" style="display: none">
                            <div id="Spinner" style="float:left;margin:0 1em 1em 0">
                                <img style="height:30px; "src="/images/bbxb.png" alt="Progress" border="0">
                            </div>
                            <h4>Themes</h4>Themes are a feature that allow the user to customize their Boomblox site in order to make it look different.<br><br>The ROBLOX theme is primarily good for being as accurate as possible in terms of assets and style, so you can record old-looking videos.<br><br>The Protonium theme was made to commemorate the original name of Boomblox and to ensure that it\'s place in history is not forgotten.
                        </div>
                        <div id="Loading" style="display: none"> A server is loading the game</div>
                        <div id="Joining" style="display: none"> The server is ready. Joining the game...</div>
                        <div id="Error" style="display: none"> An error occured. Please try again later</div>
                        <div id="Expired" style="display: none"> There are no game servers available at this time. Please try again later</div>
                        <div id="GameEnded" style="display: none"> The game you requested has ended</div>
                        <div id="GameFull" style="display: none"> The game you requested is full. Please try again later</div>
                        <div style="text-align: center; margin-top: 1em">
                            <a class="Button" href="javascript:__closeModal()">Close</a>
                        </div>
                    </div>
                </div>
                <div class="Buttons">
                    <a tabindex="4" class="Button" href="javascript:__doPostBack(\'\',\'Roblox$Submit\')">Update</a>
                    &nbsp; 
                    <a tabindex="5" class="Button" href="javascript:__doPostBack(\'\',\'Roblox$Cancel\')">Cancel</a>
                </div>
            </div>
        </div>
        ';
    }
}
?>