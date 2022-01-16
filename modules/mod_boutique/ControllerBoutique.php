<?php

require "ModeleBoutique.php";
require "VueBoutique.php";

class ControllerBoutique
{

    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleBoutique();
        $this->vue = new VueBoutique();
    }

    public function main() {
        if (!isset($_GET['category'])) {
            $categories = $this->modele->getCategories();
            $this->vue->categories($categories);
            return;
        }
        $category = $_GET['category'];

        $items = $this->modele->getItems($category);
        $this->vue->items($items);
    }
}