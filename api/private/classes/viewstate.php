<?php
class Viewstate {
    private static $key = "BOOMBLOX_VIEWSTATE_DECRYPT-T1";
    private static $algo = "sha256";
    public static function generateViewState() {
        $viewstate = [
            null => [
                "Pair" => [
                    -1994762753,
                    "Pair" => [
                        null,
                        "ArrayList of 2 element(s):" => [
                            6,
                            "Pair" => [
                                "Pair" => [
                                    "ArrayList of 6 element(s):" => [
                                        "ImageUrl",
                                        "~/images/Logo_267_70.png",
                                        "CommandName",
                                        "String.Empty",
                                        "CommandArgument",
                                        null
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                "HybridDictionary of 2 element(s):" => [
                    [
                        "Key" => "__ControlsRequirePostBackKey__",
                        "Value" => [
                            "_ctl0:lsLoginStatus:_ctl1",
                            "_ctl0:lsLoginStatus:_ctl3",
                            "_ctl0:cphRoblox:rbxContentGrid_Models:Smartdatagrid1:_ctl3:CheckboxPublic",
                            "_ctl0:cphRoblox:rbxContentGrid_Models:Smartdatagrid1:_ctl4:CheckboxPublic",
                            "_ctl0:cphRoblox:rbxContentGrid_Models:Smartdatagrid1:_ctl5:CheckboxPublic",
                            "_ctl0:cphRoblox:rbxContentGrid_Models:Smartdatagrid1:_ctl6:CheckboxPublic",
                            "_ctl0:cphRoblox:rbxContentGrid_Models:Smartdatagrid1:_ctl7:CheckboxPublic",
                            "_ctl0:cphRoblox:rbxContentGrid_Models:Smartdatagrid1:_ctl8:CheckboxPublic",
                            "_ctl0:cphRoblox:rbxContentGrid_Models:Smartdatagrid1:_ctl9:CheckboxPublic",
                            "_ctl0:cphRoblox:rbxContentGrid_Models:Smartdatagrid1:_ctl10:CheckboxPublic",
                        ]
                        ],
                    [
                        "Key" => "_ctl0:rbxGoogleAnalytics:MultiView1",
                        "Value" => [
                            "Pair" => [
                                "Pair" => [
                                    null,
                                    0
                                ],
                                null
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $preparedViewstate = serialize($viewstate);
        $start = base64_encode((random_bytes(20)));
        $end = base64_encode((random_bytes(30)));
        $encryptedViewstate = base64_encode($preparedViewstate);
        return $start.$encryptedViewstate.$end;
       # return strtoupper(bin2hex(random_bytes(500/2))); #old algo: hash_hmac(self::$algo, md5(microtime()), self::$key)
    }
}
?>