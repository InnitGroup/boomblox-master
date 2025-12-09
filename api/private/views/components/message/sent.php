<div id="Body">
    <input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="<?=base64_encode($user["userId"] . ":" . time())?>"/>
	<div class="MessageContainer">
		<div id="AdsPane">
		<?=Ad::generateAd("160x600")?>
		</div>
		<div id="MessagePane">
			<div id="ctl00_cphRoblox_pConfirmation">
				<div id="Confirmation">
					<h3>Message Sent</h3>
					<div id="Message">
						<span id="ctl00_cphRoblox_lConfirmationMessage">Your message has been sent to <?=$user["username"]?>.</span>
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