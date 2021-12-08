<?php

include "mod_connection/ControllerConnection.php";

class Controller {

    private $controllerConnection;

    public function __construct() {
        $this->controllerConnection = new ControllerConnection();
    }

    public function test() {
        $module = "accueil";
        $action = "";

        if (isset($_GET['module'])) {
            $module = $_GET['module'];
        }
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }

        switch ($module) {
            case 'connection':
                if ($action == 'connect') {
                    $this->controllerConnection->connect();
                } else if ($action == 'register') {
                    $this->controllerConnection->register();
                } else if ($action == 'disconnect') {
                    $this->controllerConnection->disconnect();
                }
                break;
        }
    }

}