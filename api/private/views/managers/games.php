<?php
class GamesManager {
    private $browseTable = [
        "MostPopular" => "Most Popular",
        "TopFavorites" => "Top Favorites",
        "RecentlyUpdated" => "Recently Updated",
        "Featured" => "Featured Games"
    ];
    private $timeTable = [
        "Now" => "Now",
        "PastDay" => "Past Day",
        "PastWeek" => "Past Week",
        "PastMonth" => "Past Month",
        "AllTime" => "All-time",
    ];
    public function getGames($sort) {
        global $db;
        $sort = htmlspecialchars($sort);
        if ($sort !== "MostPopular") {
            switch ($sort) {
                case "TopFavorites":
                    $newsort = "favorites";
                    break;
                case "RecentlyUpdated":
                    $newsort = "lastUpdate";
                    break;
                case "Featured":
                    $newsort = "interactions";
                    break;
                default:
                    Server::_404();
                    break;
            }
            $stmt = "SELECT * FROM items WHERE itemType='game' ORDER BY ".$newsort." DESC";
            $result = $db->execute($stmt);
        } else {
            $stmt = "SELECT i.*, 
            SUM(s.players) AS totalPlayers
            FROM items i
            LEFT JOIN servers s ON s.placeId = i.itemId AND s.players > 0
            WHERE i.itemType = 'game' AND i.status = 'accepted'
            GROUP BY i.itemId
            ORDER BY totalPlayers DESC, i.interactions DESC;
            ";
            $result = $db->execute($stmt);
        }
        return $result;
    }
    public function getPlayers($gameId) {
        global $db;
        $stmt = "SELECT * FROM servers WHERE placeId=:id";
        $result = $db->execute($stmt, [":id" => (int)$gameId]);
        $players = 0;
        if ($result->rowCount() > 0) {
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $server) {
                $players += $server["players"];
            }
        }
        return $players;
    }
    public function getSiteSort($m = "",$t = "") {
        $sort = "";
        $m !== "" && $sort .= "?m=".htmlspecialchars($m);
        $t !== "" && $sort .= "&t=".htmlspecialchars($t);
        return $sort;
    }
    public function loadBrowseSorts($m,$t) {
        $m = htmlspecialchars($m);
        $t = htmlspecialchars($t);
        switch ($m) {
            case "MostPopular":
                echo '
                <li><img id="ctl00_cphRoblox_rbxGames_MostPopularBullet" class="GamesBullet" src="images/games_bullet.png" alt="Bullet" border="0"><a id="ctl00_cphRoblox_rbxGames_hlMostPopular" href="Games.aspx?m=MostPopular&amp;t='.$t.'"><b>Most Popular</b></a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTopFavorites" href="Games.aspx?m=TopFavorites&amp;t='.$t.'">Top Favorites</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlRecentlyUpdated" href="Games.aspx?m=RecentlyUpdated">Recently Updated</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlFeatured" href="User.aspx?ID=1">Featured Games</a></li>
                ';
                break;
            case "TopFavorites":
                echo '
                <li><a id="ctl00_cphRoblox_rbxGames_hlMostPopular" href="Games.aspx?m=MostPopular&amp;t='.$t.'">Most Popular</a></li>
                <li><img id="ctl00_cphRoblox_rbxGames_MostPopularBullet" class="GamesBullet" src="images/games_bullet.png" alt="Bullet" border="0"><a id="ctl00_cphRoblox_rbxGames_hlTopFavorites" href="Games.aspx?m=TopFavorites&amp;t='.$t.'"><b>Top Favorites</b></a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlRecentlyUpdated" href="Games.aspx?m=RecentlyUpdated">Recently Updated</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlFeatured" href="User.aspx?ID=1">Featured Games</a></li>
                ';
                break;
            case "RecentlyUpdated":
                echo '
                <li><a id="ctl00_cphRoblox_rbxGames_hlMostPopular" href="Games.aspx?m=MostPopular&amp;t='.$t.'">Most Popular</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTopFavorites" href="Games.aspx?m=TopFavorites&amp;t='.$t.'">Top Favorites</a></li>
                <li><img id="ctl00_cphRoblox_rbxGames_MostPopularBullet" class="GamesBullet" src="images/games_bullet.png" alt="Bullet" border="0"><a id="ctl00_cphRoblox_rbxGames_hlRecentlyUpdated" href="Games.aspx?m=RecentlyUpdated"><b>Recently Updated</b></a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlFeatured" href="User.aspx?ID=1">Featured Games</a></li>
                ';
                break;
            case "Featured":
                echo '
                <li><a id="ctl00_cphRoblox_rbxGames_hlMostPopular" href="Games.aspx?m=MostPopular&amp;t='.$t.'">Most Popular</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTopFavorites" href="Games.aspx?m=TopFavorites&amp;t='.$t.'">Top Favorites</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlRecentlyUpdated" href="Games.aspx?m=RecentlyUpdated">Recently Updated</a></li>
                <li><img id="ctl00_cphRoblox_rbxGames_MostPopularBullet" class="GamesBullet" src="images/games_bullet.png" alt="Bullet" border="0"><a id="ctl00_cphRoblox_rbxGames_hlFeatured" href="User.aspx?ID=1"><b>Featured Games</b></a></li>
                ';
                break;
        }
        
    }
    public function loadTimeSorts($m,$t) {
        $m = htmlspecialchars($m);
        $t = htmlspecialchars($t);
        echo '<div id="Timespan">
                            <h4>Time</h4>
                            <ul>';
        switch ($t) {
            case "Now":
                echo '
                <li><img id="ctl00_cphRoblox_rbxGames_TimespanNowBullet" class="GamesBullet" src="images/games_bullet.png" alt="Bullet" border="0"><a id="ctl00_cphRoblox_rbxGames_hlTimespanNow" href="Games.aspx?m=MostPopular&amp;t=Now"><b>Now</b></a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastDay" href="Games.aspx?m='.$m.'&amp;t=PastDay">Past Day</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastWeek" href="Games.aspx?m='.$m.'&amp;t=PastWeek">Past Week</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastMonth" href="Games.aspx?m='.$m.'&amp;t=PastMonth">Past Month</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanAllTime" href="Games.aspx?m='.$m.'&amp;t=AllTime">All-time</a></li></ul>
                        </div>';
                break;
            case "PastDay":
                echo '
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanNow" href="Games.aspx?m='.$m.'&amp;t=Now">Now</a></li>
                <li><img id="ctl00_cphRoblox_rbxGames_TimespanNowBullet" class="GamesBullet" src="images/games_bullet.png" alt="Bullet" border="0"><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastDay" href="Games.aspx?m='.$m.'&amp;t=PastDay"><b>Past Day</b></a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastWeek" href="Games.aspx?m='.$m.'&amp;t=PastWeek">Past Week</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastMonth" href="Games.aspx?m='.$m.'&amp;t=PastMonth">Past Month</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanAllTime" href="Games.aspx?m='.$m.'&amp;t=AllTime">All-time</a></li></ul>
                        </div>';
                break;
            case "PastWeek":
                echo '
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanNow" href="Games.aspx?m='.$m.'&amp;t=Now">Now</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastDay" href="Games.aspx?m='.$m.'&amp;t=PastDay">Past Day</a></li>
                <li><img id="ctl00_cphRoblox_rbxGames_TimespanNowBullet" class="GamesBullet" src="images/games_bullet.png" alt="Bullet" border="0"><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastWeek" href="Games.aspx?m='.$m.'&amp;t=PastWeek"><b>Past Week</b></a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastMonth" href="Games.aspx?m='.$m.'&amp;t=PastMonth">Past Month</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanAllTime" href="Games.aspx?m='.$m.'&amp;t=AllTime">All-time</a></li></ul>
                        </div>';
                break;
            case "PastMonth":
                echo '
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanNow" href="Games.aspx?m='.$m.'&amp;t=Now">Now</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastDay" href="Games.aspx?m='.$m.'&amp;t=PastDay">Past Day</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastWeek" href="Games.aspx?m='.$m.'&amp;t=PastWeek">Past Week</a></li>
                <li><img id="ctl00_cphRoblox_rbxGames_TimespanNowBullet" class="GamesBullet" src="images/games_bullet.png" alt="Bullet" border="0"><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastMonth" href="Games.aspx?m='.$m.'&amp;t=PastMonth"><b>Past Month</b></a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanAllTime" href="Games.aspx?m='.$m.'&amp;t=AllTime">All-time</a></li></ul>
                        </div>';
                break;
            case "AllTime":
                echo '
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanNow" href="Games.aspx?m='.$m.'&amp;t=Now">Now</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastDay" href="Games.aspx?m='.$m.'&amp;t=PastDay">Past Day</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastWeek" href="Games.aspx?m='.$m.'&amp;t=PastWeek">Past Week</a></li>
                <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastMonth" href="Games.aspx?m='.$m.'&amp;t=PastMonth">Past Month</a></li>
                <li><img id="ctl00_cphRoblox_rbxGames_TimespanNowBullet" class="GamesBullet" src="images/games_bullet.png" alt="Bullet" border="0"><a id="ctl00_cphRoblox_rbxGames_hlTimespanAllTime" href="Games.aspx?m='.$m.'&amp;t=AllTime"><b>All-time</b></a></li></ul>
                        </div>';
                break;
        }
    }
    public function loadTitleSort($m,$t) {
        $validT = [
            "AllTime",
            "Now",
            "PastDay",
            "PastWeek",
            "PastMonth",
        ];
        if (in_array($t, $validT)) {
            return $this->browseTable[htmlspecialchars($m)]." (".$this->timeTable[htmlspecialchars($t)].")";
        } else {
            Server::_404();
        }
    }
    public function getPages($gamesResult,$c) {
        $currentPage = (int)$c;
        return "Page ".$currentPage." of ".ceil($gamesResult->rowCount() / 14);
    }
    public function loadGames($gamesResult, $page) {
        $gameCount = 0;
        foreach ($gamesResult->fetchAll(PDO::FETCH_ASSOC) as $game) {
            if ($gameCount == 0) {echo "<tr>";}
            if ($gameCount < 15*$page && ($gameCount >= ($page-1)*15)) {
                $asset = new Asset($game["itemId"]);
                $players = $this->getPlayers($game["itemId"]);
                $packed = compact("asset", "game", "players");
                PageBuilder::addComponent("games", "game", $packed);
            }
            $gameCount += 1;
            if ($gameCount % 3 == 0) {echo "</tr>";}
        }
    }
}
?>