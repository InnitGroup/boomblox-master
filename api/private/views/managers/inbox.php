<?php
class InboxManager {
    public function load() {
        global $user;

        $page = 1;
        if (isset($_POST['__EVENTTARGET']) && isset($_POST['__EVENTARGUMENT'])) {
            if ($_POST['__EVENTTARGET'] == 'ctl00$robloxCph$Pagination') {
                $page = $_POST['__EVENTARGUMENT'];
                $exploded = explode('$', $page);
                if (isset($exploded[1])) {
                    $page = $exploded[1];
                }
            }
        }
        $offset = ($page-1)*10;
        
        $messages = $user->getMessages(20, $offset);
        PageBuilder::addComponent("inbox", "main", compact("messages"));
    }

    public function handlePost() {
        if (isset($_POST['__EVENTTARGET'])) {
            switch ($_POST['__EVENTTARGET']) {
                case 'ctl00$robloxCph$Delete':
                    if (isset($_POST['ctl00$robloxCph$SelectMessage'])) {
                        global $user, $db;
                        $messages = $_POST['ctl00$robloxCph$SelectMessage'];
                        foreach ($messages as $message) {
                            $stmt = "SELECT messageId FROM messages WHERE messageId=:messageId AND archived=0 AND recipientId=:recipientId";
                            $result = $db->execute($stmt, [
                                ":messageId" => (int)$message,
                                ":recipientId" => $user->getUserId()
                            ]);
                            
                            if ($result->rowCount() > 0) {
                                $stmt = "UPDATE messages SET archived=1 WHERE messageId=:messageId AND recipientId=:recipientId";
                                $db->execute($stmt, [
                                    ":messageId" => (int)$message,
                                    ":recipientId" => $user->getUserId()
                                ]);
                            }
                        }
                    }
                    break;
            }
        }
    }
}
?>