<?php
global $theme;
?>

<div id="Body">
	<div id="BadgesContainer">
		<div id="ctl00_cphRoblox_aBadgesAndRankings">
			<input type="hidden" name="ctl00$cphRoblox$aBadgesAndRankings_AccordionExtender_ClientState" id="ctl00_cphRoblox_aBadgesAndRankings_AccordionExtender_ClientState" value="0">
			<div>
				<h4 class="TopAccordionHeader" onclick="javascript:ShowBadgeList(1)">Community Badges</h4>
			</div>
			<div id="ctl00_cphRoblox_BadgeContent1" class="BadgeContent" style="display:block;">
				<div id="CommunityBadges">
					<div class="Legend">
						<ul class="BadgesList">
							<li id="Administrator">
								<h4>Administrator Badge</h4>
								<div>This badge identifies an account as belonging to a <?=Site::getThemeProperty("name", $theme)?> administrator. Only official <?=Site::getThemeProperty("name", $theme)?> administrators will possess this badge. If someone claims to be an admin, but does not have this badge, they are potentially trying to mislead you. If this happens, please report abuse and we will delete the imposter's account.</div>
							</li>
							<li id="ForumModerator">
								<h4>Forum Moderator Badge</h4>
								<div>Users with this badge are forum moderators. They have special powers on the <?=Site::getThemeProperty("alias", $theme)?> forum and are able to delete threads that violate the Community Guidelines. Users who are exemplary citizens on <?=Site::getThemeProperty("alias", $theme)?> over a long period of time may be invited to be moderators. This badge is granted by invitation only.</div>
							</li>
							<li id="ImageModerator">
								<h4>Image Moderator Badge</h4>
								<div>Users with this badge are image moderators. Image moderators have special powers on <?=Site::getThemeProperty("alias", $theme)?> that allow them to approve or disapprove images that other users upload. Rejected images are immediately banished from the site. Users who are exemplary citizens on <?=Site::getThemeProperty("alias", $theme)?> over a long period of time may be invited to be moderators. This badge is granted by invitation only.</div>
							</li>
						</ul>
					</div>
					<div id="FeaturedBadge_Community">
						<h4><?=Site::getThemeProperty("membership", $theme)?></h4>
						<div class="FeaturedBadgeContent">
							<div class="FeaturedBadgeIcon">
								<img id="ctl00_cphRoblox_ctl01_iFeaturedBadge_Community" src="/images/Badges/<?=str_replace(" ", "",Site::getThemeProperty("membership", $theme))?>-125x125.png" height="125" width="125" border="0">
							</div>
							<p>Members of the illustrious <?=Site::getThemeProperty("membership", $theme)?> display this badge proudly. The <?=Site::getThemeProperty("membership", $theme)?> is a paid premium service. Members receive several benefits: they get ten places on their account instead of one, they earn a daily income of 15 <?=Site::getThemeProperty("currency", $theme)?>, they can sell their creations to others in the <?=Site::getThemeProperty("alias", $theme)?> Catalog, they get the ability to browse the web site without external ads, and they receive the exclusive <?=Site::getThemeProperty("membership", $theme)?> construction hat.</p>
						</div>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
			<div>
				<h4 class="AccordionHeader" onclick="javascript:ShowBadgeList(2)">Builder Badges</h4>
			</div>
			<div id="ctl00_cphRoblox_BadgeContent2" class="BadgeContent" style="display:none;">
				<div id="VisitsBadges">
					<div class="Legend">
						<ul class="BadgesList">
							<li id="Homestead">
								<h4>Homestead Badge</h4>
								<div>The homestead badge is earned by having your personal place visited 100 times. Players who achieve this have demonstrated their ability to build cool things that other <?=Site::getThemeProperty("name", $theme)?>ians were interested enough in to check out. Get a jump-start on earning this reward by inviting people to come visit your place.</div>
							</li>
							<li id="Bricksmith">
								<h4>Bricksmith Badge</h4>
								<div>The Bricksmith badge is earned by having a popular personal place. Once your place has been visited 1000 times, you will receive this award. <?=Site::getThemeProperty("name", $theme)?>ians with Bricksmith badges are accomplished builders who were able to create a place that people wanted to explore a thousand times. They no doubt know a thing or two about putting bricks together.</div>
							</li>
						</ul>
					</div>
					<div id="StatisticsRankingsPane_Visits"></div>
					<div style="clear:both;"></div>
				</div>
			</div>
			<div>
				<h4 class="AccordionHeader" onclick="javascript:ShowBadgeList(3)">Friendship Badges</h4>
			</div>
			<div id="ctl00_cphRoblox_BadgeContent3" class="BadgeContent" style="display:none;">
				<div id="FriendshipBadges">
					<div class="Legend">
						<ul class="BadgesList">
							<li id="Friendship">
								<h4>Friendship Badge</h4>
								<div>This badge is given to players who have embraced the <?=Site::getThemeProperty("name", $theme)?> community and have made at least 20 friends. People who have this badge are good people to know and can probably help you out if you are having trouble.</div>
							</li>
							<li id="Inviter">
								<h4>Inviter Badge</h4>
								<div><?=Site::getThemeProperty("name", $theme)?>ia is a vast uncharted realm, as large as the imagination. Individuals who invite others to join in the effort of mapping this mysterious region are honored in <?=Site::getThemeProperty("name", $theme)?>ian society. Citizens who successfully recruit three or more fellow explorers via the Share <?=Site::getThemeProperty("name", $theme)?> with a Friend mechanism are awarded with this badge.</div>
							</li>
						</ul>
					</div>
					<div id="StatisticsRankingsPane_Friendship"></div>
					<div style="clear:both;"></div>
				</div>
			</div>
			<div>
				<h4 class="BottomAccordionHeader" onclick="javascript:ShowBadgeList(4)">Combat Badges</h4>
			</div>
			<div id="ctl00_cphRoblox_BadgeContent4" class="BadgeContent" style="display:none;">
				<div id="CombatBadges">
					<div class="Legend">
						<ul class="BadgesList">
							<li id="CombatInitiation">
								<h4>Combat Initiation Badge</h4>
								<div>This badge is given to any player who has proven his or her combat abilities by accumulating 10 victories in battle. Players who have this badge are not complete newbies and probably know how to handle their weapons.</div>
							</li>
							<li id="Warrior">
								<h4>Warrior Badge</h4>
								<div>This badge is given to the warriors of <?=Site::getThemeProperty("name", $theme)?>ia, who have time and time again overwhelmed their foes in battle. To earn this badge, you must rack up 100 knockouts. Anyone with this badge knows what to do in a fight!</div>
							</li>
							<li id="Bloxxer">
								<h4>Bloxxer Badge</h4>
								<div>Anyone who has earned this badge is a very dangerous player indeed. Those <?=Site::getThemeProperty("name", $theme)?>ians who excel at combat can one day hope to achieve this honor, the Bloxxer Badge. It is given to the warrior who has bloxxed at least 250 enemies and who has tasted victory more times than he or she has suffered defeat. Salute!</div>
							</li>
						</ul>
					</div>
					<div id="StatisticsRankingsPane_Combat"></div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
	</div>
</div>