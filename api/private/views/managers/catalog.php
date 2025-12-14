<?php
class CatalogManager {
    private $m, $c, $t, $d, $p, $q, $theme;
    private $mToLabel = [
        "TopFavorites" => "Favorite",
        "BestSelling" => "Best Selling",
        "RecentlyUpdated" => "Recently Updated",
        "ForSale" => "For Sale",
        "PublicDomain" => "Public Domain"
    ];
    private $sortToSQL = [
        "TopFavorites" => "ORDER BY favorites DESC",
        "BestSelling" => "ORDER BY interactions DESC",
        "RecentlyUpdated" => "ORDER BY lastUpdate DESC",
        "ForSale" => "AND onsale=1 ORDER BY priceInBoombux ASC, priceInTix ASC",
        "PublicDomain" => "AND onsale=2"
    ];
    private $cToLabel = [
        #2 11 12 8 13 10 9
        "2" => "T-Shirts",
        "4" => "Meshes",
        "8" => "Hats",
        "9" => "Places",
        "10" => "Models",
        "11" => "Shirts",
        "12" => "Pants",
        "13" => "Decals",
        "17" => "Heads"
    ];
    private $cToSQL = [
        "2" => "T-Shirt",
        "4" => "Mesh",
        "8" => "Hat",
        "9" => "Place",
        "10" => "Model",
        "11" => "Shirt",
        "12" => "Pants",
        "13" => "Decal",
        "17" => "Head"
    ];
    private $dToSQL = [
        "All" => "",
        "Robux" => " AND priceInBoombux > 0 AND priceInTix = 0",
        "Tickets" => " AND priceInTix > 0 AND priceInBoombux = 0"
    ];
    private $tToLabel = [
        #PastHour PastDay PastWeek PastMonth AllTime
        "PastHour" => "Past Hour",
        "PastDay" => "Past Day",
        "PastWeek" => "Past Week",
        "PastMonth" => "Past Month",
        "AllTime" => "All-time"
    ];
    public function __construct($m = "TopFavorites", $c = "8", $t = "PastWeek", $d = "All", $p = "1", $q = "", $theme = 0) {
        $validC = [2, 4, 9, 8, 10, 11, 12, 13, 17];
        $validM = ["TopFavorites", "BestSelling", "ForSale", "RecentlyUpdated", "PublicDomain"];
        if (!in_array($c, $validC)) {
            Server::_404();
        }
        if (!in_array($m, $validM)) {
            Server::_404();
        }
        if (!is_numeric($p)) {
            Server::_404();
        }
        if (!is_numeric($c)) {
            Server::_404();
        }
        $this->m = htmlspecialchars($m);
        $this->c = (int)($c);
        $this->t = htmlspecialchars($t);
        $this->d = htmlspecialchars($d);
        $this->p = (int)($p);
        $this->q = htmlspecialchars($q);
        $this->theme = $theme;
    }
    public function getItems($sort) {
        global $db;
        $offset = "";
        $sql = "";
        #this is really bad but at least we are upgrading from old boomblox code
        ($this->p*20)-20 !== 0 && $offset .= " OFFSET ".($this->p*20)-20;
        $this->c !== "9" && $sql = "SELECT * FROM items WHERE itemType='catalog'";
        $this->d !== "All" && $sql .= $this->dToSQL[$this->d];
        $this->q !== "" && $sql .= " AND itemName LIKE '%".htmlspecialchars($this->q)."%' ";
        $this->c !== "9" && $sql .= " AND catalogType='".$this->cToSQL[$this->c]."' ".htmlspecialchars($sort);
        $this->c == "9" && $sql = "SELECT * FROM items WHERE itemType='game' ";
        $this->q !== "" & $this->c == "9" && $sql .= " AND itemName LIKE '".htmlspecialchars($this->q)."%' ";
        $this->c == "9" && $sql .= htmlspecialchars($sort);
        $result = $db->execute($sql);
        return $result;
    }
    public function getSiteSort() {
        $sort = "";
        $this->m !== "" && $sort .= "?m=".htmlspecialchars($this->m);
        $this->c !== "" && $sort .= "&c=".htmlspecialchars($this->c);
        $this->t !== "" && $sort .= "&t=".htmlspecialchars($this->t);
        $this->d !== "" && $sort .= "&d=".htmlspecialchars($this->d);
        $this->p !== "" && $sort .= "&p=".htmlspecialchars($this->p);
        return $sort;
    }
    public function getSQLSort($m) {
        return $this->sortToSQL[$m];
    }
    public function getSort() {
        $sort = "";
        $this->m !== "" && $sort .= "?m=".htmlspecialchars($this->m);
        $this->c !== "" && $sort .= "&c=".htmlspecialchars($this->c);
        $this->t !== "" && $sort .= "&t=".htmlspecialchars($this->t);
        $this->d !== "" && $sort .= "&d=".htmlspecialchars($this->d);
        return $sort;
    }
    public function getDisplaySetLabel($m, $c, $t) {
        $label = "";
        $label .= $this->mToLabel[$m]." ";
        $label .= $this->cToLabel[(int)$c].", ";
        $label .= $this->tToLabel[$t];
        return $label;
    }
    public function loadSorts() {
        echo '
        <div class="DisplayFilters">
			<h2>Catalog</h2>
			<div id="BrowseMode">
				<h4><a id="ctl00_cphRoblox_rbxCatalog_CafePressHyperLink" href="http://www.cafepress.com/roblox" target="_blank">Buy '.Site::getThemeProperty("alias", $this->theme).' Stuff!</a></h4>
                <h4><a id="ctl00_cphRoblox_rbxCatalog_CurrencyPurchaseHyperLink" href="/Upgrades/Robux.aspx">Buy '.Site::getThemeProperty("currency", $this->theme).'!</a></h4>
                <h4><a id="ctl00_cphRoblox_rbxCatalog_CurrencyExchangeHyperLink" href="/Marketplace/TradeCurrency.aspx">Trade Currency!</a></h4>
				<h4>Browse</h4>
				<ul>';
					switch ($this->m) { #
                        case "TopFavorites":
                            echo '<li><img id="ctl00_cphRoblox_rbxCatalog_BrowseModeTopFavoritesBullet" class="GamesBullet" src="images/games_bullet.png" border="0"/><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeTopFavoritesSelector" href="Catalog.aspx?m=TopFavorites&c='.htmlspecialchars($this->c).'&t='.htmlspecialchars($this->t).'&d=All"><b>Top Favorites</b></a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeBestSellingSelector" href="Catalog.aspx?m=BestSelling&c='.htmlspecialchars($this->c).'&t='.htmlspecialchars($this->t).'&d=All">Best Selling</a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeRecentlyUpdatedSelector" href="Catalog.aspx?m=RecentlyUpdated&c='.htmlspecialchars($this->c).'">Recently Updated</a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeForSaleSelector" href="Catalog.aspx?m=ForSale&c='.htmlspecialchars($this->c).'&d=All">For Sale</a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModePublicDomainSelector" href="Catalog.aspx?m=PublicDomain&c='.htmlspecialchars($this->c).'">Public Domain</a></li>';
                            break;
                        case "BestSelling":
                            echo '<li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeTopFavoritesSelector" href="Catalog.aspx?m=TopFavorites&c='.htmlspecialchars($this->c).'&t='.htmlspecialchars($this->t).'&d=All">Top Favorites</a></li>
                            <li><img id="ctl00_cphRoblox_rbxCatalog_BrowseModeTopFavoritesBullet" class="GamesBullet" src="images/games_bullet.png" border="0"/><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeBestSellingSelector" href="Catalog.aspx?m=BestSelling&c='.htmlspecialchars($this->c).'&t='.htmlspecialchars($this->t).'&d=All"><b>Best Selling</b></a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeRecentlyUpdatedSelector" href="Catalog.aspx?m=RecentlyUpdated&c='.htmlspecialchars($this->c).'">Recently Updated</a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeForSaleSelector" href="Catalog.aspx?m=ForSale&c='.htmlspecialchars($this->c).'&d=All">For Sale</a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModePublicDomainSelector" href="Catalog.aspx?m=PublicDomain&c='.htmlspecialchars($this->c).'">Public Domain</a></li>';
                            break;
                        case "RecentlyUpdated":
                            echo '<li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeTopFavoritesSelector" href="Catalog.aspx?m=TopFavorites&c='.htmlspecialchars($this->c).'&t='.htmlspecialchars($this->t).'&d=All">Top Favorites</a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeBestSellingSelector" href="Catalog.aspx?m=BestSelling&c='.htmlspecialchars($this->c).'&t='.htmlspecialchars($this->t).'&d=All">Best Selling</a></li>
                            <li><img id="ctl00_cphRoblox_rbxCatalog_BrowseModeTopFavoritesBullet" class="GamesBullet" src="images/games_bullet.png" border="0"/><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeRecentlyUpdatedSelector" href="Catalog.aspx?m=RecentlyUpdated&c='.htmlspecialchars($this->c).'"><b>Recently Updated</b></a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeForSaleSelector" href="Catalog.aspx?m=ForSale&c='.htmlspecialchars($this->c).'&d=All">For Sale</a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModePublicDomainSelector" href="Catalog.aspx?m=PublicDomain&c='.htmlspecialchars($this->c).'">Public Domain</a></li>';
                            break;
                        case "ForSale":
                            echo '<li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeTopFavoritesSelector" href="Catalog.aspx?m=TopFavorites&c='.htmlspecialchars($this->c).'&t='.htmlspecialchars($this->t).'&d=All">Top Favorites</a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeBestSellingSelector" href="Catalog.aspx?m=BestSelling&c='.htmlspecialchars($this->c).'&t='.htmlspecialchars($this->t).'&d=All">Best Selling</a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeRecentlyUpdatedSelector" href="Catalog.aspx?m=RecentlyUpdated&c='.htmlspecialchars($this->c).'">Recently Updated</a></li>
                            <li><img id="ctl00_cphRoblox_rbxCatalog_BrowseModeTopFavoritesBullet" class="GamesBullet" src="images/games_bullet.png" border="0"/><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeForSaleSelector" href="Catalog.aspx?m=ForSale&c='.htmlspecialchars($this->c).'&d=All"><b>For Sale</b></a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModePublicDomainSelector" href="Catalog.aspx?m=PublicDomain&c='.htmlspecialchars($this->c).'">Public Domain</a></li>';
                            break;
                        case "PublicDomain":
                            echo '<li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeTopFavoritesSelector" href="Catalog.aspx?m=TopFavorites&c='.htmlspecialchars($this->c).'&t='.htmlspecialchars($this->t).'&d=All">Top Favorites</a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeBestSellingSelector" href="Catalog.aspx?m=BestSelling&c='.htmlspecialchars($this->c).'&t='.htmlspecialchars($this->t).'&d=All">Best Selling</a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeRecentlyUpdatedSelector" href="Catalog.aspx?m=RecentlyUpdated&c='.htmlspecialchars($this->c).'">Recently Updated</a></li>
                            <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeForSaleSelector" href="Catalog.aspx?m=ForSale&c='.htmlspecialchars($this->c).'&d=All">For Sale</a></li>
                            <li><img id="ctl00_cphRoblox_rbxCatalog_BrowseModeTopFavoritesBullet" class="GamesBullet" src="images/games_bullet.png" border="0"/><a id="ctl00_cphRoblox_rbxCatalog_BrowseModePublicDomainSelector" href="Catalog.aspx?m=PublicDomain&c='.htmlspecialchars($this->c).'"><b>Public Domain</b></a></li>';
                            break;
                    }
				echo '</ul>
			</div>
			<div id="Category">
				<h4>Category</h4>
				
						<ul>';
                switch ($this->c) {
                    case "2": #
                        echo '
                        <li>  
                            <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl04_SelectedCategoryBullet" class="GamesBullet" src="images/games_bullet.png" border="0"/>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=2&t='.htmlspecialchars($this->t).'&d=All"><b>T-Shirts</b></a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=11&t='.htmlspecialchars($this->t).'&d=All">Shirts</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl03_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=12&t='.htmlspecialchars($this->t).'&d=All">Pants</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl04_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=8&t='.htmlspecialchars($this->t).'&d=All">Hats</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl05_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=13&t='.htmlspecialchars($this->t).'&d=All">Decals</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl06_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=10&t='.htmlspecialchars($this->t).'&d=All">Models</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl07_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=9&t='.htmlspecialchars($this->t).'&d=All">Places</a>
						</li>
                        ';
                        break;
                    case "8":
                        echo '
                        <li>  
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=2&t='.htmlspecialchars($this->t).'&d=All">T-Shirts</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=11&t='.htmlspecialchars($this->t).'&d=All">Shirts</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl03_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=12&t='.htmlspecialchars($this->t).'&d=All">Pants</a>
						</li>
						<li>
                            <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl04_SelectedCategoryBullet" class="GamesBullet" src="images/games_bullet.png" border="0"/>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl04_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=8&t='.htmlspecialchars($this->t).'&d=All"><b>Hats</b></a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl05_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=13&t='.htmlspecialchars($this->t).'&d=All">Decals</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl06_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=10&t='.htmlspecialchars($this->t).'&d=All">Models</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl07_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=9&t='.htmlspecialchars($this->t).'&d=All">Places</a>
						</li>
                        ';
                        break;
                    case "9":
                        echo '
                        <li>  
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=2&t='.htmlspecialchars($this->t).'&d=All">T-Shirts</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=11&t='.htmlspecialchars($this->t).'&d=All">Shirts</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl03_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=12&t='.htmlspecialchars($this->t).'&d=All">Pants</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl04_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=8&t='.htmlspecialchars($this->t).'&d=All">Hats</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl05_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=13&t='.htmlspecialchars($this->t).'&d=All">Decals</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl06_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=10&t='.htmlspecialchars($this->t).'&d=All">Models</a>
						</li>
						<li>
                            <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl04_SelectedCategoryBullet" class="GamesBullet" src="images/games_bullet.png" border="0"/>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl07_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=9&t='.htmlspecialchars($this->t).'&d=All"><b>Places</b></a>
						</li>
                        ';
                        break;
                    case "10":
                        echo '
                        <li>  
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=2&t='.htmlspecialchars($this->t).'&d=All">T-Shirts</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=11&t='.htmlspecialchars($this->t).'&d=All">Shirts</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl03_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=12&t='.htmlspecialchars($this->t).'&d=All">Pants</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl04_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=8&t='.htmlspecialchars($this->t).'&d=All">Hats</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl05_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=13&t='.htmlspecialchars($this->t).'&d=All">Decals</a>
						</li>
						<li>
                            <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl04_SelectedCategoryBullet" class="GamesBullet" src="images/games_bullet.png" border="0"/>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl06_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=10&t='.htmlspecialchars($this->t).'&d=All"><b>Models</b></a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl07_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=9&t='.htmlspecialchars($this->t).'&d=All">Places</a>
						</li>
                        ';
                        break;
                    case "11":
                        echo '
                        <li>  
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=2&t='.htmlspecialchars($this->t).'&d=All">T-Shirts</a>
						</li>
						<li>
                            <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl04_SelectedCategoryBullet" class="GamesBullet" src="images/games_bullet.png" border="0"/>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=11&t='.htmlspecialchars($this->t).'&d=All"><b>Shirts</b></a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl03_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=12&t='.htmlspecialchars($this->t).'&d=All">Pants</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl04_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=8&t='.htmlspecialchars($this->t).'&d=All">Hats</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl05_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=13&t='.htmlspecialchars($this->t).'&d=All">Decals</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl06_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=10&t='.htmlspecialchars($this->t).'&d=All">Models</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl07_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=9&t='.htmlspecialchars($this->t).'&d=All">Places</a>
						</li>
                        ';
                        break;
                    case "12":
                        echo '
                        <li>  
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=2&t='.htmlspecialchars($this->t).'&d=All">T-Shirts</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=11&t='.htmlspecialchars($this->t).'&d=All">Shirts</a>
						</li>
						<li>
                            <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl04_SelectedCategoryBullet" class="GamesBullet" src="images/games_bullet.png" border="0"/>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl03_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=12&t='.htmlspecialchars($this->t).'&d=All"><b>Pants</b></a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl04_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=8&t='.htmlspecialchars($this->t).'&d=All">Hats</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl05_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=13&t='.htmlspecialchars($this->t).'&d=All">Decals</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl06_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=10&t='.htmlspecialchars($this->t).'&d=All">Models</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl07_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=9&t='.htmlspecialchars($this->t).'&d=All">Places</a>
						</li>
                        ';
                        break;
                    case "13":
                        echo '
                        <li>  
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=2&t='.htmlspecialchars($this->t).'&d=All">T-Shirts</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=11&t='.htmlspecialchars($this->t).'&d=All">Shirts</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl03_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=12&t='.htmlspecialchars($this->t).'&d=All">Pants</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl04_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=8&t='.htmlspecialchars($this->t).'&d=All">Hats</a>
						</li>
						<li>
                            <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl04_SelectedCategoryBullet" class="GamesBullet" src="images/games_bullet.png" border="0"/>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl05_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=13&t='.htmlspecialchars($this->t).'&d=All"><b>Decals</b></a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl06_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=10&t='.htmlspecialchars($this->t).'&d=All">Models</a>
						</li>
						<li>
							<a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl07_AssetCategorySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c=9&t='.htmlspecialchars($this->t).'&d=All">Places</a>
						</li>
                        ';
                        break;
                }
						echo '
					
						</ul>
					
			</div>
			
			<div id="ctl00_cphRoblox_rbxCatalog_Timespan">
				';
                    if (in_array($this->m, array("BestSelling","TopFavorite","RecentlyUpdated"))) {
                        echo '
                        <h4>Time</h4>
				        <ul>
                        ';
                        switch ($this->t) {
                            case "PastDay":
                                echo '
                                <li><img id="ctl00_cphRoblox_rbxCatalog_TimespanPastWeekBullet" class="GamesBullet" src="images/games_bullet.png" border="0" /><a id="ctl00_cphRoblox_rbxCatalog_TimespanPastDaySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=PastDay&d=All"><b>Past Day</b></a></li>
                                <li><a id="ctl00_cphRoblox_rbxCatalog_TimespanPastWeekSelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=PastWeek&d=All">Past Week</a></li>
                                <li><a id="ctl00_cphRoblox_rbxCatalog_TimespanPastMonthSelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=PastMonth&d=All">Past Month</a></li>
                                <li><a id="ctl00_cphRoblox_rbxCatalog_TimespanAllTimeSelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=AllTime&d=All">All-time</a></li>
                                ';
                                break;
                            case "PastWeek":
                                echo '
                                <li><a id="ctl00_cphRoblox_rbxCatalog_TimespanPastDaySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=PastDay&d=All">Past Day</a></li>
                                <li><img id="ctl00_cphRoblox_rbxCatalog_TimespanPastWeekBullet" class="GamesBullet" src="images/games_bullet.png" border="0" /><a id="ctl00_cphRoblox_rbxCatalog_TimespanPastWeekSelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=PastWeek&d=All"><b>Past Week</b></a></li>
                                <li><a id="ctl00_cphRoblox_rbxCatalog_TimespanPastMonthSelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=PastMonth&d=All">Past Month</a></li>
                                <li><a id="ctl00_cphRoblox_rbxCatalog_TimespanAllTimeSelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=AllTime&d=All">All-time</a></li>
                                ';
                                break;
                            case "PastMonth":
                                echo '
                                <li><a id="ctl00_cphRoblox_rbxCatalog_TimespanPastDaySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=PastDay&d=All">Past Day</a></li>
                                <li><a id="ctl00_cphRoblox_rbxCatalog_TimespanPastWeekSelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=PastWeek&d=All">Past Week</a></li>
                                <li><img id="ctl00_cphRoblox_rbxCatalog_TimespanPastWeekBullet" class="GamesBullet" src="images/games_bullet.png" border="0" /><a id="ctl00_cphRoblox_rbxCatalog_TimespanPastMonthSelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=PastMonth&d=All"><b>Past Month</b></a></li>
                                <li><a id="ctl00_cphRoblox_rbxCatalog_TimespanAllTimeSelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=AllTime&d=All">All-time</a></li>
                                ';
                                break;
                            case "AllTime":
                                echo '
                                <li><a id="ctl00_cphRoblox_rbxCatalog_TimespanPastDaySelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=PastDay&d=All">Past Day</a></li>
                                <li><a id="ctl00_cphRoblox_rbxCatalog_TimespanPastWeekSelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=PastWeek&d=All">Past Week</a></li>
                                <li><a id="ctl00_cphRoblox_rbxCatalog_TimespanPastMonthSelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=PastMonth&d=All">Past Month</a></li>
                                <li><img id="ctl00_cphRoblox_rbxCatalog_TimespanPastWeekBullet" class="GamesBullet" src="images/games_bullet.png" border="0" /><a id="ctl00_cphRoblox_rbxCatalog_TimespanAllTimeSelector" href="Catalog.aspx?m='.htmlspecialchars($this->m).'&c='.htmlspecialchars($this->c).'&t=AllTime&d=All"><b>All-time</b></a></li>
                                ';
                                break;
                        }
                        echo '</ul>';
                    } elseif ($this->m == "ForSale") {
                        echo '<h4>Currency</h4>
                        <ul>';
                        switch ($this->d) {#
                            case "All": 
                                echo '
                                <li><img id="ctl00_cphRoblox_rbxCatalog_CurrencyAllBullet" class="GamesBullet" src="/images/games_bullet.png" border="0"><a href="Catalog.aspx?m=ForSale&amp;c='.htmlspecialchars($this->c).'&amp;t=PastWeek&amp;d=All"><b>All</b></a></li>
                                <li><a href="Catalog.aspx?m=ForSale&amp;c='.htmlspecialchars($this->c).'&amp;t=PastWeek&amp;d=Robux">'.Site::getThemeProperty("currency",$this->theme).'</a></li>
                                <li><a href="Catalog.aspx?m=ForSale&amp;c='.htmlspecialchars($this->c).'&amp;t=PastWeek&amp;d=Tickets">Tickets</a></li>
                                ';
                                break;
                            case "Robux": 
                                echo '
                                <li><a href="Catalog.aspx?m=ForSale&amp;c='.htmlspecialchars($this->c).'&amp;t=PastWeek&amp;d=All">All</a></li>
                                <li><img id="ctl00_cphRoblox_rbxCatalog_CurrencyAllBullet" class="GamesBullet" src="/images/games_bullet.png" border="0"><a href="Catalog.aspx?m=ForSale&amp;c='.htmlspecialchars($this->c).'&amp;t=PastWeek&amp;d=Robux"><b>'.Site::getThemeProperty("currency",$this->theme).'</b></a></li>
                                <li><a href="Catalog.aspx?m=ForSale&amp;c='.htmlspecialchars($this->c).'&amp;t=PastWeek&amp;d=Tickets">Tickets</a></li>
                                ';
                                break;
                            case "Tickets": 
                                echo '
                                <li><a href="Catalog.aspx?m=ForSale&amp;c='.htmlspecialchars($this->c).'&amp;t=PastWeek&amp;d=All">All</a></li>
                                <li><a href="Catalog.aspx?m=ForSale&amp;c='.htmlspecialchars($this->c).'&amp;t=PastWeek&amp;d=Robux">'.Site::getThemeProperty("currency",$this->theme).'</a></li>
                                <li><img id="ctl00_cphRoblox_rbxCatalog_CurrencyAllBullet" class="GamesBullet" src="/images/games_bullet.png" border="0"><a href="Catalog.aspx?m=ForSale&amp;c='.htmlspecialchars($this->c).'&amp;t=PastWeek&amp;d=Tickets"><b>Tickets</b></a></li>
                                ';
                                break;
                        }
                        echo '</ul>';
                    }
					
				echo '
			</div>
		</div>
        ';
    }
    public function getPrice($item) {
        if ($item["onsale"] == 1) {
            if ($item["priceInTix"] > 0 && $item["priceInBoombux"] > 0) {
                return '<div class="AssetPrice"><span class="PriceInRobux">'.Site::getThemeProperty("shortCurrency",$this->theme).': '.number_format($item["priceInBoombux"]).'</span></div>
                <div class="AssetPrice"><span class="PriceInTickets">Tx: '.number_format($item["priceInTix"]).'</span></div>';
            } elseif ($item["priceInBoombux"] > 0) {
                return '<div class="AssetPrice"><span class="PriceInRobux">'.Site::getThemeProperty("shortCurrency",$this->theme).': '.number_format($item["priceInBoombux"]).'</span></div>';
            } elseif ($item["priceInTix"] > 0) {
                return '<div class="AssetPrice"><span class="PriceInTickets">Tx: '.number_format($item["priceInTix"]).'</span></div>';
            }
        }
    }
    public function loadItems($items) {
        $start = ($this->p - 1) * 20;
        $counter = 0;
        $trCounter = 0;

        foreach ($items->fetchAll(PDO::FETCH_ASSOC) as $item) {
            $sales = 0;
            $item["itemType"] == "catalog" && $sales = $item["interactions"];
            if ($item["itemType"] == "game" && $this->m == "BestSelling") {break;}
            if ($counter >= $start && $counter < $start + 20) {
                if ($counter % 5 == 0 && $trCounter < 5) {
                    echo '<tr>';
                    $trCounter += 1;
                }
                $asset = new Asset($item["itemId"]);
                $thumbnail = $asset->GetThumbnail(250, 250, "PNG");
                echo '
                <td valign="top">
                    <div class="Asset">
                        <div class="AssetThumbnail">
                            <a title="'.htmlspecialchars($item["itemName"]).'" href="/Item.aspx?ID='.htmlspecialchars($item["itemId"]).'" style="display:inline-block;cursor:pointer;">
                                <img style="height:120px;width:120px;" src="'.$thumbnail.'" border="0" alt="'.htmlspecialchars($item["itemName"]).'" blankUrl="/cdn/broken-120x120.png"/>
                            </a>
                        </div>
                        <div class="AssetDetails">
                            <div class="AssetName"><a href="Item.aspx?ID='.htmlspecialchars($item["itemId"]).'">'.htmlspecialchars($item["itemName"]).'</a></div>
                            <div class="AssetLastUpdate"><span class="Label">Updated:</span> <span class="Detail">'.Helper::timeAgo($item["lastUpdate"]).'</span></div>
                            <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a href="User.aspx?ID='.htmlspecialchars($item["creatorId"]).'">'.htmlspecialchars($item["creatorName"]).'</a></span></div>
                            <div class="AssetsSold"><span class="Label">Number Sold:</span> <span class="Detail">'.Helper::times($sales).'</span></div>
                            <div class="AssetFavorites"><span class="Label">Favorited:</span> <span class="Detail">'.Helper::times($item["favorites"]).'</span></div>
                            '.$this->getPrice($item).'
                        </div>
                    </div>
                </td>
                ';
                if (($counter + 1) % 5 == 0) {
                    echo '</tr>';
                }
            }
            
            $counter++;
        }
    }
    
}
?>