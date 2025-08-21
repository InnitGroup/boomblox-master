<div id="MainPanel">
    <p>Making keys specifically for personal alternate accounts is a punishable offense.</p>
    <input type="submit" value="Generate a key">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $key = rand(1000000000,9999999999);
        $date = date("m/d/y");
        global $db, $user;
        if ($user->hasPerms(5)) {
            $stmt = "INSERT INTO `keys` (`keyC`, `creator`, `dateC`, `status`) VALUES (:keyC, :creator, :keyDate, :keyStatus)";
            if ($db->execute($stmt, [
                ":keyC" => $key,
                ":creator" => $user->getUserId(),
                ":keyDate" => $date,
                ":keyStatus" => 1
            ])) {
                echo "Key successfully generated: BOOMBLOX-$key";
            }
        }
    }
    ?>
</div>