<?php
class ResetPasswordRequest {
    private $reminders = [];
    private $guid;
    public function __construct($post) {
        $this->guid = Helper::guid();
        $this->handle($post);
    }
    public function handle($post) {
        if (!empty($_POST)) {
            if (isset($_POST["__EVENTARGUMENT"]) && !empty($_POST["__EVENTARGUMENT"])) {
                if (str_contains($_POST["__EVENTARGUMENT"], "$")) {
                    $postData = $_POST["__EVENTARGUMENT"];
                    $decryptedPostData = explode("$", $postData);
                    switch ($decryptedPostData[0]) {
                        case "ct100":
                            # Reset Password
                            $this->resetPassword($_POST["username"]);
                            break;
                        case "ct101":
                            # Remind Usernames
                            $this->remindUsernames($_POST["discordid"]);
                            break;
                    }
                }
            }
        }
    }
    public function resetPassword($username) {
        global $db;
        $stmt = "SELECT * FROM users WHERE `username`=:username";
        $result = $db->execute($stmt, [":username" => htmlspecialchars($username)]);
        if ($result->rowCount() > 0) {
            $result = $result->fetch(PDO::FETCH_ASSOC);
            $email = $result["email"];
            $userId = $db->getIdByUser(htmlspecialchars($username));
            $stmt = "SELECT * FROM tickets WHERE userId=:userId AND active=1 AND ticketType='passwordReset'";
            $result = $db->execute($stmt, [":userId" => $userId]);
            $result2 = $result->fetch(PDO::FETCH_ASSOC);
            if ($result->rowCount() == 0) {
                $stmt = "INSERT INTO tickets (userid, ticketType, ticketHash, active) VALUES (:userId, :ticketType, :ticketHash, :active)";
                $guid = strtoupper(Helper::guid());
                $result = $db->execute($stmt, [":userId" => $userId, ":ticketType" => "passwordReset", ":ticketHash" => $this->guid, ":active" => 1]);
                if ($result) {
                    $date = new DateTime();
                    $content = [
                        "content" => null,
                        "embeds" => [
                            [
                                "title" => "Boomblox Account Password Reset", #https://www.youtube.com/watch?v=8L2AHsO3Hd0
                                "description" => "Boomblox#6728\n**Date:** ".$date->format('D, M j Y H:i:s T')."\n----------------------------------------------------\n\nWe have received a request to reset the password for your ".htmlspecialchars($username)." Boomblox account. If you submitted this request, please click the link below or paste it into a web browser to proceed. If you do not wish to reset your password, please disregard this notice.\n\nhttps://".domain."/Login/ResetPassword.aspx?Ticket=".$this->guid,
                                "color" => 6308237
                            ]
                        ]
                    ];
                    Discord::sendMessage((int)$email,$content);
                    array_push($this->reminders, "A message has been sent to your discord account!");
                }
            } else {
                $result = $result2;
                $timestamp = $result["issued"];
                $timestamp = new DateTime($timestamp);
                $timeSince = Helper::bTimeAgo($timestamp);
                if ($timeSince < 7) {
                    $timeSince == 0 && $stringTime = "the same day.";
                    $timeSince == 1 && $stringTime = "a day".
                    $timeSince > 1 && $stringTime = $timeSince." days";
                    array_push($this->reminders, "A password reset ticket has already been filed within ".$stringTime);
                }
            }
        }
    }
    public function remindUsernames($email) {
        global $db;
        $stmt = "SELECT * FROM users WHERE `email`=:email";
        $result = $db->execute($stmt, [":email" => (int)$email]);
        if ($result->rowCount() > 0) {
            $result = $result->fetch(PDO::FETCH_ASSOC);
            array_push($this->reminders, $result["username"]);
        } else {
            array_push($this->reminders, "No usernames were found for ID ".(int)$email);
        }
    }
    public function getReminders() {
        $output = '';
        foreach ($this->reminders as $reminder) {
            $output .= $reminder."<br>";
        }
        return $output;
    }
    public function load() {
        echo '
        <div id="Body">
            <h2> Forgot your username or password?</h2>
            <p>We can send you an email to remind you of your usernames or reset your password. Please enter your username or email and click one of the links below.</p>
            <p style="color:red;">If you did not give us a real email address when you created your account, we cannot send you an email.</p>
            <label>Username:</label>
            <input name="username"><br>
            <div style="padding:10px">
                <a href="javascript:__doPostBack(\'\',\'ct100$rbx$ResetPassword\')">Reset Password</a><br>
            </div>
            <label>Discord ID:</label>
            <input name="discordid"><br>
            <div style="padding:10px">
                <a href="javascript:__doPostBack(\'\',\'ct101$rbx$ResetPassword\')">Usernames Reminder</a>
                <p>'.$this->getReminders().'</p>
            </div>
        </div>
        '; # Usernames Reminder will query the database for all usernames matching the given discord id (may be done thru oauth to prevent user spotting for pging
        # Reset Password will simply send a discord message and show something on the page to check your discord, in your discord you will find a link with a specific ticket to reset the password
    }
}
?>