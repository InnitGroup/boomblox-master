<div id="MainPanel">
    <?php
    global $user;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["Setting"]) && $user->hasPerms(7)) {
            $setting = $_POST["Setting"];
            $value = isset($_POST["Value"]) ? 1 : 0;
            
            if (!Setting::exists($setting)) {
                Setting::new($setting, $value);
            }
        }
    }
    ?>

    <label>Setting:</label>
    <input type="text" name="Setting"><br><br>
    <label>Value:</label>
    <input type="checkbox" name="Value"><br><br>
    <input type="submit" value="New">
</div>