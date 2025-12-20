<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Save</title>
		<link href="/CSS/RobloxOld.css" rel="stylesheet" type="text/css" />
		<script src="http://xoblog.dev/ScriptResource.axd?d=dXBsb2Fk"></script>
        <script>
            function upload(id) {
                var data = window.external.WriteSelection();
                data.Upload("http://xoblog.dev/Data/Model.ashx?ID=" + id);
                document.PublishContent.submit();
				alert("Model uploaded!");
                window.close();
            }
        </script>
	</head>
	<body bgcolor="buttonface" scroll="yes">
		<form name="PublishContent" method="post" action="/IDE/ModelUpload.aspx?Update=1" id="PublishContent">
			<div>
				<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTg1NjY2NjQ3OA9kFgICARAWAh4GYWN0aW9uBRAvSURFL1VwbG9hZC5hc3B4ZBYCAgEPZBYEAgIPZBYCAgEPZBYCAgEPFgIeC18hSXRlbUNvdW50Av////8PZAIDD2QWAmYPFQJdaHR0cDovL3d3dy5yb2Jsb3guY29tL0RhdGEvVXBsb2FkLmFzaHg/YXNzZXRpZD0wJnR5cGU9UGxhY2UmbmFtZT0mZGVzY3JpcHRpb249JmlzcHVibGljPUZhbHNlXWh0dHA6Ly93d3cucm9ibG94LmNvbS9EYXRhL1VwbG9hZC5hc2h4P2Fzc2V0aWQ9MCZ0eXBlPVBsYWNlJm5hbWU9JmRlc2NyaXB0aW9uPSZpc3B1YmxpYz1GYWxzZWQYAQUXUHVibGlzaENvbnRlbnRNdWx0aVZpZXcPD2RmZDl9Rrnv5VFMTsA2O85G7FyuFxHl" />
			</div>

			<div>
				<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWAgL4qq5QAoPktZoEN/R7rFvW4q83D2Mu4R1urei/DIs=" />
			</div>
			<p>Select the Model you wish to update:</p>
			<div id="CreationsPanel" class="CreationsPanel">
				<div class="Creations" style="height: 250px; overflow-y: scroll;">
                    <?php
					global $user;
					$models = $user->getModels();

                    foreach ($models as $item) {
                        $relativeId = $item["itemId"];
                        $name = Helper::debugString($item["itemName"]);
                        PageBuilder::addComponent("ide", "model", compact("relativeId", "name"));
                    }
                    ?>
                </div>
            </div>
		</form>
	</body>
</html>