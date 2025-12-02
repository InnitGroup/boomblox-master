<?php
class UserAd {
    public int $id;
    public string $name;
    public DateTime $createdAt;
    public User $creator;
    public string $file;

    public function __construct(int $id) {
        global $db;

        $stmt = "SELECT * FROM ads WHERE id=:id";
        $result = $db->execute($stmt, [":id" => $id]);

        if ($result->rowCount() == 0) {
            return false;
        }

        $ad = $result->fetch(PDO::FETCH_ASSOC);

        $this->id = $id;
        $this->name = $ad["name"];
        $this->createdAt = new DateTime($ad["created_at"]);
        $this->creator = new User($ad["creator"]);
        $this->file = $ad["file"];
    }

    public static function new(string $name, User $creator, string $tempFile) {
        global $db;

        # handle file here

        $stmt = "INSERT INTO ads (`name`, `createdAt`, `creator`, `file`) VALUES (:xname, :createdAt, :creator, :xfile)";
        $db->execute($stmt, [
            ":xname" => $name,
            ":createdAt" => date("Y-m-d H:i:s"),
            ":creator" => $creator->getUserId(),
            ":xfile" => 0#
        ]);
    }
};
?>