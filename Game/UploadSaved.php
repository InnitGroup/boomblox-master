<?php
if (!isset($_COOKIE["BROBLOSECURITY"])) {
	Server::_404();
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<HTML>
	<HEAD><title>
	Upload
</title>
<link rel="stylesheet" type="text/css" href="/RobloxOld.css" />
<meta name="GENERATOR" content="Microsoft Visual Studio .NET 7.1" />
<meta name="CODE_LANGUAGE" content="C#" />
<meta name="vs_defaultClientScript" content="JavaScript" />
<meta name="vs_targetSchema" content="http://schemas.microsoft.com/intellisense/ie5" />
</HEAD>
	<body bgcolor="buttonface" scroll="no" style="background-color: white;">
		<form name="Form1" method="post" action="Upload.aspx" id="Form1">
<div>
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKLTM4ODA0MzUwNg9kFgICAw9kFgRmDw8WAh4HVmlzaWJsZWhkZAIBDw8WAh8AZ2RkZEShHXVaqdyVMf+0oNNVYId9fyq8" />
</div>

			<script>
		function publish(oSrc, args)
		{
			try
			{
				window.external.ExecScript('game:Save("http://www.roblox.com/Data/Upload.ashx?id=292106")');
				args.IsValid = true;
			}
			catch (ex)
			{
				args.IsValid = false;
			}
		}
			</script>
			
			<div id="PanelDone">
	
				<TABLE height="100%" width="100%">
					<TR vAlign="top" height="100%">
						<TD>The upload has completed!
						</TD>
					</TR>
					<TR>
						<TD align="right">
							<TABLE cellSpacing="5" cellPadding="0" border="0">
								<TR>
									<TD><INPUT class="OKCancelButton" onclick="window.close(); return false" type="button" value="Close">
									</TD>
								</TR>
							</TABLE>
						</TD>
					</TR>
				</TABLE>
			
</div>
		</form>
	</body>
</HTML>
