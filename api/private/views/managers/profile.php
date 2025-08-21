<?php
class ProfileManager {
    private $theme;
    private $postData;
    private $user;
    private $validEmails = [
        "gmail.com", 
        "yahoo.com", 
        "hotmail.com", 
        "aol.com", 
        "hotmail.co.uk", 
        "hotmail.fr", 
        "msn.com", 
        "yahoo.fr", 
        "live.com", 
        "outlook.com", 
        "comcast.net"];
    private $randomEmails = [
        "mikey9203@aol.com",
        "flower4283@sbcglobal.net",
        "benny5599@hotmail.com",
        "bunny6108@aol.com",
        "jacob7642@hotmail.com",
        "james4683@yahoo.com",
        "phoebe9903@msn.com",
        "anne1316@yahoo.com",
        "caitlyn7184@hotmail.com",
        "darryl4852@msn.com",
    ];
    private $db;
    public function __construct($post, $get, $theme) {
        $this->theme = $theme;
        $this->user = new User(ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]));
        global $db;
        if (isset($get["code"]) && $this->user->getData("user","verified") == 0) {
            $clientId = Discord::clientId($get["code"]);
            $content = [];
            if (!$db->emailTaken(ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]), $clientId)) {
                $date = new DateTime();
                $content = [
                    "content" => null,
                    "embeds" => [
                        [
                            "title" => "Boomblox account discord validation",
                            "description" => "Boomblox#6728\n**Date:** ".$date->format('D, M j Y H:i:s T')."\n----------------------------------------------------\n\nDear Boomblox user, \nWe are pleased that you have chosen to validate the discord account for your ".$this->user->getData("user","username")." account.\nPlease click the link below and enter your username and email to validate your account.\n\n".fullDomain."/Login/VerifyEmail.aspx?Ticket=randomchars",
                            "color" => 6308237
                        ]
                    ]
                ];
                $stmt = "UPDATE users SET email=:email WHERE id=:id";
                $db->execute($stmt, [":email" => (int)$clientId, ":id" => ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])]);
                $stmt = "UPDATE users SET verified=1 WHERE id=:id";
                $db->execute($stmt, [":id" => ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])]);
                if (!$this->user->hasItem(33)) {
                    $this->user->giveItem(33);
                }
            } else {
                $stmt = "SELECT * FROM users WHERE email=:email";
                $result = $db->execute($stmt, [":email" => $clientId]);
                $result = $result->fetch(PDO::FETCH_ASSOC);
                $date = new DateTime();
                $content = [
                    "content" => null,
                    "embeds" => [
                        [
                            "title" => "Boomblox account alert",
                            "description" => "Boomblox#6728\n**Date:** ".$date->format('D, M j Y H:i:s T')."\n----------------------------------------------------\n\nDear Boomblox user, \nYour discord account was recently attempted to be verified with by another user. Was this you?",
                            "color" => 6308237
                        ]
                    ]
                ];
            }
            
            Discord::sendMessage((int)$clientId, $content);
            header("Location: /My/Profile.aspx");
        }
        if (isset($post["__EVENTARGUMENT"])) {
            if (str_contains($post["__EVENTARGUMENT"],"$")) {
                $decrypt = explode("$", $post["__EVENTARGUMENT"]);
                $this->postData = ["actionType" => $decrypt[1], "ageGroup" => $post["AgeGroup"], "chatMode" => $post["ChatMode"], "email" => $post["TextBoxEMail"], "blurb" => htmlspecialchars($post["Blurb"])];
                $this->processEdits();
            }
        }
    }
    public function processEdits() {
        global $db;
        switch ($this->postData["actionType"]) {
            case "Submit":
                if ($this->postData["blurb"]) {
                    $stmt = "UPDATE users SET blurb=:blurb WHERE id=:id";
                    $result = $db->execute($stmt, [":blurb" => $this->postData["blurb"], ":id" => ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])]);
                    if (!$result) {
                        $this->postData["validator"] = 4;
                    }
                }
                if (!isset($this->postData["validator"])) {
                    header("Location: /My/Profile.aspx");
                }
                break;
            case "Cancel":
                header("Location: /My/Profile.aspx");
                break;
            case "ChangePassword":
                header("Location: /Login/ResetPassword.aspx");
                break;
            case "CSettings":
                header("Location: /My/CustomSettings.aspx");
                break;
            case "VerifyEmail":
                Discord::sendOAuth();
                break;
        }
    }

    public function getVerification() {
        $verification = '';
        $string = '';
        if ($this->theme == 1) {
            $string = "Email";
        } else {
            $string = "Discord Account";
        }
        if ($this->user->getData("user", "verified") == 0) {
            $verification = '
                <div style="text-align:center;">
                    <a title="Verify '.$string.'" href="javascript:__doPostBack(\''.$this->user->getData("user","email").'\',\'Roblox$VerifyEmail\')">Verify '.$string.'</a>
                    <div class="Suggestion">and get a free hat!</div>
                </div>
            ';
        }
        return $verification;
    }
    public function getEmail() {
        $string = '';
        if ($this->theme == 1) {
            $string = "Email";
        } else {
            $string = "Discord Account";
        }

        $div = '
        <fieldset title="Update '.$string.'">
                        <legend>Update '.$string.'</legend>
                        <div class="EmailRow">
                            ';
        
        if ($this->user->getData("user", "verified") == 1) {
            if ($this->theme == 1) {
                $div .= '<label class="Label">Email:</label>&nbsp; <input disabled name="TextBoxEMail" type="text" value="'.$this->randomEmails[(int)$this->user->getData("user","email")[0]];
            } else {
                $div .= '<label class="Label">Discord ID:</label>&nbsp; <input disabled name="TextBoxEMail" type="text" value="'.htmlspecialchars($this->user->getData("user","email"));
            }
        } else {
            if ($this->theme == 1) {
                $div .= '<label class="Label">Email:</label>&nbsp; <input disabled name="TextBoxEMail" type="text"';
            } else {
                $div .= '<label class="Label">Email:</label>&nbsp; <input disabled name="TextBoxEMail" type="text"';
            }
        }

        $div .= '" tabindex="4" class="TextBox">
            </div>
            '.$this->getVerification().'
        </fieldset>';
        return $div;
    }
    public function load() { # BRB 
        echo '
        <div id="Body">
            <div id="EditProfileContainer">
                <h2>Edit Profile</h2>
                <div id="AgeGroup">
                    <fieldset title="Update your age-group">
                        <legend>Update your age-group</legend>
                        <div class="Suggestion"> This is used to customize your '.Site::getThemeProperty("alias", $this->theme).' experience. Users under 13 years are only shown pre-approved images. </div>
                        <div class="AgeGroupRow">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="radio" name="AgeGroup" value="1" tabindex="1">
                                            <label>Under 13 years</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" name="AgeGroup" value="2" checked="checked" tabindex="1">
                                            <label>13 years or older</label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
                    <fieldset title="Reset your password">
                        <legend>Change your password</legend>
                        <div class="Suggestion">Click the button below to change your password.</div>
                        <div class="ResetPasswordRow"> &nbsp; <a href="javascript:__doPostBack(\'\',\'Roblox$ChangePassword\')">Change Password</a></div>
                    </fieldset>
                </div>
                <div id="EnterEmail">
                    '.$this->getEmail().'
                </div>
                <div id="Blurb">
                    <fieldset title="Update your personal blurb">
                        <legend>Update your personal blurb</legend>
                        <div class="Suggestion">Describe yourself here (max. 1000 characters). Make sure not to provide any details that can be used to identify you outside '.Site::getThemeProperty("alias", $this->theme).'. </div>
                        <div class="BlurbRow">
                            <textarea name="Blurb" rows="2" cols="20" tabindex="3" class="MultilineTextBox">'.$this->user->getData("user","blurb").'</textarea>
                        </div>
                    </fieldset>
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