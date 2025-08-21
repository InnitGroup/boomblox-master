<?php
global $theme;
?>

<div id="Body">
	<div class="ParentsContainer">
		<a name="top"></a>
		<div id="BreadcrumbsContainer">
			<a id="ctl00_cphRoblox_BreadcrumbsHyperLink" href="/Parents.aspx"><?=Site::getThemeProperty("alias", $theme)?> Parents</a> &gt; Keeping Kids Safe
		</div>
		<a id="ctl00_cphRoblox_PageImage" class="PageImage" onclick="javascript:__doPostBack('ctl00$cphRoblox$PageImage','')" style="display:inline-block;cursor:pointer;">
			<img src="/images/Parents/KeepingKidsSafe-110x112.png" border="0" blankurl="http://t7.roblox.com:80/blank-391x398.gif">
		</a>
		<h2>Keeping Kids Safe</h2>
		<div class="Navigation">
			<ul>
				<li>
					<a href="#SiteModeration">Site Moderation</a>
				</li>
				<li>
					<a href="#ChatModesAndFiltering">Chat Modes &amp; Filtering</a>
				</li>
				<li>
					<a href="#MinimalInformationCollection">Minimal Information Collection</a>
				</li>
				<li>
					<a href="#CommunicationGuidelines">Communication Guidelines</a>
				</li>
				<li>
					<a href="#Resources">Resources</a>
				</li>
			</ul>
		</div>
		<div class="ContentSection">
			<p>Above all else, everyone here at <?=Site::getThemeProperty("alias", $theme)?> is committed to member safety. We take every precaution possible to make sure kids are protected from inappropriate and offensive individuals as well as from indecent and distasteful content.</p>
		</div>
		<dl>
			<dt>
				<a name="SiteModeration">Site Moderation</a>
			</dt>
			<dd>
				<p><?=Site::getThemeProperty("alias", $theme)?> has a team of moderators who are constantly reviewing chat logs and discussion forums, fielding abuse reports from members, and screening uploaded content files. These moderators — both <?=Site::getThemeProperty("alias", $theme)?> employees as well as trusted members of the community — follow our zero-tolerance policy in regard to swearing and obscenities, messages and content of a sexual or violent nature, and any sort of aggressive or threatening communication. In the rare times when an incident does occur, the infringing member is immediately suspended or permanently expelled.</p>
				<p>For a detailed look at what members can and cannot do, along with potential repercussions, please review our <a id="ctl00_cphRoblox_TOSHyperLink" href="/info/TermsOfService.aspx" target="_blank">Terms of Service</a>. </p>
			</dd>
			<dt>
				<a name="ChatModesAndFiltering">Chat Modes &amp; Filtering</a>
			</dt>
			<dd>
				<p>There are two chat modes available to members:</p>
				<ol>
					<li>
						<strong>Super Safe Chat:</strong> This is the preferred mode for parents looking for the ultimate in online safety. This option limits what members can say or see inside the game to a predefined menu of greetings, questions, and statements. In the website and community it prevents private messages from being exchanged.
					</li>
					<li>
						<strong>Standard Safe Chat:</strong> This mode allows members to type their messages when communicating with other members. However, every message that is typed first goes through a sophisticated filter that blocks inappropriate words and phrases. <?=Site::getThemeProperty("alias", $theme)?>'s adaptive filter also learns to decipher and catch codes or other methods that members might use to bypass the system. <em>Please note: Although our filter is continuously being updated and improved, some inappropriate comments may get through. In the event that this happens, members have easy access to a "report abuse" feature.</em>
						<br>
					</li>
				</ol>
			</dd>
			<dt>
				<a name="MinimalInformationCollection">Minimal Information Collection</a>
			</dt>
			<dd>
				<p><?=Site::getThemeProperty("alias", $theme)?> only collects kids' usernames and email addresses (or, in the case of children under 13, a parent's email address). This gives us the ability to ensure safe participation and to recover lost passwords. (If your child forgets a password, we can email a reminder.) Email addresses are not visible anywhere on the site nor will they ever be disclosed to a third party.</p>
				<p>For more detailed information, please see our <a id="ctl00_cphRoblox_PrivacyPolicyHyperLink" href="/info/Privacy.aspx" target="_blank">Privacy Policy</a>. </p>
			</dd>
			<dt>
				<a name="CommunicationGuidelines">Communication Guidelines</a>
			</dt>
			<dd>
				<p>To help protect your children, we recommend to them that they abide by a number of safety guidelines. These include the following:</p>
				<ol>
					<li>Never give out personal information of any kind, such as your real name, age, location, phone number, or school.</li>
					<li>Never give out your password, except to your parents. If others get it, one or more individuals could pretend to be you. They could give out your personal information or act in an inappropriate way on the site that could get you into trouble.</li>
					<li>Tell your parents if someone says or does something online that makes you feel uncomfortable, or if someone asks you for personal information.</li>
					<li>If someone on the <?=Site::getThemeProperty("alias", $theme)?> site harasses you or makes any comments that you feel are inappropriate, immediately send an abuse report to the <?=Site::getThemeProperty("alias", $theme)?> team.</li>
					<li>Choose a username that does not reflect or hint at your real identity. Avoid usernames that are suggestive in any way, even if they seem funny or innocent to you.</li>
				</ol>
				<p>We encourage you to review these communication guidelines with your child and to <a href="mailto:info@roblox.com">contact us</a> if you have any questions. </p>
			</dd>
			<dt>
				<a name="Resources">Resources</a>
			</dt>
			<dd>
				<p>And if you're interested in learning more about online safety, please refer to the following links, which contain useful Internet safety information for parents.</p>
				<ul>
					<li>
						<a href="http://www.wiredsafety.org/" target="_blank">WiredSafety</a>
					</li>
					<li>
						<a href="http://www.cyberangels.org/" target="_blank">CyberAngels</a>
					</li>
					<li>
						<a href="http://www.csn.org/" target="_blank">Child Safety Network</a>
					</li>
					<li>
						<a href="http://www.staysafe.org/" target="_blank">staysafe.org</a>
					</li>
					<li>
						<a href="http://onguardonline.gov/" target="_blank">OnGuardOnline.gov</a>
					</li>
					<li>
						<a href="http://www.netsmartz.org/" target="_blank">NetSmartz Workshop</a>
					</li>
					<li>
						<a href="http://www.commonsensemedia.org/" target="_blank">Common Sense Media</a>
					</li>
				</ul>
			</dd>
		</dl>
	</div>
</div>