<?php
class Forum {
    private int $postsPerPage = 12; # STATIC

    private int $forumId;
    private int $groupId;
    private int $lastPostId;
    private mixed $lastPoster;

    private string $forumTopic;
    private string $forumDesc;

    private DateTime $creationDate;
    private DateTime $lastPostTime;

    private int $threads;
    private int $posts;

    public function __construct(string|int $identifier) {
        $stmt = "SELECT * FROM forums WHERE ";

        switch (gettype($identifier)) {
            case "string":
                $stmt .= "forumTopic=:identifier";
                break;
            case "integer":
                $stmt .= "forumId=:identifier";
                break;
        }

        global $db;

        $result = $db->execute($stmt, [":identifier" => $identifier]);
        if ($result->rowCount() == 0) {
            return false;
        }

        $forum = $result->fetch(PDO::FETCH_ASSOC);

        $this->forumId = $forum["forumId"];
        $this->groupId = $forum["groupId"];
        $this->lastPostId = $forum["lastPostId"];

        if ($db->userExists($forum["lastPoster"])) {
            $this->lastPoster = new User($forum["lastPoster"]);
        } else {
            $this->lastPoster = NULL;
        }
        
        $this->forumTopic = $forum["forumTopic"];
        $this->forumDesc = $forum["forumDesc"];
        $this->creationDate = new DateTime($forum["creationDate"]);
        $this->lastPostTime = new DateTime($forum["lastPostTime"]);
        $this->threads = $forum["threads"];
        $this->posts = $forum["posts"];
    }

    public function getId() { return $this->forumId; }
    public function getGroupId() { return $this->groupId; }
    public function getLastPostId() { return $this->lastPostId; }
    public function getLastPoster() { return $this->lastPoster; }
    public function getTopic() { return $this->forumTopic; }
    public function getDescription() { return $this->forumDesc; }
    public function getCreationDate() { return $this->creationDate; }
    public function getLastPostTime() { return $this->lastPostTime; }
    public function getThreadCount() { return $this->threads; }
    public function getPostCount() { return $this->posts; }

    public static function countAllPosts(int $forumId = NULL) {
        global $db;
        $stmt; $result;

        if (isset($forumId)) {
            $stmt = "SELECT COUNT(*) FROM threads WHERE forumId=:forumId";
            $result = $db->execute($stmt, [":forumId" => $forumId]);
        } else {
            $stmt = "SELECT COUNT(*) FROM threads";
            $result = $db->execute($stmt);
        }

        return $result->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
    }

    public static function getNextPostId(int $postId, int $forumId = NULL) {
        global $db;
     
        if (isset($forumId)) {
            $stmt = "SELECT postId FROM threads WHERE forumId=:forumId AND isReply=0 AND postId > :postId ORDER BY postId ASC";
            $result = $db->execute($stmt, [
                ":forumId" => $forumId,
                ":postId" => $postId
            ]);
            return $result->fetch(PDO::FETCH_ASSOC)["postId"];
        }

        $stmt = "SELECT postId FROM threads WHERE postId > :postId AND isReply=0 ORDER BY postId ASC";
        $result = $db->execute($stmt, [":postId" => $postId]);
        return $result->fetch(PDO::FETCH_ASSOC)["postId"];
    }

    public static function getPreviousPostId(int $postId, int $forumId = NULL) {
        global $db;
     
        if (isset($forumId)) {
            $stmt = "SELECT postId FROM threads WHERE forumId=:forumId AND isReply=0 AND postId < :postId ORDER BY postId DESC";
            $result = $db->execute($stmt, [
                ":forumId" => $forumId,
                ":postId" => $postId
            ]);
            return $result->fetch(PDO::FETCH_ASSOC)["postId"];
        }

        $stmt = "SELECT postId FROM threads WHERE postId < :postId AND isReply=0 ORDER BY postId DESC";
        $result = $db->execute($stmt, [":postId" => $postId]);
        return $result->fetch(PDO::FETCH_ASSOC)["postId"];
    }

    public static function getLastGlobalPostId() {
        global $db;

        $stmt = "SELECT postId FROM threads ORDER BY postId DESC LIMIT 1";
        $result = $db->execute($stmt);
        return $result->fetch(PDO::FETCH_ASSOC)["postId"];
    }

