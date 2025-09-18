<?php
class TradeCurrencyManager {
    # calculate the returned amount based on the amount & currency
    public function calculate($amount, $currency) {
        switch ($currency) {
            case "Tickets":
                return floor((int)$amount / 10);
            case "Robux":
                return floor((int)$amount) * 10;
        }
    }

    # controller
    public function controller() {
        if (!Server::isPost()) {
            return;
        }

        #if (!isset($_POST['ctl00$cphRoblox$OrderType'])) {
        #    return;
        #}

        $amount = $_POST['ctl00$cphRoblox$HaveAmountTextBox']; # #
        $currency = $_POST['ctl00$cphRoblox$HaveCurrencyDropDownList']; #Tickets/Robux
        $orderType = $_POST['ctl00$cphRoblox$OrderType']; # MarketOrderRadioButton/LimitOrderRadioButton

        # continue
        if ($currency == "Tickets" && $amount > 10 || $currency == "Robux" && $amount > 0) {
            global $user;
            echo "you got this far :shush:";
        }
    }

    # viewer
    public function viewer() {
        PageBuilder::addComponent("marketplace", "tradecurrency");
    }
}
?>