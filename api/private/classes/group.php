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
                (`emblemId`, `privacy`, `name`, `description`, `creator`, `members`, `rolesets`) 
                VALUES 
                (:emblemId, :privacy, :gName, :gDescription, :creator, :members, :rolesets)";

        $members = serialize([
            $user->getUserId() => [
                "Roleset" => 0,
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
                "Name" => "Admin",
                "Description" => "A group administrator.",
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
            ":creator" => $user->getUserId(),
            ":privacy" => $privacy,
            ":members" => $members,
            ":rolesets" => $rolesets
        ]);
    }

    # WALL
    public function addPost(string $content, int $special = 0) {
        global $db, $user;

        if ($user->timeSinceLastWallPost() < 5) return;
        if (strlen($content) > 500) return;
        $content = Helper::debugString($content);
        
        $stmt = "INSERT INTO wall (`gid`, `date`, `content`, `userId`) VALUES (:gid, :date, :content, :userId)";

        return $db->execute($stmt, [
            ":gid" => $this->id(),
            ":date" => date("Y-m-d H:i:s"),
            ":content" => $content,
            ":userId" => $user->getUserId()
        ]);
    }

    public function getPostsRawResult(int $limit = 0, int $offset = 0) {
        global $db;

        $stmt = "SELECT * FROM wall WHERE gid=:gid ORDER BY id DESC";
        if ($limit > 0) {
            $stmt .= " LIMIT $limit OFFSET $offset";
        }

        $result = $db->execute($stmt, [":gid" => $this->id()]);
        return $result;
    }

    public function getPosts(int $limit = 0, int $offset = 0): array {
        global $db;

        $stmt = "SELECT * FROM wall WHERE gid=:gid ORDER BY id DESC";
        if ($limit > 0) {
            $stmt .= " LIMIT $limit OFFSET $offset";
        }

        $result = $db->execute($stmt, [":gid" => $this->id()]);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    # MEMBERS
    public function updateMembers(array $members) {
        if (gettype($members) == "array") {
            $this->members = $members;
            $members = serialize($members);
        } elseif (gettype($members) == "string") {
            $this->members = unserialize($members);
        }

        global $db;
        $stmt = "UPDATE groups SET members=:members WHERE id=:id";
        $db->execute($stmt, [
            ":members" => $members,
            ":id" => $this->id()
        ]);
    }

    public function getMembersInRoleset(int $rolesetId): array {
        $members = array_filter($this->rolesets, function($member) {
            if (isset($member["Roleset"])) {
                return $member["Roleset"] == $rolesetId;
            }
        });

        return $members;
    }

    public function getPermissions(int $userId): array {
        if (!$this->isInGroup($userId)) {
            return [];
        }

        $member = $this->members[$userId];
        $rolesetId = $member["Roleset"];
        $roleset = $this->rolesets[$rolesetId];

        return $roleset["Permissions"];
    }

    public function getRank(int $userId): int {
        if (!$this->isInGroup($userId)) {
            return 0;
        }

        $rolesetId = $this->members[$userId]["Roleset"];
        $roleset = $this->rolesets[$rolesetId];

        return $roleset["Rank"];
    }

    public function setRoleset(int $userId, int $rolesetId) {
        if (!$this->isInGroup($userId)) {
            return;
        }

        $this->members[$userId]["Roleset"] = $rolesetId;
        $this->updateMembers();
    }

    public function getRoleset(int $userId): array {
        if (!$this->isInGroup($userId)) {
            return 0;
        }

        $rolesetId = $this->members[$userId]["Roleset"];
        $roleset = $this->rolesets[$rolesetId];

        return $roleset;
    }

    public function canDeletePosts(int $userId): bool {
        return in_array(1, $this->getPermissions($userId));
    }

    public function canPost(int $userId): bool {
        return in_array(2, $this->getPermissions($userId));
    }

    public function canAcceptJoins(int $userId): bool {
        return in_array(3, $this->getPermissions($userId));
    }

    public function canPostStatus(int $userId): bool {
        return in_array(4, $this->getPermissions($userId));
    }

    public function canBuild(int $userId): bool {
        return in_array(5, $this->getPermissions($userId));
    }

    public function canRemoveMembers(int $userId): bool {
        return in_array(6, $this->getPermissions($userId));
    }

    public function canViewStatus(int $userId): bool {
        return in_array(7, $this->getPermissions($userId));
    }

    public function canViewWall(int $userId): bool {
        return in_array(8, $this->getPermissions($userId));
    }

    public function canChangeRanks(int $userId): bool {
        return in_array(9, $this->getPermissions($userId));
    }

    public function kickMember(int $memberId) {
        if (!$this->isInGroup($memberId)) {
            return;
        }

        $members = $this->members;
        unset($members[$memberId]);

        $this->updateMembers($members);
    }

    public function isInGroup(int $userId) {
        return isset($this->members[$userId]);
    }

    public function addMember(int $userId) {
        if ($this->isInGroup($userId)) {
            return;
        }

        $members = $this->members;
        $members[$userId] = [
            "Roleset" => 2,
            "JoinDate" => date("Y-m-d H:i:s")
        ];
        
        $this->updateMembers($members);
    }

    # ROLESETS

    public function lastRolesetId(): int {
        return end($this->rolesets);
    }

    public function findRolesetById(int $rolesetId): array {
        $rolesets = $this->rolesets;
        return $rolesets[$rolesetId];
    }

    public function findLowestRoleset(): array {
        $rolesets = $this->rolesets;
        $ranks = array_column($rolesets, "Rank");
        array_multisort($ranks, SORT_ASC, $rolesets);

        $lowestRoleset = $rolesets[1]; # Not 0, because 0 will always be guest; we want the one above that

        return $lowestRoleset;
    }

    public function findRolesetIdByRoleset(array $roleset): int {
        return array_search($roleset, $this->rolesets);
    }

    public function findRolesetByName(string $rolesetName): array {
        $matchedRoleset = array_find($this->rolesets, function($roleset) {
            return $roleset["Name"] == $rolesetName;
        });

        return $matchedRoleset;
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
            "Rank" => $rank,
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
        $rolesets = $this->rolesets;
        unset($rolesets[$rolesetId]);
        
        $members = $this->getMembersInRoleset($rolesetId);
        foreach ($members as $member) {
            $member["Roleset"] = $this->findRolesetIdByRoleset($this->findLowestRoleset()); # 2 is Member
        }

        $this->updateRolesets($rolesets);
        $this->updateMembers($members);
    }
}
?>