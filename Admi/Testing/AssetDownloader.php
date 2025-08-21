<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && header("Location: /Welcome.php");

$page = new APageBuilder($theme);
$page->buildHeader();

$error = '';
$result = '';
if (Server::isPost()) {
    if (isset($_POST['ctl$cphRoblox$assetId'])) {
        $assetId = (int)$_POST['ctl$cphRoblox$assetId'];

        if ($assetId < 10000) {
            $error = 'Too low of an ID';
        }
        
        $newfile = $_SERVER["DOCUMENT_ROOT"]."/content/test/".$assetId;
        if (empty($error)) {
            $file = file_get_contents("https://bmblox.xyz/asset/?id=".$assetId);

            if (!str_contains($file, 'Item class="Accessory"')) {
                $replaced = str_replace("www.roblox.com", "bmblox.xyz", $file);
                $replaced2 = str_replace("roblox.com", "bmblox.xyz", $replaced);
                
                file_put_contents($newfile, $replaced2);

                $result = "/content/test/".$assetId;
            } else {
                $error = "Asset is too new and uses Accessory class";
            }

            

            /*
            echo "
            <script>
                window.location = '/content/test/".$assetId."';
            </script>
            ";
            */
        }
    }
}
?>

<div id="MainPanel">
    <label>Asset ID:</label>
    <input type="number" name="ctl$cphRoblox$assetId"><br>
    <input type="submit" value="Download">
    <?php if (!empty($error)): ?>
    <br>
    <p style="color:red"><?=$error?></p>
    <?php endif; ?>
    <?php if (!empty($result)): ?>
    <br><br>
    <a style="color:green" href="<?=$result?>" download>Click to download</a>
    <?php endif; ?>
</div>

<?php
$page->buildFooter();
?>