    public static function countAllPostsByUser(int $userId) {
        global $db;
        $stmt = "SELECT COUNT(*) FROM threads WHERE author=:userId";
        $result = $db->execute($stmt, [":userId" => $userId]);
        
        return $result->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
    }

    public function getPosts(int $page = 1, string $query = NULL, int $range = NULL) {
        global $db;
        $stmt = "SELECT * FROM threads WHERE forumId=:forumId AND isReply=0 ORDER BY pinned DESC, lastActivity DESC";

        if (isset($query)) {
            $query = $query . "%";
            $offset .= " AND threadTitle LIKE ':query'";
        }

        if (isset($page)) {
            $offset = ($page * $this->postsPerPage) - $this->postsPerPage;
            $stmt .= " LIMIT {$this->postsPerPage} OFFSET $offset";
        }

        $result;
        if (isset($query)) {
            $result = $db->execute($stmt, [":forumId" => $this->getId(), ":query" => $query]);
        } else {
            $result = $db->execute($stmt, [":forumId" => $this->getId()]);
        }

        $posts = $result->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    public static function forumExists(int $forumId): bool {
        global $db;
        $stmt = "SELECT forumId FROM forums WHERE forumId=:forumId";
        $result = $db->execute($stmt, [":forumId" => $forumId]);

        return $result->rowCount() == 1;
    }

    public static function getGroupByForum(int $forumId): int {
        global $db;

        $stmt = "SELECT groupId FROM forums WHERE forumId=:forumId";
        $result = $db->execute($stmt, [":forumId" => $forumId]);
        if ($result->rowCount() == 0) {
            return false;
        }

        return $result->fetch(PDO::FETCH_ASSOC)["groupId"];
    }

    public static function formatTime(DateTime $timeToFormat): string {
        global $user;
        $today = new DateTime();
        $today->setTimezone(Helper::timezoneToDateTimeZone($user->getTimezone()));
        $diff = $today->diff($timeToFormat)->format("%a");
        $time = $timeToFormat->format("h:i ");

        if ($diff == 0) {
            return "Today @ " . $time;
        }
        
        $timeToFormat->setTimezone(Helper::timezoneToDateTimezone($user->getTimezone()));
        return $timeToFormat->format("d M Y h:i A");
    }

    public static function currentTime(): string {
        global $user;
        $current = new DateTIme();
        $current->setTimezone(Helper::timezoneToDateTimeZone($user->getTimezone()));
        return $current->format("M j, g:i A");
    }

    public function addPost(int $authorId, int $parentPost = NULL, string $title, string $content, bool $isReply = false) {
        global $db;

        if ($parentPost) {
            $parentThread = new Thread($parentPost);
            if ($parentThread->isAReply()) { # replying to a reply
                $parentPost = $parentThread->parentPost();
            }
        }

        $stmt = "INSERT INTO threads (author, parentPost, threadTitle, threadContent, postDate, lastActivity, forumId, isReply) VALUES (:authorId, :parentPost, :title, :content, :xnow, :xnow, :forumId, :isReply)";
        $db->execute($stmt, [
            ":authorId" => $authorId,
            ":parentPost" => $parentPost,
            ":title" => $title,
            ":content" => $content,
            ":xnow" => date("Y-m-d H:i:s"),
            ":forumId" => $this->getId(),
            ":isReply" => (int)$isReply
        ]);

        $stmt = "UPDATE forums SET threads = threads + :isntReply, posts = posts + 1, lastPostTime=:xnow, lastPoster=:authorId, lastPostId=:postId WHERE forumId=:forumId";
        $db->execute($stmt, [
            ":isntReply" => (int)!$isReply,
            ":xnow" => date("Y-m-d H:i:s"),
            ":authorId" => $authorId,
            ":postId" => $parentPost !== NULL ? $parentPost : $db->lastInsertId("threads"),
            ":forumId" => $this->getId()
        ]);

        if ($parentPost == NULL) {
            return $db->lastInsertId("threads");
        }
        
        return $parentPost;
    }
}
?>