<?php
class MembershipManager {
    private $theme;
    private $user;
    public function __construct($theme) {
        global $user;
        $this->theme = $theme;
        $this->user = $user;
    }
    public function cancel() {
        if ($this->user->hasBC() || $this->user->hasTBC()) {
            return '
            <div id="Cancellation">
                <h4>Cancel Membership</h4>
                <p>Cancel automatic monthly card charges anytime within billing cycle</p>
                <p>Memberships are non-refundable</p>
                <div class="CancelButton">
                    <a class="Button" href="../My/AccountUpgrades/Manage.aspx">Cancel Membership</a>
                </div>
            </div>
            ';
        }
    }
    public function load() {
        echo '
            <div id="Body">
                <div id="BuildersClubContainer" style="height:703px;">
                    <img id="JoinBuildersClubNow" src="/images/JoinBuildersClubNow.png">
                    <div id="MembershipOptions">
                        <div id="OneMonth">
                            <img src="/images/BuyBCMonthly.png"><br>
                            <a href="PaymentMethods.aspx?ap=2" class="Label" style="position:relative;left:73px;">Get Monthly</a>
                        </div>
                        <div id="SixMonths">
                            <img src="/images/BuyBC6Months.png"><br>
                            <a href="PaymentMethods.aspx?ap=3" class="Label" style="position:relative;left:73px;">Get 6 Months</a>
                        </div>
                        <div id="TwelveMonths">
                            <img src="/images/BuyBC12Months.png"><br>
                            <a href="PaymentMethods.aspx?ap=4" class="Label" style="position:relative;left:68px;">Get 12 Months</a>
                        </div>
                    </div>
                    <div id="WhyJoin">
                        <h3>Why Join Builders Club?</h3>
                        <ul id="MembershipBenefits">
                            <li id="Benefit_MultiplePlaces">Create up to 10 places on a single account</li>
                            <li id="Benefit_RobuxAllowance">Earn a daily income of 15 '.strtoupper(Site::getThemeProperty("currency", $this->theme)).'</li>
                            <li id="Benefit_SellContent">Sell your creations to others in the '.Site::getThemeProperty("alias", $this->theme).' catalog</li>
                            <li id="Benefit_SuppressAds">Never see any outside ads on '.strtoupper(Site::getThemeProperty("url", $this->theme)).'</li>
                            <li id="Benefit_ExclusiveHat">Receive the exclusive '.Site::getThemeProperty("membership", $this->theme).' construction hard hat</li>
                        </ul>
                        <div style="height:10px;clear:both;"></div>
                        <span>Product is Windows-only. For more information, read our <a href="/Parents/BuildersClub.aspx">'.Site::getThemeProperty("membership", $this->theme).' FAQs</a>.</span>
                        <div style="height:15px;clear:both;"></div>
                        <h3>Not Ready Yet?</h3>
                        <ul id="MembershipBenefits">
                            <li id="Benefit_RobuxAllowance">You can also <a href="Robux.aspx">buy '.Site::getThemeProperty("currency", $this->theme).'</a> directly for cash.</li>
                        </ul>  
                        <div style="height:8px;clear:both;"></div>
                        <span>This is a page for decoration only, no purchases or real life money exchanges can be made on the '.Site::getThemeProperty("alias", $this->theme).' site.</span>
                    </div>
                    '.$this->cancel().'
                </div>
            </div>
            <div style="clear:both;"></div>
        ';
    }
}
?>