<?php
global $theme;
?>

<div id="Body">
	<h2>Contacting <?=Site::getThemeProperty("alias", $theme)?></h2>
	<h3>Customer Service</h3>
	<p>For customer service, billing and technical issues</p>
	<p>Email: info@<?=Site::getThemeProperty("url", $theme)?> (fastest response)</p>
	<p>Phone: 888-858-2569 ext 2</p>
	<h3>Advertising Sales</h3>
	<p>For advertising on <?=Site::getThemeProperty("alias", $theme)?> including display ads and integrated campaigns</p>
	<p>Email: adsales@<?=Site::getThemeProperty("url", $theme)?></p>
	<p>Phone: 888-858-2569 ext 3</p>
	<h3>Jobs at <?=Site::getThemeProperty("alias", $theme)?></h3>
    <?=$theme == 0 ? "This theme is purely for decoration and reflects no real Boomblox hiring process." : ""?>
	<p>Full-time inquiries only, adults 18+ years of age</p>
	<p>Website: jobs.<?=Site::getThemeProperty("url", $theme)?> (latest openings)</p>
	<p>Email: jobs<?=Site::getThemeProperty("url", $theme)?></p>
	<p>Phone: 888-858-2569 ext 1</p>
</div>