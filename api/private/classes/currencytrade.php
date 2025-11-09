<?php
class CurrencyTrade {
    private int $orderId;
    private int $given;
    private int $asked;

    private string $currency;
    private string $shortCurrency;
    private string $type;

    private User $trader;
    private DateTime $occured;

    public function __construct(int $tradeId) {
        global $db, $theme;
        $stmt = "SELECT * FROM trades WHERE postId=:tradeId";
        $result = $db->execute($stmt, [":tradeId" => $tradeId]);
        $trade = $result->fetch(PDO::FETCH_ASSOC);

        $this->orderId = $tradeId;
        $this->currency = $trade["currency"];
        $this->type = $trade["orderType"];
        $this->trader = new User($trade["traderId"]);
        $this->shortCurrency = $this->currency == "Tickets" ? "Tx" : Site::getThemeProperty("shortCurrency", $theme);
        $this->given = $trade["amountGiven"];
        $this->asked = $trade["amountAsked"];
        $this->occured = new DateTime($trade["occured"]);
    }

    public function getId(): int { return $this->orderId; }
    public function given(): int { return $this->given; }
    public function asked(): int { return $this->asked; }
    public function currency(): string { return $this->currency; }
    public function shortCurrency(): string { return $this->shortCurrency; }
    public function type(): string { return $this->type; }
    public function trader(): User { return $this->trader; }

    public function askedCurrency(): string {
        global $theme;
        return $this->currency == "Tickets" ? Site::getThemeProperty("shortCurrency", $theme) : "Tx";
    }

    public function rate(): float {
        return round($this->given/$this->asked, "6");
    }

    public function getDate(): string {
        return $this->occured->format("m/d/Y g:i:s A");
    }

    public static function getTradeCountByUser(int $userId) {
        global $db;
        $stmt = "SELECT COUNT(*) AS tradeCount FROM trades WHERE traderId=:userId";
        $result = $db->execute($stmt, [":userId" => $userId]);
        $tradeCount = $result->fetch(PDO::FETCH_ASSOC)["tradeCount"];

        return $tradeCount;
    }
};
?>