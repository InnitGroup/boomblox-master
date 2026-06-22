<?php
class ToolboxManager {
    public function getModels() {
        global $user, $db;
        $count = $this->modelCount();

        $stmt = "SELECT * FROM items WHERE `catalogType`='Model' AND `status` <> 'blocked'";

        if (isset($_POST["tbSearch"])) {
            $search = htmlspecialchars($_POST["tbSearch"]);
            $stmt .= " AND itemName LIKE '%$search%'";
        }

        if (isset($_POST["ddlToolboxes"]) || isset($_GET["Category"])) {
            $sort = isset($_POST["ddlToolboxes"]) ? htmlspecialchars($_POST["ddlToolboxes"]) : htmlspecialchars($_GET["Category"]);
            if ($sort == "MyModels") {
                $stmt .= " AND creatorId=".$user->getUserId()." ORDER BY itemId DESC";
            }
            if ($sort == "MyDecals") {
                $stmt = "SELECT * FROM items WHERE `catalogType`='Decal' AND `status` <> 'blocked' AND creatorId=".$user->getUserId()." ORDER BY itemId DESC";
            }
            if ($sort == "AllDecals") {
                $stmt = "SELECT * FROM items WHERE `catalogType`='Decal' AND `status` <> 'blocked'";
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

    public function getCategory() {
        if (isset($_POST["ddlToolboxes"])) {
            return htmlspecialchars($_POST["ddlToolboxes"]);
        }

        if (isset($_GET["Category"])) {
            return htmlspecialchars($_GET["Category"]);
        }
        
        return "AllModels";
    }

    public function getModelsInCategory($typeId) {
        global $db, $user;
        $count = 0;

        if ($typeId == "AllModels") {
            $stmt = "SELECT COUNT(*) AS count FROM items WHERE catalogType='Model'";
            $result = $db->execute($stmt);
            $count = $result->fetch(PDO::FETCH_ASSOC)["count"];
            return $count;
        } elseif ($typeId == "MyModels") {
            return count($user->getModels(true));
        } elseif ($typeId == "AllDecals") {
            $stmt = "SELECT COUNT(*) AS count FROM items WHERE catalogType='Decal'";
            $result = $db->execute($stmt);
            $count = $result->fetch(PDO::FETCH_ASSOC)["count"];
        } elseif ($typeId == "MyDecals") {
            return $user->getItems("decal", true);
        } else {
            $stmt = "SELECT COUNT(*) AS count FROM items WHERE modelType=:typeId";
            $result = $db->execute($stmt, [":typeId" => $typeId]);
            $count = $result->fetch(PDO::FETCH_ASSOC)["count"];
            return $count;
        }
    }

    public function getPage() {
        if (isset($_GET["PageIndex"])) {
            return htmlspecialchars($_GET["PageIndex"]);
        }

        return 0;
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
        $page = $this->getPage();
        $category = $this->getCategory();
        PageBuilder::addComponent("ide", "toolboxnav", compact("toolbox", "count", "page", "category"));
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