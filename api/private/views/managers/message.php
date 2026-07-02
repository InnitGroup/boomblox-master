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
        global $db, $user;
        $userId = $user->getUserId();
        $recipientId = $_GET["RecipientID"];

        $this->recipient = [
            "userId" => $recipientId,
            "username" => $db->getUserById($recipientId)
        ];

                    
        if (!$db->userExists($recipientId)) {
            Server::_404();
            #echo 2;
        }

        if ($user->timeSinceLastMessage() < 5) {
            Server::_404();
        }

        if ($recipientId == 65) {
            $totalMessage = "{$user->getUsername()} sent a message titled {$messageData[0]} with the following content: {$messageData[1]}";
            $totalMessage = str_replace("@", "#", $totalMessage);
            Discord::sendWebhookMessage("visor", $totalMessage);
        }

        # secret 
        if (($messageData[0] == "nos numquam ad sinistram" || $messageData[1] == "nos numquam ad sinistram") && $recipientId !== 3 && $recipientId !== 65) {
            $recipient = new User($recipientId);
            if ($user->hasItem(56) && !$recipient->hasItem(56)) {
                $stmt = "SELECT COUNT(*) AS messagesSent FROM messages WHERE senderId=:senderId AND recipientId=:recipientId AND `content`=:phrase";
                $result = $db->execute($stmt, [
                    ":senderId" => $userId,
                    ":recipientId" => $recipientId,
                    ":phrase" => "nos numquam ad sinistram"
                ]);

                $messagesSent = $result->fetch(PDO::FETCH_ASSOC)["messagesSent"];

                if ($messagesSent == 0) {
                    $user->giveTix(2);
                }
            }
        }

        $stmt = "INSERT INTO messages (`senderId`, `senderUn`, `recipientId`, `subject`, `content`, `friendInvite`, `inviteActive`, `date`) VALUES (:userId, :username, :recipientId, :subject, :content, 0, 0, :xdate)";
        $db->execute($stmt, [
            ":userId" => $userId,
            ":username" => $db->getUserById($userId),
            ":recipientId" => $recipientId,
            ":subject" => $messageData[0],
            ":content" => $messageData[1],
            ":xdate" => date("Y-m-d H:i:s A")
        ]);

        $this->page = "sent";
    }

    public function reply() {
        global $db, $user;
        if ($user->timeSinceLastMessage() < 5) {
            Server::_404();
        }
        
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

        $stmt = "INSERT INTO messages (`senderId`, `senderUn`, `recipientId`, `subject`, `content`, `friendInvite`, `inviteActive`, `date`) VALUES (:userId, :username, :recipientId, :subject, :content, 0, 0, :xdate)";
        $db->execute($stmt, [
            ":userId" => $userId,
            ":username" => $user->getUsername(),
            ":recipientId" => $recipientId,
            ":subject" => $subject,
            ":content" => $content,
            ":xdate" => date("Y-m-d H:i:s A")
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
        
        exit(header("Location: /My/Inbox.aspx"));
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