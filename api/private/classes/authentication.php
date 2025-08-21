<?php
class Authentication {
    public function isAuthed() {
        $this->isMaintenance();
        /*if (isset($_SESSION["id"])) {
            $user = new User((int)$_SESSION["id"]);
            Economy::issueDaily($user);
            $stmt = "UPDATE users SET `lastOnline` = :lastOnline WHERE `id`=:id";
            $this->db->execute($stmt,[":lastOnline" => date("Y-m-d H:i:s"), ":id" => (int)$_SESSION["id"]]);
            return true;
        }*/
        if (isset($_COOKIE["BROBLOSECURITY"])) {
            $roblosecurity = $_COOKIE["BROBLOSECURITY"];
            if (ROBLOSECURITY::match($roblosecurity)) {
                global $db;
                $userId = ROBLOSECURITY::match($roblosecurity);
                $user = new User($userId);
                Economy::issueDaily($user);
                if ($user->isPunished()) {if (basename($_SERVER['PHP_SELF']) !== "NotApproved.php") {header("Location: /NotApproved.aspx");}}
                $stmt = "UPDATE users SET `lastOnline` = :lastOnline WHERE `id`=:id";
                $db->execute($stmt,[":lastOnline" => date("Y-m-d H:i:s"), ":id" => ROBLOSECURITY::match($roblosecurity)]);
                #return true;
                return true;
            }
            return false;
        }
        return false;
    }
    public function hasPerms($permissionLevel) {
        if (isset($_COOKIE["BROBLOSECURITY"])) { 
            $user = new User(ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]));
            return $user->getData("user","level") >= $permissionLevel;
        } else {
            return false;
        }
    }
    public function isMaintenance() {
        if (maintenance) {
            if (passwordLocked) {
                #if (!isset($_SESSION["unlocked"])) {
                    if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] !== user || $_SERVER['PHP_AUTH_PW'] !== password) {
                        header('HTTP/1.1 401 Unauthorized');
                        header('WWW-Authenticate: Basic realm="Restricted Area"');
                    } else {
                        #$_SESSION["unlocked"] = true;
                    }
                #}
            } else {
                if (isset($_COOKIE["BROBLOSECURITY"])) {
                    $user = new User(ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]));
                    if (basename($_SERVER['PHP_SELF']) !== "Maintenance.php" && !$user->hasPerms(3)) {
                        header("Location: /Maintenance.aspx");
                    }
                } elseif (basename($_SERVER['PHP_SELF']) !== "Maintenance.php") {
                    header("Location: /Maintenance.aspx");
                }
                
            }
        }
    }
    public function logout() {
        ROBLOSECURITY::detach(ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]), true);
    }
    public function login($userId) {
        global $db;
        ROBLOSECURITY::set($userId);
        $stmt = "UPDATE users SET lastOnline = :lastOnline WHERE id=:id";
        $db->execute($stmt,[":lastOnline" => date("Y-m-d H:i:s"), ":id" => (int)$userId]);
    }
}
?>