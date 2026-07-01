<?php
class Group {
    private int $id;
    private int $emblemId;
    private int $privacy; # 0 - Public | 1 - Private

    private string $name;
    private string $description;
    private User $creator;

    private array $members;
    private array $rolesets;

    public function __construct(int $groupId) {
        global $db;
        $stmt = "SELECT * FROM groups WHERE id=:groupId";
        $result = $db->execute($stmt, [":groupId" => $groupId]);
        if ($result->rowCount() == 0) {
            return;
        }

        $group = $result->fetch(PDO::FETCH_ASSOC);
        
        $this->id = $groupId;
        $this->emblemId = $group["emblemId"];
        $this->privacy = $group["privacy"];
        $this->name = $group["name"];
        $this->description = $group["description"];
        $this->creator = new User($group["creator"]);
        $this->members = unserialize($group["members"]);
        $this->rolesets = unserialize($group["rolesets"]);
    }

    public function id(): int { return $this->id; }
    public function emblemId(): int { return $this->emblemId; }
    public function privacy(): int { return $this->privacy; }
    public function name(): string { return $this->name; }
    public function description(): string { return $this->description; }
    public function creator(): User { return $this->creator; }
    public function members(): array { return $this->members; }
    public function rolesets(): array { return $this->rolesets; }

    public function setEmblemId(int $emblemId) {
        global $db;
        $stmt = "UPDATE groups SET `emblemId`=:emblemId WHERE id=:id";
        
        $db->execute($stmt, [
            ":emblemId" => $emblemId,
            ":id" => $this->id()
        ]);
    }

    public function setPrivacy(int $privacy) {
        global $db;
        $stmt = "UPDATE groups SET `privacy`=:privacy WHERE id=:id";
        
        $db->execute($stmt, [
            ":privacy" => $privacy,
            ":id" => $this->id()
        ]);
    }

    public function setName(string $name) {
        global $db;
        $stmt = "UPDATE groups SET `name`=:gName WHERE id=:id";
        
        $db->execute($stmt, [
            ":gName" => $name,
            ":id" => $this->id()
        ]);
    }

    public function setDescription(string $description) {
        global $db;
        $stmt = "UPDATE groups SET `description`=:gDescription WHERE id=:id";
        
        $db->execute($stmt, [
            ":gDescription" => $description,
            ":id" => $this->id()
        ]);
    }


    public static function new(string $name, string $description, int $emblemId, int $privacy, int $wallView, int $posting) {
        global $db, $user;
        $stmt = "INSERT INTO groups 
                (`emblemId`, `privacy`, `name`, `description`, `creator`, `members`, `privacy`, `rolesets`) 
                VALUES 
                (:emblemId, :privacy, :gName, :gDescription, :creator, :members, :privacy, :rolesets)";

        $members = serialize([
            $user->getUserId() => [
                "Role" => 1,
                "JoinDate" => date("Y-m-d H:i:s")
            ]
        ]);

        # PERMISSIONS
        # [1, 2, 3, 4, 5, 6, 7, 8, 9]
        # 1 - Can delete posts on group wall
        # 2 - Can post on group wall
        # 3 - Can accept group join requests
        # 4 - Can post to group status
        # 5 - Can build in group places
        # 6 - Can remove members from group with a lower rank
        # 7 - Can view the group status
        # 8 - Can view the group wall
        # 9 - Can change the ranks of lower-ranked members. New rank can only be as high as the performer's rank

        $rolesets = serialize([
            [
                "Name" => "Owner",
                "ID" => 1,
                "Description" => "The group",
                "Rank" => 255,
                "Permissions" => [1, 2, 3, 4, 5, 6, 7, 8, 9]
            ],
            [
                "Name" => "Administrator",
                "Description" => "A group administrator."
                "Rank" => 254,
                "ID" => 2,
                "Permissions" => [1, 2, 4, 5, 6, 7, 8]
            ],
            [
                "Name" => "Member",
                "Description" => "A regular group member.",
                "Rank" => 1,
                "ID" => 3,
                "Permissions" => [2, 5, 7, 8]
            ],
            [
                "Name" => "Guest",
                "Description" => "A non-group member.",
                "Rank" => 0,
                "ID" => 4,
                "Permissions" => [7]
            ]
        ]);

        $db->execute($stmt, [
            ":emblemId" => $emblemId,
            ":privacy" => $privacy, 
            ":gName" => $name,
            ":gDescription" => $description,
            ":creator" => $user->getUserId()
            ":privacy" => $privacy,
            ":members" => $members,
            ":rolesets" => $rolesets
        ]);
    }

    public function lastRolesetId(): int {
        return end($this->rolesets)["ID"];
    }

    public function newRoleset(string $name, string $description, int $rank) {
        $rolesets = $this->rolesets;
        
        $id = $this->lastRolesetId() + 1;
        $roleset = [
            "Name" => $name,
            "Description" => $description,
            "Rank" => $rank,
            "ID" => $id,
            "Permissions" => []
        ];

        array_push($rolesets, $roleset);
        $rolesets = serialize($rolesets);

        global $db;
        $stmt = "UPDATE groups SET rolesets=:rolesets WHERE id=:id";
        $db->execute($stmt, [
            ":rolesets" => $rolesets,
            ":id" => $this->id()
        ]);
    }
}
?>