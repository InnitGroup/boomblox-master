<?php
class TradeCurrencyManager {
    public function handle() {
        if (!Server::isPost()) {
            return;
        }

        #if (!isset($_POST['ctl00$cphRoblox$OrderType'])) {
        #    return;
        #}

        var_dump($_POST);
        $amount = $_POST['ctl00$cphRoblox$HaveAmountTextBox']; # #
        $currency = $_POST['ctl00$cphRoblox$HaveCurrencyDropDownList']; #Tickets/Robux
        $orderType = $_POST['ctl00$cphRoblox$OrderType']; # MarketOrderRadioButton/LimitOrderRadioButton

    }

    public function load() {
        PageBuilder::addComponent("marketplace", "tradecurrency");
    }
}
?>