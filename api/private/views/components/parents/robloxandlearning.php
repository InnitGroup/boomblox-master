<?php
global $theme;
?>

<div id="Body">
	<div class="ParentsContainer">
		<a name="top"></a>
		<div id="BreadcrumbsContainer">
			<a id="ctl00_cphRoblox_BreadcrumbsHyperLink" href="/Parents.aspx"><?=Site::getThemeProperty("alias", $theme)?> Parents</a> &gt; <?=Site::getThemeProperty("alias", $theme)?> and Learning
		</div>
		<a id="ctl00_cphRoblox_PageImage" class="PageImage" onclick="javascript:__doPostBack('ctl00$cphRoblox$PageImage','')" style="display:inline-block;cursor:pointer;">
			<img src="/images/Parents/RobloxAndLearning-110x110.png" border="0" blankurl="http://t6.roblox.com:80/blank-128x128.gif">
		</a>
		<h2><?=Site::getThemeProperty("alias", $theme)?> and Learning</h2>
		<div class="Navigation">
			<ul>
				<li>
					<a href="#TheLearningProcess">The Learning Process</a>
				</li>
				<li>
					<a href="#SubjectSpecificBenefits">Subject-specific Benefits</a>
				</li>
			</ul>
		</div>
		<dl>
			<dt>
				<a name="TheLearningProcess">The Learning Process</a>
			</dt>
			<dd>
				<p>We believe in the theory that kids learn best by making things — by engaging in the creative and complex process of imagining, designing, and constructing. Provide them with a safe and nurturing place to build, give them the requisite tools, and let them play.</p>
				<p>We're particularly inspired by the educational theory pioneered by Seymour Papert of the MIT Media Lab. This theory — labeled "Constructionism" — not only holds that kids learn best when they are in the active roles of designer and builder, but that their learning is optimized when they're assuming these roles in a public forum.</p>
				<p>This makes good sense to us — particularly after observing some of our members who know that the fruits of their labor may be seen, praised, and used by others. These are motivated kids who become deeply engaged with building complex structures and solving complex problems. Their level of creativity, the amount of time and care spent building, and the extent and high quality of their discourse never fails to astonish us.</p>
				<p>And P.S.: This isn't just child's play. Constructionist learning applies to all of us, regardless of age. So, if you're so inclined, give yourself permission to engage, create, and build stuff too!</p>
				<p>Learn more about <a href="http://en.wikipedia.org/wiki/Constructivism_(learning_theory)" target="_blank">Constructionism</a>, <a href="http://papert.org/" target="_blank">Seymour Papert</a>, or the <a href="http://www.media.mit.edu/" target="_blank">MIT media lab</a>. </p>
			</dd>
			<dt>
				<a name="SubjectSpecificBenefits">Subject-specific Benefits</a>
			</dt>
			<dd>
				<p>Of course, there are also educational benefits associated with specific academic subjects, including mathematics, physics, mechanical engineering, computer programming, logic, game theory, and more! These benefits are unavoidable byproducts of designing, building, and playing in a 3D simulated world.</p>
				<p>Stay tuned for greater detail here as the team at <?=Site::getThemeProperty("alias", $theme)?> continues to work with schools and educators to better understand and articulate how these educational benefits map to curriculum-based learning.</p>
				<p>If you're a teacher or parent who has some specific thoughts on this matter, we'd love to hear from you. You can always contact us at <a href="mailto:info@roblox.com">info@roblox.com</a>. </p>
			</dd>
		</dl>
	</div>
</div>