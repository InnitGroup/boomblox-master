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
        global $user;
        $this->theme = $theme;
        $this->user = $user;
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
                if (strlen($post["Blurb"]) > 1000) {
                    $post["Blurb"] = substr($post["Blurb"], 1000);
                }
                $this->postData = ["actionType" => $decrypt[1], "ageGroup" => $post["AgeGroup"], "chatMode" => $post["ChatMode"], "email" => $post["TextBoxEMail"], "blurb" => Helper::debugString($post["Blurb"])];
                $this->processEdits();
            }
        }
    }

    public function processEdits() {
        global $db, $user;
        switch ($this->postData["actionType"]) {
            case "Submit":
                if ($this->postData["blurb"]) {
                    $blurb = Helper::debugString($this->postData["blurb"]);
                    if (str_contains($blurb, domain)) {
                        $blurb = "[ Content Deleted ]";
                    }

                    $stmt = "UPDATE users SET blurb=:blurb WHERE id=:id";
                    $result = $db->execute($stmt, [":blurb" => $blurb, ":id" => $user->getUserId()]);
                    if (!$result) {
                        $this->postData["validator"] = 4;
                    }
                }
                if (!isset($this->postData["validator"])) {
                    exit(header("Location: /My/Profile.aspx"));
                }
                break;
            case "Cancel":
                header("Location: /My/Profile.aspx");
                exit;
                break;
            case "ChangePassword":
                header("Location: /Login/ResetPassword.aspx");
                exit;
                break;
            case "CSettings":
                header("Location: /My/CustomSettings.aspx");
                exit;
                break;
            case "VerifyEmail":
                Discord::sendOAuth();
                break;
        }
    }

    public function load() { # BRB 
        $emails = $this->randomEmails;
        $variables = compact("emails");

        PageBuilder::addComponent("editprofile", "main", $variables);
    }
}
?>