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

    # logs currency exchange to db
    public function log(int $trader, string $orderType, string $currency, int $given, int $asked, string $status, int $isSplit = 0) {
        global $db;

        $stmt = "INSERT INTO trades (`traderId`, `orderType`, `currency`, `amountGiven`, `amountAsked`, `status`, `occured`, `isSplit`) VALUES (:traderId, :orderType, :currency, :amountGiven, :amountAsked, :xstatus, :occured, :isSplit)";
        $db->execute($stmt, [
            ":traderId" => $trader,
            ":orderType" => $orderType,
            ":currency" => $currency,
            ":amountGiven" => $given,
            ":amountAsked" => $asked,
            ":xstatus" => $status,
            ":occured" => date("Y-m-d H:i:s"),
            ":isSplit" => $isSplit
        ]);
    }

    # market trade Tx
    public function handleTicketMarketTrade(int $amount) {
        global $user;
        if ($user->getTickets() < $amount) {
            return false;
        }

        $output = $this->calculate($amount, "Tickets");
        $user->takeTix($amount);
        $user->giveBux($output);
        $this->log($user->getUserId(), "Market", "Tickets", $amount, $output, "complete");
        return true;
    }

    # market trade R$
    public function handleRobuxMarketTrade(int $amount) {
        global $user;
        if ($user->getBoombux() < $amount) {
            return false;
        }

        $output = $this->calculate($amount, "Robux");
        $user->takeBux($amount);
        $user->giveTix($output);
        $this->log($user->getUserId(), "Market", "Robux", $amount, $output, "complete");
        return true;
    }

    # rate checker to see if any other limit order trades portray a rate that is being requested
    public function getTradeByRate(float $rate, string $type, int $amount, bool $isSplit): bool|array {
        global $db;

        $marginalizedRateMin = $rate - 0.005;
        $marginalizedRateMax = $rate + 0.005;

        $result = NULL;
        
        if ($isSplit) {
            $stmt = "SELECT * FROM trades WHERE `rate` > :rateMin AND `rate` < :rateMax AND `status` = 'processing' ORDER BY `rate` DESC";

            $result = $db->execute($stmt, [
                ":rateMin" => $marginalizedRateMin,
                ":rateMax" => $marginedRateMax,
            ]);

        } else {
            $stmt = "SELECT * FROM trades WHERE `rate` > :rateMin AND `rate` < :rateMax AND `status` = 'processing' AND `amountAsked` >= :amount AND `split` = 1 ORDER BY `rate` DESC";

            $result = $db->execute($stmt, [
                ":rateMin" => $marginalizedRateMin,
                ":rateMax" => $marginedRateMax,
                ":amount" => $amount
            ]);
        }

        if ($result->rowCount() == 0) {
            return false;
        }

        $trade = $result->fetch(PDO::FETCH_ASSOC);

        return $trade;
    }

    # limit trade Tx
    public function handleTicketLimitTrade(int $given, int $asked) {
        global $user;
        Discord::sendWebhookMessage("vcchat", "hello");
        if ($user->getTickets() < $given) {
            Discord::sendWebhookMessage("vcchat", "hi");
            return false;
        }

        // $given/$asked
        // cut off at ten-thousandths place
        Discord::sendWebhookMessage("vcchat", "hi2");
        $rate = $given/$asked;
        Discord::sendWebhookMessage("vcchat", (string)$rate);
        $rate = round($rate, 4, PHP_ROUND_HALF_DOWN);
        Discord::sendWebhookMessage("vcchat", "hi3");
        $isSplit = isset($_POST['ctl00$cphRoblox$AllowSplitTradesCheckBox']);

        Discord::sendWebhookMessage("vcchat", (string)$rate);

        return;

        // we need to check if any trades, at the same rate (maybe with .01% margin for error?) are available
        // so then we can simply take/complete from that trade
        
        //$user->takeTix($given);
        //$user->giveTix($output);
        $this->log($user->getUserId(), "Limit", "Tickets", $given, $asked, "processing", $isSplit);
    }

    # controller
    public function controller() {

        if (!Server::isPost()) {
            return;
        }

        if (!isset($_POST['ctl00$cphRoblox$OrderType'])) {
            return;
        }


        $amount = (int)$_POST['ctl00$cphRoblox$HaveAmountTextBox']; # #
        $asked = isset($_POST['ctl00$cphRoblox$WantAmountTextBox']) ? (int)$_POST['ctl00$cphRoblox$WantAmountTextBox'] : 0;
        $currency = $_POST['ctl00$cphRoblox$HaveCurrencyDropDownList']; #Tickets/Robux
        $orderType = $_POST['ctl00$cphRoblox$OrderType']; # MarketOrderRadioButton/LimitOrderRadioButton

        if ($currency == "Tickets" && $amount >= 20 || $currency == "Robux" && $amount > 0) {
            if ($orderType == "LimitOrderRadioButton") {
                global $user;
                if (!$user->hasPerms(7)) Server::_404();

                switch ($currency) {
                    case "Tickets":
                        if ($result = $this->handleTicketLimitTrade($amount, $asked)) {
                            Server::_self();
                        }

                        break;
                    case "Robux":
                        if ($result = $this->handleRobuxLimitTrade($amount, $asked)) {
                            Server::_self();
                        }

                            break;
                }
            } elseif ($orderType == "MarketOrderRadioButton") {
                switch ($currency) {
                case "Tickets":
                    if ($result = $this->handleTicketMarketTrade($amount)) {
                        Server::_self();
                    }

                    break;
                case "Robux":
                    if ($result = $this->handleRobuxMarketTrade($amount)) {
                        #Server::_self();
                    }

                    break;
                }
            }            
        }
    }

    # viewer
    public function viewer() {
        PageBuilder::addComponent("marketplace", "tradecurrency");
    }
}
?>