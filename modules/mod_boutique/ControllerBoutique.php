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
        // Buy confirm
        if (isset($_POST['form-recap'])) {
            $category = $_POST['category'];
            $price = $_POST['price'];
            $item_id = $_POST['item_id'];
            $item = $this->modele->getItem($item_id);

            // Item not exist
            if (!isset($item) || empty($item)) {
                $this->categories();
                return;
            }

            // User not connected
            if (!isset($_SESSION['user_name']) || empty($_SESSION['user_name'])) {
                $this->categories();
                return;
            }
            $user = (new ModeleConnection())->getUser($_SESSION['user_name']);
            if (!isset($user) || empty($user)) {
                $this->categories();
                return;
            }

            if ($user['user_coins'] < $price) {
                $this->vue->noCoins();
                header( "refresh:1;url=index.php?module=boutique");
                return;
            }

            $this->modele->removeCoins($price, $user['user_id']);

            switch ($category) {
                case "Grades":
                    $this->modele->setGrade($item_id + 1, $user['user_id']);
                    $this->vue->buySuccess();
                    header( "refresh:1;url=index.php?module=boutique");
                    return;
                case "Titres":
                    $this->modele->setTitre($item_id - 2, $user['user_id']);
                    $this->vue->buySuccess();
                    header( "refresh:1;url=index.php?module=boutique");
                    break;
                default:
                    $this->categories();
                    break;
            }
            return;
        }

        // Buy
        if (isset($_GET['action']) && $_GET['action'] == 'buy') {
            if (isset($_GET['item'])) {
                $item = $this->modele->getItem($_GET['item']);

                if (!isset($item) || empty($item)) {
                    $this->items();
                    return;
                }

                $this->vue->recap($item);
                return;
            }
        }

        // All categories
        if (!isset($_GET['category'])) {
            $this->categories();
            return;
        }

        $this->items();
    }

    private function categories() {
        $categories = $this->modele->getCategories();
        $this->vue->categories($categories);
    }

    private function items() {
        $category = $_GET['category'];

        // Show Items
        $items = $this->modele->getItems($category);
        $this->vue->items($items);
    }
}