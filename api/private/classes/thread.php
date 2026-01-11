<?php
class Thread {
    private int $id;
    private int $forumId;
    private int|null $parentPost;

    private bool $isReply;
    private bool $pinned;
    private User $author;
    private array $views;
    
    private string $title;
    private string $content;

    private DateTime $postDate;
    private DateTime $lastActivity;

    public static function threadExists(int $threadId): bool {
        global $db;

        $stmt = "SELECT * FROM threads WHERE postId=:threadId"; # AND isReply=0";
        $result = $db->execute($stmt, [":threadId" => $threadId]);
        return $result->rowCount() > 0;
    }

    public function __construct(int $threadId) {
        global $db;

        $stmt = "SELECT * FROM threads WHERE postId=:threadId";
        $result = $db->execute($stmt, [":threadId" => $threadId]);
        $thread = $result->fetch(PDO::FETCH_ASSOC);

        $this->id = $thread["postId"];
        $this->forumId = $thread["forumId"];
        $this->isReply = (bool)$thread["isReply"];
        $this->parentPost = $thread["parentPost"];
        $this->pinned = (bool)$thread["pinned"];
        $this->author = new User($thread["author"]);
        $this->title = $thread["threadTitle"];
        $this->content = $thread["threadContent"];
        $this->postDate = new DateTime($thread["postDate"]);
        $this->lastActivity = new DateTime($thread["lastActivity"]);
        $this->views = unserialize($thread["views"]);
    }

    public function getId() { return $this->id; }
    public function getForumId() { return $this->forumId; }
    public function isAReply() { return $this->isReply; }
    public function isPinned() { return $this->pinned; }
    public function getAuthor() { return $this->author; }
    public function getTitle() { return $this->title; }
    public function getContent() { return $this->content; }

    public function getPostDate() { 
        global $user;
        $postDate = $this->postDate;
        $postDate->setTimezone(Helper::timezoneToDateTimeZone($user->getTimezone()));
        return $postDate;
    }

    public function getLastActivity() { 
        global $user;
        $lastActivity = $this->lastActivity;
        $lastActivity->setTimezone(Helper::timezoneToDateTimeZone($user->getTimezone()));
        return $lastActivity;
    }
    public function getViews() { return $this->views; }
    public function viewCount() { return count($this->views); }
    public function parentPost() { return $this->parentPost; }

    public function getAuthorBust() {
        $avatar = new Avatar($this->author->getUserId());
        return $avatar->GetThumbnail(500, 500, "PNG");
    }

    public function formatPostDate() {
        global $user;
        $postDate = $this->postDate;
        $todayDate = (new DateTime())->format("Y-m-d");
        $lastDate  = $postDate->format("Y-m-d");
        $postDate->setTimezone(Helper::timezoneToDateTimeZone($user->getTimezone()));

        if ($todayDate === $lastDate) {
            return "Today @ " . $postDate->format("h:i A");
        }

        return $postDate->format("m/d/Y h:i:s A");
    }

    public function formatLastActivity() {
        global $user;
        $lastActivity = $this->lastActivity;
        $todayDate = (new DateTime())->format("Y-m-d");
        $lastDate  = $lastActivity->format("Y-m-d");
        $lastActivity->setTimezone(Helper::timezoneToDateTimeZone($user->getTimezone()));

        if ($todayDate === $lastDate) {
            return "Today @ " . $lastActivity->format("h:i A");
        }

        return $lastActivity->format("d M Y h:i A");
    }

    public function postedToday() {
        $lastActivity = $this->lastActivity;
        $today = new DateTime();
        $diff = $today->diff($lastActivity)->format("%a");

        return $diff == 0;
    }

    public function getReplies(int $limit = 25, int $offset = 0) {
        global $db;

        $stmt = "SELECT postId FROM threads WHERE parentPost=:threadId LIMIT $limit OFFSET $offset";
        $result = $db->execute($stmt, [":threadId" => $this->getId()]);
        if ($result->rowCount() == 0) {
            return [];
        }

        $replies = [];
        $fetchedReplies = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($fetchedReplies as $fetchedReply) {
            $reply = new Thread($fetchedReply["postId"]);
            array_push($replies, $reply);
        }

        return $replies;
    }

    public function countReplies() {
        global $db;

        $stmt = "SELECT COUNT(*) FROM threads WHERE parentPost=:threadId";
        $result = $db->execute($stmt, [":threadId" => $this->getId()]);
        
        return $result->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
    }
};
?>