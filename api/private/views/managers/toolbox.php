<?php
class ToolboxManager {
    public function __construct() {
        
        #var_dump($_POST);
    }
    public function getModels() {
        global $user, $db;

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
        
        $result = $db->execute($stmt);
        $fetched = $result->fetchAll(PDO::FETCH_ASSOC);
        return [$result, $fetched];
    }
    public function loadModels() {
        $modelData = $this->getModels();
        $result = $modelData[0];
        $fetched = $modelData[1];
        PageBuilder::addComponent("ide", "toolbox", compact("result", "fetched"));
    }

    public function loadPagerLocation() {
        $modelData = $this->getModels();
        #181-200 of 644

    }
}
?>