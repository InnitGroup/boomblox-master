<?php
class BrowseManager {
    private $sortBy = "lastOnline";
    private $sortDirection = "DESC";
    private $page = 1;
    private $search = "";
    private $sort = null;

    private $sortToSQL = [
        "userName" => "username",
        "userName2" => "username",
        "lastActivity" => "lastOnline",
        "lastActivity2" => "lastOnline",
    ];

    public function __construct($sort = null, $search = "") {
        $this->sort = $sort;
        $this->search = $search;
        $this->loadSort($sort, $search);
    }

    private function getDb() {
        global $db;
        return $db;
    }

    public function getUsers() {
        $offset = ($this->page - 1) * 10;
        $limit = 10;

        // Validate sort column and direction
        $sortBy = in_array($this->sortBy, ['username', 'lastOnline']) ? $this->sortBy : 'lastOnline';
        $sortDirection = strtoupper($this->sortDirection) === 'ASC' ? 'ASC' : 'DESC';

        $sql = "
            SELECT id, username, lastOnline 
            FROM users
            WHERE username LIKE :search
            ORDER BY $sortBy $sortDirection
            LIMIT $limit OFFSET $offset
        ";

        $stmtObj = $this->getDb()->execute($sql, [
            ":search" => $this->search . '%'
        ]);

        while ($user = $stmtObj->fetch(PDO::FETCH_ASSOC)) {
            yield $user;
        }
    }

    public function getUserCount() {
        $sql = "SELECT COUNT(*) FROM users WHERE username LIKE :search";
        return (int) $this->getDb()->execute($sql, [
            ":search" => $this->search . '%'
        ])->fetchColumn();
    }

    public function loadUsers() {
        $userCount = $this->getUserCount();
        foreach ($this->getUsers() as $user) {
            $avatar = new Avatar($user["id"]);
            $userObj = new User($user["id"]);
            PageBuilder::addComponent("browse", "griditem", compact("avatar", "user", "userObj"));
        }

        $paginator = new BrowsePaginator("UsersBrowsed", $this->page, ceil($userCount / 10));
        echo $paginator->load();
    }

    public function loadSort($sort = null, $search = "") {
        if (!empty($sort)) {
            $this->sort = $sort;
            $type = substr($sort, 0, 4);
            $decrypt = substr($sort, 5);

            switch ($type) {
                case "Page":
                    $this->page = max(1, (int)$decrypt);
                    break;
                case "Sort":
                    $key = htmlspecialchars($decrypt);
                    $this->sortBy = $this->sortToSQL[$key] ?? $this->sortBy;
                    $this->sortDirection = str_ends_with($key, "2") ? "ASC" : "DESC";
                    break;
            }
        }

        if ($search !== "") {
            $this->search = $search;
        }
    }

    public function setupSortPostBack($type) {
        $map = [
            "name" => ["Sort\$userName" => "Sort\$userName2", "Sort\$userName2" => "Sort\$userName"],
            "location" => ["Sort\$lastActivity" => "Sort\$lastActivity2", "Sort\$lastActivity2" => "Sort\$lastActivity"]
        ];

        if (!isset($map[$type])) return $this->sort;

        return $map[$type][$this->sort] ?? array_key_first($map[$type]);
    }

    public function load() {
        $postBack = $this->setupSortPostBack("name");

        $data = [
            "search" => $this->search,
            "sort" => $this->sort,
            "postBack" => $postBack
        ];

        PageBuilder::addComponent("browse", "top", $data);
        PageBuilder::addComponent("browse", "grid", $data);
        $this->loadUsers();
        PageBuilder::addComponent("browse", "bottom", $data);
    }
}
?>