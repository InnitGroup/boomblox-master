<?php
class AbuseManager {
    public function __construct() {
        if (Server::isPost()) {
            if (isset($_POST['__EVENTARGUMENT']) && isset($_POST['ct100$Comment$TextBox'])) {
                switch ($_POST['__EVENTARGUMENT']) {
                    case 'rbx$ct100Report$UserProfile':
                        $this->handleReport("user", $_GET["userID"]);
                        break;
                    case 'rbx$ct100Report$Asset':
                        $this->handleReport("asset", $_GET["ID"]);
                        break;
                }
            }
        }
    }
    public function handleReport($abuseType, $abuseId) {
        global $db, $user;
        $stmt = "INSERT INTO reports (`type`, `abuse`, `comment`, `reportedBy`) VALUES (:abuseType, :abuseId, :comment, :reportedBy)";
        $comment = $_POST['ct100$Comment$TextBox'];
        $reportedBy = $user->getUserId();

        if (empty(trim($comment))) {$comment = "No user comment available.";}
        if ($db->execute($stmt, [":abuseType" => $abuseType, ":abuseId" => $abuseId, ":comment" => $comment, ":reportedBy" => $reportedBy])) {
            switch ($abuseType) {
                case "user":
                    header("Location: /User.aspx?ID=$abuseId");
                    break;
                case "asset":
                    header("Location: /Item.aspx?ID=$abuseId");
                    break;
                default:
                    Server::_404();
                    break;
            }
        }
    }
}
?>