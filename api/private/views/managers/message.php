<?php

class MessageManager {
    private array $message;
    private string $page;
    private array $recipient;

    public function __construct() {
        $this->setup();
    }

    public function setup() {
        #var_dump($_POST);
        if (isset($_POST["__EVENTTARGET"]) && !empty($_POST["__EVENTTARGET"])) {
            switch ($_POST["__EVENTTARGET"]) {
                case 'ctl00$cphRoblox$lbSend':
                    $subject = $_POST['ctl00$cphRoblox$rbxMessageEditor$txtSubject'];
                    $content = $_POST['ctl00$cphRoblox$rbxMessageEditor$txtBody'];
                    $message = [
                        $subject,
                        $content
                    ];

                    return $this->send($message);
                    
                case 'ctl00$cphRoblox$lbContinue':
                    if (isset($_POST['__EVENTVALIDATION'])) {
                        $recipientTemplate = explode(":", base64_decode($_POST['__EVENTVALIDATION']));
                        $recipientId = $recipientTemplate[0];

                        header("Location: /User.aspx?ID={$recipientId}");
                    }

                    header("Location: /User.aspx");
                    break;

                case 'ctl00$cphRoblox$lbCancel':
                    header("Location: /User.aspx");
                    break;
                case 'ctl00$cphRoblox$lbReply':
                    return $this->handleReply();
                    case 'ctl00$cphRoblox$lbSubmitReply':
                    return $this->reply();
                case 'ctl00$cphRoblox$lbDelete':
                    return $this->delete();
                default:
                    break;
            }
        }

        if (isset($_GET["RecipientID"])) {
            return $this->handleWrite();
        } elseif (isset($_GET["MessageID"])) {
            return $this->handleMessage();
        } else {
            Server::_404();
        }
    }

    public function send($messageData) {
        global $db;
        $userId = ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]);
        $recipientId = $_GET["RecipientID"];

        $this->recipient = [
            "userId" => $recipientId,
            "username" => $db->getUserById($recipientId)
        ];

        if (!$db->userExists($recipientId)) {
            Server::_404();
            #echo 2;
        }

        $stmt = "INSERT INTO messages (`senderId`, `senderUn`, `recipientId`, `subject`, `content`, `friendInvite`, `inviteActive`) VALUES (:userId, :username, :recipientId, :subject, :content, 0, 0)";
        $db->execute($stmt, [
            ":userId" => $userId,
            ":username" => $db->getUserById($userId),
            ":recipientId" => $recipientId,
            ":subject" => $messageData[0],
            ":content" => $messageData[1]
        ]);

        $this->page = "sent";
    }

    public function reply() {
        global $db, $user;
        $userId = $user->getUserId();
        $messageId = $_GET["MessageID"];
        $messageData = $this->getMessageData($messageId);
        $recipientId = $messageData["senderId"];
        $sender = $messageData["senderUn"];

        $subject = $_POST['ctl00$cphRoblox$rbxMessageEditor$txtSubject'];
        $datetime = new DateTime;
        $date = $datetime->format("m/d/y");
        $time = $datetime->format("H:i A");
        $content = $_POST['ctl00$cphRoblox$rbxMessageEditor$txtBody']; #"------------------------------
        #On $date at $time ".$user->getUsername()." wrote
        #" . $_POST['ctl00$cphRoblox$rbxMessageEditor$txtBody'];
        

        $this->recipient = [
            "userId" => $recipientId,
            "username" => $db->getUserById($recipientId)
        ];

        if (!$db->userExists($recipientId)) {
            Server::_404();
            #echo 2;
        }

        $stmt = "INSERT INTO messages (`senderId`, `senderUn`, `recipientId`, `subject`, `content`, `friendInvite`, `inviteActive`) VALUES (:userId, :username, :recipientId, :subject, :content, 0, 0)";
        $db->execute($stmt, [
            ":userId" => $userId,
            ":username" => $user->getUsername(),
            ":recipientId" => $recipientId,
            ":subject" => $subject,
            ":content" => $content
        ]);

        $this->page = "sent";
    }

    public function delete() {
        global $user, $db;
        $messageId = $_GET["MessageID"];
        if ($message = $this->getMessageData($messageId)) {
            if ($message["recipientId"] === $user->getUserId()) {
                $stmt = "UPDATE messages SET archived=1 AND unread=0 WHERE messageId=:messageId";
                $db->execute($stmt, [
                    ":messageId" => $messageId
                ]);
            }
        }
        header("Location: /My/Inbox.aspx");
    }

    public function handleMessage() {
        global $user, $db;
        $messageId = (int)$_GET["MessageID"];

        if (!$this->messageExists($messageId)) {
            Server::_404();
        }

        $this->message = [
            "type" => "Read",
            "messageData" => $this->getMessageData($messageId),
        ];

        if ($user->getUserId() !== $this->message["messageData"]["recipientId"]) {
            Server::_404();
        }

        if ($this->message["messageData"]["unread"] == 1) {
            $stmt = "UPDATE messages SET unread=0 WHERE messageId=:messageId";
            $db->execute($stmt, [":messageId" => $this->message["messageData"]["messageId"]]);
        }

        $this->page = "read";
    }

    public function handleReply() {
        global $user, $db;
        $messageId = (int)$_GET["MessageID"];

        if (!$this->messageExists($messageId)) {
            Server::_404();
        }

        $this->message = [
            "type" => "Read",
            "messageData" => $this->getMessageData($messageId),
        ];

        if ($user->getUserId() !== $this->message["messageData"]["recipientId"]) {
            Server::_404();
        }

        if ($this->message["messageData"]["unread"] == 1) {
            $stmt = "UPDATE messages SET unread=0 WHERE messageId=:messageId";
            $db->execute($stmt, [":messageId" => $this->message["messageData"]["messageId"]]);
        }

        $this->page = "reply";
    }

    public function messageExists($messageId) {
        global $db;
        $stmt = "SELECT * FROM messages WHERE messageId=:messageId";
        $result = $db->execute($stmt, [":messageId" => $messageId]);
        
        return $result->rowCount() == 1;
    }

    public function getMessageData($messageId) {
        global $db;
        
        if (!$this->messageExists($messageId)) {
            Server::_404();
            #echo 4;
        }

        $stmt = "SELECT * FROM messages WHERE messageId=:messageId";
        $result = $db->execute($stmt, [":messageId" => $messageId]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function handleWrite() {
        global $db, $user;
        $recipientId = (int)$_GET["RecipientID"];
        $sender = $user;
        $recipient = new User($recipientId);

        if (!$db->userExists($recipientId)) {
            Server::_404();
            #echo 5;
        }

        $this->message = [
            "type" => "Write",
            "recipient" => $recipientId,
        ];

        return $this->page = "write";
    }

    public function load() {
        global $db;
        switch ($this->page) {
            case "sent":
                $user = $this->recipient;
                $variable = "user";
                break;
            default:
                $message = $this->message;
                $variable = "message";
                break;
        }

        return PageBuilder::addComponent("message", $this->page, compact($variable));
    }
}

?>