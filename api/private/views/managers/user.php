<?php
class UserManager {
    private $user;
    private $userId;
    private $publicView;
    private $theme;
    private $badges;
    private $invPage = 1;
    private $favPage = 1;
    private $viewstate;
    private $invCategory = "8";
    private $favCategory = "9";
    private $inventoryEndpoint = "'api/public/views/Inventory.php'";
    private $favoritesEndpoint = "'api/public/views/Favorites.php'";

    public function __construct($userId = 0, $publicView = false, $theme = 1, $postData = []) {
        $this->userId = (int)$userId;
        $this->theme = (int)$theme;
        
        if ($userId == 0) {
            global $user;
            $this->user = $user;
            $this->userId = $user->getUserId();
            $publicView && $this->publicView = false;
        } else {
            global $db;
            if (!$db->userExists($userId)) {
                Server::_404();
            }
            $this->user = new User((int)$userId);
            $this->publicView = $publicView;
        };

        switch ($postData[1]) {
            case 'ct100$rbx$CreatePlace':
                if ($this->user->getAvailablePlaces() > 0) {
                    $this->user->givePlace();
                }
                break;
            case 'ctl00$FriendRequests$DeclineAll':
                $this->user->declineAllInvites();
                break;
            case 'ctl00$FriendRequests$AcceptAll':
                $this->user->acceptAllInvites();
                break;
            case 'ctl00$robloxCph$RemoveFavorite';
                #var_dump($_POST);
                $this->user->removeFavorite($_POST['__EVENTTARGET']);
                header("Location: ".$_SERVER["REQUEST_URI"]);
                break;
        }

        if (!empty($postData[0])) {
            $decryptedPostData = explode("\$", $postData[1]);
            if (!empty($decryptedPostData[0]) && !empty($decryptedPostData[1]) && !empty($decryptedPostData[2])) {
                $first = $decryptedPostData[0]; # can be asset type id or page integer
                $second = $decryptedPostData[1]; # defines whether its the Paginator or AssetCategory
                $third = $decryptedPostData[2]; # defines viewstate
                $this->viewstate = $third;
                switch ($third) {
                    case "Favorites":
                        $second == "Paginator" && $this->favPage = (int)$first;
                        $this->favCategory = htmlspecialchars($postData[2]);
                        break;
                    case "Inventory":
                        $second == "Paginator" && $this->invPage = (int)$first;
                        $this->invCategory = htmlspecialchars($postData[2]);
                        $second == "AssetCategory" && $this->invCategory = htmlspecialchars($first);
                        break;
                }
                
            } else {
                $this->favPage = 1;
                $this->viewstate = "Favorites";
            }
        }
        
    }
    //head start
    public function loadTitle() {
        if ($this->userId == ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])) {
            return "My ".Site::getThemeProperty("alias", $this->theme)." Home Page";
        } else {
            return $this->user->getData("user", "username")."'s ".Site::getThemeProperty("alias", $this->theme)." Home Page";
        }
    }
    //loadProfilePane start
    public function loadProfilePane() {
        $avatar = new Avatar($this->userId);
        $user = $this->user;
        $publicView = $this->publicView;
        PageBuilder::addComponent("user", "profilepane", compact("avatar", "user", "publicView"));
    }
    //loadBadgesPane start
    public function addBadge($image, $alt, $height, $label) {
        $output = "";
        if ($this->badges !== 0 && $this->badges % 4 == 0) {
            $output .= "</tr>";
        }
        $this->badges += 1;
        return $output.'
        <td>
            <div class="Badge">
                <div class="BadgeImage">
                    <a href="Badges.aspx">
                        <img src="images/Badges/'.$image.'" alt="'.$alt.'" height="'.$height.'" border="0">
                    </a>
                </div>
                <div class="BadgeLabel">
                    <a href="Badges.aspx">'.$label.'</a>
                </div>
            </div>
        </td>
        ';
    }
    public function loadBadges() {
        $badges = "";
        if (in_array("Administrator", $this->user->typeStaff())) {
            $badges .= $this->addBadge(Site::getThemeProperty("alias", $this->theme).'Administrator-75x75.png',
            'This badge identifies an account as belonging to a '.Site::getThemeProperty("name", $this->theme).' administrator. Only official '.Site::getThemeProperty("name", $this->theme).' administrators will possess this badge. If someone claims to be an admin, but does not have this badge, they are potentially trying to mislead you. If this happens, please report abuse and we will delete the imposter\'s account.',
            75,
            'Administrator');
        }
        if (in_array("SuperModerator", $this->user->typeStaff())) {
            $badges .= $this->addBadge('SuperModerator-75x75.png',
            'This badge identifies an account as belonging to a '.Site::getThemeProperty("alias", $this->theme).' Super Moderator. Only official '.Site::getThemeProperty("alias", $this->theme).' moderators possess this badge. If someone claims to be a moderator, but does not have this badge, they are potentially trying to mislead you. Super Moderators are vigilant on all areas of '.Site::getThemeProperty("alias", $this->theme).' including the forums, images, game chats and some secret areas. They have the awesome power of the glowing hammer and are not afraid to use it.',
            75,
            'Super Moderator');
        }
        if (in_array("ForumModerator", $this->user->typeStaff())) {
            $badges .= $this->addBadge('ForumModerator-75x75.png',
            'Users with this badge are forum moderators. They have special powers on the '.Site::getThemeProperty("alias", $this->theme).' forum and are able to delete threads that violate the Community Guidelines. Users who are exemplary citizens on '.Site::getThemeProperty("alias", $this->theme).' over a long period of time may be invited to be moderators. This badge is granted by invitation only.',
            75,
            'Forum Moderator');
        }
        if (in_array("ImageModerator", $this->user->typeStaff())) {
            $badges .= $this->addBadge('ImageModerator-75x75.png',
            'Users with this badge are image moderators. Image moderators have special powers on '.Site::getThemeProperty("alias", $this->theme).' that allow them to approve or disapprove images that other users upload. Rejected images are immediately banished from the site. Users who are exemplary citizens on '.Site::getThemeProperty("alias", $this->theme).' over a long period of time may be invited to be moderators. This badge is granted by invitation only.',
            75,
            'Image Moderator');
        }
        if (in_array("FakeModerator", $this->user->typeStaff())) {
            $badges .= $this->addBadge(Site::getThemeProperty("alias", $this->theme).'Administrator-75x75.png',
            'This badge identifies an account as belonging to a '.Site::getThemeProperty("name", $this->theme).' administrator. Only official '.Site::getThemeProperty("name", $this->theme).' administrators will possess this badge. If someone claims to be an admin, but does not have this badge, they are potentially trying to mislead you. If this happens, please report abuse and we will delete the imposter\'s account.',
            75,
            'Administrator');
        }
        if ($this->user->getVisits() >= 1000) {
            $badges .= $this->addBadge('Bricksmith-54x75.png',
            'The Bricksmith badge is earned by having a popular personal place. Once your place has been visited 1000 times, you will receive this award. '.Site::getThemeProperty("name", $this->theme).'ians with Bricksmith badges are accomplished builders who were able to create a place that people wanted to explore a thousand times. They no doubt know a thing or two about putting bricks together.',
            75,
            'Bricksmith');
        }
        if ($this->user->getVisits() >= 100) {
            $badges .= $this->addBadge('Homestead-70x75.png',
            'The homestead badge is earned by having your personal place visited 100 times. Players who achieve this have demonstrated their ability to build cool things that other '.Site::getThemeProperty("name", $this->theme).'ians were interested enough in to check out. Get a jump-start on earning this reward by inviting people to come visit your place.',
            75,
            'Homestead');
        }
        if ($this->user->getData("user","kos") >= 250) {
            $badges .= $this->addBadge('Bloxxer-75x75.png',
            'Anyone who has earned this badge is a very dangerous player indeed. Those Robloxians who excel at combat can one day hope to achieve this honor, the Bloxxer Badge. It is given to the warrior who has bloxxed at least 250 enemies and who has tasted victory more times than he or she has suffered defeat. Salute!',
            75,
            'Bloxxer');
        }
        if ($this->user->getData("user","kos") >= 100) {
            $badges .= $this->addBadge('Warrior-75x75.png',
            'This badge is given to the warriors of '.Site::getThemeProperty("name", $this->theme).'ia, who have time and time again overwhelmed their foes in battle. To earn this badge, you must rack up 100 knockouts. Anyone with this badge knows what to do in a fight!',
            75,
            'Warrior');
        }
        if ($this->user->getData("user","kos") >= 10) {
            $badges .= $this->addBadge('CombatInitiation-75x75.png',
            'This badge is given to any player who has proven his or her combat abilities by accumulating 10 victories in battle. Players who have this badge are not complete newbies and probably know how to handle their weapons.',
            75,
            'Combat Initiation');
        }
        if ($this->user->joinDate(true) >= 365) {
            $badges .= $this->addBadge('Veteran-75x75.png',
            'This decoration is awarded to all citizens who have played '.Site::getThemeProperty("alias", $this->theme).' for at least a year. It recognizes stalwart community members who have stuck with us over countless releases and have helped shape '.Site::getThemeProperty("alias", $this->theme).' into the game that it is today. These medalists are the true steel, the core of the '.Site::getThemeProperty("name", $this->theme).'ian history ... and its future.',
            75,
            'Veteran');
        }
        if (count($this->user->getFriends(false)) >= 20) {
            $badges .= $this->addBadge('Friendship-75x75.png',
            'This badge is given to players who have embraced the '.Site::getThemeProperty("alias", $this->theme).' community and have made at least 20 friends. People who have this badge are good people to know and can probably help you out if you are having trouble.',
            75,
            'Friendship');
        }
        if ($this->user->hasBC()) {
            $badges .= $this->addBadge(str_replace(' ', '', Site::getThemeProperty("membership", $this->theme)).'-125x125.png',
            'Members of the illustrious '.Site::getThemeProperty("membership", $this->theme).' display this badge proudly. The '.Site::getThemeProperty("membership", $this->theme).' is a paid premium service. Members receive several benefits: they get ten places on their account instead of one, they earn a daily income of 15 '.Site::getThemeProperty("currency", $this->theme).', they can sell their creations to others in the '.Site::getThemeProperty("name", $this->theme).' Catalog, they get the ability to browse the web site without external ads, and they receive the exclusive '.Site::getThemeProperty("membership", $this->theme).' construction hat.',
            75,
            Site::getThemeProperty("membership", $this->theme));
        }
        if ($this->user->isInviter()) {
            $badges .= $this->addBadge(Site::getThemeProperty("alias", $this->theme).'Inviter-75x75.png',
            Site::getThemeProperty("name", $this->theme).'ia is a vast uncharted realm, as large as the imagination. Individuals who invite others to join in the effort of mapping this mysterious region are honored in '.Site::getThemeProperty("alias", $this->theme).'ian society. Citizens who successfully recruit three or more fellow explorers via the Share '.Site::getThemeProperty("alias", $this->theme).' with a Friend mechanism are awarded with this badge.',
            75,
            'Inviter');
        }
        if ($badges == "") {
            if ($this->publicView) {
                $badges = Site::noResults($this->user->getData("user", "username").' does not have any '.Site::getThemeProperty("name", $this->theme).' badges.');
            } else {
                $badges = Site::noResults("You do not yet have any ".Site::getThemeProperty("name", $this->theme)." badges.");
            }
        }
        return $badges;
    }
    public function loadBadgesPane() {
        echo '
            <div id="UserBadgesPane">
				<div id="UserBadges">
					<h4>
						<a href="Badges.aspx">Badges</a>
					</h4>
					<table cellspacing="0" align="Center" border="0">
						<tr>
                            '.$this->loadBadges().'
						</tr>
					</table>
				</div>
			</div>
        ';
    }
    //loadStatsPane start
    public function loadStatsPane() {
        echo '
            <div id="UserStatisticsPane" >
				<div id="UserStatistics" style="transition: height 0.5s ease-out; overflow: hidden; height: 200px;">
					<h4>Statistics</h4>
					<div class="Statistic">
						<div class="Label">
							<acronym title="The number of this user\'s friends.">Friends</acronym>:
						</div>
						<div class="Value">
							<span>'.number_format(count($this->user->getFriends(false))).' ( last week)</span>
						</div>
					</div>';
                    if (!$this->publicView) {
                        echo '
                        <div class="Statistic">
                            <div class="Label">
                                <acronym title="The number of this user\'s friends that they invited.">Friends Invited</acronym>:
                            </div>
                            <div class="Value">
                                <span> ( last week)</span>
                            </div>
                        </div>
                        ';
                    } echo '
					<div class="Statistic">
						<div class="Label">
							<acronym title="The number of posts this user has made to the '.Site::getThemeProperty("name", $this->theme).' forum.">Forum Posts</acronym>:
						</div>
						<div class="Value">
							<span>'.number_format($this->user->getForumPosts(NULL, true)).'</span>
						</div>
					</div>
					<div class="Statistic">
						<div class="Label">
							<acronym title="The number of times this user\'s profile has been viewed.">Profile Views</acronym>:
						</div>
						<div class="Value">
							<span>'.number_format($this->user->getProfileViews()).' ( last week)</span>
						</div>
					</div>
					<div class="Statistic">
						<div class="Label">
							<acronym title="The number of times this user\'s place has been visited.">Place Visits</acronym>:
						</div>
						<div class="Value">
							<span>'.number_format($this->user->getVisits()).' ('.number_format($this->user->getLastWeekVisits()).' last week)</span>
						</div>
					</div>
					<div class="Statistic">
						<div class="Label">
							<acronym title="The number of times this user\'s character has destroyed another user\'s character in-game.">Knockouts</acronym>:
						</div>
						<div class="Value">
							<span>'.number_format($this->user->getData("user", "kos")).' ('.number_format($this->user->getLastWeekKOs()).' last week)</span>
						</div>
					</div>';
                    if (!$this->publicView) {
                        echo '
                    <div class="Statistic">
						<div class="Label">
							<acronym title="The number of times this user\'s character has been destroyed by another user\'s character in-game.">Wipeouts</acronym>:
						</div>
						<div class="Value">
							<span>'.number_format($this->user->getData("user", "wos")).' ('.number_format($this->user->getLastWeekWOs()).' last week)</span>
						</div>
					</div>'; }
                    echo '
				</div>
			</div>
        ';
    }
    //loadPlaces start
    public function loadPlace($isFirst, $place, $id) {
        $display = $isFirst ? "block" : "none";
        $publicView = $this->publicView;
        $packed = compact("display", "place", "id", "publicView");
        if (Server::isIE7()) {
            PageBuilder::addComponent("user", "placeIE", $packed);
        } else {
            PageBuilder::addComponent("user", "place", $packed);
        }
    }
    public function loadPlaces() {
        if (Server::isIE7()) {
            PageBuilder::addComponent("user", "iescript");
        }
        $places = $this->user->getPlaces();
        if ($places) {
            $placeCount = 0;
            foreach ($places as $place) {
                if ($placeCount == 0) {
                    echo $this->loadPlace(true, $place, $placeCount);
                } else {
                    echo $this->loadPlace(false, $place, $placeCount);
                }
                $placeCount += 1;
            }
        } else {
            if ($this->publicView) {
                echo Site::noResults($this->user->getData("user","username")." has no places.");
            } else {
                echo Site::noResults("You have no places.");
            }
        }
    }
    //loadFriendsPane start
    public function loadFriends() {
        global $db;
        $friends = $this->user->getFriends(true);
        $result = "";
        if ($friends !== 0) {
            $friends = unserialize($friends);
            if (count($friends) == 0) {
                if ($this->publicView) {
                    return Site::noResults($this->user->getData("user","username")." has no friends.");
                } else {
                    return Site::noResults("You have no friends.");
                }
            }
            $friendsCount = 0;
            foreach ($friends as $friend) {
                if ($friendsCount == 6) {
                    break;
                }
                if ($friendsCount !== 0 && $friendsCount % 3 == 0) {
                    $result .= '</tr>';
                }
                $friendUser = new User($db->getIdByUser($friend));
                $avatar = new Avatar($db->getIdByUser($friend));
                $statusIndicator = $friendUser->isOnline() ? "Online" : "Offline";
                $actualStatus = $friendUser->isOnline() ? "online." : "offline (last seen at ".$friendUser->lastOnline().").";
                $result .= '
                            <td>
								<div class="Friend">
									<div class="Avatar">
										<a title="'.$friend.'" href="/User.aspx?ID='.$db->getIdByUser($friend).'" style="display:inline-block;cursor:pointer;">
											<img style="height:100px;" src="'.$avatar->GetThumbnail(500,500,"PNG").'" border="0" alt="'.$friend.'" blankUrl="http://t6.roblox.com:80/blank-100x100.gif" />
										</a>
									</div>
									<div class="Summary">
										<span class="OnlineStatus">
											<img src="images/OnlineStatusIndicator_Is'.$statusIndicator.'.gif" alt="'.$friend.' is '.$actualStatus.'" border="0" />
										</span>
										<span class="Name">
											<a href="User.aspx?ID='.$db->getIdByUser($friend).'">'.$friend.'</a>
										</span>
									</div>
								</div>
							</td>
                ';
                $friendsCount += 1;
            }
            return $result;
        } else {
            if ($this->publicView) {
                return Site::noResults($this->user->getData("user","username")." has no friends.");
            } else {
                return Site::noResults("You have no friends.");
            }
        }
    }
    public function loadFriendsPane() {
        $username = $this->user->getUsername();
        $userId = $this->user->getUserId();
        $friends = $this->loadFriends();
        $friendCount = count($this->user->getFriends(false));
        $publicView = $this->publicView;

        $packed = compact("username", "userId", "friends", "friendCount", "publicView");
        PageBuilder::addComponent("user", "friendspane", $packed);
    }
    
    //asset config start
    private $cToSQL = [
        "2" => "t-shirt",
        "8" => "Hat",
        "9" => "game",
        "10" => "Model",
        "11" => "Shirt",
        "12" => "Pants",
        "13" => "Decal",
        "17" => "Head"
    ];
    private $cToString = [
        "2" => "T-Shirts",
        "8" => "Hats",
        "9" => "Places",
        "10" => "Models",
        "11" => "Shirts",
        "12" => "Pants",
        "13" => "Decals",
        "17" => "Heads"
    ];
    
    public function loadFavPanePaginator($type) { // Header/Footer
        $page = 1;
        $category = "9";
        $page = $this->favPage;
        $category = $this->favCategory;
        $view = (int)$this->publicView;

        $pages = ceil($this->user->getFavorites($this->cToSQL[$category], true)/6);
        if ($pages < 2) {
            return false;
        }
        $paginator = '<div class="'.$type.'Pager">';
        if ($page > 1) {
            $paginator .= '<a href="javascript:__doWebPostBack('.$this->favoritesEndpoint.',\'FavoritesPane\', {\'userId\': '.$this->userId.',\'publicView\': '.$view.',\'theme\': '.$this->theme.',\'postData\': [\'PageSelector\',\''.(int)($page-1).'$Paginator$Favorites\','.$category.']})"><span class="NavigationIndicators">&lt;&lt; </span>Previous</a> ';
        }
        $paginator .= '<span>Page '.(int)$page.' of '.$pages.'</span>';
        if ($page < $pages && $pages > 1) {
            $paginator .= ' <a href="javascript:__doWebPostBack('.$this->favoritesEndpoint.',\'FavoritesPane\', {\'userId\': '.$this->userId.',\'publicView\': '.$view.',\'theme\': '.$this->theme.',\'postData\': [\'PageSelector\',\''.(int)($page+1).'$Paginator$Favorites\','.$category.']})">Next <span class="NavigationIndicators">&gt;&gt;</span></a>';
        }
        $paginator .= '</div>';
        return $paginator;
    }
    public function loadInvPanePaginator() {
        $page = 1;
        $category = "8";
        $page = $this->invPage;
        $category = $this->invCategory;
        $view = (int)$this->publicView;

        $pages = ceil($this->user->getItems($this->cToSQL[$category], true)/15);
        if ($pages < 2) {
            return false;
        }
        $paginator = '<div class="FooterPager">';
        if ($page > 1) {
            $paginator .= '<a href="javascript:__doWebPostBack('.$this->inventoryEndpoint.',\'UserAssetsPane\',{\'userId\': '.$this->userId.',\'publicView\': '.$view.',\'theme\': '.$this->theme.',\'postData\': [\'PageSelector\',\''.(int)($page-1).'$Paginator$Inventory\','.$category.']})"><span class="NavigationIndicators">&lt;&lt; </span>Previous</a> ';
        }
        $paginator .= '<span>Page '.(int)$page.' of '.$pages.'</span>';
        if ($page < $pages && $pages > 1) {
            $paginator .= ' <a href="javascript:__doWebPostBack('.$this->inventoryEndpoint.',\'UserAssetsPane\',{\'userId\': '.$this->userId.',\'publicView\': '.$view.',\'theme\': '.$this->theme.',\'postData\': [\'PageSelector\',\''.(int)($page+1).'$Paginator$Inventory\','.$category.']})">Next <span class="NavigationIndicators">&gt;&gt;</span></a>';
            
        }
        $paginator .= '</div>';
        return $paginator;
    }
    public function categorySelected($category, $value) {
        if ($category == null && $value == 9) {
            return 'selected="selected"';
        }
        if ((int)$category == (int)$value) {
            return 'selected="selected"';
        }
    }
    public function invCategorySelected($category, $value) {
        if ($category == null && $value == 9) {
            return '_Selected';
        }
        if ((int)$category == (int)$value) {
            return '_Selected';
        }
    }
    //loadFavoritesPane start
    public function loadFavorites() {
        $publicView = $this->publicView;
        $page = 1;
        $category = "9";
        $limit = 6;
        $page = $this->favPage;
        $category = $this->favCategory;
        $favorites = $this->user->getFavorites($this->cToSQL[$category]);
        $countedFavorites = 0;
        $result = '';
        if (count($favorites) > 0) {
            foreach ($favorites as $favorite) {
                $countedFavorites += 1;
                if ($countedFavorites > (($page-1)*$limit) && $countedFavorites < ($limit*$page)+1) { # countedFavorites > 6 && countedFavorites < 12
                    $asset = new Asset($favorite["itemId"]);
                    $thumb = $asset->GetThumbnail(250,250,"PNG");
                    $result .= '
                                        <td class="Asset" valign="top">
                                            <div style="padding:5px">';
                                            if (!$publicView) {$result .= '<a class="RemoveItem" href="javascript:__doPostBack(\''.$favorite["itemId"].'\', \'ctl00$robloxCph$RemoveFavorite\')" style="position:relative;left:20px;" onclick="wearItem(event)">&nbsp;[ delete ]&nbsp;</a>';}
                                                
                                                $result .= '<div class="AssetThumbnail">
                                                    <a title="'.htmlspecialchars(Helper::debugString($favorite["itemName"])).'" href="/Item.aspx?ID='.htmlspecialchars($favorite["itemId"]).'" style="display:inline-block;cursor:pointer;">
                                                        <img style="height:110px;width:110px;" src="'.$thumb.'" border="0" alt="'.htmlspecialchars(Helper::debugString($favorite["itemName"])).'">
                                                    </a>
                                                </div>
                                                <div class="AssetDetails">
                                                    <div class="AssetName">
                                                        <a href="Item.aspx?ID='.htmlspecialchars($favorite["itemId"]).'">'.htmlspecialchars(Helper::debugString(($favorite["itemName"]))).'</a>
                                                    </div>
                                                    <div class="AssetCreator">
                                                        <span class="Label">Creator:</span>
                                                        <span class="Detail">
                                                            <a href="User.aspx?ID='.htmlspecialchars($favorite["creatorId"]).'">'.htmlspecialchars(Helper::debugString($favorite["creatorName"])).'</a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                    ';
                    if ($countedFavorites % 3 == 0) {
                        $result .= '</tr>';
                    }
                } 
                
            }
        } else {
            if ($this->publicView) {
                return Site::noResults($this->user->getData("user", "username")." does not have any favorite ".$this->cToString[$category].".");
            } else {
                return Site::noResults("You do not have any favorite ".$this->cToString[$category].".");
            }
        }
        return $result;
    }
    public function loadFavoritesPane() {
        $view = (int)$this->publicView;
        echo '
				<div>
					<div id="Favorites">
                        <h4>Favorites</h4>
                        <div id="FavoritesContent" style="">
                            '.$this->loadFavPanePaginator("Header").'
                            <table id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList" cellspacing="0" border="0">
                                <tbody>
                                    '.$this->loadFavorites().'
                                </tbody>
                            </table>
                            '.$this->loadFavPanePaginator("Footer").'
                        </div>
                        <div class="PanelFooter"> Category:&nbsp; <select onchange="javascript:__doWebPostBack('.$this->favoritesEndpoint.',\'FavoritesPane\',{\'userId\': '.$this->userId.',\'publicView\': '.$view.',\'theme\': '.$this->theme.',\'postData\': [\'AssetCategory\',this.value + \'$AssetCategory$Favorites\',this.value]})" name="AssetCategory">
                                <option '.$this->categorySelected($this->favCategory, 17).' value="17">Heads</option>        
                                <option '.$this->categorySelected($this->favCategory, 2).' value="2">T-Shirts</option>
                                <option '.$this->categorySelected($this->favCategory, 11).' value="11">Shirts</option>
                                <option '.$this->categorySelected($this->favCategory, 12).' value="12">Pants</option>
                                <option '.$this->categorySelected($this->favCategory, 8).' value="8">Hats</option>
                                <option '.$this->categorySelected($this->favCategory, 13).' value="13">Decals</option>
                                <option '.$this->categorySelected($this->favCategory, 10).' value="10">Models</option>
                                <option '.$this->categorySelected($this->favCategory, 9).' value="9">Places</option>
                            </select>
                        </div>
                    </div>
				</div>
        ';
    }

    public function loadFriendRequests() {
        $user = $this->user;
        
        if (!$this->publicView) {
            PageBuilder::addComponent("user", "friendrequests", compact("user"));
        }
    }
    //loadInventoryPane
    public function addItemPrice($itemId) {
        global $db;
        $stmt = "SELECT * FROM items WHERE itemId=:itemId";
        $res = $db->execute($stmt,[":itemId" => (int)$itemId]);
        $res = $res->fetch(PDO::FETCH_ASSOC);
        if ($res["onsale"] == 1) {
            if ($res["priceInTix"] > 0) {
                return '<div class="AssetPrice"><span class="PriceInTickets">Tx: '.number_format((int)$res["priceInTix"]).'</span></div>';
            }
            if ($res["priceInBoombux"] > 0) {
                return '<div class="AssetPrice"><span class="PriceInRobux">'.Site::getThemeProperty("shortCurrency",$this->theme).': '.number_format((int)$res["priceInBoombux"]).'</span></div>';
            }
        }
    }
    public function loadInventory() {
        $page = 1;
        $category = "8";
        $limit = 15;
        $page = $this->invPage;
        $category = $this->invCategory;

        switch ($category) {
            case 9:
                $items = array_reverse($this->user->getPlaces());
                break;
            case 10:
                $items = array_reverse($this->user->getModels());
                break;
            default:
                $items = array_reverse($this->user->getItems($this->cToSQL[$category]));
                break;
        }

        $countedItems = 0;
        $result = '';
        if (count($items) > 0) {
            foreach ($items as $item) {
                $countedItems += 1;
                if ($countedItems > (($page-1)*$limit) && $countedItems < ($limit*$page)+1) { # countedFavorites > 6 && countedFavorites < 12
                    $asset = new Asset($item["itemId"]);
                    #$thumb = $asset->GetThumbnail(100,100,"PNG");
                    #if ($category == 10) {
                        $thumb = $asset->GetThumbnail(250,250,"PNG");
                    #}
                    $result .= '
                                        <td class="Asset" valign="top">
                                            <div style="padding:5px">
                                                <div class="AssetThumbnail">
                                                    <a title="'.htmlspecialchars($item["itemName"]).'" href="/Item.aspx?ID='.htmlspecialchars($item["itemId"]).'" style="display:inline-block;cursor:pointer;">
                                                        <img style="height:110px;width:110px;" src="'.$thumb.'" border="0" alt="'.htmlspecialchars($item["itemName"]).'">
                                                    </a>
                                                </div>
                                                <div class="AssetDetails">
                                                    <div class="AssetName">
                                                        <a href="Item.aspx?ID='.htmlspecialchars($item["itemId"]).'">'.htmlspecialchars($item["itemName"]).'</a>
                                                    </div>
                                                    <div class="AssetCreator">
                                                        <span class="Label">Creator:</span>
                                                        <span class="Detail">
                                                            <a href="User.aspx?ID='.htmlspecialchars($item["creatorId"]).'">'.htmlspecialchars($item["creatorName"]).'</a>
                                                        </span>
                                                    </div>
                                                    '.$this->addItemPrice($item["itemId"]).'
                                                </div>
                                            </div>
                                        </td>
                    ';
                    if ($countedItems % 5 == 0) {
                        $result .= '</tr>';
                    }
                } 
                
            }
        } else {
            if ($this->publicView) {
                return Site::noResults($this->user->getData("user", "username")." does not own any ".$this->cToString[$category].".");
            } else {
                return Site::noResults("You do not own any ".$this->cToString[$category].".");
            }
        }
        return $result;
    }
    public function loadInventoryPane() {
        $view = $this->publicView ?? 0;
        echo '

			<div>
				<div id="UserAssets">
					<h4>Stuff</h4>
                    <div>';
                        if ((bool)!$view) {
                            echo '
                                <a href="/Catalog.aspx?c='.$this->invCategory.'">Shop</a>
                                &nbsp;';
                                $type = Helper::itemType($this->invCategory);
                                if ($type->IsContent) {
                                    echo '<a href="/My/ContentBuilder.aspx?ContentType='.$this->invCategory.'">Create</a>';
                                } else {
                                    echo '<span style="color:gray;">Create</span>'; 
                                }
                        } echo '
                    </div>
					<div id="AssetsMenu">
                        <div class="AssetsMenuItem'.$this->invCategorySelected($this->invCategory, 17).'">
							<a class="AssetsMenuButton'.$this->invCategorySelected($this->invCategory, 17).'" href="javascript:__doWebPostBack('.$this->inventoryEndpoint.',\'UserAssetsPane\',{\'userId\': '.$this->userId.',\'publicView\': '.(int)$view.',\'theme\': '.$this->theme.',\'postData\': [\'AssetCategorySelector\',\'17$AssetCategory$Inventory\',17]})">Heads</a>
						</div>
						<div class="AssetsMenuItem'.$this->invCategorySelected($this->invCategory, 2).'">
							<a class="AssetsMenuButton'.$this->invCategorySelected($this->invCategory, 2).'" href="javascript:__doWebPostBack('.$this->inventoryEndpoint.',\'UserAssetsPane\',{\'userId\': '.$this->userId.',\'publicView\': '.(int)$view.',\'theme\': '.$this->theme.',\'postData\': [\'AssetCategorySelector\',\'2$AssetCategory$Inventory\',2]})">T-Shirts</a>
						</div>
						<div class="AssetsMenuItem'.$this->invCategorySelected($this->invCategory, 11).'">
							<a class="AssetsMenuButton'.$this->invCategorySelected($this->invCategory, 11).'" href="javascript:__doWebPostBack('.$this->inventoryEndpoint.',\'UserAssetsPane\',{\'userId\': '.$this->userId.',\'publicView\': '.(int)$view.',\'theme\': '.$this->theme.',\'postData\': [\'AssetCategorySelector\',\'11$AssetCategory$Inventory\',11]})">Shirts</a>
						</div>
						<div class="AssetsMenuItem'.$this->invCategorySelected($this->invCategory, 12).'">
							<a class="AssetsMenuButton'.$this->invCategorySelected($this->invCategory, 12).'" href="javascript:__doWebPostBack('.$this->inventoryEndpoint.',\'UserAssetsPane\',{\'userId\': '.$this->userId.',\'publicView\': '.(int)$view.',\'theme\': '.$this->theme.',\'postData\': [\'AssetCategorySelector\',\'12$AssetCategory$Inventory\',12]})">Pants</a>
						</div>
						<div class="AssetsMenuItem'.$this->invCategorySelected($this->invCategory, 8).'">
							<a class="AssetsMenuButton'.$this->invCategorySelected($this->invCategory, 8).'" href="javascript:__doWebPostBack('.$this->inventoryEndpoint.',\'UserAssetsPane\',{\'userId\': '.$this->userId.',\'publicView\': '.(int)$view.',\'theme\': '.$this->theme.',\'postData\': [\'AssetCategorySelector\',\'8$AssetCategory$Inventory\',8]})">Hats</a>
						</div>
						<div class="AssetsMenuItem'.$this->invCategorySelected($this->invCategory, 13).'">
							<a class="AssetsMenuButton'.$this->invCategorySelected($this->invCategory, 13).'" href="javascript:__doWebPostBack('.$this->inventoryEndpoint.',\'UserAssetsPane\',{\'userId\': '.$this->userId.',\'publicView\': '.(int)$view.',\'theme\': '.$this->theme.',\'postData\': [\'AssetCategorySelector\',\'13$AssetCategory$Inventory\',13]})">Decals</a>
						</div>
						<div class="AssetsMenuItem'.$this->invCategorySelected($this->invCategory, 10).'">
							<a class="AssetsMenuButton'.$this->invCategorySelected($this->invCategory, 10).'" href="javascript:__doWebPostBack('.$this->inventoryEndpoint.',\'UserAssetsPane\',{\'userId\': '.$this->userId.',\'publicView\': '.(int)$view.',\'theme\': '.$this->theme.',\'postData\': [\'AssetCategorySelector\',\'10$AssetCategory$Inventory\',10]})">Models</a>
						</div>
						<div class="AssetsMenuItem'.$this->invCategorySelected($this->invCategory, 9).'">
							<a class="AssetsMenuButton'.$this->invCategorySelected($this->invCategory, 9).'" href="javascript:__doWebPostBack('.$this->inventoryEndpoint.',\'UserAssetsPane\',{\'userId\': '.$this->userId.',\'publicView\': '.(int)$view.',\'theme\': '.$this->theme.',\'postData\': [\'AssetCategorySelector\',\'9$AssetCategory$Inventory\',9]})">Places</a>
						</div>
					</div>
					<div id="AssetsContent">
						<table cellspacing="0" border="0">
                        '.$this->loadInventory().'
						</table>
						'.$this->loadInvPanePaginator().'
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>

        ';
    }
}
?>