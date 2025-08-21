<?php
$settings = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<script>
    if (!localStorage.getItem('hasRefreshed')) {
        localStorage.setItem('hasRefreshed', 'true');
        location.reload();
    } else {
        localStorage.removeItem('hasRefreshed');
    }
</script>

<div id="MainPanel">
    <h1>Settings</h1>
    <i>Please be very careful, as these settings configure the ENTIRE site.</i><br>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        global $db, $user;

        $stmt = "SELECT `option` FROM settings";
        $result = $db->execute($stmt);
        if ($user->hasPerms(5)) {
            if ($result->rowCount() > 0) {
                $tempSettings = $result->fetchAll(PDO::FETCH_ASSOC);
                $settingOptions = array_column($tempSettings, 'option');

                $processed = [];

                foreach ($_POST as $option => $value) {
                    if (in_array($option, $settingOptions)) {
                        $stmt = "UPDATE settings SET `value`=1 WHERE `option`=:setting";
                        $db->execute($stmt, [":setting" => $option]);
                        $processed[] = $option;

                        $setting = new Setting($option);
                        $setting->set(1);
                    }
                }

                foreach ($settingOptions as $setting) {
                    if (!in_array($setting, $processed)) {
                        $stmt = "UPDATE settings SET `value`=0 WHERE `option`=:setting";
                        $db->execute($stmt, [":setting" => $setting]);
                        
                        $setting = new Setting($setting);
                        $setting->set(0);
                    }
                }
            }
        }
    }
    ?>
    <?php if ($result->rowCount() == 0): ?>
        No settings to configure.
    <?php else: ?>
        <table style="border-collapse: collapse">
            <tr style="background-color: #A32121; color: white">
                <th>Option</th>
                <th>Value</th>
                <th>Last Set</th>
                <th>Last Setter</th>
            </tr>
            <?php 
            foreach ($settings as $setting): ?>
            <tr style="background-color: white; text-align: center">
                <td style="min-width: 150px"><?=htmlspecialchars($setting["option"])?></td>
                <td><input type="checkbox" name="<?=htmlspecialchars($setting["option"])?>" style="width: 45px; text-align: center" <?=(int)$setting["value"] == 1 ? "checked" : ""?> onclick="document.aspnetForm.submit()"></td>
                <td style="min-width: 200px">
                    <?php
                    $preTime = new DateTime($setting["lastSet"]);
                    $setTime = $preTime->format("n/j/Y g:i:s A");
                    ?><?=$setTime?>
                </td>
                <td style="min-width: 120px;">
                    <?php
                    $setter = "N/A";
                    if ($setting["lastSetter"] !== 0) {
                        $user = new User($setting["lastSetter"]);
                        $setter = $user->getUsername();
                    }
                    ?><?=$setter?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>