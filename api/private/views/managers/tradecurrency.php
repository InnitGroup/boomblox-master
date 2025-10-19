<?php
class TradeCurrencyManager {
    # calculate the returned amount based on the amount & currency
    public function calculate($amount, $currency) {
        if ($amount <= 0) {
            return false;
        }

        if ($currency == "Tickets" && $amount < 20) {
            return false;
        }

        switch ($currency) {
            case "Tickets":
                return floor((int)$amount / 10);
            case "Robux":
                return floor((int)$amount) * 10;
        }
    }

    public function handleTicketMarketTrade(int $amount) {
        global $user;
        if ($user->getTickets() < $amount) {
            return false;
        }

        $output = $this->calculate($amount, "Tickets");
        $user->takeTix($amount);
        $user->giveBux($output);
        return true;
    }

    public function handleRobuxMarketTrade(int $amount) {
        global $user;
        if ($user->getBoombux() < $amount) {
            return false;
        }

        $output = $this->calculate($amount, "Robux");
        $user->takeBux($amount);
        $user->giveTix($output);
        return true;
    }

    public function log(int $trader, string $orderType, string $currency, int $given, int $asked, string $status) {
        global $db;

        $stmt = "INSERT INTO trades (`traderId`, `orderType`, `currency`, `amountGiven`, `amountAsked`, `status`) VALUES (:trader, :orderType, :currency, :given, :asked, :xstatus)";
        $db->execute($stmt, [
            ":traderId" => $trader,
            ":orderType" => $orderType,
            ":currency" => $currency,
            ":amountGiven" => $given,
            ":amountAsked" => $asked,
            ":xstatus" => $status
        ]);
    }

    # controller
    public function controller() {
        if (!Server::isPost()) {
            return;
        }

        if (!isset($_POST['ctl00$cphRoblox$OrderType'])) {
            return;
        }

        $amount = $_POST['ctl00$cphRoblox$HaveAmountTextBox']; # #
        $currency = $_POST['ctl00$cphRoblox$HaveCurrencyDropDownList']; #Tickets/Robux
        $orderType = $_POST['ctl00$cphRoblox$OrderType']; # MarketOrderRadioButton/LimitOrderRadioButton

        # continue
        if ($orderType == "LimitOrderRadioButton") {
            return; // too advanced
        }

        if ($currency == "Tickets" && $amount > 20 || $currency == "Robux" && $amount > 0) {
            switch ($currency) {
                case "Tickets":
                    if ($result = $this->handleTicketMarketTrade($amount)) {
                        Server::_self();
                    }

                    break;
                case "Robux":
                    if ($result = $this->handleRobuxMarketTrade($amount)) {
                        Server::_self();
                    }

                    break;
            }
        }
    }

    # viewer
    public function viewer() {
        PageBuilder::addComponent("marketplace", "tradecurrency");
    }
}
?>