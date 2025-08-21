<?php
class ShoutboxManager {
    public function __construct() {
        if (!empty($_POST)) {
            if ($_POST["__EVENTTARGET"] == 'ctl00$cphRoblox$gvShoutbox' && $_POST["__EVENTARGUMENT"] == 'Post' && isset($_POST['ctl00$cphRoblox$gvShoutboxInput'])) {
                $postedText = $_POST['ctl00$cphRoblox$gvShoutboxInput'];
                if (!empty(trim($postedText))) {
                    global $db, $user;
                    $stmt = "INSERT INTO shoutbox (`user`, `text`) VALUES (:username, :postedText)";
                    $db->execute($stmt, [
                        ":username" => $user->getUsername(),
                        ":postedText" => $postedText,
                    ]);
                    
                    header("Location: " . $_SERVER['PHP_SELF']);
                }
            }
        }
    }
    public function load() {
        global $db;
        $stmt = "SELECT * FROM shoutbox ORDER BY `shoutId` DESC";
        $result = $db->execute($stmt);
        $shouts = [];

        if ($result->rowCount() > 0) {
            $shouts = $result->fetchAll(PDO::FETCH_ASSOC);
        }

        $packed = compact("shouts");
        PageBuilder::addComponent("shoutbox", "main", $packed);
    }
}
?>