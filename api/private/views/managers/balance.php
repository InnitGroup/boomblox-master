<?php
class BalanceManager {
    private $theme;
    private $user;
    public function __construct($theme) {
        $this->theme = $theme;
    }
	public function load() {
		$theme = $this->theme;
		$packed = compact("theme");
		PageBuilder::addComponent("balance", "top", $packed);
		PageBuilder::addComponent("balance", "about", $packed);
		PageBuilder::addComponent("balance", "earnings", $packed);
	}
}
?>