<?php
# general authentication management and data handling
class Authentication {

    # checks if the current visitor on-site is authenticated
    public function isAuthed() {
        $this->isMaintenance();

        if (isset($_COOKIE["BROBLOSECURITY"])) {
            $roblosecurity = $_COOKIE["BROBLOSECURITY"];
            if (ROBLOSECURITY::match($roblosecurity)) {
                global $db;
                $userId = ROBLOSECURITY::match($roblosecurity);
                $user = new User($userId);

                Economy::issueDaily($user);
                if ($user->isPunished()) {if (basename($_SERVER['PHP_SELF']) !== "NotApproved.php") {header("Location: /NotApproved.aspx"); exit;}}

                $stmt = "UPDATE users SET `lastOnline` = :lastOnline WHERE `id`=:id";
                $db->execute($stmt,[":lastOnline" => date("Y-m-d H:i:s"), ":id" => ROBLOSECURITY::match($roblosecurity)]);
                return true;
            }
            return false;
        }
        return false;
    }

    # checks if a user has a specific permission level
    public function hasPerms($permissionLevel) {
        if (isset($_COOKIE["BROBLOSECURITY"])) { 
            $user = new User(ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]));
            return $user->getData("user","level") >= $permissionLevel;
        }

        return false;
    }

    # checks if the site is on maintenance
    public function isMaintenance() {
        if (maintenance) {
            if (passwordLocked) {
                if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] !== user || $_SERVER['PHP_AUTH_PW'] !== password) {
                    header('HTTP/1.1 401 Unauthorized');
                    header('WWW-Authenticate: Basic realm="Restricted Area"');
                    exit;
                }
            } else {
                if (isset($_COOKIE["BROBLOSECURITY"])) {
                    $user = new User(ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]));
                    if (basename($_SERVER['PHP_SELF']) !== "Maintenance.php" && !$user->hasPerms(3)) {
                        header("Location: /Maintenance.aspx");
                        exit;
                    }
                } elseif (basename($_SERVER['PHP_SELF']) !== "Maintenance.php" && Server::getIP() !== Server::getServerIP()) {
                    header("Location: /Maintenance.aspx");
                    exit;
                }
            }
        }
    }

    # logs the user out of the current authenticated session
    public function logout() {
        ROBLOSECURITY::detach(ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]), true);
    }

    # logs the user into a new authenticated session
    public function login($userId) {
        global $db;
        ROBLOSECURITY::set($userId);
        IP::whitelist($userId);
        $stmt = "UPDATE users SET lastOnline = :lastOnline WHERE id=:id";
        $db->execute($stmt,[":lastOnline" => date("Y-m-d H:i:s"), ":id" => (int)$userId]);
    }
}
?>