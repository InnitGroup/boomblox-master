<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Upload</title>
		<link href="/CSS/RobloxOld.css" rel="stylesheet" type="text/css" />
		<script src="http://<?=domain?>/ScriptResource.axd?d=dXBsb2Fk"></script>
	</head>
	<body bgcolor="buttonface" scroll="no">
		<form name="PublishContent" method="post" action="/IDE/Upload.aspx" id="PublishContent">
			<div>
				<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTg1NjY2NjQ3OA9kFgICARAWAh4GYWN0aW9uBRAvSURFL1VwbG9hZC5hc3B4ZBYCAgEPZBYEAgIPZBYCAgEPZBYCAgEPFgIeC18hSXRlbUNvdW50Av////8PZAIDD2QWAmYPFQJdaHR0cDovL3d3dy5yb2Jsb3guY29tL0RhdGEvVXBsb2FkLmFzaHg/YXNzZXRpZD0wJnR5cGU9UGxhY2UmbmFtZT0mZGVzY3JpcHRpb249JmlzcHVibGljPUZhbHNlXWh0dHA6Ly93d3cucm9ibG94LmNvbS9EYXRhL1VwbG9hZC5hc2h4P2Fzc2V0aWQ9MCZ0eXBlPVBsYWNlJm5hbWU9JmRlc2NyaXB0aW9uPSZpc3B1YmxpYz1GYWxzZWQYAQUXUHVibGlzaENvbnRlbnRNdWx0aVZpZXcPD2RmZDl9Rrnv5VFMTsA2O85G7FyuFxHl" />
			</div>

			<div>
				<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWAgL4qq5QAoPktZoEN/R7rFvW4q83D2Mu4R1urei/DIs=" />
			</div>
			<input id="DialogResult" type="hidden" />
			<table height="100%" cellpadding="12" width="100%">
				<tr valign="top">
				<td colspan="2">
				<p>You are about to publish this Place to ROBLOX.  Please choose how you would like to save your work:</p>
				</td>
				</tr>
				<tr>
				<td width="120" valign="top"><input type="submit" name="ChoosePublishContentModificationButton" value="Update" id="ChoosePublishContentModificationButton" class="OKCancelButton" style="width:100%;" /></td>
				<td valign="top"><strong>Update an existing Place on ROBLOX.</strong><br />Choose this to make changes to a Place you have previously created.  You will have the opportunity to select which Place you wish to update.</td>
				</tr>
				<tr>
				<td width="120" valign="top"><input class="OKCancelButton" onclick="DialogResult.value='2'; window.close(); return false" style="WIDTH: 100%" type="button" value="Cancel" /></td>
				<td valign="top"><strong>Keep playing and exit later.</strong></td>
				</tr>
			</table>
			
		</form>
	</body>
</html>