<?php
class Datalix {
    private $apiKey = [
        0,
        "NGZiY2Q2ZGYtZDE2Yi00ZWY3LThiNDEtNjg5MWVmODYzOThm",
        2,
    ];
    public function getApiKey() {
        return base64_decode($this->apiKey[1]);
    }
}
?>