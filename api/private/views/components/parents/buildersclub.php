<?php
global $theme;
?>

<div id="Body">
	<div class="ParentsContainer">
		<a name="top"></a>
		<div id="BreadcrumbsContainer">
			<a id="ctl00_cphRoblox_BreadcrumbsHyperLink" href="/Parents.aspx"><?=Site::getThemeProperty("alias", $theme)?> Parents</a> &gt; <?=Site::getThemeProperty("membership", $theme)?>
		</div>
		<a id="ctl00_cphRoblox_PageImage" class="PageImage" onclick="javascript:__doPostBack('ctl00$cphRoblox$PageImage','')" style="display:inline-block;cursor:pointer;">
			<img src="/images/Parents/BuildersClub-110x110.png" border="0" blankurl="http://t6.roblox.com:80/blank-128x128.gif">
		</a>
		<h2><?=Site::getThemeProperty("membership", $theme)?></h2>
		<div class="Navigation">
			<ul>
				<li>
					<a href="#AboutBuildersClub">About <?=Site::getThemeProperty("membership", $theme)?></a>
				</li>
				<li>
					<a href="#PaymentMethods">Which payment methods do you accept?</a>
				</li>
				<li>
					<a href="#TransactionSecurity">Will my payment information be secure?</a>
				</li>
				<li>
					<a href="#RefundPolicy">What is your refund policy?</a>
				</li>
				<li>
					<a href="#AcceptedCurrencies">What currencies do you accept?</a>
				</li>
				<li>
					<a href="#FamilyPlans">Does <?=Site::getThemeProperty("alias", $theme)?> offer family plans?</a>
				</li>
				<li>
					<a href="#MembershipTimeliness">How soon does membership take effect?</a>
				</li>
				<li>
					<a href="#MembershipRenewals">Will my membership automatically renew?</a>
				</li>
				<li>
					<a href="#MembershipExpiration">What happens when my membership expires?</a>
				</li>
				<li>
					<a href="#MembershipTransfers">Can I transfer my <?=Site::getThemeProperty("membership", $theme)?> membership to a different <?=Site::getThemeProperty("alias", $theme)?> account?</a>
				</li>
				<li>
					<a href="#TOSViolations">What is the <?=Site::getThemeProperty("alias", $theme)?> policy regarding terms of service violations?</a>
				</li>
				<li>
					<a href="#MembershipCancellation">How do I cancel my membership?</a>
				</li>
			</ul>
		</div>
		<dl>
			<dt>
				<a name="AboutBuildersClub">About <?=Site::getThemeProperty("membership", $theme)?></a>
			</dt>
			<dd>
				<p><?=Site::getThemeProperty("membership", $theme)?> is a premium service that enhances the <?=Site::getThemeProperty("alias", $theme)?> experience.</p>
				<p><?=Site::getThemeProperty("membership", $theme)?> memberships give kids the ability to create and manage multiple structures and environments (up to 10). <?=Site::getThemeProperty("membership", $theme)?> members also gain the ability to earn <?=Site::getThemeProperty("alias", $theme)?> currency — called "<?=Site::getThemeProperty("currency", $theme)?>" — which can be used to purchase premium items in the <?=Site::getThemeProperty("alias", $theme)?> catalog. These items enable much greater (i.e. much cooler!) customization of users' avatars and their interactive creations.</p>
				<p>In addition, <?=Site::getThemeProperty("membership", $theme)?> members gain the ability to promote their creations in the <?=Site::getThemeProperty("alias", $theme)?> catalog and sell them to other members using the virtual <?=Site::getThemeProperty("alias", $theme)?> economy.</p>
				<p>Finally, unlike free account holders, <?=Site::getThemeProperty("membership", $theme)?> members will no longer be exposed to, or distracted by, on screen advertisements.</p>
				<p>For parents who are interested in learning more about subscription options or in purchasing a <?=Site::getThemeProperty("membership", $theme)?> membership for their child, click on the membership button on the home page or <a id="ctl00_cphRoblox_BCSignUpHyperLink" href="/web/20080718043016/http://www.roblox.com/Upgrades/BuildersClub.aspx">start the sign-up process</a> now. </p>
			</dd>
			<dt>
				<a name="PaymentMethods">Which payment methods do you accept?</a>
			</dt>
			<dd>
				<p>At this time <?=Site::getThemeProperty("alias", $theme)?> accepts payment via all major credit cards. We will be expanding our selection of payment methods in the coming months. Please do not mail cash to <?=Site::getThemeProperty("alias", $theme)?> headquarters.</p>
			</dd>
			<dt>
				<a name="TransactionSecurity">Will my payment information be secure?</a>
			</dt>
			<dd>
				<p>All transactions on <?=Site::getThemeProperty("alias", $theme)?> use secure commercial-grade encryption. Furthermore, information relating to your payment (such as your credit card number) never resides on our servers. All of our online transactions are processed by PayPal, a trusted name in internet commerce.</p>
			</dd>
			<dt>
				<a name="RefundPolicy">What is your refund policy?</a>
			</dt>
			<dd>
				<p>Memberships are non-refundable.</p>
			</dd>
			<dt>
				<a name="AcceptedCurrencies">What currencies do you accept?</a>
			</dt>
			<dd>
				<p>All prices are in US dollars. However, most online payment methods will convert currencies at the current bank rate. Check with your credit card company or banking institution.</p>
			</dd>
			<dt>
				<a name="FamilyPlans">Does <?=Site::getThemeProperty("alias", $theme)?> Offer Family Plans?</a>
			</dt>
			<dd>
				<p>We do not offer family plans at this time.</p>
			</dd>
			<dt>
				<a name="MembershipTimeliness">How soon does membership take effect?</a>
			</dt>
			<dd>
				<p>Memberships will be activated as soon as payment is received. How quickly this occurs depends upon the method of payment.</p>
				<blockquote>
					<strong>Credit Card:</strong> Your membership will be activated instantly. <br>
					<strong>PayPal:</strong> If your PayPal account charges directly to a credit card, your membership will usually be activated within one day. If your PayPal account charges to a bank account (eCheck), up to 10 days may be required to receive payment.
				</blockquote>
			</dd>
			<dt>
				<a name="MembershipRenewals">Will my membership automatically renew?</a>
			</dt>
			<dd>
				<p>Only monthly subscriptions paid via credit card will autorenew, in order to ensure continuous, uninterrupted service. All other subscriptions need to be manually renewed from the <?=Site::getThemeProperty("membership", $theme)?> page.</p>
			</dd>
			<dt>
				<a name="MembershipExpiration">What happens when my membership expires?</a>
			</dt>
			<dd>
				<p>You do not lose anything when your membership expires. Your account loses <?=Site::getThemeProperty("membership", $theme)?> status, but will remain active. You will keep all existing places that you own and all assets (including your current <?=Site::getThemeProperty("currency", $theme)?> and Tickets balance). You will lose all other abilities associated with being in <?=Site::getThemeProperty("membership", $theme)?>. Accounts can be re-subscribed at any time.</p>
			</dd>
			<dt>
				<a name="MembershipTransfers">Can I transfer my <?=Site::getThemeProperty("membership", $theme)?> membership to a different <?=Site::getThemeProperty("alias", $theme)?> account?</a>
			</dt>
			<dd>
				<p>Unfortunately, we are not able to offer this service at this time.</p>
			</dd>
			<dt>
				<a name="TOSViolations">What is the <?=Site::getThemeProperty("alias", $theme)?> policy regarding terms of service violations?</a>
			</dt>
			<dd>
				<p>The <?=Site::getThemeProperty("alias", $theme)?> Team is committed to keeping the <?=Site::getThemeProperty("alias", $theme)?> community safe for kids of all ages. <?=Site::getThemeProperty("membership", $theme)?> members who violate our terms of service may have their accounts suspended for a period of time or deleted at our discretion. There will be no refunds on suspended or deleted accounts.</p>
				<p>Parents are encouraged to help their children understand that our standards for behavior online are similar to those that might be upheld at an elementary school playground.</p>
			</dd>
			<dt>
				<a name="MembershipCancellation">How do I cancel my membership?</a>
			</dt>
			<dd>
				<p>Cancellations only apply to monthly <?=Site::getThemeProperty("membership", $theme)?> subscriptions that were paid via credit card. Canceling is easy — simply click the <a id="ctl00_cphRoblox_HyperLink1" href="/Upgrades/Cancel.aspx">Cancel Membership</a> button that appears on the <?=Site::getThemeProperty("membership", $theme)?> page and confirm the cancellation. If you cancel a recurring subscription, you will continue to receive <?=Site::getThemeProperty("membership", $theme)?> privileges for the remainder of the currently paid month. </p>
			</dd>
		</dl>
	</div>
</div>