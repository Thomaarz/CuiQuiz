<?php

include "VueHome.php";

class ControllerHome
{

    private $vue;

    public function __construct() {
        $this->vue = new VueHome();
    }

    public function main() {
        $this->vue->main();
    }

}