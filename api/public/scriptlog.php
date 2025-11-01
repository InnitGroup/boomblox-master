<?php
#made: 01/19/2025 @marsoc
#last edit: 01/19/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user, $auth;

$whitelisted = [
    "a7b1b12afef178fb0feb72e5faf3ffed", // [Client] return game:findFirstChild("NetworkClient")~=nil
    "03a0650e359ef3f0e1e6c4eeb25d3e4d", // [Roblox] Local Gui
    "e9120b545a0a38c398e547e7091d6f1c", // [Roblox] Local Gui
    "b9ebf5d9bc79bc3b93ead1fe4721a999", // [Roblox] Local Gui
    "4f4d161071002c301f11a146ab788933", // [Roblox] Local Gui
    "70c316d0692f4a13c496a931d3e5ee19", // [Roblox] Local Gui
    "f65dea824660a0dc8229207b53c909ce", // [Roblox] Local Gui
    "0b7d28d1880e71acf4ba4e995c6bccdf", // [Roblox] Trowel script
    "210ff6525607c2222dd6aaa4cc1a83dc", // [Client] Play solo in studio
    "582732186f2ba3c00bf03e0e6ef7d87e", // [Client] Character script
    "c096a64502c1f8638d6a234e13130486", // Game script by thereal
    "20d892247f1a7357975e0ee60b8e06ae", // Game script by clockwork [Roblox]
    "d0a7395ff9b46dcf73101b9bf2ba502c", // [Client] Character script
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contents = file_get_contents("php://input");

    if (str_contains($contents, "@")) {
        $contents = str_replace("@", "[@]", $contents);
    }

    $md5 = md5($contents);

    if (in_array($md5, $whitelisted)) {
        Discord::sendWebhookMessage("script", "-# [dev] $md5");
        exit;
    }

    $tag = $user->isInGame() ? "[IN-GAME]" : "[STUDIO]";
    Discord::sendWebhookMessage("script", "[$md5] $tag Script from: {$user->getUsername()}: ```lua
$contents```");
}

exit;
?>