<?php

include "VueAccount.php";

class ControllerAccount
{

    private $vue;

    public function __construct() {
        $this->vue = new VueAccount();
    }

    public function main() {
        if (!isset($_SESSION['user_name'])) {
            return;
        }

        $user = (new ModeleConnection())->getUser($_SESSION['user_name']);
        if (!isset($user) || empty($user)) {
            return;
        }

        $this->vue->infos($user);
    }
}