<?php
global $theme;
?>

<div id="Body">
	<div class="ParentsContainer">
		<div id="LeftColumn">
			<h2><?=Site::getThemeProperty("alias", $theme)?> Parents</h2>
			<div class="ParentsSection" id="ROBLOXGuide">
				<a id="ctl00_cphRoblox_RobloxGuideImageHyperLink" class="SectionIcon" text="<?=Site::getThemeProperty("alias", $theme)?> Guide" href="/Parents/RobloxGuide.aspx" style="display:inline-block;cursor:pointer;">
					<img style="height:115px;width:110px;" src="/images/Parents/<?=Site::getThemeProperty("name", $theme)?>Guide-110x115.png?t=<?=time()?>" border="0" blankurl="http://t3.roblox.com:80/blank-110x115.gif">
				</a>
				<h3>
					<a id="ctl00_cphRoblox_RobloxGuideHyperLink" href="Parents/RobloxGuide.aspx"><?=Site::getThemeProperty("alias", $theme)?> Guide</a>
				</h3>
				<p>Background information on the world of <?=Site::getThemeProperty("alias", $theme)?>, especially for parents.</p>
			</div>
			<div class="ParentsSection" id="KeepingKidsSafe">
				<a id="ctl00_cphRoblox_KeepingKidsSafeImageHyperLink" class="SectionIcon" text="Keeping Kids Safe" href="/Parents/KeepingKidsSafe.aspx" style="display:inline-block;cursor:pointer;">
					<img src="/images/Parents/<?=$theme == 0 || $theme > 2 ? "Boomblox" : ""?>KeepingKidsSafe-110x112.png" border="0" blankurl="http://t4.roblox.com:80/blank-110x112.gif">
				</a>
				<h3>
					<a id="ctl00_cphRoblox_KeepingKidsSafeHyperLink" href="Parents/KeepingKidsSafe.aspx">Keeping Kids Safe</a>
				</h3>
				<p>Information on how to keep your kids safe while online.</p>
			</div>
			<div class="ParentsSection" id="FAQs">
				<a id="ctl00_cphRoblox_FAQsImageHyperLink" class="SectionIcon" text="FAQs" href="/Parents/FAQs.aspx" style="display:inline-block;cursor:pointer;">
					<img src="/images/Parents/FAQs-110x110.png" border="0" blankurl="http://t6.roblox.com:80/blank-110x110.gif">
				</a>
				<h3>
					<a id="ctl00_cphRoblox_FAQsHyperLink" href="Parents/FAQs.aspx">FAQs</a>
				</h3>
				<p>Questions and answers just for parents.</p>
			</div>
		</div>
		<div id="RightColumn">
			<h2>&nbsp;</h2>
			<div class="ParentsSection" id="BuildersClub">
				<a id="ctl00_cphRoblox_BuildersClubImageHyperLink" class="SectionIcon" text="<?=Site::getThemeProperty("membership", $theme)?>" href="/Parents/BuildersClub.aspx" style="display:inline-block;cursor:pointer;">
					<img src="/images/Parents/BuildersClub-110x110.png" border="0" blankurl="http://t6.roblox.com:80/blank-110x110.gif">
				</a>
				<h3>
					<a id="ctl00_cphRoblox_BuildersClubHyperLink" href="Parents/BuildersClub.aspx"><?=Site::getThemeProperty("membership", $theme)?></a>
				</h3>
				<p>Play for free, or enhance your experience with <?=Site::getThemeProperty("membership", $theme)?>.</p>
			</div>
			<div class="ParentsSection" id="ROBLOXAndLearning">
				<a id="ctl00_cphRoblox_ROBLOXAndLearningImageHyperLink" class="SectionIcon" text="ROBLOX and Learning" href="/Parents/ROBLOXAndLearning.aspx" style="display:inline-block;cursor:pointer;">
					<img src="/images/Parents/RobloxAndLearning-110x110.png" border="0" blankurl="http://t6.roblox.com:80/blank-110x110.gif">
				</a>
				<h3>
					<a id="ctl00_cphRoblox_ROBLOXAndLearningHyperLink" href="Parents/RobloxAndLearning.aspx"><?=Site::getThemeProperty("alias", $theme)?> and Learning</a>
				</h3>
				<p><?=Site::getThemeProperty("alias", $theme)?> kids learn engineering, design, science and programming while playing.</p>
			</div>
			<div class="ParentsSection" id="WhatParentsAreSaying">
				<a id="ctl00_cphRoblox_WhatParentsAreSayingImageHyperLink" class="SectionIcon" text="What Parents are Saying" href="/Parents/WhatParentsAreSaying.aspx" style="display:inline-block;cursor:pointer;">
					<img src="/images/Parents/WhatParentsAreSaying-110x110.png" border="0" blankurl="http://t6.roblox.com:80/blank-110x110.gif">
				</a>
				<h3>
					<a id="ctl00_cphRoblox_WhatParentsAreSayingHyperLink" href="Parents/WhatParentsAreSaying.aspx">What Parents are Saying</a>
				</h3>
				<p>Hear what other parents are saying about <?=Site::getThemeProperty("alias", $theme)?>.</p>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
</div>