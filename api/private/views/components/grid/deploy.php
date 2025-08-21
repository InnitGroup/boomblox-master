<?php
global $db;
?>

<div id="MainPanel">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        global $user;
        if ($user->hasPerms(7)) {
            if (isset($_POST["Confirmation"]) && isset($_POST["Confirmation2"]) && isset($_FILES["ClientZip"])) {
                $prefile = $_FILES["ClientZip"];
                if ($prefile["type"] == "application/x-zip-compressed" && $prefile["size"] > 5000000) {
                    $deploy = new Deployment("Client", "Client", $prefile["tmp_name"]);
                    $hash = $deploy->prep();
                    $deploy->deploy($hash);
                }
            } else {
                $stmt = "SELECT * FROM deploy";
                $result = $db->execute($stmt);
                if ($result->rowCount() > 0) {
                    $deployments = $result->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($_POST as $hash => $value) {
                        $hashColumn = array_column($deployments, "versionHash");
                        if (in_array($hash, $hashColumn)) {
                            $deploy = new Deployment("Client", "Client", "N/A");
                            $deploy->push($hash);
                        }
                    }
                }
            }
        }
    }
    ?>
    <h1>Version Deployer</h1>
    <label>Client .zip:</label>
    <input type="file" name="ClientZip">
    <hr>
    <label>Confirm:</label>
    <input type="checkbox" name="Confirmation">
    <input type="checkbox" name="Confirmation2">
    <br><br>
    <input type="submit" value="Deploy">
    <p></p><br>
    <hr>
    <br><h1>Version Pusher</h1>
    <?php
    $stmt = "SELECT * FROM deploy ORDER BY deployId DESC LIMIT 3";
    $result = $db->execute($stmt);
    if ($result->rowCount() == 0):
    ?>
    No versions available to deploy.
    <?php
    else:
        $deployments = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($deployments as $deploy): ?>
            <label><?=$deploy["versionHash"]?></label>
            <input type="submit" name="<?=$deploy["versionHash"]?>" value="Push"><br><br>
        <?php endforeach; endif; ?>
</div>