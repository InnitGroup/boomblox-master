<?php
class Forum {
    private int $forumId;
    private int $groupId;
    private int $lastPostId;
    private User $lastPoster;

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
        $this->lastPoster = new User($forum["lastPoster"]);
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

    public static function forumExists(int $forumId): bool {
        global $db;
        # query for forum by id
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
}
?>