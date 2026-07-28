<?php
#made: 01/19/2025 @marsoc
#last edit: 02/15/2025 @marsoc: pageRestrictor
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;

if (isset($_GET["feed"])) {
    $feed = $_GET["feed"];
    if ($feed === "rss") {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/Data/GamesRSS.php";
        exit;
    }
}

!$auth->isAuthed() && Server::_404();;

$games = new GamesManager;
$m = $_GET["m"] ?? "MostPopular";
$t = $_GET["t"] ?? "AllTime";
$p = $_GET["p"] ?? "1";

if (!is_numeric($p)) {
    Server::_404();
}

$gameItems = $games->getGames($m);
$paginator = new Paginator("Games", $gameItems, $p, 15, $games->getSiteSort($m, $t));

Server::pageRestrictor($gameItems, 15, $p);

$page = new PageBuilder(Site::getThemeProperty("alias", $theme)." Games - ".$games->loadTitleSort($m, $t), $theme, "/templates/authheader.php");
$page->buildHeader();
?>

<div id="Body">
    <div id="GamesContainer">            
        <div> 
            <div class="DisplayFilters">
                <h2>Games&nbsp;<a href="Games.aspx?feed=rss"><img src="images/feed-icons/feed-icon-14x14.png" alt="RSS" border="0"></a></h2>
                <div id="BrowseMode">
                    <h4>Browse</h4>
                    <ul>
                        <?=$games->loadBrowseSorts($m,$t)?>
                    </ul>
                </div>
                <div>
                    <?php if ($m !== "RecentlyUpdated") {$games->loadTimeSorts($m,$t);} ?> 
                </div>
                </div>
                <div id="Games">
                    <span class="GamesDisplaySet"><?=$games->loadTitleSort($m,$t)?></span>
                    <div style="clear:both;"></div>
                    <?=$paginator->load()?>
                    <div id="GamePageAdDiv" style="height: 175px; width: 360px; float: right; _overflow: hidden;">
                            <div style="width: 300px; height: 250px; margin-left: 38px; position: relative; top: -90px;">
                                <div style="overflow: hidden;">
                                <?=Ad::generateAd("300x250a")?>
                                <a id="ctl00_cphRoblox_rbxGames_GamesPageAd_ReportAdButton" title="click to report an ad" class="BadAdButton" href="javascript:__doPostBack('ctl00$cphRoblox$rbxGames$GamesPageAd$ReportAdButton','')">[ report ]</a>
                            </div>
                        </div>
                    </div>
                    <?=$games->loadGames($gameItems, $p);?>
                    <div style="clear:both;"></div>
                    <?=$paginator->load(false);?>
                </div>
            </div>
            <div style="clear:both;"></div>
        </div> 
    </div>
<?php
$page->buildFooter();
?>