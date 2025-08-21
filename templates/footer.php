<?php
#made: 01/04/2025 @marsoc
#last edit: 01/07/2025 @marsoc: added theme property year instead of static '©2008. Patents pending.'
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
?>
            
                <div id="Footer" style="clear:both;">
                    <hr>
                    <p class="Legalese">
                    <?=Site::getThemeProperty("alias",$theme); ?>, "Online Building Toy", characters and names are under 
                        <a href="/info/About.aspx"><?=Site::getThemeProperty("company",$theme); ?></a>,
                        <?=Site::getThemeProperty("year",$theme);?><br/>
                        <?=Site::getThemeProperty("company2",$theme);?> is not affiliated with Lego, MegaBloks, Bionicle, Pokemon, Nintendo, Lincoln Logs, Yu Gi Oh, K'nex, Tinkertoys, Erector Set, or the Pirates of the Caribbean. ARrrr!
                        <br>
                        Use of this site signifies your acceptance of the
                        <a href="/info/TermsOfService.aspx">Terms and Conditions</a>.
                        <br>
                        <a href="/info/Privacy.aspx">Privacy Policy</a>
                        &nbsp;|&nbsp; <a href="mailto:boombloxkewl@gmail.com">Contact Us</a> &nbsp;|&nbsp;
                        <a href="/info/About.aspx">About Us</a>
                        &nbsp;|&nbsp;
                        <a href="/info/Jobs.aspx">Jobs</a>
                    </p>
                </div>
            </div>
        </form>
    </body>
</html>