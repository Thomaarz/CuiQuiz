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
            header( "refresh:0;url=index.php?module=connection");
            return;
        }

        $user = (new ModeleConnection())->getUser($_SESSION['user_name']);
        if (!isset($user) || empty($user)) {
            header( "refresh:0;url=index.php?module=connection&action=disconnect");
            return;
        }

        if (isset($_GET['action']) && $_GET['action'] == "historique") {
            if (isset($_GET['tentative'])) {
                $reponses = (new ModeleQuiz())->getReponses($_GET['tentative']);

                if (!isset($reponses) || empty($reponses)) {
                    header( "refresh:0;url=index.php?module=compte");
                    return;
                }

                $this->vue->historiqueTentative($reponses);
                return;
            }
            $user = (new ModeleConnection())->getUser($_SESSION['user_name']);
            $tentatives = (new ModeleQuiz())->getTentatives($user['user_id']);
            $this->vue->historique($tentatives);
            return;
        }

        $this->vue->infos($user);
    }
}