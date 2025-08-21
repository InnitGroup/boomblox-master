<?php
class Registration {
    private $usernameError = array(
        "This username is already taken!",
        "This username is in use by somebody else."
    );
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
        return true;
    }
    public function error($json, $focus) {
        $focus == $json->focus && print $json->error ?? "";
    }
}
?>