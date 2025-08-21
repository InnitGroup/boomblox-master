<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Save</title>
		<link href="/CSS/RobloxOld.css" rel="stylesheet" type="text/css" />
		<script src="http://bmblox.xyz/ScriptResource.axd?d=dXBsb2Fk"></script>
        <script>
            function upload() {
                var data = window.external.WriteSelection();
                data.Upload("http://bmblox.xyz/Data/Model.ashx");
                document.PublishContent.submit();
                window.close();
            }
        </script>
	</head>
	<body bgcolor="buttonface" scroll="no">
		<form name="PublishContent" method="post" action="/IDE/ModelUpload.aspx" id="PublishContent">
			<div>
				<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTg1NjY2NjQ3OA9kFgICARAWAh4GYWN0aW9uBRAvSURFL1VwbG9hZC5hc3B4ZBYCAgEPZBYEAgIPZBYCAgEPZBYCAgEPFgIeC18hSXRlbUNvdW50Av////8PZAIDD2QWAmYPFQJdaHR0cDovL3d3dy5yb2Jsb3guY29tL0RhdGEvVXBsb2FkLmFzaHg/YXNzZXRpZD0wJnR5cGU9UGxhY2UmbmFtZT0mZGVzY3JpcHRpb249JmlzcHVibGljPUZhbHNlXWh0dHA6Ly93d3cucm9ibG94LmNvbS9EYXRhL1VwbG9hZC5hc2h4P2Fzc2V0aWQ9MCZ0eXBlPVBsYWNlJm5hbWU9JmRlc2NyaXB0aW9uPSZpc3B1YmxpYz1GYWxzZWQYAQUXUHVibGlzaENvbnRlbnRNdWx0aVZpZXcPD2RmZDl9Rrnv5VFMTsA2O85G7FyuFxHl" />
			</div>

			<div>
				<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWAgL4qq5QAoPktZoEN/R7rFvW4q83D2Mu4R1urei/DIs=" />
			</div>
			<table>
                <tr>
                    <td style="text-align:right;vertical-align:top;padding-right:5px;">
                        <label>Name:</label>
                    </td>
                    <td>
                        <input name="ctl00$cphRoblox$Name" type="text" size="50">
                    </td>
                </tr>
                <tr>
                    <td style="text-align:right;vertical-align:top;padding-right:5px;">
                        <label for="description">Description:</label>
                    </td>
                    <td>
                        <textarea name="ctl00$cphRoblox$Description" cols="53" rows="10"></textarea>
                        <div style="clear:both"></div>    
                        <input name="ctl00$cphRoblox$PublicUse" type="checkbox">
                        <label>Publish for free public use.</label>
                    </td>
                </tr>
                <tr>
                    <td style="position:relative;left:342px;top:15px;">
                        <button onclick="javascript:upload()" style="margin-right:5px;">Submit</button>
                        <button>Cancel</button>
                    </td>
                </tr>
            </table>
		</form>
	</body>
</html>