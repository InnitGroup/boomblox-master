<?php
class ToolboxManager {
    public function getModels() {
        global $user, $db;
        $count = $this->modelCount();

        $stmt = "SELECT * FROM items WHERE `catalogType`='Model'";

        if (isset($_POST["tbSearch"])) {
            $search = htmlspecialchars($_POST["tbSearch"]);
            $stmt .= " AND itemName LIKE '$search%'";
        }

        if (isset($_POST["ddlToolboxes"])) {
            $sort = htmlspecialchars($_POST["ddlToolboxes"]);
            if ($sort == "MyModels") {
                $stmt .= " AND creatorId=".$user->getUserId()." ORDER BY itemId DESC";
            }
            if ((int)$sort > 0) {
                $stmt .= " AND modelType=".$sort;
            }
        }

        $stmt .= " LIMIT 20";

        if (isset($_GET["PageIndex"])) {
            $index = $_GET["PageIndex"];
            if ($index*20 <= $count) {
                $offset = $index*20;
                $stmt .= " OFFSET $offset";
            }
        }
        
        $result = $db->execute($stmt);
        $fetched = $result->fetchAll(PDO::FETCH_ASSOC);
        return [$result, $fetched];
    }

    public function modelCount() {
        global $db;

        $stmt = "SELECT COUNT(*) FROM items WHERE catalogType='Model'";
        $result = $db->execute($stmt);
        $count = $result->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];

        return $count;
    }

    public function loadModels() {
        $modelData = $this->getModels();
        $result = $modelData[0];
        $fetched = $modelData[1];
        PageBuilder::addComponent("ide", "toolbox", compact("result", "fetched"));
    }

    public function loadNavigation() {
        $count = $this->modelCount();
        $toolbox = $this;
        PageBuilder::addComponent("ide", "toolboxnav", compact("toolbox", "count"));
    }

    public function loadPagerLocation() {
        $count = $this->modelCount();

        $index = $_GET["PageIndex"] ?? 0;
        $min = ($index * 20) + 1;
        $max = ($index+1) * 20;
        if ($max > $count) {
            $max = $count;
        }
        PageBuilder::addComponent("ide", "toolboxpagerlocation", compact("count", "min", "max"));
        #181-200 of 644
    }
}
?>