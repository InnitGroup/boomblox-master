<?php
class Forums {
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