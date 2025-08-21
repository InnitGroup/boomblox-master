<?php
class BrowseManager {
    private $sortBy = "lastOnline";
    private $page = 1;
    private $search = NULL;
    private $sort = NULL;
    private $sortToSQL = [
        "userName" => "username",
        "userName2" => "username",
        "lastActivity" => "lastOnline",
        "lastActivity2" => "lastOnline",

    ];
    private $sortDirection = "DESC";
    public function __construct($sort, $search) {
        $this->sort = $sort;
        $this->search = $search;
        $this->loadSort($sort, $search);
    }
    public function getUsers() {
        global $db;
        if (isset($this->search)) {
            $searchedString = htmlspecialchars($this->search);
        } else {
            $searchedString = "";
        }
        $offset = ($this->page-1)*10;
        $stmt = "SELECT * FROM users WHERE username LIKE '$searchedString%' ORDER BY $this->sortBy $this->sortDirection LIMIT 10 OFFSET $offset";
        $result = $db->execute($stmt);
        return $result;
    }
    public function getUserCount() {
        global $db;
        if (isset($this->search)) {
            $searchedString = htmlspecialchars($this->search);
        } else {
            $searchedString = "";
        }
        $offset = ($this->page-1)*10;
        $stmt = "SELECT * FROM users WHERE username LIKE '$searchedString%'";
        $result = $db->execute($stmt);
        return $result;
    }
    public function loadUsers() {
        $result = $this->getUsers();
        $users = 0;
        foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $user) {
            $avatar = new Avatar($user["id"]);
            $userObj = new User($user["id"]);
            $data = compact("avatar", "user", "userObj");
            PageBuilder::addComponent("browse", "griditem", $data);
        }
        $paginator = new BrowsePaginator("UsersBrowsed", $this->page, ceil($this->getUserCount()->rowCount()/10));
        echo $paginator->load();
    }
    public function loadSort($sort, $search = "") {
        $type = substr($sort,0,4);
        if ($type !== "tbSearch") {
            $decrypt = substr($sort,5); 
            switch ($type) {
                case "Page":
                    $this->page = htmlspecialchars($decrypt);
                    break;
                case "Sort":
                    $this->sortBy = $this->sortToSQL[htmlspecialchars($decrypt)];
                    break;
            }
        }
        if (!empty($search)) {
            $this->search = $search;
        }
    }
    
    public function setupSortPostBack($type,$value) {
        if ($type == "name") {
            switch ($value) {
                case "Sort\$userName":
                    $this->sortDirection = "DESC";
                    return "Sort\$userName2";
                case "Sort\$userName2":
                    $this->sortDirection = "ASC";
                    return "Sort\$userName";
                default:
                    return 'Sort$userName';
            }
        } elseif ($type == "location") {
            switch ($value) {
                case "Sort\$lastActivity":
                    $this->sortDirection = "DESC";
                    return "Sort\$lastActivity2";
                case "Sort\$lastActivity2":
                    $this->sortDirection = "ASC";
                    return "Sort\$lastActivity";
                default:
                    return 'Sort$lastActivity';
            }
        }
    }
    
    public function load() {
        $search = $this->search;
        $sort = $this->sort;
        $postBack = $this->setupSortPostBack("name",$sort);
        $data = compact("search", "sort", "postBack");
        PageBuilder::addComponent("browse", "top", $data);
        PageBuilder::addComponent("browse", "grid", $data);
        $this->loadUsers();
        PageBuilder::addComponent("browse", "bottom", $data);
    }
}
?>