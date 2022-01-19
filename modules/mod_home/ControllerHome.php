<?php

include "VueHome.php";
include "ModeleHome.php";

class ControllerHome
{

    private $vue;
    private $modele;

    public function __construct() {
        $this->vue = new VueHome();
        $this->modele = new ModeleHome();
    }

    public function main() {
        $actus = $this->modele->getActus();
        $this->vue->main($actus);
    }

}