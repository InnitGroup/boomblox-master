<?php
class Discord {
    private static $secret = array(
        "ZGx0NzR3dEoxXzg0V09Dcy1QaFJpdW1KY0hwN2ZhMjI==",
    );
    private static $clientId = array(
        "MTM1NDkwNzg3ODcyNDczMDkxMA==",
    );
    private static $token = array(
        "TVRNMU5Ea3dOemczT0RjeU5EY3pNRGt4TUEuR2lWQVloLjFPQ2lkaXR4anVQNjNpQjBaRUtTMGNEVzcwMG5wSWZxdVRRTjdn",
    );
    private static $webhooks = array(
        "games" => "https://discord.com/api/webhooks/1414034389423099934/w0cEn1lT6mtAMSVeV5Umdknc4p8NjNHNmlJzO6kmZc5i1grWR9M0H10gyHGE7Zalpd35",
        "weird" => "https://discord.com/api/webhooks/1414057284505440359/fYMeIQOSWGN7EoKL6KZXHdtR8V2NsVfIfhApad_KVJmVvmeigkZtZVjlOHjfnTDWy5-p",
        "script" => "https://discord.com/api/webhooks/1432561048765857933/hJ9bZ3hbpd3Xuo77uvwASMrxX2iwp8wjcNnDUsKqKfG6hF2x9n9UJgjS23SuYuVAC43r",
        "anticheat" => "https://discord.com/api/webhooks/1432561252584001536/VasleZFwJ5IuR1RIjvIc-YNroPPXEaQalFuq1VLCd2LKFM11Pw92wUbGVIiFtOX21NI9",
        "test" => "https://discord.com/api/webhooks/1437278114399916042/T8FPEx9Ijhw7Viw-jaEUwPwsJXXzKWxNMRxXISL1_lNO5RE3zNPeVtxil2Krg-lts58z",
        "vcchat" => "https://discord.com/api/webhooks/1439068553931128852/ko48BntElyrfYtfBAokXpbY7KMXFiTl0CQsO9RycUzr6kfG57EYepxWmuRKpiyMWVEwx"
    );
    #https://stackoverflow.com/questions/54936975/setting-up-a-discord-oauth2-login-on-my-website-with-php
    public static function sendOAuth() {
        $params = [
            'client_id' => base64_decode(string: self::$clientId[0]),
            'redirect_uri' => fullDomain.'/My/Profile.aspx',
            'response_type' => 'code',
            'scope' => 'identify'
        ];
        header("Location: https://discordapp.com/api/oauth2/authorize?".http_build_query($params));
    }
    public static function getClient($code, $post, $headers = []) {
        #url => https://discordapp.com/api/oauth2/token
        $curl = curl_init("https://discordapp.com/api/oauth2/token");
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl);

        if ($post) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
            $headers[] = 'Accept: application/json';
            $headers[] = 'Authorization: Bearer '.$code;

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($curl);
            return json_decode($response);
        }
    }
    public static function clientId($code) {
        $response = self::getClient($code, array(
            "grant_type" => "authorization_code",
            "client_id" => base64_decode(self::$clientId[0]),
            "client_secret" => base64_decode(self::$secret[0]),
            "redirect_uri" => fullDomain.'/My/Profile.aspx',
            "code" => $code
        ));

        $headers[] = 'Authorization: Bearer '.$response->access_token;
        $curl = curl_init("https://discord.com/api/v10/users/@me");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($curl);
        $data = json_decode($data, true);
        return $data["id"];
    }
    public static function sendMessage($userId, $content) {
        $headers = [
            "Authorization: Bot ".base64_decode(self::$token[0]),
            "Content-Type: application/json",
        ];
        $curl = curl_init("https://discord.com/api/v10/users/@me/channels");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(["recipient_id" => $userId]));
        $response = json_decode(curl_exec($curl),true);
        $channelId = $response["id"];

        $curl = curl_init("https://discord.com/api/v10/channels/".$channelId."/messages");
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($content));
        curl_exec($curl);
        curl_close($curl);
    }

    public static function sendWebhookMessage($webhookId, $content) {
        $webhook = self::$webhooks[$webhookId];

        $data = json_encode([
            "content" => $content
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $curl = curl_init($webhook);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
?>