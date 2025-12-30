<?php
# general database class
class Database {
    # database personal info
    private $host = '127.0.0.1';
    private $dbname = 'boomdb';
    private $dbuser = 'root';
    private $dbpassword = '$W-m%bSA9gg9';

    # current instance of the database
    protected $current;

    # main constructor
    public function __construct() {
        if ($this->current == NULL) {
            $this->current = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->dbuser,$this->dbpassword);
            $this->current->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
    }

    # execute macro to ensure statements are always prepared
    public function execute($sql,$args = []) {
        $stmt = $this->current->prepare($sql);
        if ($stmt->execute($args)) {
            return $stmt;
        }

        print_r($sql);
        print_r($args);
    }

    # returns database name
    public static function getName() {
        return "boomdb";
    }

    # returns database password
    public static function getPassword() {
        return base64_decode('JFctbSViU0E5Z2c5');
    }

    # checks if a username is taken in the user table
    public function usernameTaken($username) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $result = $this->execute($sql,[":username" => htmlspecialchars($username)]);
        return $result->rowCount() > 0;
    }

    # checks if an email is taken in the user table
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

    # checks if a given key is in use
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

    # creates a new user
    public function createUser($username, $password, $key) {
        if (!$this->keyTaken($key)) {
            $torsoColors = [1, 37, 21, 194, 141];
            $joincode = bin2hex(random_bytes(16));

            $sql = "INSERT INTO users (username, password, torsoColor, joincode) VALUES (:username, :password, :torsoColor, :joincode)";
            $this->execute($sql, [
                ":username" => $username, 
                ":password" => password_hash($password, PASSWORD_BCRYPT), 
                ":torsoColor" => $torsoColors[rand(0,4)],
                ":joincode" => $joincode,
            ]);

            $sql = "UPDATE `keys` SET `status`=0, `recipient`=:recipient WHERE `keyC`=:keyC";
            $key = substr($key, 9);
            $this->execute($sql, [":keyC" => (int)$key, ":recipient" => $this->getLastUserId()]);
        }
    }

    # gets the last user id to be created
    public function getLastUserId() {
        $sql = "SELECT `id` FROM users ORDER BY `id` DESC LIMIT 1";
        $result = $this->execute($sql);
        $fetched = $result->fetch(PDO::FETCH_ASSOC);
        
        return $fetched["id"];
    }

    # gets the user id of a user by their username
    public function getIdByUser($username) {
        $sql = "SELECT * FROM users WHERE username=:username";
        $result = $this->execute($sql,[":username" => $username]);
        if ($result->rowCount() > 0) {
            $fetched = $result->fetch(PDO::FETCH_ASSOC);
            return $fetched["id"];
        }
    }

    # gets the username of a user by their user id
    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id=:id";
        $result = $this->execute($sql,[":id" => $id]);
        $fetched = $result->fetch(PDO::FETCH_ASSOC);
        return $fetched["username"];
    }

    # returns all users
    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $result = $this->execute($sql);
        return $result;
    }

    # returns all users
    public function getAllUsersThisMonth() {
        $sql = "SELECT * FROM users WHERE `lastOnline` >= DATE_FORMAT(NOW() ,'%Y-%m-01')";
        $result = $this->execute($sql);
        return $result;
    }

    # checks if a user exists by their user id
    public function userExists($userId) {
        $sql = "SELECT * FROM users WHERE id=:id";
        $result = $this->execute($sql, [":id" => $userId]);
        return (bool)$result->rowCount() > 0;
    }

    # gets a static instance of the database
    public function singleton() {
        return $this->current;
    }

    # gets the primary key of a table
    public function getPrimaryKey($table) {
        $stmt = "SHOW KEYS FROM `$table` WHERE Key_name = 'PRIMARY'";
        $result = $this->execute($stmt);
        $fetched = $result->fetch(PDO::FETCH_ASSOC);
        $primaryKey = $fetched['Column_name'];

        return $primaryKey;
    }

    # gets the id of the last inserted object of a table
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