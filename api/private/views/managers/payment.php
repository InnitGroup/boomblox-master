<?php
class PaymentManager {
    private $ap;
    private $theme;
    public function __construct($ap, $theme) {
        $validAp = [2, 3, 4, 7, 8, 10, 17];
        if (!in_array($ap, $validAp)) {
            Server::_404();
        }
        $this->ap = $ap;
        $this->theme = $theme;
    }
    public function getAmount() {
        $amount = "0";
        switch ($this->ap) {
            case 2:
                return "Monthly ".Site::getThemeProperty("membership",$this->theme);
            case 3:
                return "6 Months of ".Site::getThemeProperty("membership",$this->theme);
            case 4:
                return "12 Months of ".Site::getThemeProperty("membership",$this->theme);
            case 7:
                return "2,000 ".Site::getThemeProperty("shortCurrency",$this->theme);
            case 8:
                return "4,500 ".Site::getThemeProperty("shortCurrency",$this->theme);
            case 10:
                return "10,000 ".Site::getThemeProperty("shortCurrency",$this->theme);
            case 17:
                return "22,500 ".Site::getThemeProperty("shortCurrency",$this->theme);
        }
    }
    public function getTitle() {
        return Site::getThemeProperty("alias", $this->theme)." - Payment for ".$this->getAmount();
    }
    public function loadPayment() {
        echo '
        <div id="Body">
            <h2>Payment for '.$this->getAmount().'</h2>
            <p>Unfortunately '.Site::getThemeProperty("alias", $this->theme).' does not support real-life transactions, here are other ways to get '.Site::getThemeProperty("currency", $this->theme).':</p>
            <ul>
                <li>'.Site::getThemeProperty("membership", $this->theme).' - You receive 15 '.Site::getThemeProperty("shortCurrency", $this->theme).' daily.</li>
                <li>Boosting the discord server - You receive 100 '.Site::getThemeProperty("shortCurrency", $this->theme).' initially, along with '.Site::getThemeProperty("membership", $this->theme).'.</li>
                <li>'.Site::getThemeProperty("membership", $this->theme).' members visiting your place - You receive '.Site::getThemeProperty("shortCurrency", $this->theme).' per visit.</li>
                <li>Contests - Some contests or events will provide '.Site::getThemeProperty("currency", $this->theme).' as a prize or participation award.</li>
            </ul>
            <p>And here are ways to get '.Site::getThemeProperty("membership", $this->theme).':</p>
            <ul>
                <li>Boosting the discord server - as long as you are boosting the server, you will have '.Site::getThemeProperty("membership", $this->theme).'</li>
                <li>Contest - Some contests or events will provide '.Site::getThemeProperty("membership", $this->theme).' as a prize.</li>
                <li>Giveaway - Sometimes giveaways are hosted on the '.Site::getThemeProperty("alias", $this->theme).' platform, and '.Site::getThemeProperty("membership", $this->theme).' may be provided as a prize.</li>
            </ul>
        </div>
        ';
    }
}
?>