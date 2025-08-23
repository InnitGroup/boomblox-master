<?php
class ResetPassword {
    private $get;
    private $isTicketed;
    private $ticket;
    private $errors = array("");
    private $mentions = array("");
    public function __construct($post, $get) {
        $this->get = $get;
        $this->isTicketed = isset($this->get["Ticket"]) && !empty($this->get["Ticket"]);
        if ($this->isTicketed) {
            $this->ticket = new Ticket($this->get["Ticket"]);
            if (!$this->ticket->isActive() or !$this->ticket->isRecent()) {
                $this->errors = ["Ticket expired/inactive"];
            }
        }
        $this->handle($post);
    }
    public function handle($post) {
        if (Server::isPost()) {
            if (!empty($post)) {
                if (empty($post['ctl00$cphRoblox$UserName']) && !$this->isTicketed) {
                    $this->errors = ["Please enter a username."];
                }
                if ($this->isTicketed) {
                    if (!$this->ticket->isActive() or !$this->ticket->isRecent()) {
                        $this->errors = ["Ticket expired/inactive"];
                        return false;
                    }
                    if (!empty($post['ctl00$cphRoblox$Password']) && !empty($post['ctl00$cphRoblox$ConfirmPassword'])) {
                        $password = $post['ctl00$cphRoblox$Password'];
                        $confirmed = $post['ctl00$cphRoblox$ConfirmPassword'];
                        if ($password == $confirmed) {
                            if (strlen($password) >= 4) {
                                $user = $this->ticket->getUser(true);
                                if ($user->changePassword($password)) {
                                    $this->mentions = ["Your password has successfully been changed."];
                                    if ($user->getData("user","email") !== NULL) {
                                        $discordId = (int)$user->getData("user","email");
                                        $date = new DateTime();
                                        $content = [
                                            "content" => null,
                                            "embeds" => [
                                                [
                                                    "title" => "Boomblox Account Password has been reset", #https://www.youtube.com/watch?v=8L2AHsO3Hd0
                                                    "description" => "Boomblox#6728\n**Date:** ".$date->format('D, M j Y H:i:s T')."\n----------------------------------------------------\n\nYour password has successfully been reset on your ".$user->getData("user","username")." Boomblox account!",
                                                    "color" => 6308237
                                                ]
                                            ]
                                        ];
                                        Discord::sendMessage($discordId,$content);
                                    }
                                    $this->ticket->deactivate();
                                }
                            } else {
                                $this->errors = ["Your password must be at least 4 characters."]; 
                            }
                        } else {
                            $this->errors = ["Your passwords must match."]; 
                        }
                    } else {
                        $this->errors = ["Please fill out each password box."];
                    }
                } else {
                    #
                }
            } else {
                $this->errors = ["Internal form error."];
            }
        }
    }
    public function loadUsername() {
        if ($this->isTicketed) {
            if ($this->ticket->getInfo()) {
                $user = $this->ticket->getUser(true);
                $username = $user->getData("user", "username");
                return '<p style="text-align:left;"> Username: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="ctl00$cphRoblox$UserName" disabled type="text" value="'.$username.'" id="ctl00_cphRoblox_UserName" /></p>';
            }
        } else {
            return '<p style="text-align:left;"> Username: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="ctl00$cphRoblox$UserName" type="text" id="ctl00_cphRoblox_UserName" /></p>';
        }
    }
    public function loadErrors() {
        return '<p style="color:red;">'.$this->errors[0].'</p>';
    }
    public function loadMentions() {
        return '<p style="color:green;">'.$this->mentions[0].'</p>';
    }
    public function load() {
        echo '
             <div id="Body">
                <h3>Reset Password</h3>
                '.$this->loadErrors().'
                '.$this->loadMentions().'
                '.$this->loadUsername().'
                <p>
                <p style="text-align:left;"> Password: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="ctl00$cphRoblox$Password" type="password" autocomplete="new-password" id="ctl00_cphRoblox_UserName" />
                </p>
                <p>
                <p> Confirm Password: &nbsp;&nbsp;&nbsp;&nbsp; <input name="ctl00$cphRoblox$ConfirmPassword" type="password" autocomplete="new-password" id="ctl00_cphRoblox_UserName" />
                </p>
                <p>
                <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input id="SetPassword" name="spw" type="submit" value="Set Password" class="Button" />
            </div>
        ';
    }
}
?>