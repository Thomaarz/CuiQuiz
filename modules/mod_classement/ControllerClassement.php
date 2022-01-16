<?php

require "ModeleClassement.php";
require "VueClassement.php";

class ControllerClassement
{

    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleClassement();
        $this->vue = new VueClassement();
    }

    public function main() {
        $users = $this->modele->getUsersByLevel();
        $this->vue->classement($users);
    }
}