<?php
class ForumGroup {
    private int $groupId;
    private string $groupName;

    private array $groups = [
        1 => NULL,
        4 => "Help Center",
        5 => "Fun",
        6 => "Entertainment"
    ];

    public function __construct(int|string $input) {
        global $theme;

        $this->groups[1] = Site::getThemeProperty("alias", $theme);

        switch (gettype($input)) {
            case "int":
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

        public function getId() { return $this->groupId; }
        public function getName() { return $this->groupName; }
    }
};
?>