<?php
class Thread {
    private int $id;
    private int $forumId;
    private bool $isReply;
    private bool $pinned;
    private User $author;
    
    private string $title;
    private string $content;

    private DateTime $postDate;
    private DateTime $lastActivity;

    public static function threadExists(int $threadId): bool {
        global $db;

        $stmt = "SELECT * FROM threads WHERE postId=:threadId AND isReply=0";
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
        $this->pinned = (bool)$thread["pinned"];
        $this->author = new User($db->getIdByUser($thread["author"]));
        $this->title = $thread["threadTitle"];
        $this->content = $thread["threadContent"];
        $this->postDate = new DateTime($thread["postDate"]);
        $this->lastActivity = new DateTime($thread["lastActivity"]);
    }

    public function getId() { return $this->id; }
    public function getForumId() { return $this->forumId; }
    public function isAReply() { return $this->isReply; }
    public function isPinned() { return $this->pinned; }
    public function getAuthor() { return $this->author; }
    public function getTitle() { return $this->title; }
    public function getContent() { return $this->content; }
    public function getPostDate() { return $this->postDate; }
    public function getLastActivity() { return $this->lastActivity; }
    public function getAuthorBust() {
        $avatar = new Avatar($this->author->getUserId());
        return $avatar->GetThumbnail(64, 64, "PNG");
    }
};
?>