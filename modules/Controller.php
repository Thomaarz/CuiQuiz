<?php

include "mod_connection/ControllerConnection.php";

class Controller {

    private $controllerConnection;

    public function __construct() {
        $this->controllerConnection = new ControllerConnection();
    }

    public function test() {
        $module = "home";

        if (isset($_GET['module'])) {
            $module = $_GET['module'];
        }

        switch ($module) {
            case 'connection':
                $this->controllerConnection->main();
                break;
        }
    }
}