<div id="Body">
    <input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="<?=base64_encode($user["userId"] . ":" . time())?>"/>
	<div class="MessageContainer">
		<div id="MessagePane">
			<div id="ctl00_cphRoblox_pConfirmation">
				<div id="Confirmation">
					<h3>Request Exists</h3>
					<div id="Message">
						<span id="ctl00_cphRoblox_lConfirmationMessage">You already have a friend invitation sent to <?=$user["username"]?>.</span>
					</div>
					<div class="Buttons">
						<a id="ctl00_cphRoblox_lbContinue" class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$lbContinue','')">Continue</a>
					</div>
				</div>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
</div>