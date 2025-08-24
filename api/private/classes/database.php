<?php
#made: 01/04/2025 @marsoc
#last edit: 01/09/2025 @marsoc: usernameTaken and keyTaken functions to simplify queries

class Database {
    private $host = '127.0.0.1';
    private $dbname = 'boomdb';
    private $dbuser = 'root';
    private $dbpassword = '$W-m%bSA9gg9';
    protected $current;

    public function __construct() {
        if ($this->current == NULL) {
            $this->current = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->dbuser,$this->dbpassword);
            $this->current->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        #echo "Connected"; # Debugging purposes
    }

    public function execute($sql,$args = []) {
        $stmt = $this->current->prepare($sql);
        if ($stmt->execute($args)) {
            return $stmt;
        } else {
            print_r($sql);
            print_r($args);
        }
    }

    public static function getName() {
        return "boomdb";
    }

    public static function getPassword() {
        return base64_decode('JFctbSViU0E5Z2c5');
    }

    public function usernameTaken($username) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $result = $this->execute($sql,[":username" => htmlspecialchars($username)]);
        return $result->rowCount() > 0;
    }
    public function emailTaken($user, $email) {
        $stmt = "SELECT * FROM users WHERE email=:email";
        $result = $this->execute($stmt, [":email" => htmlspecialchars($email)]);
        if ($result->rowCount() > 0) {
            $result = $result->fetch(PDO::FETCH_ASSOC);
            if ($result["id"] !== $user) {
                return true;
            }
        }
        return false;
    }
    public function keyTaken($key) {
        $key = substr($key,9);
        if ($key !== "") {
            $sql = "SELECT * FROM `keys` WHERE `keyC` = :keyC";
            $result = $this->execute($sql,[":keyC" => $key]);
            $fetched = $result->fetch(PDO::FETCH_ASSOC);
            return $result->rowCount() == 0 ?? $fetched->status == 0;
        } else {
            return 1;
        }
    }

    public function createUser($username, $password, $key) {
        if (!$this->keyTaken($key)) {
            $torsoColors = [1, 37, 21, 194, 141];
            $sql = "INSERT INTO users (username, password, torsoColor) VALUES (:username, :password, :torsoColor)";
            $this->execute($sql,[":username" => $username, ":password" => password_hash($password, PASSWORD_BCRYPT), ":torsoColor" => $torsoColors[rand(0,4)]]);
            $sql = "UPDATE `keys` SET `status`=0 WHERE `keyC`=:keyC";
            $key = substr($key, 9);
            $this->execute($sql, [":keyC" => (int)$key]);
            $sql = "UPDATE `keys` SET `recipient`=:recipient WHERE `keyC`=:keyC";
            $this->execute($sql, [":recipient" => $this->getLastUserId(), ":keyC" => $key]);
        }
    }
    public function getLastUserId() {
        $sql = "SELECT `id` FROM users ORDER BY `id` DESC LIMIT 1";
        $result = $this->execute($sql);
        $fetched = $result->fetch(PDO::FETCH_ASSOC);
        return $fetched["id"];
    }
    public function getIdByUser($username) {
        $sql = "SELECT * FROM users WHERE username=:username";
        $result = $this->execute($sql,[":username" => $username]);
        if ($result->rowCount() > 0) {
            $fetched = $result->fetch(PDO::FETCH_ASSOC);
            return $fetched["id"];
        }
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id=:id";
        $result = $this->execute($sql,[":id" => $id]);
        $fetched = $result->fetch(PDO::FETCH_ASSOC);
        return $fetched["username"];
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $result = $this->execute($sql);
        return $result;
    }

    public function userExists($userId) {
        $sql = "SELECT * FROM users WHERE id=:id";
        $result = $this->execute($sql, [":id" => $userId]);
        return (bool)$result->rowCount() > 0;
    }

    public function singleton() {
        return $this->current;
    }

    public function getPrimaryKey($table) {
        $stmt = "SHOW KEYS FROM `$table` WHERE Key_name = 'PRIMARY'";
        $result = $this->execute($stmt);
        $fetched = $result->fetch(PDO::FETCH_ASSOC);
        $primaryKey = $fetched['Column_name'];

        return $primaryKey;
    }

    public function lastInsertId($table, $where = "") {
        $primaryKey = $this->getPrimaryKey($table);
        $stmt = "SELECT $primaryKey FROM $table";

        if (!empty($where)) {
            $stmt .= " WHERE $where";
        }

        $stmt .= " ORDER BY $primaryKey DESC";
        $result = $this->execute($stmt);

        $fetched = $result->fetch(PDO::FETCH_ASSOC);
        return $fetched[$primaryKey];
    }
}

?>