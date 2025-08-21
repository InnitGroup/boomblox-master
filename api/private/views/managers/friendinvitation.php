<?php

class FriendInvitationManager {
    private array $invitation;
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

                case 'ctl00$cphRoblox$lbAccept':
                    global $user;
                    $invitationData = $this->getInvitationData($_GET["InvitationID"]);
                    $sender = new User($invitationData["senderId"]);
                    $recipient = $user;
                    $recipientUn = $recipient->getUsername();

                    $sender->addFriend($recipientUn);
                    $recipient->addFriend($sender->getUsername());

                    $message = [
                        "senderId" => 1,
                        "senderUn" => "ROBLOX [System Message]",
                        "subject" => "Friend Request: Accepted",
                        "content" => $recipientUn . " has accepted your friend request.",
                        "recipientId" => $sender->getUserId()
                    ];

                    $sender->sendMessage($message);

                    $this->deactivateInvitation($invitationData);
                    return header("Location: /User.aspx");
                    break;

                case 'ctl00$cphRoblox$lbDecline':
                    $invitationData = $this->getInvitationData($_GET["InvitationID"]);
                    $sender = new User($invitationData["senderId"]);
                    $recipient = new User(ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]));
                    $recipientUn = $recipient->getUsername();

                    $message = [
                        "senderId" => 1,
                        "senderUn" => "ROBLOX [System Message]",
                        "subject" => "Friend Request: Declined",
                        "content" => $recipientUn . " has declined your friend request.",
                        "recipientId" => $sender->getUserId()
                    ];
                    $sender->sendMessage($message);

                    $this->deactivateInvitation($invitationData);
                    return header("Location: /User.aspx");
                    break;

                case 'ctl00$cphRoblox$lbCancel':
                    header("Location: /User.aspx");
                    break;

                default:
                    break;
            }
        }

        if (isset($_GET["RecipientID"])) {
            return $this->handleWrite();
        } elseif (isset($_GET["InvitationID"])) {
            return $this->handleInvitation();
        } else {
            Server::_404();
            #echo 1;
        }
    }

    public function send($messageData) {
        global $db;
        $userId = ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]);
        $recipientId = $_GET["RecipientID"];

        if ($userId == $recipientId) {
            return Server::_404();
        }

        $this->recipient = [
            "userId" => $recipientId,
            "username" => $db->getUserById($recipientId)
        ];

        if (!$db->userExists($recipientId)) {
            return Server::_404();
        }

        if ($this->alreadyInvited($recipientId)) {
            return $this->page = "alreadyexists";
        }

        $stmt = "INSERT INTO messages (`senderId`, `senderUn`, `recipientId`, `subject`, `content`, `friendInvite`, `inviteActive`) VALUES (:userId, :username, :recipientId, :subject, :content, 1, 1)";
        $db->execute($stmt, [
            ":userId" => $userId,
            ":username" => $db->getUserById($userId),
            ":recipientId" => $recipientId,
            ":subject" => $messageData[0],
            ":content" => $messageData[1]
        ]);

        $this->page = "sent";
    }

    public function deactivateInvitation($invitation) {
        global $db;

        $stmt = "UPDATE messages SET inviteActive=0 WHERE messageId=:invitationId";
        return $db->execute($stmt, [":invitationId" => $invitation["messageId"]]);
    }

    public function handleInvitation() {
        global $db;
        $invitationId = (int)$_GET["InvitationID"];

        if (!$this->invitationExists($invitationId)) {
            Server::_404();
            #echo 3;
        }

        $this->invitation = [
            "type" => "Read",
            "invitationData" => $this->getInvitationData($invitationId),
        ];

        $this->page = "read";
    }

    public function invitationExists($invitationId) {
        global $db;
        $stmt = "SELECT * FROM messages WHERE messageId=:messageId AND inviteActive=1";
        $result = $db->execute($stmt, [":messageId" => $invitationId]);
        
        return $result->rowCount() == 1;
    }

    public function alreadyInvited($userInvited) {
        global $db;
        $userId = ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]);

        $stmt = "SELECT * FROM messages WHERE recipientId=:userInvited AND senderId=:senderId AND inviteActive=1";
        $result = $db->execute($stmt, [":userInvited" => $userInvited, ":senderId" => $userId]);

        return $result->rowCount() >= 1;
    }

    public function getInvitationData($invitationId) {
        global $db;
        
        if (!$this->invitationExists($invitationId)) {
            Server::_404();
            #echo 4;
        }

        $stmt = "SELECT * FROM messages WHERE messageId=:messageId AND friendInvite=1";
        $result = $db->execute($stmt, [":messageId" => $invitationId]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function handleWrite() {
        global $db;
        $recipientId = (int)$_GET["RecipientID"];
        $sender = new User(ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]));
        $recipient = new User($recipientId);

        if (!$db->userExists($recipientId)) {
            Server::_404();
            #echo 5;
        }

        $this->invitation = [
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
            case "alreadyexists":
                $user = $this->recipient;
                $variable = "user";
                break;
            default:
                $invitation = $this->invitation;
                $variable = "invitation";
                break;
        }

        return PageBuilder::addComponent("friendinvitation", $this->page, compact($variable));
    }
}

?>