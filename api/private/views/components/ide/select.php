<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $auth;
!$auth->isAuthed() && Server::_404();;
$user = new User(ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]));
$places = $user->getPlaces();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Upload</title>
		<link href="/CSS/RobloxOld.css" rel="stylesheet" type="text/css" />
        <script src="http://<?=domain?>/ScriptResource.axd?d=dXBsb2Fk"></script>
        <script>
            function __doPostBack(eventTarget, eventArgument) {
                document.PublishContent.__EVENTTARGET.value = eventTarget;
                document.PublishContent.__EVENTARGUMENT.value = eventArgument;
                publishRegular(eventArgument);
                document.PublishContent.submit();
            }
        </script>
	</head>
	<body bgcolor="buttonface" scroll="no">
		<form name="PublishContent" method="post" action="Upload.aspx" id="PublishContent">
			<div>
				<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
				<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
				<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTg1NjY2NjQ3OA9kFgICAQ9kFgICAQ9kFgQCAg9kFgICAQ9kFgICAQ8WAh4LXyFJdGVtQ291bnQCARYCAgEPZBYEAgEPDxYCHg9Db21tYW5kQXJndW1lbnQFCDQ2NjE2MzIwZGQCAw8WAh4EVGV4dAUnUk9CTE9YIHRoZWFjaGluZyBzY2hvb2wgMShtYWRlIGluIDIwMTEpZAIDD2QWAmYPFQJdaHR0cDovL3d3dy5yb2Jsb3guY29tL0RhdGEvVXBsb2FkLmFzaHg/YXNzZXRpZD0wJnR5cGU9UGxhY2UmbmFtZT0mZGVzY3JpcHRpb249JmlzcHVibGljPUZhbHNlXWh0dHA6Ly93d3cucm9ibG94LmNvbS9EYXRhL1VwbG9hZC5hc2h4P2Fzc2V0aWQ9MCZ0eXBlPVBsYWNlJm5hbWU9JmRlc2NyaXB0aW9uPSZpc3B1YmxpYz1GYWxzZWQYAQUXUHVibGlzaENvbnRlbnRNdWx0aVZpZXcPD2QCAmRDyEmzAqhVulIDgIFzvbXdOamMzw==" />
			</div>
			<div>
				<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWAgKYmoScBQK68o/2CN9cM+S4ci3B8/hSU/vwOHW+UNqd" />
			</div>
			<input id="DialogResult" type="hidden" />
			<p>Select the Place you wish to update:</p>
			<div id="CreationsPanel" class="CreationsPanel" style="overflow:auto;">
				<div class="Creations">
					<?php
                    foreach ($places as $item) {
                        $relativeId = $item["itemId"];
                        $name = Helper::debugString($item["itemName"]);
                        PageBuilder::addComponent("ide", "creation", compact("relativeId", "name"));
                    }
                    ?>
				</div>
			</div>
		</form>
	</body>
</html>