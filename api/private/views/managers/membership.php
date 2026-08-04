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
        PageBuilder::addComponent("membership", "main");
    }
}
?>