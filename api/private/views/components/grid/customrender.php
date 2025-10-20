<?php
$base64 = 0;
$imageFormat = "n/a";

if (Server::isPost()) {
    $width = isset($_POST["width"]) ? (int)$_POST["width"] : 500;
    $height = isset($_POST["height"]) ? (int)$_POST["height"] : 500;
    $imageFormat = isset($_POST["imageFormat"]) ? htmlspecialchars($_POST["imageFormat"]) : "JPG";
    if ($width > 750 || $height > 750) {
        Discord::sendWebhookMessage("weird", "someones trying to abuse render panel with 750px+ renders");
        exit;
    }

    if ($imageFormat !== "PNG" && $imageFormat !== "JPG") {
        Discord::sendWebhookMessage("weird", "someones trying to abuse render panel with non png/jpg renders");
        exit;
    }

    $script = $_POST["script"] . " return game:GetService('ThumbnailGenerator'):Boom('".$imageFormat."', ".$width.", ".$height.", true)";

    $xml = Thumbnail::getXml($script);
    $response = Thumbnail::getCurl($xml);
    if ($response) {
        $base64 = Thumbnail::getBase64FromResponse($response);
        $imageFormat = strtolower($imageFormat);
    }
}
?>

<div id="MainPanel">
    <h1>Lua Render Panel</h1>
    <p>Use this for custom renders; if abused your permissions will be removed, this is logged</p>
    <hr>
    <label for="width">Width: </label>
    <input type="number" name="width" value="250"><br>
    <label for="Height">Height: </label>
    <input type="number" name="height" value="250"><br>
    <label for="imageFormat">Image Format: </label><br>
    <label for="imageFormat">PNG </label>
    <input type="radio" name="imageFormat" value="PNG" checked><br>
    <label for="imageFormat">JPG </label>
    <input type="radio" name="imageFormat" value="JPG">
    <hr>
    <textarea name="script" rows="10" cols="40" placeholder="game.Players:CreateLocalPlayer(0) game.Players.Player:LoadCharacter()"></textarea><br>
    <input type="submit">
    <hr>
    <?php if ($base64 !== 0): ?>
        <img src="data:image/<?=htmlspecialchars($imageFormat)?>;base64, <?=$base64?>">
    <?php endif; ?>
</div>