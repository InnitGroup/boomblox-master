<?php
class HomeManager {
    private $theme;
    private $user;
    public function __construct($theme) {
        global $user;
        $this->theme = (int)$theme;
        $this->user = $user;
    }
    public function signInPane() {
        $avatar = new Avatar($this->user->getUserId());
        $avatar = $avatar->GetThumbnail(540,660,"PNG");

        return '
        <div id="SignInPane">
            <div id="LoginViewContainer">
                <div id="LoginView">
                    <h5 id="loginViewTitle">Logged in</h5>
                        <div id="AlreadySignedIn"></div>
                        <a title="'.$this->user->getData("user","username").'" style="display:inline-block;height:190px;width:152px;cursor:pointer;" href="/User.aspx">
                            <img src="'.$avatar.'" style="display:inline-block;height:175px;width:145px;margin-top:15px;" border="0" alt="'.$this->user->getData("user","username").'">
                        </a>
		    	    </div>
	    	        <br>
                    <div>
                        <div class="RobloxNews">
                            <br>
                            <h3 style="color: gray;">'.Site::getThemeProperty("alias",$this->theme).' News</h3>
                            <br>
                            <div id="RobloxNews">
                            </div>
                        </div>
                    </div>
                </div>
			<br/>    
		</div>
        ';
    }
    public function atAGlance() {
        return '
        <div id="RobloxAtAGlance">
			<h2>'.Site::getThemeProperty("alias",$this->theme).' Virtual Playworld</h2>
			<h3>'.Site::getThemeProperty("alias",$this->theme).' is Free!</h3>
			<ul id="ThingsToDo">
				<li id="Point1">
					<h3>Build your personal Place</h3>
					<div>Create buildings, vehicles, scenery, and traps with thousands of virtual bricks.</div>
				</li>
				<li id="Point2">
					<h3>Meet new friends online</h3>
					<div>Visit your friend\'s place, chat in 3D, and build together.</div>
				</li>
				<li id="Point3">
					<h3>Battle in the Brick Arenas</h3>
					<div>Play with the slingshot, rocket, or other brick battle tools.  Be careful not to get "bloxxed".</div>
				</li>
			</ul>
			<div id="Showcase">
			    <iframe width="400" height="326" src="https://www.youtube.com/embed/JTllO3ktfDY?si=Ia-ZX73qEYMZ3uPx?autoplay=1&loop=1&controls=0" frameborder="0" allowfullscreen></iframe>
            </div>
			<div id="Install"><br></div>
			<div id="ctl00_cphRoblox_pForParents">
			<div id="ForParents">
				<a id="ctl00_cphRoblox_hlKidSafe" title="'.Site::getThemeProperty("alias",$this->theme).' is kid-safe!" href="Parents.aspx" style="display:inline-block;"><img title="'.Site::getThemeProperty("alias",$this->theme).' is kid-safe!" src="images/COPPASeal-125x125.jpg" border="0"/></a>
			</div>
        </div>
	    </div>
        ';
    }
    public function userPlaces() {
        global $db;
        $stmt = "SELECT * FROM items WHERE itemType='game' AND access=1 ORDER BY rand() LIMIT 5";
        $result = $db->execute($stmt);
        $coolplaces = '';

        if ($result->rowCount() > 0) {
            $places = $result->fetchAll(PDO::FETCH_ASSOC);
            #print_r($places);
            foreach ($places as $place) {
                $asset = new Asset($place["itemId"]);
                $render = $asset->GetThumbnail(420, 230, "PNG");
                $coolplaces .= '
                <td class="UserPlace">
                    <a id="ctl00_cphRoblox_CoolPlacesDataList_ctl00_rbxContentImage" title="'.htmlspecialchars($place["itemName"]).'" href="/Item.aspx?ID='.(int)$place["itemId"].'" style="display:inline-block;cursor:pointer;"><img style="width:120px;height:70px;" src="'.$render.'" border="0" alt="'.htmlspecialchars($place["itemName"]).'" blankurl="http://t2.xoblog.dev:80/blank-120x70.gif"/></a>
                </td>
                ';
            }
        }
        return '
        <div id="UserPlacesPane">
            <div id="UserPlaces_Content">
                <table id="ctl00_cphRoblox_CoolPlacesDataList" cellspacing="0" border="0" width="100%">
                    <tr>
                        '.$coolplaces.'
                    </tr>
                </table>
            </div>
            <div id="UserPlaces_Header">
                <h3>Cool Places</h3>
                <p>Check out some of our favorite '.Site::getThemeProperty("alias",$this->
                theme).' places!</p>
            </div>
	        <div id="ctl00_cphRoblox_ie6_peekaboo" style="clear: both"></div>
        </div>
        ';
    }

    public function start() {
        echo '
        <div id="SplashContainer">
        '.$this->signInPane(), $this->atAGlance(), $this->userPlaces().'
        </div>
    ';
    }
}
?>