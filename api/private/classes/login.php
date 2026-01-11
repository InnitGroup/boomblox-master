<?php
class Login {
    public function validateLogin($username, $password) {
        global $db;
        $sql = "SELECT `password` FROM users WHERE username=:username";
        $stmt = $db->execute($sql,[":username" => htmlspecialchars($username)]);
        $fetched = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
            return password_verify($password, $fetched["password"]);
        }
    }

    public function login($username) {
        global $auth, $db;
        $user = new User($db->getIdByUser($username));
        if ($user->hasPerms(3) && Setting::disabled("LoginEnabled")) {
            $auth->login($db->getIdByUser(($username)));
        }
        if (Setting::enabled("LoginEnabled")) {
            $auth->login($db->getIdByUser(($username)));
        }
    }
}
?>