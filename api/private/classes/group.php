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

        $this->emblemId = $emblemId;
    }

    public function setPrivacy(int $privacy) {
        global $db;
        $stmt = "UPDATE groups SET `privacy`=:privacy WHERE id=:id";
        
        $db->execute($stmt, [
            ":privacy" => $privacy,
            ":id" => $this->id()
        ]);

        $this->privacy = $privacy;
    }

    public function setName(string $name) {
        global $db;
        $stmt = "UPDATE groups SET `name`=:gName WHERE id=:id";
        
        $db->execute($stmt, [
            ":gName" => $name,
            ":id" => $this->id()
        ]);

        $this->name = $name;
    }

    public function setDescription(string $description) {
        global $db;
        $stmt = "UPDATE groups SET `description`=:gDescription WHERE id=:id";
        
        $db->execute($stmt, [
            ":gDescription" => $description,
            ":id" => $this->id()
        ]);

        $this->description = $description;
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
                "Description" => "The group",
                "Rank" => 255,
                "Permissions" => [1, 2, 3, 4, 5, 6, 7, 8, 9]
            ],
            [
                "Name" => "Administrator",
                "Description" => "A group administrator."
                "Rank" => 254,
                "Permissions" => [1, 2, 4, 5, 6, 7, 8]
            ],
            [
                "Name" => "Member",
                "Description" => "A regular group member.",
                "Rank" => 1,
                "Permissions" => [2, 5, 7, 8]
            ],
            [
                "Name" => "Guest",
                "Description" => "A non-group member.",
                "Rank" => 0,
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

    # ROLESETS

    public function lastRolesetId(): int {
        return end($this->rolesets);
    }

    public function findRolesetById(int $rolesetId): array {
        $rolesets = $this->rolesets;
        return $rolesets[$rolesetId];
    }

    public function getMembersInRoleset(int $rolesetId): array {
        
    }

    public function updateRolesets($rolesets) {
        if (gettype($rolesets) == "array") {
            $this->rolesets = $rolesets;
            $rolesets = serialize($rolesets);
        } elseif (gettype($rolesets) == "string") {
            $this->rolesets = unserialize($rolesets);
        }

        global $db;
        $stmt = "UPDATE groups SET rolesets=:rolesets WHERE id=:id";
        $db->execute($stmt, [
            ":rolesets" => $rolesets,
            ":id" => $this->id()
        ]);
    }

    public function newRoleset(string $name, string $description, int $rank) {
        $rolesets = $this->rolesets;
        
        $roleset = [
            "Name" => $name,
            "Description" => $description,
            "Rank" => $rank
            "Permissions" => []
        ];

        array_push($rolesets, $roleset);
        $this->updateRolesets($rolesets);
    }

    public function editRolesetName(int $rolesetId, string $name) {
        $rolesets = $this->rolesets;
        $rolesets[$rolesetId]["Name"] = $name;

        $this->updateRolesets($rolesets);
    }

    public function editRolesetDescription(int $rolesetId, string $description) {
        $rolesets = $this->rolesets;
        $rolesets[$rolesetId]["Description"] = $description;

        $this->updateRolesets($rolesets);
    }

    public function editRolesetRank(int $rolesetId, int $rank) {
        $rolesets = $this->rolesets;
        $rolesets[$rolesetId]["Rank"] = $rank;

        $this->updateRolesets($rolesets);
    }

    public function editRolesetPermissions(int $rolesetId, array $permissions) {
        $rolesets = $this->rolesets;
        $rolesets[$rolesetId]["Permissions"] = $permissions;

        $this->updateRolesets($rolesets);
    }

    public function deleteRoleset(int $rolesetId) {

    }
}
?>