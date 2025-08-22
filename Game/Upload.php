<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user;

if (!isset($_COOKIE["BROBLOSECURITY"])) {
	Server::_404();
}

if (Server::isPost()) {
	header("Location: /Game/UploadSaved.aspx");
}
?>

<link rel="stylesheet" href="/CSS/RobloxOld.css">
<form name="Form1" method="post" action="Upload.aspx" id="Form1">
	<div>
		<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
		<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
		<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUJMjcyNDIxMDA1ZGTvke74cS+qm4nFchNyWTBREhwBzA==" />
	</div>
	<script src="http://<?=domain?>/ScriptResource.axd?d=dXBsb2Fk"></script>
	<script>
		function publish() {
			document.getElementById("Uploading").style.display = 'block';
			try {
				window.external.ExecScript('visit=game:GetService("Visit") game:Save(visit:GetUploadUrl())');
				//args.IsValid = true;
				document.getElementById("DialogResult").value = '1';
				window.close();
			} catch (ex) {
				try {
					window.external.ExecScript('visit=game:GetService("Visit") game:Save(visit:GetUploadUrl())');
					//args.IsValid = true;
					document.getElementById("DialogResult").value = '1';
					window.close();
				} catch (ex2) {
					//args.IsValid = false;
				}
			}
			document.getElementById("Uploading").style.display = 'none';
		}
	</script>
	<INPUT id="DialogResult" type="hidden">
	<?php if (Setting::enabled("PlaceUploading") || !Setting::enabled("PlaceUploading") && $user->hasPerms(7)) { ?>
	<TABLE height="100%" cellPadding="12" width="100%">
		<TR vAlign="top">
			<TD colSpan="2">
				<P>You are about to leave your Place. Do you wish to save changes made to your Place before exiting?</P>
				<DIV id="Uploading" style="display:none; FONT-WEIGHT: bold; COLOR: royalblue">Uploading. Please wait...</DIV>
				<span id="CustomValidator2" style="color:Red;visibility:hidden;">Upload Failed!</span>
				
			</TD>
		</TR>
		<TR>
			<td width="120">
				<input type="submit" name="Button1" value="Save" onclick="javascript:publish()" id="Button1" class="OKCancelButton" style="width:100%;" />
			</td>
			<td>Save changes to my Place to ROBLOX. You will leave your place after the save has completed.</td>
		</TR>
		<tr>
			<td width="120">
				<INPUT class="OKCancelButton" style="WIDTH: 100%" onclick="DialogResult.value='1'; window.close(); return false" type="button" value="Don't Save">
			</td>
			<td>Leave my Place on ROBLOX unchanged. You will lose any changes you made during your visit.</td>
		</tr>
		<tr>
			<td width="120">
				<INPUT class="OKCancelButton" style="WIDTH: 100%" onclick="DialogResult.value='2'; window.close(); return false" type="button" value="Cancel">
			</td>
			<td>Keep playing and exit later</td>
		</tr>
	</TABLE>
	<?php } else { ?>
		<h1 style="text-align:center">Feature disabled</h1>
		<INPUT class="OKCancelButton" style="WIDTH: 100%" onclick="DialogResult.value='1'; window.close(); return false" type="button" value="Don't Save"><br><br>
		<INPUT class="OKCancelButton" style="WIDTH: 100%" onclick="DialogResult.value='2'; window.close(); return false" type="button" value="Cancel">
	<?php } ?>
</form>