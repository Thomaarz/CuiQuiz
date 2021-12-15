<?php

include "VueAccount.php";

class ControllerAccount
{

    private $modele;
    private $vue;

    public function __construct() {
        $this->vue = new VueAccount();
        $this->modele = new ModeleConnection();
    }

    public function main() {

         if (!isset($_SESSION['user_name'])) {
            return;
        }

        $user = $this->modele->getUser($_SESSION['user_name']);
        if (!isset($user) || empty($user)) {
            return;
        }

        $this->vue->main($user);
    }

}