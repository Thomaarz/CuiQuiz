<?php

include "ModeleAdministration.php";
include "VueAdministration.php";

class ControllerAdministration
{

    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleAdministration();
        $this->vue = new VueAdministration();
    }

    public function main() {
        $category = "";
        if (isset($_GET['category'])) {
            $category = $_GET['category'];
        }

        if (!isset($_SESSION['user_name']) || !isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header( "refresh:0;url=index.php?module=accueil");
            return;
        }

        switch ($category) {
            case "news":
                $this->news();
                break;
            default:
                break;
        }
    }

    public function news() {

        $action = "create";
        $actus_id = -1;
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }
        if (isset($_GET['actus_id'])) {
            $actus_id = $_GET['actus_id'];
        }

        switch ($action) {
            case 'edit':
                if ($actus_id == -1) {
                    $this->createActus();
                } else {
                    $this->updateActus($actus_id);
                }
                break;
            case 'delete':
                if ($actus_id == -1) {
                    $this->createActus();
                } else {
                    $this->deleteActus($actus_id);
                }
                break;
            default:
                $this->createActus();
        }


    }

    public function updateActus($actus_id) {
        // Update news
        if (isset($_POST['form-news-update'])) {

            $this->modele->updateNews($actus_id, $_POST['title'], $_POST['lore']);
            $this->vue->updateActusSuccess();
            header( "refresh:1;url=index.php?module=accueil");
            return;
        }

        $actus = $this->modele->getNews($actus_id);
        $this->vue->updateActus($actus);
    }

    public function deleteActus($actus_id) {
        // Delete news
        if (isset($_POST['form-news-delete'])) {

            $this->modele->deleteNews($actus_id);
            $this->vue->deleteActusSuccess();
            header( "refresh:1;url=index.php?module=accueil");
            return;
        }

        $actus = $this->modele->getNews($actus_id);
        $this->vue->deleteActus($actus);
    }

    public function createActus() {
        // Insert news
        if (isset($_POST['form-news-create'])) {

            $this->modele->insertNews($_SESSION['user_name'], $_POST['title'], $_POST['lore']);
            $this->vue->createSuccess();
            header( "refresh:1;url=index.php?module=accueil");
            return;
        }

        $this->vue->createActus();
    }
}