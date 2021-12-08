<?php

include "ModeleQuiz.php";
include "VueQuiz.php";

class ControllerQuiz {

    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleQuiz();
        $this->vue = new VueQuiz();
    }

    public function main() {

    }

}