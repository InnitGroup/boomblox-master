<?php
class Registration {
    public array $presets = [
        "Ryxo",
        "DEMOblock",
        "Talen14",
        "cendrena",
        "idomino",
        "seeeeth",
        "planeboys12",
        "unseenunheard",
        "Alacazar"
    ];

    private array $usernameError = [
        "This username is already taken!",
        "This username is in use by somebody else."
    ];

    public function handle() {
        global $db;
        #username validators: This username is already taken!Try x instead!
        if (empty($_POST["Username"]) && !isset($error)) {
            $error = array("error" => "Username field cannot be empty.", "focus" => "EnterUsername");
        }
        if ($db->usernameTaken($_POST["Username"]) && !isset($error)) {
            $error = array("error" => $this->usernameError[array_rand($this->usernameError)], "focus" => "EnterUsername");
        }
        if (!Helper::validUsername($_POST["Username"]) && !isset($error)) {
            $error = array("error" => "Username may only contain A-Z, a-z, and 0-9.", "focus" => "EnterUsername");
        }
        if (strlen($_POST["Username"]) < 3 && !isset($error)) {
            $error = array("error" => "Username is too short, 3-20 characters only.", "focus" => "EnterUsername");
        }
        if (strlen($_POST["Username"]) > 20 && !isset($error)) {
            $error = array("error" => "Username is too long, 3-20 characters only.", "focus" => "EnterUsername");
        }
        #password validators: This password cannot be used
        if (empty($_POST["Password"]) && !isset($error)) {
            $error = array("error" => "Password field cannot be empty.", "focus" => "EnterPassword");
        }
        if ($_POST["Password"] == "password" && !isset($error)) {
            $error = array("error" => "This password cannot be used.", "focus" => "EnterPassword");
        }
        if (Helper::contains($_POST["Password"],[" "]) && !isset($error)) {
            $error = array("error" => "Password cannot contain spaces.", "focus" => "EnterPassword");
        }
        if (strlen($_POST["Password"]) < 4 && !isset($error)) {
            $error = array("error" => "Password is too short, at least 4 characters minimum.", "focus" => "EnterPassword");
        }
        if (empty($_POST["PasswordConfirm"]) && !isset($error)) {
            $error = array("error" => "Please confirm your password.", "focus" => "EnterPassword");
        }
        if ($_POST["Password"] !== $_POST["PasswordConfirm"] && !isset($error)) {
            $error = array("error" => "The two passwords entered do not match.", "focus" => "EnterPassword");
        }
        if ($db->keyTaken($_POST["Key"]) && !isset($error)) {
            $error = array("error" => "The key you have entered is invalid.", "focus" => "EnterKey");
        }

        if (isset($error)) {
            return json_encode($error);
        }

        $db->createUser($_POST["Username"],$_POST["Password"],$_POST["Key"]);
        $id = $db->getIdByUser($_POST["Username"]);
        ROBLOSECURITY::new($id);
        IP::whitelist($id);

        $newUser = new User($id);
        $message = [
            "senderId" => 1,
            "senderUn" => "Boomblox",
            "subject" => "Welcome to Boomblox",
            "content" => "Hello, new Boombloxian!!

Welcome to Boomblox! We are constantly working to make Boomblox a fun, safe, and creative place for everyone. We update Boomblox frequently, so be sure to visit our NEWS section to learn about new exciting updates. If you have questions about how something works, our HELP section is a great place to start. Finally, the FORUM is a where you can find other people and make friends. Be sure to read the Community Guidelines as well, so you know how best to get along with people on Boomblox! http://wiki.roblox.com/index.php?title=Community_Guidelines

Have a great time here!",
            "recipientId" => $id
        ];

        $newUser->sendMessage($message);
        $newUser->givePlace();

        if (in_array($_POST["Username"], $this->presets)) {
            $newUser->giveBux(100);
            $message = [
                "senderId" => 1,
                "senderUn" => "Boomblox",
                "subject" => "Welcome to Boomblox",
                "content" => "Hello, {$newUser->getUsername()}, you have been awarded B$ 100 for choosing a preset username, thank you for building site accuracy within the population!",
                "recipientId" => $id
            ];

            $newUser->sendMessage($message);
        }

        return true;
    }
    public function error($json, $focus) {
        $focus == $json->focus && print $json->error ?? "";
    }
}
?>