<?php
class Thumbnail {
    private static $location = "t2";
    public static function getXML($script) {
        return '<?xml version="1.0" encoding="UTF-8"?>
        <SOAP-ENV:Envelope 
            xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" 
            xmlns:ns1="'.Server::getBaseUrl().'">
            <SOAP-ENV:Body>
                <ns1:OpenJob>
                    <ns1:job>
                        <ns1:id>'.Helper::guid().'</ns1:id>
                        <ns1:expirationInSeconds>30</ns1:expirationInSeconds>
                        <ns1:category>1</ns1:category>
                        <ns1:cores>1</ns1:cores>
                    </ns1:job>
                    <ns1:script>
                        <ns1:name>Script</ns1:name>
                        <ns1:script><![CDATA[
                            '.$script.'
                        ]]></ns1:script>
                    </ns1:script>
                </ns1:OpenJob>
            </SOAP-ENV:Body>
        </SOAP-ENV:Envelope>';
    }

    public static function getCurl($xml) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => Server::getRccAddress(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $xml, 
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml; charset=utf-8',
                'Content-Length: '.strlen($xml),
            ),
        ));
        return curl_exec($curl);
    }

    public static function getLocation() {
        return self::$location;
    }

    public static function getBase64FromResponse($response) {
        $start = strpos($response, '<ns1:value>') + strlen('<ns1:value>');
        $end = strpos($response, '</ns1:value>', $start);
        return substr($response, $start, $end - $start);
    }

    public static function hasError($response) {
        $errors = [
            "err=0x2F7C",
            "tag expected after Byte-Order-Mark",
            "TextXmlParser::parse empty file",
            "stack end"
        ];

        foreach ($errors as $error) {
            if (str_contains($response, $error)) {
                return $error;
            }
        }
    }

    public static function uploadRender($path, $base64) {
        
        $file = fopen($path,"w");
        fwrite($file,base64_decode($base64));
        fclose($file);
    }

    public static function extractSkybox($path) {
        $xml = file_get_contents($path);

        # url based image
        if (str_contains($xml, '<Content name="SkyboxFt"><url>')) {
            $halfA = explode('<Content name="SkyboxFt"><url>', $xml)[1];
            $contentUrl = explode('</url></Content>', $halfA)[0];
            $url = urldecode($contentUrl);
            $image = file_get_contents($url);
            return $url;
        }

        # inline image data detection
        if (str_contains($xml, '<Content name="SkyboxFt" mimeType=')) {
            return self::getUnavail("110x110");
        }
    }

    public static function getUnavail($size) {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/cdn/t2/unavail-".$size.".png")) {
            return "https://t2.".domain."/unavail-".$size.".png";
        } else {
            return "https://t2.".domain."/unavail-100x100.png";
        }
    }

    public static function getHashResult($null, $hash) {
        return "https://t2.".domain."/".$hash."?v=1";
    }
}
?>