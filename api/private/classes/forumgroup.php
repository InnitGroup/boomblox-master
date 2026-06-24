<?php
class ForumGroup {
    private int $groupId;
    private string $groupName;

    private array $groups = [
        1 => "ROBLOX",
        4 => "Help Center",
        5 => "Fun",
        6 => "Entertainment"
    ];

    private static array $s_groups = [
        1 => "ROBLOX",
        4 => "Help Center",
        5 => "Fun",
        6 => "Entertainment"
    ];

    public function __construct(int|string $input) {
        global $theme;

        $this->groups[1] = Site::getThemeProperty("alias", $theme);

        switch (gettype($input)) {
            case "integer":
                if (!isset($this->groups[$input])) {
                    return false;
                }

                $this->groupId = $input;
                $this->groupName = $this->groups[$this->groupId];
                break;
            case "string":
                if (!array_search($input, $this->groups)) {
                    return false;
                }

                $this->groupId = array_search($input, $this->groups);
                $this->groupName = $this->groups[$this->groupId];
                break;
        }

    }

    public function getId(): int { return $this->groupId; }
    public function getName(): string { return Helper::themeAdjust($this->groupName); }
    
    public static function getAllGroups(): array {
        return self::$s_groups;
    }

    public function getForumsInGroup() : array { 
        global $db;

        $stmt = "SELECT * FROM forums WHERE groupId=:forumGroupId";
        $result = $db->execute($stmt, [":forumGroupId" => $this->groupId]);

        if ($result->rowCount() == 0) {
            return ["Error" => "No forums in the current forum group."];
        }

        $forumArray = array();
        $forums = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($forums as $forum) {
            $forumToPush = new Forum($forum["forumId"]);
            array_push($forumArray, $forumToPush);
        }

        return $forumArray;
     }
};
?>