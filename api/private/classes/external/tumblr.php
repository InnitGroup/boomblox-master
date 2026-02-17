<?php
class Tumblr {
    private static $apiKey = array(
        ""
    );
    private static $blogName = "boombloxjournal";
    private static $url = "https://api.tumblr.com/v2/blog/boombloxjournal/posts?api_key=UydRiRxbd7POluaTSwvnhhxOdhFXB8cPC57xQ8AKBdhNF7aXle&limit=3";

    public static function getRecentPost() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $response = json_decode($response, true);
        if (isset($response['response']['posts'])) {
            $post = $response['response']['posts'][0];
            var_dump($post);
            $post2 = $response['response']['posts'][1];
            $post3 = $response['response']['posts'][2];
            return [$post["summary"], $post2["summary"], $post3["summary"]];
        }
    }

    public static function getRelativePostTitle($id) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $response = json_decode($response, true);
        if (isset($response['response']['posts'])) {
            $post = $response['response']['posts'][$id];
            return $post["summary"];
        }
    }

    public static function getRelativePostLink($id) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $response = json_decode($response, true);
        if (isset($response['response']['posts'])) {
            $post = $response['response']['posts'][$id];
            return "https://boombloxjournal.tumblr.com/post/".$post["id"];
        }
    }

    public static function getNews() { 
        return '
        <h4 style="text-align: center; height: 16px; margin: 0px 0px 2px 0px;"><a id="ctl00_cphRoblox_NewsFeed_RobloxNewsHyperLink" href="#"><font color="graytext">ROBLOX News</font></a></h4>
        <table id="ctl00_cphRoblox_NewsFeed_dlNews" cellspacing="0" cellpadding="1" border="0" width="158">
            <tbody>
                <tr>
                    <td align="left">
                    <li style="margin-left: 1px;">
                        <a id="ctl00_cphRoblox_NewsFeed_dlNews_ctl00_NewsItemHyperLink" href="'.Tumblr::getRelativePostLink(0).'">'.Tumblr::getRelativePostTitle(0).'</a>
                    </li>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                    <li style="margin-left: 1px;">
                        <a id="ctl00_cphRoblox_NewsFeed_dlNews_ctl00_NewsItemHyperLink" href="'.Tumblr::getRelativePostLink(1).'">'.Tumblr::getRelativePostTitle(1).'</a>
                    </li>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                    <li style="margin-left: 1px;">
                        <a id="ctl00_cphRoblox_NewsFeed_dlNews_ctl00_NewsItemHyperLink" href="'.Tumblr::getRelativePostLink(2).'">'.Tumblr::getRelativePostTitle(2).'</a>
                    </li>
                    </td>
                </tr>
            </tbody>
        </table>
        ';
    }
}
?>