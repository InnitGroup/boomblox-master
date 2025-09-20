<?php
global $user;
$punishment = $user->getActivePunishment();
$type = $punishment["actionType"];
$length = $punishment["actionLength"];
$reportedtime = new DateTime($punishment["actionDate"]);
$datetime = new DateTime();
$reported = $reportedtime->format("n/j/Y g:i:s A");
$expiry = $reportedtime->modify("+$length day");
$title;
$description;

switch ($type) {
	case "Reminder":
		$title = "Reminder";
		break;
	case "Warn";
		$title = "Warning";
		break;
	case "Ban":
		$plural = $length > 1 ? "s" : "";
		$title = "Banned for " . $length . " Day" . $plural;
		break;
	case "Delete":
	case "Termination":
	case "Poison":
		$title = "Account Deleted";
		break;
}
?>

<div id="Body">
	<div style="margin: 150px auto 150px auto; width: 500px; border: black thin solid; padding: 22px;">
		<h2> <?=$title?> </h2>
		<p> Our content monitors have determined that your behavior at ROBLOX has been in violation of our Terms of Service. We will terminate your account if you do not abide by the rules.</p>
		<p> Reason: <span style="font-weight: bold"> Profanity</span>
			<br> Source: <span style="font-weight: bold"> <?=htmlspecialchars($punishment["actionSource"])?></span>
			<br> Reported: <span style="font-weight: bold"> <?=$reported?></span>
		</p>
		<p>
			<span style="font-weight: bold"> <?=htmlspecialchars($punishment["actionComment"])?></span>
		</p>
		<p> Please abide by the <a href="http://wiki.roblox.com/index.php?title=Community_Guidelines">ROBLOX Community Guidelines</a> so that ROBLOX can be fun for users of all ages. </p>
		<?php if ($type == "Ban") {
			PageBuilder::addComponent("notapproved", "disabled", compact("punishment"));
		}?>
		<div id="ctl00_cphRoblox_UpdatePanel1">
			<?php if ($datetime >= $expiry && $type !== "Termination") {
				PageBuilder::addComponent("notapproved", "activate");
			}?>
		</div>
	</div>
</div>