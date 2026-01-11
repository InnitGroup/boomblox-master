<?php
class EditUserProfileManager {
    public function __construct() {
        global $user;
        if (Server::isPost()) {
            if (isset($_POST["Timezone"])) {
                $timezone = $user->getTimezone();
                $timezones = [-10, -9, -8, -7, -6, -5, -4, -3, 0, 1, 2, 3, 4, 5, 8, 9, 10, 11, 12];
                $newTimezone = $_POST["Timezone"];
                if (!in_array($newTimezone, $timezones)) {
                    Server::_404();
                }

                if ($timezone !== $newTimezone) {
                    $user->setTimezone($newTimezone);
                }
            }

            if (isset($_POST["Occupation"])) {
                $occupation = $user->getOccupation();
                $newOccupation = $_POST["Occupation"];
                
                if (strlen($newOccupation) > 35) {
                    Server::_404();
                }

                if ($occupation !== $newOccupation) {
                    $user->setOccupation($newOccupation);
                }
            }

            if (isset($_POST["Interests"])) {
                $interests = $user->getInterests();
                $newInterests = $_POST["Interests"];

                if (strlen($newInterests) > 35) {
                    Server::_404();
                }
                
                if ($interests !== $newInterests) {
                    $user->setInterests($newInterests);
                }
            }

            if (isset($_POST["AolIm"])) {
                $aim = $user->getAIM();
                $newAim = $_POST["AolIm"];

                if (strlen($newAim) > 35) {
                    Server::_404();
                }
                
                if ($aim !== $newAim) {
                    $user->setAIM($newAim);
                }
            }

            if (isset($_POST["Icq"])) {
                $icq = $user->getICQ();
                $newIcq = $_POST["Icq"];

                if (strlen($newIcq) > 35) {
                    Server::_404();
                }
                
                if ($icq !== $newIcq) {
                    $user->setICQ($newIcq);
                }
            }

            if (isset($_POST["Location"])) {
                $location = $user->getLocation();
                $newLocation = $_POST["Location"];
                
                if (strlen($newLocation) > 35) {
                    Server::_404();
                }
                
                if ($location !== $newLocation) {
                    $user->setLocation($newLocation);
                }
            }

            if (isset($_POST["MsnIm"])) {
                $msn = $user->getMSN();
                $newMsn = $_POST["MsnIm"];

                if (strlen($newMsn) > 35) {
                    Server::_404();
                }
                
                if ($msn !== $newMsn) {
                    $user->setMSN($newMsn);
                }
            }

            if (isset($_POST["YahooIM"])) {
                $yahoo = $user->getYahoo();
                $newYahoo = $_POST["YahooIM"];

                if (strlen($newYahoo) > 35) {
                    Server::_404();
                }
                
                if ($yahoo !== $newYahoo) {
                    $user->setYahoo($newYahoo);
                }
            }

            if (isset($_POST["Website"])) {
                $website = $user->getWebsite();
                $newWebsite = $_POST["Website"];

                if (!filter_var($newWebsite, FILTER_VALIDATE_URL) && !empty($newWebsite)) {
                    Server::_404();
                }

                if (strlen($newWebsite) > 35) {
                    Server::_404();
                }
                
                if ($website !== $newWebsite) {
                    $user->setWebsite($newWebsite);
                }
            }

            if (isset($_POST["FakeEmail"])) {
                $pemail = $user->getPemail();
                $newPemail = $_POST["FakeEmail"];
                
                if (!preg_match('/[A-Za-z]+@[A-Za-z]+\\.[A-Za-z]+/i', $newPemail) && !empty($newPemail)) {
                    Server::_404();
                }

                if (strlen($newPemail) > 35) {
                    Server::_404();
                }

                if ($pemail !== $newPemail) {
                    $user->setPemail($newPemail);
                }
            }

            Server::_self();
        }
    }
};