<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RCCService Render Lua</title>
    <style>
        body {
            background-color: #181818;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1, h2 {
            color: #61dafb;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        label {
            font-size: 18px;
            margin-bottom: 10px;
        }

        input,
        select,
        textarea {
            padding: 10px;
            font-size: 16px;
            width: 300px;
            border: 2px solid #61dafb;
            border-radius: 5px;
            margin-bottom: 15px;
            background-color: #2c2c2c;
            color: #ffffff;
        }

        .button-container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .avatar-container {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }

        .square-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 8px solid #61dafb;
            border-radius: 15px;
            box-sizing: border-box;
            pointer-events: none;
        }

        img {
            border-radius: 15px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>RCCService Render Lua</h1>
    <?php

class RCCServiceSoap {
    public $ip;
    public $port;
    public $url;
    public $SoapClient;

    function __construct($ip = "localhost", $port = 53640, $url = "roblox.com") {
        $this->ip = $ip;
        $this->port = $port;
        $this->url = $url;
        $this->SoapClient = new SoapClient(null, array(
            'location' => 'http://' . $this->ip . ':' . $this->port . '/RCCServiceSoap',
            'uri'      => 'http://' . $this->url . '/',
            'style'    => SOAP_RPC,
            'use'      => SOAP_ENCODED
        ));
    }
  
    function callToService($name, $arguments = []) {
        $result = $this->SoapClient->{$name}($arguments);
        return (!is_soap_fault($result) ? (isset($result->{$name."Result"}) ? $result->{$name."Result"} : null) : $result);
    }
  
    function GetStatus() {
        return $this->callToService(__FUNCTION__);
    }
  
    function requestUrl($url, $xml) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        $luashit = array("LUA_TSTRING", "LUA_TNUMBER", "LUA_TBOOLEAN", "LUA_TTABLE");
        $result = str_replace($luashit, "", $result);
        $almost = strstr($result, '<ns1:value>');
        $luashit = array('<ns1:value>', "</ns1:value>", "</ns1:OpenJobResult>", "<ns1:OpenJobResult>", "<ns1:type>", "</ns1:type>", "<ns1:table>", "</ns1:table>", "</ns1:OpenJobResult>", "</ns1:OpenJobResponse>", "</SOAP-ENV:Body>", "</SOAP-ENV:Envelope>");
        $result = str_replace($luashit, "", $almost);

        return $result;
    }

    function execScript($script, $jobId, $jobExpiration) {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:ns2="http://'.$this->url.'/RCCServiceSoap" xmlns:ns1="http://'.$this->url.'/" xmlns:ns3="http://'.$this->url.'/RCCServiceSoap12">
            <SOAP-ENV:Body>
                <ns1:OpenJob>
                    <ns1:job>
                        <ns1:id>'.$jobId.'</ns1:id>
                        <ns1:expirationInSeconds>'.$jobExpiration.'</ns1:expirationInSeconds>
                        <ns1:category>1</ns1:category>
                        <ns1:cores>321</ns1:cores>
                    </ns1:job>
                    <ns1:script>
                        <ns1:name>Script</ns1:name>
                        <ns1:script>
                            <![CDATA[
                                '.$script.'
                            ]]>
                        </ns1:script>
                    </ns1:script>
                </ns1:OpenJob>
            </SOAP-ENV:Body>
        </SOAP-ENV:Envelope>';
        $url = 'http://'.$this->ip.':'.$this->port.'/';

        return $this->requestUrl($url,$xml);
    }
}

$RCCServiceSoap = new RCCServiceSoap();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $scriptText = $_POST['luaScript'] . '

local result = game:GetService("ThumbnailGenerator"):Click("PNG", ' . ($_POST['width'] ?: 420) . ', ' . ($_POST['height'] ?: 420) . ', false)
return result';

    $render = $RCCServiceSoap->execScript($scriptText, rand(1,getrandmax()), 120);

    if ($render !== null) {
        echo '<div class="avatar-container">';
        echo '<div class="square-overlay"></div>';
        echo '<img src="data:image/png;base64,' . $render . '" alt="Render">';
        echo '</div>';
        echo '<div class="button-container">';
        echo '</div>';
    } else {
        echo "Failed to get image data.";
    }
} else {
    ?>
    <form id="luaForm" method="post">
        <label for="luaScript">Lua Script:</label><br>
        <textarea id="luaScript" name="luaScript" rows="10" cols="50"><?php echo isset($_POST['luaScript']) ? $_POST['luaScript'] : ''; ?></textarea><br>
        <label for="width">Width:</label>
        <input type="text" id="width" name="width" pattern="\d{1,4}" title="Enter width (1-4 digits)" placeholder="420" value="420"><br>
        <label for="height">Height:</label>
        <input type="text" id="height" name="height" pattern="\d{1,4}" title="Enter height (1-4 digits)" placeholder="420" value="420"><br><br>
        <input type="submit" value="Execute">
    </form>
    <?php } ?>
    </body>
    </html>
